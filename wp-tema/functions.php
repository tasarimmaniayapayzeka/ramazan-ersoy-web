<?php
/**
 * DRRE teması — çekirdek işlevler
 *
 * TASARIM KAYNAĞI: Stil dosyaları temaya KOPYALANMAZ. Statik sitenin
 * assets/ klasörü public_html kökünde duruyor ve orada kalacak; tema
 * oradan bağlanır. Böylece tek kaynak korunur — site.css'e yapılan bir
 * düzeltme hem statik sayfalarda hem WordPress'te aynı anda geçerli olur.
 * Kopyalasaydık iki sürüm doğar ve zamanla birbirinden saparlardı
 * (bu projede SSS'lerin JSON-LD ile sapması tam olarak böyle oldu).
 */

if (!defined('ABSPATH')) exit;

/** Statik sitenin kök adresi. WP alt dizinde (/wp-yeni/) kurulu olduğu için
 *  varlıklar bir üst dizinden gelir. Yayına geçildiğinde bu sabit '/' olur. */
define('DRRE_KOK', '/');

/* ============================================================
   0) PARÇALAR
   İçerik tipleri (hastalik/test/tedavi/rehber + alan kutuları) ve
   tıbbi şema üreteci ayrı dosyalarda. Bu satırlar olmadan CPT'ler
   kaydolmaz ve JSON-LD basılmaz — tema sessizce yarım çalışır.
   ============================================================ */
require_once get_template_directory() . '/inc/icerik-tipleri.php';
require_once get_template_directory() . '/inc/sema.php';
require_once get_template_directory() . '/inc/gorsel-alt.php';
require_once get_template_directory() . '/inc/yoast-uyum.php';

/* ============================================================
   1) STİL VE BETİKLER
   ============================================================ */
function drre_varliklar() {
    $v = '20260816';   /* önbellek kırıcı — site.css değişince elle artır */

    /* tokens.css'i ayrıca bağlamıyoruz: site.css onu @import ediyor. */
    wp_enqueue_style('drre-site', DRRE_KOK . 'assets/css/site.css', [], $v);
    wp_enqueue_style('drre-chatbot', DRRE_KOK . 'assets/css/chatbot.css', ['drre-site'], $v);

    wp_enqueue_script('drre-site', DRRE_KOK . 'assets/js/site.js', [], $v, true);
    wp_enqueue_script('drre-chatbot', DRRE_KOK . 'assets/js/chatbot.js', [], $v, true);
}
add_action('wp_enqueue_scripts', 'drre_varliklar');

/** Fontlar preload edilir — statik sitedeki <head> ile aynı davranış.
 *  Fraunces 600 (başlıklar) ve Mulish 400 (gövde) ilk boyamada gerekiyor. */
function drre_font_preload() {
    $f = [ 'fraunces-600-lat.woff2', 'mulish-400-lat.woff2' ];
    foreach ($f as $d) {
        printf('<link rel="preload" href="%sassets/fonts/%s" as="font" type="font/woff2" crossorigin>' . "\n",
            esc_url(DRRE_KOK), esc_attr($d));
    }
}
add_action('wp_head', 'drre_font_preload', 1);

/* ============================================================
   2) WORDPRESS ÇIKTISINI BUDAMA
   Varsayılan kurulum 68 KB'lık sayfa üretiyordu; bunların hiçbirini
   kullanmıyoruz. Blok editörü YAZARKEN çalışmaya devam eder — burada
   yalnızca ÖN YÜZ çıktısı temizleniyor.
   ============================================================ */
function drre_temizle() {
    /* Blok/tema stilleri: tasarımımız site.css'ten geliyor, bunlar çakışır */
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style('global-styles');

    /* Gömme betiği: dış içerik gömmüyoruz */
    wp_dequeue_script('wp-embed');
}
add_action('wp_enqueue_scripts', 'drre_temizle', 100);

/* Emoji: ~10 KB betik + harici s.w.org bağlantısı. Türkçe içerikte
   emoji kullanılmıyor (v2 rebrand'de emoji 33 sayfadan temizlenmişti). */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
add_filter('emoji_svg_url', '__return_false');

/* Sürüm numarasını gizle: saldırganlar sürüme göre bilinen açık arar */
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

/* Kullanılmayan keşif etiketleri */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'feed_links_extra', 3);

/* XML-RPC: kaba kuvvet saldırılarının başlıca hedefi, ihtiyacımız yok */
add_filter('xmlrpc_enabled', '__return_false');

/* Kullanıcı listeleme ucunu kapat (/wp-json/wp/v2/users kullanıcı adı sızdırır) */
add_filter('rest_endpoints', function ($uclar) {
    unset($uclar['/wp/v2/users'], $uclar['/wp/v2/users/(?P<id>[\d]+)']);
    return $uclar;
});

/* ============================================================
   3) TEMA DESTEKLERİ
   ============================================================ */
function drre_kurulum() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    register_nav_menus([ 'ana' => 'Ana menü', 'alt' => 'Alt bilgi menüsü' ]);
}
add_action('after_setup_theme', 'drre_kurulum');

/* Yorumlar tamamen kapalı: hasta yorumu/hasta deneyimi yayımlamak
   12.11.2025/33075 Tanıtım Yönetmeliği'nde YASAK. Açık bırakılan bir
   yorum alanı, mevzuata aykırı içeriğin siteye girmesinin en kolay yolu. */
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
add_filter('comments_array', '__return_empty_array', 10, 2);
