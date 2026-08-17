<?php
/**
 * Template Name: Araç — Anafilaksi Acil Plan Kartı
 * Kişisel cüzdan kartı + buzdolabı sayfası üretir. TAMAMEN İSTEMCİDE
 * çalışır: girilen bilgiler sunucuya GİTMEZ, hiçbir yerde SAKLANMAZ
 * (özel nitelikli sağlık verisi — KVKK'nın en katı yorumu).
 * Acil adım sırası sitenin kanonik metnidir; şablon hekim onaylıdır.
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
<style>
  .ak-form label{display:block;font-size:.82rem;color:var(--muted);margin:0 0 .25rem}
  .ak-form input{width:100%;border:1.5px solid var(--line);border-radius:9px;background:var(--bg);
    padding:.6rem .85rem;font:inherit;font-size:.93rem;margin-bottom:.9rem}
  .ak-kart{background:#fff;color:#122E2B;border-radius:12px;overflow:hidden;max-width:360px;
    border:1px solid #E3ECEA;box-shadow:0 8px 24px -12px rgba(18,46,43,.2)}
  .ak-serit{background:#B91C1C;color:#fff;display:flex;justify-content:space-between;align-items:center;
    padding:.55rem .95rem;font-weight:800;font-size:.8rem;letter-spacing:.06em}
  .ak-serit span:last-child{font-size:1.1rem}
  .ak-ic{padding:.95rem 1.05rem;display:grid;gap:.45rem;font-size:.84rem}
  .ak-satir{display:flex;justify-content:space-between;gap:1rem;border-bottom:1px dashed #E3ECEA;padding-bottom:.4rem}
  .ak-satir b{font-weight:800;text-align:right}
  .ak-adimlar{margin:.3rem 0 0;padding:0;list-style:none;display:grid;gap:.35rem;font-size:.79rem}
  .ak-adimlar li{display:flex;gap:.5rem}
  .ak-no{flex:none;width:18px;height:18px;border-radius:50%;background:#B91C1C;color:#fff;
    font-size:.68rem;font-weight:800;display:grid;place-items:center;margin-top:.1rem}
  /* Yazdırma: yalnız kart alanı, A4'e iki kopya + A5 buzdolabı bölümü */
  @media print{
    body *{visibility:hidden}
    #akYazdirAlani, #akYazdirAlani *{visibility:visible}
    #akYazdirAlani{position:absolute;left:0;top:0;width:100%}
    .site-header,.topbar,.sticky-bar,.site-footer{display:none!important}
    .ak-buzdolabi{page-break-before:always}
  }
  .ak-buzdolabi{background:#fff;border:2px solid #B91C1C;border-radius:14px;max-width:560px;
    padding:1.4rem 1.6rem;margin-top:1.4rem;color:#122E2B}
  .ak-buzdolabi h3{color:#B91C1C;font-size:1.3rem;margin:0 0 .6rem}
  .ak-buzdolabi .ak-adimlar{font-size:.95rem;gap:.55rem}
  .ak-buzdolabi .ak-no{width:22px;height:22px;font-size:.8rem}
</style>

<main id="icerik">
<div class="wrap">
  <nav class="crumbs" aria-label="Sayfa yolu">
    <a href="/">Anasayfa</a> <span aria-hidden="true">›</span>
    <a href="/araclar/">Araçlar</a> <span aria-hidden="true">›</span>
    <span aria-current="page">Acil Plan Kartı</span>
  </nav>
</div>

<section class="section section--tight">
  <div class="wrap">
    <p class="eyebrow">Anafilaksi hazırlığı</p>
    <h1>Kişisel acil plan kartınızı oluşturun</h1>
    <p class="hero-lede" style="max-width:62ch">Anafilaksi riski taşıyanlar için cüzdan kartı ve
      buzdolabı sayfası: alerjenleriniz, otoenjektörünüzün yeri ve acil durumda aranacak kişi —
      kanonik ilk yardım sırasıyla birlikte, yazdırmaya hazır.</p>
  </div>
</section>

<section class="section section--tight" style="padding-top:0">
  <div class="wrap">
    <div class="grid-2" style="align-items:start">
      <div class="ak-form">
        <h2 class="sm" style="letter-spacing:.08em;text-transform:uppercase;color:var(--gold)">Bilgileriniz</h2>
        <label for="akAd">Ad Soyad (kartta görünecek)</label>
        <input id="akAd" maxlength="40" placeholder="Ayşe K.">
        <label for="akAlerjen">Bilinen alerjenler</label>
        <input id="akAlerjen" maxlength="80" placeholder="Arı zehri · Penisilin grubu">
        <label for="akOto">Adrenalin otoenjektörü (var mı, nerede durur?)</label>
        <input id="akOto" maxlength="60" placeholder="Var — el çantasının ön gözünde">
        <label for="akKisi">Acil durumda aranacak kişi (ad + telefon)</label>
        <input id="akKisi" maxlength="60" placeholder="Mehmet K. — 05xx xxx xx xx">
        <div class="btn-row" style="margin-top:.4rem">
          <button class="btn btn--primary" id="akYazdir" type="button">Yazdır / PDF olarak kaydet</button>
        </div>
        <p class="xs muted" style="margin-top:1rem">Bilgileriniz yalnızca bu sayfada, sizin
          cihazınızda işlenir; sunucuya gönderilmez ve saklanmaz. Yazdırma penceresinde
          "PDF olarak kaydet"i seçerek dosya da alabilirsiniz.</p>
      </div>

      <div id="akYazdirAlani">
        <h2 class="sm" style="letter-spacing:.08em;text-transform:uppercase;color:var(--gold)">Cüzdan kartı · 85×54 mm</h2>
        <div class="ak-kart">
          <div class="ak-serit"><span>⚠ ANAFİLAKSİ RİSKİ</span><span>112</span></div>
          <div class="ak-ic">
            <div class="ak-satir"><span>Ad</span><b id="akcAd">—</b></div>
            <div class="ak-satir"><span>Alerjen</span><b id="akcAlerjen">—</b></div>
            <div class="ak-satir"><span>Otoenjektör</span><b id="akcOto">—</b></div>
            <ol class="ak-adimlar">
              <li><span class="ak-no">1</span><span>Otoenjektörü uyluğun <b>DIŞ</b> yanına uygula — bekletme</span></li>
              <li><span class="ak-no">2</span><span>Hemen <b>112</b>'yi ara, "anafilaksi" de</span></li>
              <li><span class="ak-no">3</span><span>Sırtüstü yatır, bacakları yükselt; ayağa kaldırma</span></li>
            </ol>
            <div class="ak-satir" style="border:0;padding-top:.2rem"><span>Yakını</span><b id="akcKisi">—</b></div>
          </div>
        </div>

        <div class="ak-buzdolabi">
          <h3>ANAFİLAKSİ ACİL PLANI</h3>
          <p style="margin:0 0 .8rem;font-size:.95rem"><b id="akbAd">—</b> ·
            Alerjen: <b id="akbAlerjen">—</b> · Otoenjektör: <b id="akbOto">—</b></p>
          <ol class="ak-adimlar">
            <li><span class="ak-no">1</span><span>Reçeteli adrenalin otoenjektörünü <b>uyluğun dış yanına</b> uygula. Tereddüt etme — geç kalmak, erken davranmaktan daha risklidir.</span></li>
            <li><span class="ak-no">2</span><span>Hemen <b>112'yi ara</b>; telefonda "anafilaksi" kelimesini açıkça söyle.</span></li>
            <li><span class="ak-no">3</span><span><b>Sırtüstü yatır, bacakları yükselt.</b> Nefes almakta zorlanıyorsa oturmasına izin ver; kusuyorsa yan yatır. Aniden ayağa kaldırma, yürütme.</span></li>
            <li><span class="ak-no">4</span><span>Belirtiler geçse bile <b>hastaneye git</b> — reaksiyon saatler sonra ikinci kez geri dönebilir.</span></li>
            <li><span class="ak-no">5</span><span>Antihistaminik ve kortizon anafilaksiyi <b>durdurmaz</b>; adrenalinin yerini tutmaz.</span></li>
          </ol>
          <p style="margin:.9rem 0 0;font-size:.85rem">Acil kişi: <b id="akbKisi">—</b> ·
            Uzm. Dr. Ramazan Ersoy · 0212 709 93 96 · drramazanersoy.tr</p>
        </div>
      </div>
    </div>

    <p class="xs muted" style="margin-top:2rem;border-top:1px solid var(--line);padding-top:1rem">
      Bu kart bilgilendirme ve hazırlık amaçlıdır; şablon metni Uzm. Dr. Ramazan Ersoy tarafından
      onaylanmıştır ve <a href="/hastaliklar/anafilaksi.html">anafilaksi sayfasındaki</a> kanonik
      ilk yardım sırasıyla birebir aynıdır. Otoenjektör kullanım tekniğini hekiminizden öğrenin;
      kartı düzenli aralıklarla güncelleyin.
    </p>
  </div>
</section>
</main>
<script src="/assets/js/araclar/acil-kart.js?v=1" defer></script>
<?php get_footer(); ?>
