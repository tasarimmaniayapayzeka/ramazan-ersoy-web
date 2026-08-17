<?php
/**
 * Template Name: Araç — Belirti Yol Haritası
 * Serbest metin şikayeti sitedeki doğru sayfalara yönlendirir.
 * Motor: arac-api.php (mod=rota). Acil tarama SUNUCUDA, AI'dan önce;
 * acil yanıtında istemci kırmızı 112 kartına döner ve girişi kilitler
 * (chatbot ile aynı davranış). Teşhis dili sunucu süzgecinde engelli.
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
<style>
  .yr-kutu{max-width:720px}
  .yr-metin{width:100%;min-height:110px;border:1.5px solid var(--line);border-radius:12px;
    padding:1rem;font:inherit;font-size:.95rem;resize:vertical;background:var(--bg)}
  .yr-yanit{background:var(--cream);border:1px solid var(--cream-line);border-radius:14px;
    border-bottom-left-radius:4px;padding:1.1rem 1.25rem;margin-top:1.2rem;display:none}
  .yr-yanit.acik{display:block}
  .yr-rota{display:grid;gap:.6rem;margin-top:1rem}
  @media(min-width:640px){ .yr-rota{grid-template-columns:repeat(3,1fr)} }
  .yr-rota a{display:block;border:1.5px solid var(--line);border-radius:10px;padding:.8rem .9rem;
    text-decoration:none;color:var(--ink);background:#fff;font-size:.84rem;line-height:1.45}
  .yr-rota a b{display:block;color:var(--coral);font-size:.9rem;margin-bottom:.2rem}
  .yr-acil{display:none;background:#FEF2F2;border:2px solid var(--red);border-radius:14px;
    padding:1.2rem 1.3rem;margin-top:1.2rem}
  .yr-acil.acik{display:block}
  .yr-acil h2{color:var(--red);margin:0 0 .5rem;font-size:1.15rem}
  .yr-acil a.tel{display:inline-block;background:var(--red);color:#fff;border-radius:10px;
    padding:.8rem 1.6rem;font-weight:800;text-decoration:none;font-size:1.05rem;margin-top:.6rem}
  .yr-bekle{display:none;color:var(--muted);font-size:.9rem}
  .yr-bekle.acik{display:inline}
</style>

<main id="icerik">
<div class="wrap">
  <nav class="crumbs" aria-label="Sayfa yolu">
    <a href="/">Anasayfa</a> <span aria-hidden="true">›</span>
    <a href="/araclar/">Araçlar</a> <span aria-hidden="true">›</span>
    <span aria-current="page">Belirti Yol Haritası</span>
  </nav>
</div>

<section class="section section--tight">
  <div class="wrap">
    <p class="eyebrow">Yol gösterici</p>
    <h1>Nereden başlayacağınızı bilmiyor musunuz?</h1>
    <p class="hero-lede" style="max-width:62ch">Şikayetinizi kendi cümlelerinizle yazın; sitedeki
      doğru sayfaları ve size uygun testi önerelim. Bu araç teşhis koymaz — yol gösterir;
      kesin değerlendirmeyi muayene yapar.</p>
  </div>
</section>

<section class="section section--tight" style="padding-top:0">
  <div class="wrap">
    <div class="yr-kutu">
      <label class="sr-only" for="yrMetin">Şikayetinizi yazın</label>
      <textarea id="yrMetin" class="yr-metin" maxlength="800"
        placeholder="Örnek: Üç haftadır geceleri öksürükle uyanıyorum, merdiven çıkarken nefesim yetişmiyor…"></textarea>
      <div class="btn-row" style="margin-top:.9rem">
        <button class="btn btn--primary" id="yrGonder" type="button">Yol haritamı çıkar</button>
        <span class="yr-bekle" id="yrBekle">Hazırlanıyor…</span>
      </div>

      <div class="yr-acil" id="yrAcil" role="alert">
        <h2>Bu belirtiler acil olabilir</h2>
        <p style="margin:0">Yazdıklarınız, beklemeden değerlendirilmesi gereken bir tabloya işaret
          ediyor olabilir. Bu aracı bırakın ve <strong>hemen 112'yi arayın</strong>. Reçeteli
          adrenalin otoenjektörünüz varsa önce onu uygulayın, hemen ardından 112'yi arayın.</p>
        <a class="tel" href="tel:112">112'yi ARA</a>
      </div>

      <div class="yr-yanit" id="yrYanit" aria-live="polite">
        <p id="yrMesaj" style="margin:0"></p>
        <div class="yr-rota" id="yrRota"></div>
        <div class="btn-row" style="margin-top:1.1rem">
          <a class="btn btn--primary" href="/randevu.html">Randevu talep et</a>
          <a class="btn btn--wa" data-wa="Merhaba, şikayetlerim için randevu almak istiyorum."
             data-wa-src="yol-haritasi" href="#">WhatsApp'tan yazın</a>
        </div>
      </div>
    </div>

    <p class="xs muted" style="margin-top:2rem;border-top:1px solid var(--line);padding-top:1rem">
      Bu araç teşhis koymaz ve hekim muayenesinin yerine geçmez. Nefes alamama, dilde/boğazda
      şişme, bayılma hissi varsa beklemeyin — <a href="tel:112">112</a>'yi arayın.
      Yazdıklarınız kaydedilmez; yapay zekâya gönderilmeden önce kişisel bilgiler
      (telefon, e-posta, kimlik no) otomatik maskelenir. Muayenehanemiz yalnızca
      yetişkin hastaları kabul eder.
    </p>
  </div>
</section>
</main>
<script src="/assets/js/araclar/rota.js?v=1" defer></script>
<?php get_footer(); ?>
