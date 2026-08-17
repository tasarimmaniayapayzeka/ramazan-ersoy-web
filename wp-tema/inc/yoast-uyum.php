<?php
/**
 * Yoast ince ayarları — temanın Yoast'la tam uyumu.
 *
 * İLKE: veri TEK yerde durur. Meta açıklama drre_desc alanında,
 * görseller assets/img/icerik/ altında; Yoast bunları filtreyle alır.
 * İkinci bir kopya tutulsaydı zamanla sapacaklardı (bu projede SSS
 * çiftlenmesi tam olarak böyle bir hatadan doğmuştu).
 */
if (!defined('ABSPATH')) exit;

/* Başlık ayracı: "|" — site genelinde tek dil.
   `wpseo_separator` filtresi canlıda İŞLEMEDİ (başlıklar "-" ile çıktı);
   ayraç seçenek katmanından okunuyor olmalı. Seçeneği doğrudan ve
   İDEMPOTENT biçimde ayarlıyoruz: her yüklemede kontrol, farklıysa yaz. */
add_action('init', function () {
    if (!function_exists('YoastSEO')) return;
    try {
        $secenek = YoastSEO()->helpers->options;
        if ($secenek->get('separator') !== 'sc-pipe') {
            $secenek->set('separator', 'sc-pipe');
        }
    } catch (\Throwable $e) { /* Yoast yoksa sessiz geç */ }
}, 20);

/* XML sitemap TEK KAYNAK: kökteki statik sitemap.xml (build-sitemap.js
   üretir, tüm adresleri yeni biçimde içerir). Yoast'ın ikinci bir sitemap
   yayınlaması Search Console'da çift kayıt ve çelişki yaratır — kapalı.
   Filtre tek başına yetmedi (gece denetimi sitemap_index.xml'i 200 buldu),
   seçenek de idempotent kapatılıyor; .htaccess ayrıca 301'lüyor. */
add_filter('wpseo_enable_xml_sitemaps', '__return_false');
add_action('init', function () {
    if (!function_exists('YoastSEO')) return;
    try {
        $s = YoastSEO()->helpers->options;
        if ($s->get('enable_xml_sitemap')) $s->set('enable_xml_sitemap', false);
    } catch (\Throwable $e) {}
}, 21);

/* Yazar arşivi: tek yazarlı sitede yalnız kullanıcı adı sızdırır
   (?author=1 → /author/ersoy-yonetim/ — gece denetimi yakaladı).
   Arşiv 404'e düşürülür; .htaccess ?author= taramasını ayrıca keser. */
add_action('template_redirect', function () {
    if (is_author()) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
    }
});

/* Meta açıklama: Yoast alanı boşsa drre_desc devreye girer.
   Böylece hoca ileride Yoast kutusunu doldurursa o kazanır;
   doldurmadıysa içerik üretim hattının yazdığı açıklama çıkar. */
add_filter('wpseo_metadesc', function ($desc) {
    if ($desc) return $desc;
    /* 'page' dahil: tam devirde statikten gelen sayfaların eski meta
       açıklamaları drre_desc'e taşındı (sayfa-olustur.php) */
    if (is_singular(['hastalik', 'test', 'tedavi', 'rehber', 'page'])) {
        return (string) get_post_meta(get_the_ID(), 'drre_desc', true);
    }
    return $desc;
});

/**
 * Paylaşım görseli: öne çıkan görsel atanmadıysa slug sözleşmesindeki
 * JPEG eklenir (og:image için WebP değil JPEG — WhatsApp ve eski
 * önizleyiciler WebP'yi her zaman göstermez).
 *
 * NEDEN ACTION: `wpseo_opengraph_image` filtresi yalnız VAR OLAN görseli
 * süzer; hiç görsel bulunamadıysa presenter hiç çalışmaz ve filtre
 * tetiklenmez (canlıda böyle yakalandı — og:image tamamen yoktu).
 * Görsel EKLEMENİN doğru yolu bu action'daki konteyner.
 */
add_action('wpseo_add_opengraph_images', function ($konteyner) {
    if (has_post_thumbnail()) return;   /* öne çıkan varsa Yoast zaten alır */
    if (is_singular(['hastalik', 'test', 'tedavi', 'rehber'])) {
        $slug = get_post_field('post_name', get_the_ID());
        if (file_exists(dirname(ABSPATH) . '/assets/img/icerik/' . $slug . '-1440.jpg')) {
            $konteyner->add_image_by_url('https://drramazanersoy.tr/assets/img/icerik/' . $slug . '-1440.jpg');
            return;
        }
    }
    /* Sayfalar + anasayfa + arşivler: genel paylaşım kartı. twitter:card
       ilan edilip og:image verilmemesi (gece denetimi bulgusu) önizlemeyi
       platformun insafına bırakıyordu. */
    $konteyner->add_image_by_url('https://drramazanersoy.tr/assets/img/og.jpg');
});
