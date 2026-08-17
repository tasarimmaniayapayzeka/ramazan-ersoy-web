/* sitemap.xml üreteci — TAM DEVİR sürümü (17 Ağu 2026).
 *
 * Eski sürüm diskteki .html dosyalarını tarıyordu; statik sayfalar
 * WordPress'e devredilip silindiği için artık AÇIK LİSTE kullanılır.
 * Yoast'ın XML sitemap'i bilinçli KAPALI (wp-tema/inc/yoast-uyum.php) —
 * tek sitemap kaynağı bu dosyadır, Search Console'a bu gönderilir.
 *
 * Yeni sayfa eklenince: listeye ekle + `node build-sitemap.js` + deploy.
 */
const fs = require('fs');
const path = require('path');

const BASE = 'https://drramazanersoy.tr';
const BUGUN = new Date().toISOString().slice(0, 10);

/* [yol, öncelik] — yollar / ile biter (WP dizin biçimi); en/ statik istisna */
const SAYFALAR = [
  ['/', '1.0'],
  ['/randevu/', '0.9'],
  ['/tedaviler/alerji-asisi-immunoterapi/', '0.9'],
  ['/hastaliklar/alerjik-rinit/', '0.8'],
  ['/hastaliklar/astim/', '0.8'],
  ['/hastaliklar/urtiker/', '0.8'],
  ['/hastaliklar/besin-alerjisi/', '0.8'],
  ['/hastaliklar/ilac-alerjisi/', '0.8'],
  ['/hastaliklar/ari-alerjisi/', '0.8'],
  ['/hastaliklar/herediter-anjiyoodem/', '0.8'],
  ['/hastaliklar/mastositoz/', '0.8'],
  ['/hastaliklar/anafilaksi/', '0.8'],
  ['/hastaliklar/', '0.7'],
  ['/testler/', '0.8'],
  ['/testler/deri-prick-testi/', '0.8'],
  ['/testler/spesifik-ige-kan-testi/', '0.8'],
  ['/testler/solunum-fonksiyon-testi/', '0.8'],
  ['/testler/yama-testi/', '0.8'],
  ['/testler/provokasyon-testleri/', '0.8'],
  ['/tedaviler/', '0.7'],
  ['/tedaviler/alerji-asisi-sss/', '0.8'],
  ['/alerji-rehberi/', '0.7'],
  ['/alerji-rehberi/ev-tozu-akari-yatak-odasi/', '0.7'],
  ['/alerji-rehberi/evcil-hayvan-alerjisi/', '0.7'],
  ['/alerji-rehberi/gebelikte-alerji-ve-astim/', '0.7'],
  ['/alerji-rehberi/klima-ve-ic-ortam-alerjenleri/', '0.7'],
  ['/alerji-rehberi/yetiskinlikte-baslayan-astim/', '0.7'],
  ['/dr-ramazan-ersoy/', '0.7'],
  ['/yayinlar-ve-oduller/', '0.6'],
  ['/basinda/', '0.6'],
  ['/iletisim/', '0.7'],
  ['/alerji-testi-fiyatlari-2026/', '0.6'],
  ['/araclar/', '0.5'],
  ['/araclar/alerji-mi-soguk-alginligi-mi/', '0.6'],
  ['/araclar/astim-kontrol-testi/', '0.6'],
  ['/araclar/polen-takvimi/', '0.6'],
  ['/araclar/video-kutuphanesi/', '0.6'],
  ['/hasta-merkezi/', '0.5'],
  ['/hasta-merkezi/ikinci-gorus/', '0.6'],
  ['/hasta-merkezi/online-on-degerlendirme/', '0.6'],
  ['/hasta-merkezi/randevunuza-hazirlanin/', '0.6'],
  ['/en/', '0.6'],
  ['/en/international-patients.html', '0.6'],
  ['/kvkk-aydinlatma/', '0.3'],
  ['/cerez-politikasi/', '0.3'],
  ['/yasal-uyari/', '0.3'],
];

const xml = '<?xml version="1.0" encoding="UTF-8"?>\n' +
  '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">\n' +
  SAYFALAR.map(([yol, oncelik]) => {
    let alt = '';
    if (yol === '/') {
      alt = '    <xhtml:link rel="alternate" hreflang="en" href="' + BASE + '/en/"/>\n';
    } else if (yol === '/en/') {
      alt = '    <xhtml:link rel="alternate" hreflang="tr" href="' + BASE + '/"/>\n';
    }
    return '  <url>\n    <loc>' + BASE + yol + '</loc>\n    <lastmod>' + BUGUN + '</lastmod>\n' +
      alt + '    <priority>' + oncelik + '</priority>\n  </url>';
  }).join('\n') + '\n</urlset>\n';

fs.writeFileSync(path.join(__dirname, 'sitemap.xml'), xml);
console.log('sitemap.xml yazıldı — ' + SAYFALAR.length + ' URL');
