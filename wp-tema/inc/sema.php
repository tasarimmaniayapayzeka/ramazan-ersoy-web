<?php
/**
 * Tıbbi şema (JSON-LD) — SEO'nun asıl değer taşıyan katmanı
 *
 * NEDEN EKLENTİ DEĞİL: Yoast ve RankMath yalnızca genel şema üretir
 * (WebPage / Article / Person / Organization / BreadcrumbList).
 * Bu sitede 42 sayfada 100 blok var ve büyük kısmı TIBBİ:
 * MedicalCondition, MedicalTest, MedicalTherapy, Physician.
 * Eklentiye devretmek bu katmanı kaybetmek olurdu.
 *
 * YOAST İLE İŞ BÖLÜMÜ: Yoast kuruluysa sayfa künyesi (WebPage/Article/
 * Breadcrumb) ondan gelir; biz YALNIZCA tıbbi katmanı ekleriz. @id
 * çakışması olmaması için kendi düğümlerimize ayrı @id veriyoruz.
 */
if (!defined('ABSPATH')) exit;

function drre_yoast_var() {
    return defined('WPSEO_VERSION');
}

/* ============================================================
   SSS — TEK KAYNAK
   Alandaki düz metin hem sayfadaki <details> bloğunu hem FAQPage
   şemasını üretir. Statik sitede bu ikisi AYRI AYRI elle yazılıyordu
   ve astim.html'de birbirinden sapmıştı (aynı soruya iki farklı cevap).
   Tek kaynaktan üretilince o hata sınıfı yapısal olarak imkânsızlaşır.
   ============================================================ */
function drre_sss_ayikla($id) {
    $ham = trim((string) get_post_meta($id, 'drre_sss', true));
    if ($ham === '') return [];

    $sonuc = [];
    /* Boş satır SSS'leri ayırır; ilk satır soru, kalanı cevap. */
    foreach (preg_split('/\R{2,}/u', $ham) as $blok) {
        $satir = preg_split('/\R/u', trim($blok));
        if (count($satir) < 2) continue;
        $soru = trim(array_shift($satir));
        $cevap = trim(implode(' ', array_map('trim', $satir)));
        if ($soru === '' || $cevap === '') continue;
        $sonuc[] = ['soru' => $soru, 'cevap' => $cevap];
    }
    return $sonuc;
}

/** Sayfada gösterilen SSS bloğu — şemayla AYNI veriden. */
function drre_sss_yaz($id) {
    $sss = drre_sss_ayikla($id);
    if (!$sss) return;
    echo '<section class="section section--tight"><div class="wrap-narrow">';
    echo '<h2>Sık sorulan sorular</h2>';
    foreach ($sss as $s) {
        printf(
            '<details class="faq"><summary>%s</summary><div class="faq-body"><p>%s</p></div></details>',
            esc_html($s['soru']),
            esc_html($s['cevap'])
        );
    }
    echo '</div></section>';
}

/* ============================================================
   ŞEMA ÇIKTISI
   ============================================================ */
function drre_sema() {
    if (!is_singular(['hastalik', 'test', 'tedavi', 'rehber'])) return;

    $id   = get_the_ID();
    $tip  = get_post_type();
    $url  = get_permalink($id);
    $ad   = get_the_title($id);
    $ozet = trim((string) get_post_meta($id, 'drre_ozet', true));
    if ($ozet === '') $ozet = wp_strip_all_tags(get_the_excerpt($id));

    $dugumler = [];

    /* --- 1) Tıbbi düğüm: içerik tipine göre --- */
    $tibbi = null;
    if ($tip === 'hastalik') {
        $tibbi = ['@type' => 'MedicalCondition', 'name' => $ad, 'description' => $ozet];
    } elseif ($tip === 'test') {
        $tibbi = ['@type' => 'MedicalTest', 'name' => $ad, 'description' => $ozet,
                  'usedToDiagnose' => ['@type' => 'MedicalCondition', 'name' => 'Alerjik hastalıklar']];
    } elseif ($tip === 'tedavi') {
        $tibbi = ['@type' => 'MedicalTherapy', 'name' => $ad, 'description' => $ozet];
    }
    if ($tibbi) {
        $tibbi['@id'] = $url . '#tibbi';
        $tibbi['url'] = $url;
        /* Sağlık içeriğinde kaynağı belli etmek E-E-A-T açısından önemli */
        $tibbi['recognizingAuthority'] = [
            '@type' => 'Physician',
            'name'  => 'Uzm. Dr. Ramazan Ersoy',
            'medicalSpecialty' => 'Allergy',
        ];
        $dugumler[] = $tibbi;
    }

    /* --- 2) FAQPage: sayfadaki SSS ile AYNI veriden --- */
    $sss = drre_sss_ayikla($id);
    if ($sss) {
        $sorular = [];
        foreach ($sss as $s) {
            $sorular[] = [
                '@type' => 'Question',
                'name'  => $s['soru'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $s['cevap']],
            ];
        }
        $dugumler[] = ['@type' => 'FAQPage', '@id' => $url . '#sss', 'mainEntity' => $sorular];
    }

    /* --- 3) Sayfa künyesi: YALNIZCA Yoast yoksa --- */
    if (!drre_yoast_var()) {
        $inceleme = get_post_meta($id, 'drre_inceleme', true);
        $dugumler[] = [
            '@type' => 'MedicalWebPage',
            '@id'   => $url . '#sayfa',
            'url'   => $url,
            'name'  => $ad,
            'description' => $ozet,
            'inLanguage' => 'tr-TR',
            'datePublished' => get_the_date('c', $id),
            'dateModified'  => get_the_modified_date('c', $id),
            'lastReviewed'  => $inceleme ?: get_the_modified_date('Y-m-d', $id),
            'reviewedBy' => [
                '@type' => 'Physician',
                'name'  => 'Uzm. Dr. Ramazan Ersoy',
                'medicalSpecialty' => 'Allergy',
            ],
        ];
    }

    if (!$dugumler) return;
    echo "\n<script type=\"application/ld+json\">"
       . wp_json_encode(['@context' => 'https://schema.org', '@graph' => $dugumler],
                        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
       . "</script>\n";
}
add_action('wp_head', 'drre_sema', 20);
