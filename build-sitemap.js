/* sitemap.xml üreteci — yeni sayfa eklenince `node build-sitemap.js` ile yenile.
   WP fazında yerini WP sitemap'i alacak; cPanel'e statik çıkarsa bu dosya kullanılır. */
const fs = require('fs');
const path = require('path');

const BASE = 'https://drramazanersoy.tr';
const ROOT = __dirname;
const SKIP = new Set(['404.html']);

const pages = [];
(function walk(dir) {
  for (const f of fs.readdirSync(dir)) {
    const p = path.join(dir, f);
    const s = fs.statSync(p);
    if (s.isDirectory()) {
      if (!['.git', 'node_modules', '.claude', 'assets'].includes(f)) walk(p);
    } else if (f.endsWith('.html') && !SKIP.has(f)) {
      let rel = path.relative(ROOT, p).replace(/\\/g, '/');
      if (rel.endsWith('index.html')) rel = rel.slice(0, -'index.html'.length);
      pages.push({ url: BASE + '/' + rel, mtime: s.mtime.toISOString().slice(0, 10) });
    }
  }
})(ROOT);

// öncelik: anasayfa 1.0, ticari merkez 0.9, hastalık/test 0.8, diğer 0.6, yasal 0.3
const prio = (u) => {
  if (u === BASE + '/') return '1.0';
  if (u.includes('immunoterapi') || u.includes('/randevu')) return '0.9';
  if (u.includes('/hastaliklar/') || u.includes('/testler/') || u.includes('/tedaviler/')) return '0.8';
  if (u.includes('kvkk') || u.includes('cerez') || u.includes('yasal')) return '0.3';
  return '0.6';
};

/* HİBRİT GEÇİŞ (17 Ağu 2026): 21 içerik sayfası WordPress'e taşındı.
   Diskteki .html dosyaları 301 ile WP adresine gidiyor (.htaccess §4);
   sitemap'e artık HEDEF adresler yazılır — Google'a 301 zinciri yerine
   doğrudan kanonik adresi vermek taşınmanın en temiz sinyalidir.
   Liste .htaccess'teki yönlendirme kümesiyle AYNI olmak zorunda. */
const WPYE_TASINDI = new Set([
  'hastaliklar/alerjik-rinit', 'hastaliklar/astim', 'hastaliklar/urtiker',
  'hastaliklar/besin-alerjisi', 'hastaliklar/ilac-alerjisi', 'hastaliklar/ari-alerjisi',
  'hastaliklar/herediter-anjiyoodem', 'hastaliklar/mastositoz', 'hastaliklar/anafilaksi',
  'testler/deri-prick-testi', 'testler/spesifik-ige-kan-testi',
  'testler/solunum-fonksiyon-testi', 'testler/yama-testi', 'testler/provokasyon-testleri',
  'tedaviler/alerji-asisi-immunoterapi', 'tedaviler/alerji-asisi-sss',
  'alerji-rehberi/ev-tozu-akari-yatak-odasi', 'alerji-rehberi/evcil-hayvan-alerjisi',
  'alerji-rehberi/gebelikte-alerji-ve-astim', 'alerji-rehberi/klima-ve-ic-ortam-alerjenleri',
  'alerji-rehberi/yetiskinlikte-baslayan-astim',
]);
for (const p of pages) {
  const rel = p.url.slice(BASE.length + 1).replace(/\.html$/, '');
  if (WPYE_TASINDI.has(rel)) p.url = BASE + '/' + rel + '/';
}

pages.sort((a, b) => prio(b.url) - prio(a.url) || a.url.localeCompare(b.url));

const xml = '<?xml version="1.0" encoding="UTF-8"?>\n' +
  '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">\n' +
  pages.map(p => {
    let alt = '';
    if (p.url === BASE + '/') {
      alt = '    <xhtml:link rel="alternate" hreflang="en" href="' + BASE + '/en/"/>\n';
    } else if (p.url === BASE + '/en/') {
      alt = '    <xhtml:link rel="alternate" hreflang="tr" href="' + BASE + '/"/>\n';
    }
    return '  <url>\n    <loc>' + p.url + '</loc>\n    <lastmod>' + p.mtime + '</lastmod>\n' +
      alt + '    <priority>' + prio(p.url) + '</priority>\n  </url>';
  }).join('\n') + '\n</urlset>\n';

fs.writeFileSync(path.join(ROOT, 'sitemap.xml'), xml);
console.log('sitemap.xml yazıldı — ' + pages.length + ' URL');
