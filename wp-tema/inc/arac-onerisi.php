<?php
/**
 * İçerik sayfalarına bağlamsal araç önerisi
 *
 * Araç, hastanın derdiyle uğraştığı sayfada teklif edilir — menüde
 * durması yetmez. Eşleme içerik slug'ı üzerinden; kartlar single.php'de
 * künyeden önce basılır.
 */
if (!defined('ABSPATH')) exit;

function drre_arac_onerileri($slug) {
    $araclar = [
        'etiket' => ['Etiket Dedektifi', '/araclar/etiket-dedektifi/',
            'İçindekiler listesindeki gizli alerjen adlarını sizin için tarayalım.'],
        'acil-kart' => ['Acil Plan Kartı', '/araclar/acil-plan-karti/',
            'Cüzdan kartı + buzdolabı sayfası: kişisel anafilaksi planınızı yazdırın.'],
        'rota' => ['Belirti Yol Haritası', '/araclar/belirti-yol-haritasi/',
            'Nereden başlayacağınızdan emin değilseniz şikayetinizi yazın, yol gösterelim.'],
        'ev-risk' => ['Ev Ortamı Risk Haritası', '/araclar/ev-ortami-risk-haritasi/',
            '10 soruda evinizin alerjen yükü + öncelik sıralı eylem planı.'],
    ];
    $esleme = [
        'besin-alerjisi' => ['etiket', 'acil-kart'],
        'anafilaksi' => ['acil-kart'],
        'ari-alerjisi' => ['acil-kart'],
        'mastositoz' => ['acil-kart'],
        'ilac-alerjisi' => ['acil-kart'],
        'astim' => ['rota', 'ev-risk'],
        'alerjik-rinit' => ['rota', 'ev-risk'],
        'urtiker' => ['rota'],
        'herediter-anjiyoodem' => [],
        'ev-tozu-akari-yatak-odasi' => ['ev-risk'],
        'klima-ve-ic-ortam-alerjenleri' => ['ev-risk'],
        'evcil-hayvan-alerjisi' => ['ev-risk', 'rota'],
        'gebelikte-alerji-ve-astim' => ['rota'],
        'yetiskinlikte-baslayan-astim' => ['rota'],
        'deri-prick-testi' => ['rota'],
        'spesifik-ige-kan-testi' => ['rota'],
        'solunum-fonksiyon-testi' => ['rota'],
        'yama-testi' => ['rota'],
        'provokasyon-testleri' => ['rota'],
    ];
    if (empty($esleme[$slug])) return;
    echo '<h2 style="margin-top:2.5rem">Size yardımcı olabilecek araçlar</h2><div class="grid-2">';
    foreach ($esleme[$slug] as $anahtar) {
        [$baslik, $url, $kisa] = $araclar[$anahtar];
        printf('<a class="tool-card" href="%s"><h3>%s</h3><p>%s</p></a>',
            esc_url($url), esc_html($baslik), esc_html($kisa));
    }
    echo '</div>';
}
