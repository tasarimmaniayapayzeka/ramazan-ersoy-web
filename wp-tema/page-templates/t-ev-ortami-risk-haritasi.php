<?php
/**
 * Template Name: Araç — Ev Ortamı Risk Haritası
 * 10 soruluk deterministik anket → kişisel eylem planı. AI YOK, sunucu YOK:
 * puanlama ve öneriler ev-risk.js içinde, kaynak içerik akar/klima
 * rehberleriyle birebir aynı çizgide. Anonim — hiçbir veri gönderilmez.
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
<style>
  .ev-soru{border:1px solid var(--line);border-radius:12px;padding:1rem 1.2rem;margin-bottom:.9rem;background:#fff}
  .ev-soru p{margin:0 0 .6rem;font-weight:700;font-size:.95rem}
  .ev-secenek{display:flex;flex-wrap:wrap;gap:.5rem}
  .ev-secenek button{border:1.5px solid var(--line);border-radius:99px;padding:.42rem 1rem;
    font:inherit;font-size:.86rem;color:var(--muted);background:#fff;cursor:pointer}
  .ev-secenek button[aria-pressed="true"]{border-color:var(--coral);color:var(--coral);font-weight:700}
  .ev-sonuc{display:none;margin-top:1.6rem}
  .ev-sonuc.acik{display:block}
  .ev-olcek{height:10px;border-radius:99px;background:var(--line);overflow:hidden;margin:.6rem 0 1.2rem}
  .ev-olcek i{display:block;height:100%;border-radius:99px;transition:width .5s ease}
  .ev-oneri{display:flex;gap:.8rem;align-items:flex-start;padding:.85rem 1rem;
    border:1px solid var(--line);border-radius:10px;background:var(--bg);margin-bottom:.6rem}
  .ev-oneri .no{flex:none;width:26px;height:26px;border-radius:8px;background:var(--coral);
    color:#fff;display:grid;place-items:center;font-weight:800;font-size:.8rem}
  .ev-oneri b{font-size:.93rem} .ev-oneri p{margin:.15rem 0 0;font-size:.85rem;color:var(--muted)}
  @media print{
    body *{visibility:hidden}
    #evSonuc,#evSonuc *{visibility:visible}
    #evSonuc{position:absolute;left:0;top:0;width:100%}
    .site-header,.topbar,.sticky-bar,.site-footer{display:none!important}
  }
</style>

<main id="icerik">
<div class="wrap">
  <nav class="crumbs" aria-label="Sayfa yolu">
    <a href="/">Anasayfa</a> <span aria-hidden="true">›</span>
    <a href="/araclar/">Araçlar</a> <span aria-hidden="true">›</span>
    <span aria-current="page">Ev Ortamı Risk Haritası</span>
  </nav>
</div>

<section class="section section--tight">
  <div class="wrap">
    <p class="eyebrow">Ev içi alerjenler</p>
    <h1>Eviniz alerjeni ne kadar besliyor?</h1>
    <p class="hero-lede" style="max-width:62ch">10 kısa soru; sonunda evinize özel, öncelik
      sıralı bir eylem planı. Sorular ev tozu akarı ve iç ortam rehberlerimizdeki kanıt
      çerçevesine dayanır — yanıtlarınız hiçbir yere gönderilmez.</p>
  </div>
</section>

<section class="section section--tight" style="padding-top:0">
  <div class="wrap">
    <div style="max-width:760px">
      <div id="evSorular"></div>
      <div class="btn-row" style="margin-top:1.1rem">
        <button class="btn btn--primary" id="evHesapla" type="button">Risk haritamı çıkar</button>
      </div>

      <div class="ev-sonuc" id="evSonuc" aria-live="polite">
        <h2 id="evBaslik" style="margin-bottom:.2rem"></h2>
        <div class="ev-olcek"><i id="evCubuk" style="width:0"></i></div>
        <h3 class="sm" style="letter-spacing:.08em;text-transform:uppercase;color:var(--gold)">Önce bunlar — öncelik sırasıyla</h3>
        <div id="evOneriler"></div>
        <div class="btn-row" style="margin-top:1.1rem">
          <button class="btn btn--ghost" id="evYazdir" type="button">Planı yazdır</button>
        </div>
        <p class="xs muted" style="margin-top:1rem">Öneriler geneldir ve
          <a href="/alerji-rehberi/ev-tozu-akari-yatak-odasi.html">ev tozu akarı</a> ile
          <a href="/alerji-rehberi/klima-ve-ic-ortam-alerjenleri.html">iç ortam alerjenleri</a>
          rehberlerimizle aynı çizgidedir; şikayetleriniz sürüyorsa değerlendirme için
          <a href="/randevu.html">randevu talep edin</a>.</p>
      </div>
    </div>
  </div>
</section>
</main>
<script src="/assets/js/araclar/ev-risk.js?v=1" defer></script>
<?php get_footer(); ?>
