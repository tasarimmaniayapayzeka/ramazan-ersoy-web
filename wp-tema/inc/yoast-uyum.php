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
 * JPEG eklenir (og:image için WebP değil JPEG — WhatsApp ve eski
 * önizleyiciler WebP'yi her zaman göstermez).
 *
 * NEDEN ACTION: `wpseo_opengraph_image` filtresi yalnız VAR OLAN görseli
 * süzer; hiç görsel bulunamadıysa presenter hiç çalışmaz ve filtre
 * tetiklenmez (canlıda böyle yakalandı — og:image tamamen yoktu).
 * Görsel EKLEMENİN doğru yolu bu action'daki konteyner.
 */
add_action('wpseo_add_opengraph_images', function ($konteyner) {
    if (!is_singular(['hastalik', 'test', 'tedavi', 'rehber'])) return;
    if (has_post_thumbnail()) return;   /* öne çıkan varsa Yoast zaten alır */
    $slug = get_post_field('post_name', get_the_ID());
    if (file_exists(dirname(ABSPATH) . '/assets/img/icerik/' . $slug . '-1440.jpg')) {
        $konteyner->add_image_by_url('https://drramazanersoy.tr/assets/img/icerik/' . $slug . '-1440.jpg');
    }
});
