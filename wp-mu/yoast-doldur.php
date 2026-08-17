<?php
/**
 * TEK SEFERLİK — Yoast odak anahtar kelimesi doldurma (17 Ağu 2026).
 * İçerik üretim hattının belirlediği odak kelimeler Yoast'ın kendi
 * alanına yazılır; böylece düzenleme ekranındaki analiz çalışır ve
 * kırmızı "anahtar kelime yok" uyarıları kapanır. Yalnız BOŞ alana
 * yazar — hoca ileride elle girdiyse dokunmaz. Bitince bayrakla
 * kilitlenir; dosya sonraki dağıtımda kaldırılacak.
 */
if (!defined('ABSPATH')) exit;

add_action('init', function () {
    if (get_option('drre_focuskw_2026_08_17')) return;

    $esleme = [
        'alerji-asisi-immunoterapi' => 'alerji aşısı',
        'alerji-asisi-sss' => 'alerji aşısı sık sorulan sorular',
        'alerjik-rinit' => 'alerjik rinit',
        'anafilaksi' => 'anafilaksi',
        'ari-alerjisi' => 'arı alerjisi',
        'astim' => 'yetişkinlerde astım',
        'besin-alerjisi' => 'besin alerjisi',
        'deri-prick-testi' => 'deri prick testi',
        'ev-tozu-akari-yatak-odasi' => 'ev tozu akarı',
        'evcil-hayvan-alerjisi' => 'evcil hayvan alerjisi',
        'gebelikte-alerji-ve-astim' => 'gebelikte alerji ve astım',
        'herediter-anjiyoodem' => 'herediter anjiyoödem',
        'ilac-alerjisi' => 'ilaç alerjisi',
        'klima-ve-ic-ortam-alerjenleri' => 'klima ve iç ortam alerjenleri',
        'mastositoz' => 'mastositoz',
        'provokasyon-testleri' => 'provokasyon testi',
        'solunum-fonksiyon-testi' => 'solunum fonksiyon testi',
        'spesifik-ige-kan-testi' => 'spesifik IgE kan testi',
        'urtiker' => 'ürtiker',
        'yama-testi' => 'yama testi',
        'yetiskinlikte-baslayan-astim' => 'yetişkinlikte başlayan astım',
    ];

    $yazilan = 0;
    foreach ($esleme as $slug => $kelime) {
        $p = get_page_by_path($slug, OBJECT, ['hastalik', 'test', 'tedavi', 'rehber']);
        if (!$p) continue;
        if (get_post_meta($p->ID, '_yoast_wpseo_focuskw', true) === '') {
            update_post_meta($p->ID, '_yoast_wpseo_focuskw', $kelime);
            $yazilan++;
        }
    }
    update_option('drre_focuskw_2026_08_17', 'yazilan:' . $yazilan, false);
}, 99);
