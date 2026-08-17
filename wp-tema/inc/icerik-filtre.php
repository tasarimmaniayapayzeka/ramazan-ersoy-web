<?php
/**
 * İçerik render filtreleri
 *
 * 1) ESKİ ADRES DÖNÜŞÜMÜ: WXR ile gelen gövdelerde iç bağlantılar eski
 *    statik .html biçiminde (DB'de ~20 sayfada). 301'ler kullanıcıyı
 *    kurtarıyor ama site-içi linkin yönlendirmesiz olması hem hız hem
 *    SEO hijyeni. DB'ye dokunmak yerine gösterim anında çevrilir —
 *    böylece hoca ileride eski alışkanlıkla .html yapıştırsa bile sayfa
 *    hep doğru çıkar.
 *
 * 2) 112 BAĞLANTISI: acil metinlerdeki çıplak "112'yi arayın" ifadeleri
 *    tıklanabilir tel: bağlantısına çevrilir (zaten bağlantılı olanlar
 *    korunur). Mobilde tek dokunuş hayat kurtarır.
 */
if (!defined('ABSPATH')) exit;

function drre_eski_adres_haritasi() {
    static $h = null;
    if ($h !== null) return $h;
    $h = [];
    $gruplar = [
        'hastaliklar' => ['alerjik-rinit','astim','urtiker','besin-alerjisi','ilac-alerjisi','ari-alerjisi','herediter-anjiyoodem','mastositoz','anafilaksi'],
        'testler' => ['deri-prick-testi','spesifik-ige-kan-testi','solunum-fonksiyon-testi','yama-testi','provokasyon-testleri'],
        'tedaviler' => ['alerji-asisi-immunoterapi','alerji-asisi-sss'],
        'alerji-rehberi' => ['ev-tozu-akari-yatak-odasi','evcil-hayvan-alerjisi','gebelikte-alerji-ve-astim','klima-ve-ic-ortam-alerjenleri','yetiskinlikte-baslayan-astim'],
        'araclar' => ['alerji-mi-soguk-alginligi-mi','astim-kontrol-testi','polen-takvimi','video-kutuphanesi'],
        'hasta-merkezi' => ['ikinci-gorus','online-on-degerlendirme','randevunuza-hazirlanin'],
    ];
    foreach ($gruplar as $dizin => $sluglar) {
        foreach ($sluglar as $s) $h["/$dizin/$s.html"] = "/$dizin/$s/";
        $h["/$dizin/index.html"] = "/$dizin/";
    }
    foreach (['basinda','cerez-politikasi','dr-ramazan-ersoy','iletisim','randevu','kvkk-aydinlatma','yasal-uyari','yayinlar-ve-oduller'] as $s) {
        $h["/$s.html"] = "/$s/";
    }
    $h['/fiyatlar/alerji-testi-fiyatlari-2026.html'] = '/alerji-testi-fiyatlari-2026/';
    $h['/index.html'] = '/';
    /* en/ BİLEREK yok — statik kaldı, adresleri değişmedi */
    return $h;
}

function drre_adresleri_cevir($metin) {
    if (!is_string($metin) || $metin === '' || strpos($metin, '.html') === false) return $metin;
    $harita = drre_eski_adres_haritasi();
    /* hem kök-göreli hem mutlak biçim */
    foreach ($harita as $eski => $yeni) {
        $metin = str_replace('href="' . $eski . '"', 'href="' . $yeni . '"', $metin);
        $metin = str_replace('href="https://drramazanersoy.tr' . $eski . '"',
                             'href="https://drramazanersoy.tr' . $yeni . '"', $metin);
        /* çapa/sorgu taşıyanlar: href="/x.html#konu" */
        $metin = str_replace('href="' . $eski . '#', 'href="' . $yeni . '#', $metin);
        $metin = str_replace('href="' . $eski . '?', 'href="' . $yeni . '?', $metin);
    }
    return $metin;
}

function drre_112_linkle($metin) {
    if (strpos($metin, '112') === false) return $metin;
    /* zaten bağlantılı olan 112'leri koru */
    $metin = str_replace('<a href="tel:112">112</a>', "\x01KORU112\x01", $metin);
    $metin = preg_replace('/\b112\b(?=\'yi|\'YI|’yi| numaral)/u', '<a href="tel:112">112</a>', $metin);
    return str_replace("\x01KORU112\x01", '<a href="tel:112">112</a>', $metin);
}

add_filter('the_content', 'drre_adresleri_cevir', 8);
add_filter('the_content', 'drre_112_linkle', 9);
