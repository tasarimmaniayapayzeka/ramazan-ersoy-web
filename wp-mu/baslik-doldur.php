<?php
/**
 * TEK SEFERLİK — Yoast özel başlık + kurulum artığı temizliği (17 Ağu 2026).
 * seoBaslik'lar Yoast başlık alanına yazılır (65 karakter bulgusu);
 * sample-page / hello-world silinir (canlıda ve sitemap'te görünüyordu).
 * Yalnız BOŞ alana yazar; bitince bayrakla kilitlenir, dosya kaldırılır.
 */
if (!defined('ABSPATH')) exit;

add_action('init', function () {
    if (get_option('drre_baslik_2026_08_17')) return;

    $esleme = [
        'alerji-asisi-immunoterapi' => 'Alerji Aşısı (İmmünoterapi) Nedir?',
        'alerji-asisi-sss' => 'Alerji Aşısı Sık Sorulan Sorular',
        'alerjik-rinit' => 'Alerjik Rinit Belirtileri',
        'anafilaksi' => 'Anafilaksi (Alerjik Şok)',
        'ari-alerjisi' => 'Arı Alerjisi: Belirti ve Tedavi',
        'astim' => 'Yetişkinlerde Astım',
        'besin-alerjisi' => 'Besin Alerjisi Belirtileri',
        'deri-prick-testi' => 'Deri Prick Testi Nasıl Yapılır?',
        'ev-tozu-akari-yatak-odasi' => 'Ev Tozu Akarı: Yatak Odası Rehberi',
        'evcil-hayvan-alerjisi' => 'Evcil Hayvan Alerjisiyle Yaşam',
        'gebelikte-alerji-ve-astim' => 'Gebelikte Alerji ve Astım',
        'herediter-anjiyoodem' => 'Herediter Anjiyoödem (HAÖ)',
        'ilac-alerjisi' => 'İlaç Alerjisi ve Testi',
        'klima-ve-ic-ortam-alerjenleri' => 'Klima ve İç Ortam Alerjenleri',
        'mastositoz' => 'Mastositoz Belirtileri ve Triptaz',
        'provokasyon-testleri' => 'Provokasyon Testi Nedir?',
        'solunum-fonksiyon-testi' => 'Solunum Fonksiyon Testi',
        'spesifik-ige-kan-testi' => 'Spesifik IgE Kan Testi',
        'urtiker' => 'Ürtiker (Kurdeşen)',
        'yama-testi' => 'Yama Testi (Patch Test)',
        'yetiskinlikte-baslayan-astim' => 'Yetişkinlikte Başlayan Astım',
    ];
    $yazilan = 0;
    foreach ($esleme as $slug => $baslik) {
        $p = get_page_by_path($slug, OBJECT, ['hastalik', 'test', 'tedavi', 'rehber']);
        if (!$p) continue;
        if (get_post_meta($p->ID, '_yoast_wpseo_title', true) === '') {
            /* %%sep%% %%sitename%% kuyruğu Yoast şablon değişkeniyle */
            update_post_meta($p->ID, '_yoast_wpseo_title', $baslik . ' %%sep%% %%sitename%%');
            $yazilan++;
        }
    }

    $silinen = 0;
    foreach ([['page', 'sample-page'], ['post', 'hello-world'], ['page', 'ornek-sayfa'], ['post', 'merhaba-dunya']] as [$tip, $slug]) {
        $p = get_page_by_path($slug, OBJECT, $tip);
        if ($p) { wp_delete_post($p->ID, true); $silinen++; }
    }

    update_option('drre_baslik_2026_08_17', "baslik:$yazilan artik:$silinen", false);
}, 99);
