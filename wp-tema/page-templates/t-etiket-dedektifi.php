<?php
/**
 * Template Name: Araç — Etiket Dedektifi
 * Besin alerjeni gizli ad tarayıcısı. Motor: arac-api.php (mod=etiket) —
 * AI + güvenlik ağı sözlüğü; AI kapalıysa araç sözlükle çalışmaya devam eder.
 * Mevzuat: ürün yorumu yapar, tıbbi öneri/teşhis üretmez (sunucu süzgeçli).
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
<style>
  .ed-cipler{display:flex;flex-wrap:wrap;gap:.5rem;margin:.4rem 0 1.4rem}
  .ed-cip{border:1.5px solid var(--line);border-radius:99px;padding:.45rem 1.05rem;
    font-size:.9rem;color:var(--muted);background:#fff;cursor:pointer;font-family:inherit}
  .ed-cip[aria-pressed="true"]{border-color:var(--coral);color:var(--coral);font-weight:700}
  .ed-cip[aria-pressed="true"]::before{content:"✓ "}
  .ed-metin{width:100%;min-height:150px;border:1.5px solid var(--line);border-radius:12px;
    padding:1rem;font:inherit;font-size:.95rem;resize:vertical;background:var(--bg)}
  .ed-bulgu{display:flex;gap:.8rem;align-items:flex-start;padding:.85rem 1rem;
    border:1px solid var(--line);border-radius:10px;background:var(--bg);margin-bottom:.6rem}
  .ed-isaret{flex:none;width:28px;height:28px;border-radius:8px;display:grid;place-items:center;
    font-weight:800;color:#fff;font-size:.85rem}
  .ed-isaret.kesin{background:var(--red)} .ed-isaret.olasi{background:var(--amber)}
  .ed-isaret.temiz{background:var(--coral)}
  .ed-bulgu b{font-size:.95rem} .ed-bulgu p{margin:.2rem 0 0;font-size:.86rem;color:var(--muted)}
  .ed-bekle{display:none;color:var(--muted);font-size:.9rem}
  .ed-bekle.acik{display:block}
</style>

<main id="icerik">
<div class="wrap">
  <nav class="crumbs" aria-label="Sayfa yolu">
    <a href="/">Anasayfa</a> <span aria-hidden="true">›</span>
    <a href="/araclar/">Araçlar</a> <span aria-hidden="true">›</span>
    <span aria-current="page">Etiket Dedektifi</span>
  </nav>
</div>

<section class="section section--tight">
  <div class="wrap">
    <p class="eyebrow">Besin alerjisi aracı</p>
    <h1>Etiket Dedektifi: içindekiler listesinde gizli alerjen var mı?</h1>
    <p class="hero-lede" style="max-width:62ch">Kazein aslında süttür; E-322 soya olabilir; "aroma
      verici (badem)" bir ağaç yemişidir. Alerjenlerinizi seçin, ürünün içindekiler listesini
      yapıştırın — bilinen gizli adları sizin için tarayalım.</p>
  </div>
</section>

<section class="section section--tight" style="padding-top:0">
  <div class="wrap">
    <div class="grid-2" style="align-items:start">
      <div>
        <h2 class="sm" style="letter-spacing:.08em;text-transform:uppercase;color:var(--gold)">1 · Alerjenlerinizi seçin</h2>
        <div class="ed-cipler" id="edAlerjenler" role="group" aria-label="Alerjen seçimi">
          <button type="button" class="ed-cip" data-a="sut" aria-pressed="false">Süt</button>
          <button type="button" class="ed-cip" data-a="yumurta" aria-pressed="false">Yumurta</button>
          <button type="button" class="ed-cip" data-a="yer-fistigi" aria-pressed="false">Yer fıstığı</button>
          <button type="button" class="ed-cip" data-a="agac-yemisi" aria-pressed="false">Ağaç yemişleri</button>
          <button type="button" class="ed-cip" data-a="soya" aria-pressed="false">Soya</button>
          <button type="button" class="ed-cip" data-a="gluten" aria-pressed="false">Buğday / gluten</button>
          <button type="button" class="ed-cip" data-a="deniz" aria-pressed="false">Kabuklu deniz ürünü</button>
          <button type="button" class="ed-cip" data-a="balik" aria-pressed="false">Balık</button>
          <button type="button" class="ed-cip" data-a="susam" aria-pressed="false">Susam</button>
        </div>
        <h2 class="sm" style="letter-spacing:.08em;text-transform:uppercase;color:var(--gold)">2 · İçindekiler listesini yapıştırın</h2>
        <label class="sr-only" for="edMetin">İçindekiler listesi</label>
        <textarea id="edMetin" class="ed-metin" maxlength="2500"
          placeholder="Ürün etiketindeki 'İçindekiler' bölümünü olduğu gibi buraya yapıştırın…"></textarea>
        <div class="btn-row" style="margin-top:1rem">
          <button class="btn btn--primary" id="edTara" type="button">Listeyi tara</button>
          <span class="ed-bekle" id="edBekle">Taranıyor…</span>
        </div>
      </div>
      <div>
        <h2 class="sm" style="letter-spacing:.08em;text-transform:uppercase;color:var(--gold)">Sonuç</h2>
        <div id="edSonuc" aria-live="polite">
          <p class="sm muted">Sonuçlar burada görünecek. Bu araç yalnız yazılı listeyi tarar;
             ambalajdaki "izler içerebilir" uyarısını göremez.</p>
        </div>
      </div>
    </div>

    <p class="xs muted" style="margin-top:2rem;border-top:1px solid var(--line);padding-top:1rem">
      Bu araç bilgilendirme amaçlıdır; kesinlik garanti etmez ve tıbbi öneri üretmez.
      Üreticinin etiketi, "izler içerebilir" uyarıları ve çapraz bulaşma riski her zaman esastır —
      şüpheli üründen uzak durun. Yapıştırdığınız metin kaydedilmez.
      Besin alerjinizin kapsamını netleştirmek için
      <a href="/hastaliklar/besin-alerjisi.html">besin alerjisi</a> sayfamıza bakabilir,
      <a href="/randevu.html">randevu talep edebilirsiniz</a>.
    </p>
  </div>
</section>
</main>
<script src="/assets/js/araclar/etiket.js?v=1" defer></script>
<?php get_footer(); ?>
