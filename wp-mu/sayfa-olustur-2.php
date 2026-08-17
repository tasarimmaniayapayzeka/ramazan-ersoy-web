<?php
/**
 * TEK SEFERLİK — araç sayfaları kurulumu (17 Ağu 2026, 2. dalga).
 * 4 yeni aracın WP sayfalarını araclar ebeveyni altına kurar,
 * şablonlarını atar, meta açıklamalarını yazar. Bitince kilitlenir;
 * dosya sonraki dağıtımda kaldırılır.
 */
if (!defined('ABSPATH')) exit;

add_action('init', function () {
    if (get_option('drre_arac_sayfalari_2026_08_17')) return;

    $ebeveyn = get_page_by_path('araclar', OBJECT, 'page');
    $ebeveynId = $ebeveyn ? $ebeveyn->ID : 0;

    $araclar = [
        ['slug' => 'etiket-dedektifi', 'baslik' => 'Etiket Dedektifi: Gizli Alerjen Tarayıcı',
         'sablon' => 'page-templates/t-etiket-dedektifi.php',
         'desc' => 'İçindekiler listesini yapıştırın, alerjenlerinizi seçin: kazein, E-322, peynir altı suyu gibi gizli alerjen adlarını sizin için tarayalım. Ücretsiz araç.'],
        ['slug' => 'belirti-yol-haritasi', 'baslik' => 'Belirti Yol Haritası: Nereden Başlamalı?',
         'sablon' => 'page-templates/t-belirti-yol-haritasi.php',
         'desc' => 'Şikayetinizi kendi cümlelerinizle yazın; sitedeki doğru sayfaları ve size uygun alerji testini önerelim. Teşhis koymaz, yol gösterir.'],
        ['slug' => 'acil-plan-karti', 'baslik' => 'Anafilaksi Acil Plan Kartı Oluşturucu',
         'sablon' => 'page-templates/t-acil-plan-karti.php',
         'desc' => 'Anafilaksi riski taşıyanlar için kişisel cüzdan kartı ve buzdolabı sayfası: alerjenler, otoenjektör bilgisi ve kanonik ilk yardım sırası — yazdırmaya hazır.'],
        ['slug' => 'ev-ortami-risk-haritasi', 'baslik' => 'Ev Ortamı Alerjen Risk Haritası',
         'sablon' => 'page-templates/t-ev-ortami-risk-haritasi.php',
         'desc' => '10 soruda evinizin alerjen yükünü değerlendirin: akar, küf, nem, evcil hayvan. Sonunda evinize özel, öncelik sıralı eylem planı — anonim ve ücretsiz.'],
    ];

    $kurulan = 0;
    foreach ($araclar as $a) {
        if (get_page_by_path('araclar/' . $a['slug'], OBJECT, 'page')) continue;
        $id = wp_insert_post([
            'post_type' => 'page', 'post_status' => 'publish',
            'post_title' => $a['baslik'], 'post_name' => $a['slug'],
            'post_parent' => $ebeveynId, 'post_content' => '',
        ]);
        if (!is_wp_error($id)) {
            update_post_meta($id, '_wp_page_template', $a['sablon']);
            update_post_meta($id, 'drre_desc', $a['desc']);
            $kurulan++;
        }
    }
    update_option('drre_arac_sayfalari_2026_08_17', 'kuruldu:' . $kurulan, false);
    flush_rewrite_rules();
}, 99);
