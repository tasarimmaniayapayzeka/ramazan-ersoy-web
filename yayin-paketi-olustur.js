/* Yayın paketi üretici — cPanel'e yüklenecek dosyaları ayıklar.
   Kullanım:  node yayin-paketi-olustur.js
   Çıktı:     ../ramazan-ersoy-YAYIN/  klasörü (ve içeriği)
   Dışarıda bırakılanlar: .git, .claude, server.js, build-sitemap.js,
   bu script, node_modules, fonts/*.txt ve manifest (geliştirme artıkları). */
const fs = require('fs');
const path = require('path');

const KAYNAK = __dirname;
const HEDEF = path.join(path.dirname(__dirname), 'ramazan-ersoy-YAYIN');

const KLASOR_HARIC = new Set(['.git', '.claude', 'node_modules']);
const DOSYA_HARIC = new Set([
  'server.js', 'build-sitemap.js', 'yayin-paketi-olustur.js',
  '.gitignore', 'package.json', 'package-lock.json',
]);
const UZANTI_HARIC = new Set(['.md', '.zip', '.log']);
// fonts klasöründeki geliştirme artıkları
const OZEL_HARIC = new Set(['assets/fonts/css2.txt', 'assets/fonts/fraunces.txt', 'assets/fonts/manifest.json']);

let kopyalanan = 0, atlanan = 0, toplamBoyut = 0;
const atlananListe = [];

function kopyala(src, dst, rel = '') {
  fs.mkdirSync(dst, { recursive: true });
  for (const ad of fs.readdirSync(src)) {
    const s = path.join(src, ad);
    const d = path.join(dst, ad);
    const relYol = rel ? rel + '/' + ad : ad;
    const st = fs.statSync(s);

    if (st.isDirectory()) {
      if (KLASOR_HARIC.has(ad)) { atlanan++; atlananListe.push(relYol + '/ (klasör)'); continue; }
      kopyala(s, d, relYol);
    } else {
      if (DOSYA_HARIC.has(ad) || UZANTI_HARIC.has(path.extname(ad)) || OZEL_HARIC.has(relYol)) {
        atlanan++; atlananListe.push(relYol); continue;
      }
      fs.copyFileSync(s, d);
      kopyalanan++;
      toplamBoyut += st.size;
    }
  }
}

if (fs.existsSync(HEDEF)) fs.rmSync(HEDEF, { recursive: true });
kopyala(KAYNAK, HEDEF);

console.log('YAYIN PAKETİ HAZIR');
console.log('Konum   :', HEDEF);
console.log('Dosya   :', kopyalanan, '· Boyut:', (toplamBoyut / 1024 / 1024).toFixed(2), 'MB');
console.log('Atlanan :', atlanan);
atlananListe.forEach(a => console.log('   -', a));

// .htaccess kontrolü (gizli dosya kopyalandı mı?)
const ht = path.join(HEDEF, '.htaccess');
console.log('\n.htaccess pakette:', fs.existsSync(ht) ? 'EVET' : 'HAYIR — ELLE KOPYALAYIN!');
