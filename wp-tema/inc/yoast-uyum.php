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

/* Başlık ayracı: statik sayfalar "|" kullanıyor; site genelinde tek dil */
add_filter('wpseo_separator', function () { return '|'; });

/* XML sitemap TEK KAYNAK: kökteki statik sitemap.xml (build-sitemap.js
   üretir, taşınan 21 sayfayı yeni adresleriyle zaten içerir). Yoast'ın
   ikinci bir sitemap yayınlaması Search Console'da çift kayıt ve
   çelişki yaratır — kapalı. */
add_filter('wpseo_enable_xml_sitemaps', '__return_false');

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
 * JPEG kullanılır (og:image için WebP değil JPEG — WhatsApp ve eski
 * önizleyiciler WebP'yi her zaman göstermez).
 */
function drre_paylasim_gorseli($url) {
    if ($url) return $url;
    if (!is_singular(['hastalik', 'test', 'tedavi', 'rehber'])) return $url;
    $slug = get_post_field('post_name', get_the_ID());
    if (file_exists(dirname(ABSPATH) . '/assets/img/icerik/' . $slug . '-1440.jpg')) {
        return 'https://drramazanersoy.tr/assets/img/icerik/' . $slug . '-1440.jpg';
    }
    return $url;
}
add_filter('wpseo_opengraph_image', 'drre_paylasim_gorseli');
add_filter('wpseo_twitter_image', 'drre_paylasim_gorseli');
