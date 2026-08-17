<?php
/**
 * Template Name: Alerji ve Astım Video Kütüphanesi
 * Statik siteden otomatik devşirildi (tam-devir.js, 17 Ağu 2026).
 * Kaynak içerik hekim onaylı; düzenleme GEREKİYORSA bu dosyada yapılır,
 * WP editöründe değil (sayfa gövdesi bilinçli olarak boş).
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
<main id="icerik">

<!-- ═══ BREADCRUMB ═══ -->
<div class="wrap">
  <nav class="crumbs" aria-label="Site yolu">
    <a href="/">Anasayfa</a> <span aria-hidden="true">›</span>
    <span>Araçlar</span> <span aria-hidden="true">›</span>
    <span aria-current="page">Video Kütüphanesi</span>
  </nav>
</div>

<!-- ═══ BAŞLIK ═══ -->
<section class="section section--tight">
  <div class="wrap">
    <p class="eyebrow">Araçlar · Video</p>
    <h1>Dr. Ersoy anlatıyor — video kütüphanesi</h1>
    <p class="hero-lede" style="max-width:62ch">Dr. Ersoy'un YouTube kanalında alerji ve astım üzerine <strong>70'ten fazla video</strong> bulunuyor. Bu sayfa, o içerikleri konuya göre düzenleyen merkezi kütüphanedir: aradığınız konuyu bulun, tıklayın, izleyin. Videolar kısa tutulmuştur ve hasta diliyle anlatılır.</p>


    <div class="btn-row" style="margin-top:1.25rem">
      <a class="btn btn--primary" href="https://www.youtube.com/@dr.ramazanersoy1012" target="_blank" rel="noopener">YouTube kanalına gidin</a>
      <a class="btn btn--ghost" href="/randevu/">Randevu Talep Et</a>
    </div>
  </div>
</section>

<!-- ═══ 1 · ALERJİK RİNİT & POLEN ═══ -->
<section class="section section--mint" id="baslarken">
  <div class="wrap">
    <div class="section-head reveal">
      <p class="eyebrow">Konu 1</p>
      <h2>Başlarken</h2>
      <p>Alerji uzmanına ilk kez gelen hastaların en çok sorduğu sorular.</p>
    </div>
    <div class="vgrid reveal">

      <article class="vcard">
        <button class="vcard-poster" data-video="<?php echo esc_attr(drre_video('tanisma')); ?>" data-en-boy="9/16"
                data-baslik="Uzm. Dr. Ramazan Ersoy"
                aria-label="Uzm. Dr. Ramazan Ersoy — videoyu izle (0:36)">
          <?php /* drre-vkapak: gercek kapak, kendi sunucumuzdan (i.ytimg'e
                   ziyaretci istegi YOK); dosya yoksa soyut poster gosterilir */
          $vkId = drre_video('tanisma');
          $vkYol = '/assets/img/video/' . $vkId . '.jpg';
          if ($vkId && file_exists(dirname(ABSPATH) . $vkYol)) : ?>
          <img src="<?php echo esc_url($vkYol); ?>" alt="" loading="lazy" decoding="async"
               style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:inherit">
          <?php else : ?>
          <svg viewBox="0 0 270 480" preserveAspectRatio="xMidYMid slice" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="vp0" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#EAF6F4"/><stop offset="1" stop-color="#CFE7E3"/></linearGradient></defs><rect width="270" height="480" fill="url(#vp0)"/><path d="M-10 360q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="3.5" stroke-linecap="round" opacity=".45"/><path d="M-10 396q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="2.5" stroke-linecap="round" opacity=".3"/><circle cx="205" cy="86" r="4" fill="#B98A3B" opacity=".65"/><circle cx="228" cy="120" r="2.5" fill="#B98A3B" opacity=".45"/><circle cx="52" cy="104" r="3" fill="#2E7C78" opacity=".35"/></svg>
          <?php endif; ?>
          <span class="vcard-play" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
          <span class="vcard-sure" aria-hidden="true">0:36</span>
        </button>
        <h3>Uzm. Dr. Ramazan Ersoy</h3>
        <p class="sm muted">Hangi hastalıklarla ilgileniyor, hangi şikayetlerle başvurabilirsiniz — kısa tanışma.</p>
      </article>

      <article class="vcard">
        <button class="vcard-poster" data-video="<?php echo esc_attr(drre_video('neye-bakar')); ?>" data-en-boy="9/16"
                data-baslik="Yetişkin alerji uzmanı neye bakar?"
                aria-label="Yetişkin alerji uzmanı neye bakar? — videoyu izle (0:44)">
          <?php /* drre-vkapak: gercek kapak, kendi sunucumuzdan (i.ytimg'e
                   ziyaretci istegi YOK); dosya yoksa soyut poster gosterilir */
          $vkId = drre_video('neye-bakar');
          $vkYol = '/assets/img/video/' . $vkId . '.jpg';
          if ($vkId && file_exists(dirname(ABSPATH) . $vkYol)) : ?>
          <img src="<?php echo esc_url($vkYol); ?>" alt="" loading="lazy" decoding="async"
               style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:inherit">
          <?php else : ?>
          <svg viewBox="0 0 270 480" preserveAspectRatio="xMidYMid slice" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="vp1" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#F3EFE4"/><stop offset="1" stop-color="#E3DCC7"/></linearGradient></defs><rect width="270" height="480" fill="url(#vp1)"/><path d="M-10 360q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="3.5" stroke-linecap="round" opacity=".45"/><path d="M-10 396q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="2.5" stroke-linecap="round" opacity=".3"/><circle cx="205" cy="86" r="4" fill="#B98A3B" opacity=".65"/><circle cx="228" cy="120" r="2.5" fill="#B98A3B" opacity=".45"/><circle cx="52" cy="104" r="3" fill="#2E7C78" opacity=".35"/></svg>
          <?php endif; ?>
          <span class="vcard-play" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
          <span class="vcard-sure" aria-hidden="true">0:44</span>
        </button>
        <h3>Yetişkin alerji uzmanı neye bakar?</h3>
        <p class="sm muted">Alerjik hastalıklar yalnızca kaşıntı ve hapşırıktan ibaret değildir; kapsamı bu videoda.</p>
      </article>

      <article class="vcard">
        <button class="vcard-poster" data-video="<?php echo esc_attr(drre_video('ne-zaman')); ?>" data-en-boy="9/16"
                data-baslik="Alerji şikayetlerinde ne zaman doktora başvurmalıyız?"
                aria-label="Alerji şikayetlerinde ne zaman doktora başvurmalıyız? — videoyu izle (0:38)">
          <?php /* drre-vkapak: gercek kapak, kendi sunucumuzdan (i.ytimg'e
                   ziyaretci istegi YOK); dosya yoksa soyut poster gosterilir */
          $vkId = drre_video('ne-zaman');
          $vkYol = '/assets/img/video/' . $vkId . '.jpg';
          if ($vkId && file_exists(dirname(ABSPATH) . $vkYol)) : ?>
          <img src="<?php echo esc_url($vkYol); ?>" alt="" loading="lazy" decoding="async"
               style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:inherit">
          <?php else : ?>
          <svg viewBox="0 0 270 480" preserveAspectRatio="xMidYMid slice" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="vp2" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#EDF4F7"/><stop offset="1" stop-color="#D5E6EE"/></linearGradient></defs><rect width="270" height="480" fill="url(#vp2)"/><path d="M-10 360q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="3.5" stroke-linecap="round" opacity=".45"/><path d="M-10 396q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="2.5" stroke-linecap="round" opacity=".3"/><circle cx="205" cy="86" r="4" fill="#B98A3B" opacity=".65"/><circle cx="228" cy="120" r="2.5" fill="#B98A3B" opacity=".45"/><circle cx="52" cy="104" r="3" fill="#2E7C78" opacity=".35"/></svg>
          <?php endif; ?>
          <span class="vcard-play" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
          <span class="vcard-sure" aria-hidden="true">0:38</span>
        </button>
        <h3>Alerji şikayetlerinde ne zaman doktora başvurmalıyız?</h3>
        <p class="sm muted">“Geçer” diye beklenen bazı şikayetler alerjik bir hastalığın belirtisi olabilir.</p>
      </article>

    </div>
  </div>
</section>

<section class="section " id="muayene-test">
  <div class="wrap">
    <div class="section-head reveal">
      <p class="eyebrow">Konu 2</p>
      <h2>Muayene ve testler</h2>
      <p>Randevudan sonuca: süreçte ne oluyor, hangi test ne işe yarıyor.</p>
    </div>
    <div class="vgrid reveal">

      <article class="vcard">
        <button class="vcard-poster" data-video="<?php echo esc_attr(drre_video('muayene')); ?>" data-en-boy="9/16"
                data-baslik="Alerji muayene süreci nasıl ilerler?"
                aria-label="Alerji muayene süreci nasıl ilerler? — videoyu izle (0:37)">
          <?php /* drre-vkapak: gercek kapak, kendi sunucumuzdan (i.ytimg'e
                   ziyaretci istegi YOK); dosya yoksa soyut poster gosterilir */
          $vkId = drre_video('muayene');
          $vkYol = '/assets/img/video/' . $vkId . '.jpg';
          if ($vkId && file_exists(dirname(ABSPATH) . $vkYol)) : ?>
          <img src="<?php echo esc_url($vkYol); ?>" alt="" loading="lazy" decoding="async"
               style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:inherit">
          <?php else : ?>
          <svg viewBox="0 0 270 480" preserveAspectRatio="xMidYMid slice" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="vp3" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#F1F0F6"/><stop offset="1" stop-color="#DEDBEA"/></linearGradient></defs><rect width="270" height="480" fill="url(#vp3)"/><path d="M-10 360q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="3.5" stroke-linecap="round" opacity=".45"/><path d="M-10 396q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="2.5" stroke-linecap="round" opacity=".3"/><circle cx="205" cy="86" r="4" fill="#B98A3B" opacity=".65"/><circle cx="228" cy="120" r="2.5" fill="#B98A3B" opacity=".45"/><circle cx="52" cy="104" r="3" fill="#2E7C78" opacity=".35"/></svg>
          <?php endif; ?>
          <span class="vcard-play" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
          <span class="vcard-sure" aria-hidden="true">0:37</span>
        </button>
        <h3>Alerji muayene süreci nasıl ilerler?</h3>
        <p class="sm muted">İlk adım test değil, hikâyeyi dinlemektir. Muayenede sırayla ne yapılıyor?</p>
      </article>

      <article class="vcard">
        <button class="vcard-poster" data-video="<?php echo esc_attr(drre_video('testler')); ?>" data-en-boy="9/16"
                data-baslik="Alerji testleri nedir, nasıl yapılır?"
                aria-label="Alerji testleri nedir, nasıl yapılır? — videoyu izle (0:47)">
          <?php /* drre-vkapak: gercek kapak, kendi sunucumuzdan (i.ytimg'e
                   ziyaretci istegi YOK); dosya yoksa soyut poster gosterilir */
          $vkId = drre_video('testler');
          $vkYol = '/assets/img/video/' . $vkId . '.jpg';
          if ($vkId && file_exists(dirname(ABSPATH) . $vkYol)) : ?>
          <img src="<?php echo esc_url($vkYol); ?>" alt="" loading="lazy" decoding="async"
               style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:inherit">
          <?php else : ?>
          <svg viewBox="0 0 270 480" preserveAspectRatio="xMidYMid slice" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="vp4" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#EAF6F4"/><stop offset="1" stop-color="#CFE7E3"/></linearGradient></defs><rect width="270" height="480" fill="url(#vp4)"/><path d="M-10 360q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="3.5" stroke-linecap="round" opacity=".45"/><path d="M-10 396q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="2.5" stroke-linecap="round" opacity=".3"/><circle cx="205" cy="86" r="4" fill="#B98A3B" opacity=".65"/><circle cx="228" cy="120" r="2.5" fill="#B98A3B" opacity=".45"/><circle cx="52" cy="104" r="3" fill="#2E7C78" opacity=".35"/></svg>
          <?php endif; ?>
          <span class="vcard-play" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
          <span class="vcard-sure" aria-hidden="true">0:47</span>
        </button>
        <h3>Alerji testleri nedir, nasıl yapılır?</h3>
        <p class="sm muted">Deri prick testi başta olmak üzere yöntemler ve nasıl değerlendirildiği.</p>
      </article>

      <article class="vcard">
        <button class="vcard-poster" data-video="<?php echo esc_attr(drre_video('sikayetim-yok')); ?>" data-en-boy="9/16"
                data-baslik="Şikayetim yok, yine de alerji testi yaptırmalı mıyım?"
                aria-label="Şikayetim yok, yine de alerji testi yaptırmalı mıyım? — videoyu izle (0:39)">
          <?php /* drre-vkapak: gercek kapak, kendi sunucumuzdan (i.ytimg'e
                   ziyaretci istegi YOK); dosya yoksa soyut poster gosterilir */
          $vkId = drre_video('sikayetim-yok');
          $vkYol = '/assets/img/video/' . $vkId . '.jpg';
          if ($vkId && file_exists(dirname(ABSPATH) . $vkYol)) : ?>
          <img src="<?php echo esc_url($vkYol); ?>" alt="" loading="lazy" decoding="async"
               style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:inherit">
          <?php else : ?>
          <svg viewBox="0 0 270 480" preserveAspectRatio="xMidYMid slice" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="vp5" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#F3EFE4"/><stop offset="1" stop-color="#E3DCC7"/></linearGradient></defs><rect width="270" height="480" fill="url(#vp5)"/><path d="M-10 360q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="3.5" stroke-linecap="round" opacity=".45"/><path d="M-10 396q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="2.5" stroke-linecap="round" opacity=".3"/><circle cx="205" cy="86" r="4" fill="#B98A3B" opacity=".65"/><circle cx="228" cy="120" r="2.5" fill="#B98A3B" opacity=".45"/><circle cx="52" cy="104" r="3" fill="#2E7C78" opacity=".35"/></svg>
          <?php endif; ?>
          <span class="vcard-play" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
          <span class="vcard-sure" aria-hidden="true">0:39</span>
        </button>
        <h3>Şikayetim yok, yine de alerji testi yaptırmalı mıyım?</h3>
        <p class="sm muted">Şikayeti olmayan kişide de test pozitif çıkabilir. Bu ne anlama gelir, ne anlama gelmez?</p>
      </article>

    </div>
  </div>
</section>

<section class="section section--cream" id="astim">
  <div class="wrap">
    <div class="section-head reveal">
      <p class="eyebrow">Konu 3</p>
      <h2>Astım ve nefes darlığı</h2>
      <p>Her nefes darlığı astım değildir; astım da her zaman nefes darlığıyla başlamaz.</p>
    </div>
    <div class="vgrid reveal">

      <article class="vcard">
        <button class="vcard-poster" data-video="<?php echo esc_attr(drre_video('alerjik-astim')); ?>" data-en-boy="9/16"
                data-baslik="Alerjik astım nedir? Belirtileri nelerdir?"
                aria-label="Alerjik astım nedir? Belirtileri nelerdir? — videoyu izle (0:37)">
          <?php /* drre-vkapak: gercek kapak, kendi sunucumuzdan (i.ytimg'e
                   ziyaretci istegi YOK); dosya yoksa soyut poster gosterilir */
          $vkId = drre_video('alerjik-astim');
          $vkYol = '/assets/img/video/' . $vkId . '.jpg';
          if ($vkId && file_exists(dirname(ABSPATH) . $vkYol)) : ?>
          <img src="<?php echo esc_url($vkYol); ?>" alt="" loading="lazy" decoding="async"
               style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:inherit">
          <?php else : ?>
          <svg viewBox="0 0 270 480" preserveAspectRatio="xMidYMid slice" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="vp6" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#EDF4F7"/><stop offset="1" stop-color="#D5E6EE"/></linearGradient></defs><rect width="270" height="480" fill="url(#vp6)"/><path d="M-10 360q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="3.5" stroke-linecap="round" opacity=".45"/><path d="M-10 396q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="2.5" stroke-linecap="round" opacity=".3"/><circle cx="205" cy="86" r="4" fill="#B98A3B" opacity=".65"/><circle cx="228" cy="120" r="2.5" fill="#B98A3B" opacity=".45"/><circle cx="52" cy="104" r="3" fill="#2E7C78" opacity=".35"/></svg>
          <?php endif; ?>
          <span class="vcard-play" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
          <span class="vcard-sure" aria-hidden="true">0:37</span>
        </button>
        <h3>Alerjik astım nedir? Belirtileri nelerdir?</h3>
        <p class="sm muted">Nefes darlığı, hırıltı ve uzun süren öksürük alerjik astımın belirtisi olabilir.</p>
      </article>

      <article class="vcard">
        <button class="vcard-poster" data-video="<?php echo esc_attr(drre_video('nefes-darligi')); ?>" data-en-boy="9/16"
                data-baslik="Her nefes darlığı astım mıdır?"
                aria-label="Her nefes darlığı astım mıdır? — videoyu izle (0:38)">
          <?php /* drre-vkapak: gercek kapak, kendi sunucumuzdan (i.ytimg'e
                   ziyaretci istegi YOK); dosya yoksa soyut poster gosterilir */
          $vkId = drre_video('nefes-darligi');
          $vkYol = '/assets/img/video/' . $vkId . '.jpg';
          if ($vkId && file_exists(dirname(ABSPATH) . $vkYol)) : ?>
          <img src="<?php echo esc_url($vkYol); ?>" alt="" loading="lazy" decoding="async"
               style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:inherit">
          <?php else : ?>
          <svg viewBox="0 0 270 480" preserveAspectRatio="xMidYMid slice" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="vp7" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#F1F0F6"/><stop offset="1" stop-color="#DEDBEA"/></linearGradient></defs><rect width="270" height="480" fill="url(#vp7)"/><path d="M-10 360q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="3.5" stroke-linecap="round" opacity=".45"/><path d="M-10 396q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="2.5" stroke-linecap="round" opacity=".3"/><circle cx="205" cy="86" r="4" fill="#B98A3B" opacity=".65"/><circle cx="228" cy="120" r="2.5" fill="#B98A3B" opacity=".45"/><circle cx="52" cy="104" r="3" fill="#2E7C78" opacity=".35"/></svg>
          <?php endif; ?>
          <span class="vcard-play" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
          <span class="vcard-sure" aria-hidden="true">0:38</span>
        </button>
        <h3>Her nefes darlığı astım mıdır?</h3>
        <p class="sm muted">Nefes darlığının altında kalp hastalıkları dâhil farklı nedenler bulunabilir.</p>
      </article>

    </div>
  </div>
</section>

<section class="section section--mint" id="ozel-durumlar">
  <div class="wrap">
    <div class="section-head reveal">
      <p class="eyebrow">Konu 4</p>
      <h2>Alerjisi olanlar için özel durumlar</h2>
      <p>Alerjik hastaların başka bir işlem öncesinde sık sorduğu güvenlik soruları. Bu videolar bilgilendirme amaçlıdır; söz konusu işlemler bu muayenehanede uygulanmaz.</p>
    </div>
    <div class="vgrid reveal">

      <article class="vcard">
        <button class="vcard-poster" data-video="<?php echo esc_attr(drre_video('atopik')); ?>" data-en-boy="9/16"
                data-baslik="Atopik dermatit ve egzama hastaları mezoterapi yaptırabilir mi?"
                aria-label="Atopik dermatit ve egzama hastaları mezoterapi yaptırabilir mi? — videoyu izle (0:41)">
          <?php /* drre-vkapak: gercek kapak, kendi sunucumuzdan (i.ytimg'e
                   ziyaretci istegi YOK); dosya yoksa soyut poster gosterilir */
          $vkId = drre_video('atopik');
          $vkYol = '/assets/img/video/' . $vkId . '.jpg';
          if ($vkId && file_exists(dirname(ABSPATH) . $vkYol)) : ?>
          <img src="<?php echo esc_url($vkYol); ?>" alt="" loading="lazy" decoding="async"
               style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:inherit">
          <?php else : ?>
          <svg viewBox="0 0 270 480" preserveAspectRatio="xMidYMid slice" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="vp8" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#EAF6F4"/><stop offset="1" stop-color="#CFE7E3"/></linearGradient></defs><rect width="270" height="480" fill="url(#vp8)"/><path d="M-10 360q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="3.5" stroke-linecap="round" opacity=".45"/><path d="M-10 396q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="2.5" stroke-linecap="round" opacity=".3"/><circle cx="205" cy="86" r="4" fill="#B98A3B" opacity=".65"/><circle cx="228" cy="120" r="2.5" fill="#B98A3B" opacity=".45"/><circle cx="52" cy="104" r="3" fill="#2E7C78" opacity=".35"/></svg>
          <?php endif; ?>
          <span class="vcard-play" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
          <span class="vcard-sure" aria-hidden="true">0:41</span>
        </button>
        <h3>Atopik dermatit ve egzama hastaları mezoterapi yaptırabilir mi?</h3>
        <p class="sm muted">Atopik bireyler bazı kimyasallara ve ürünlere daha reaktif olabilir; öncesinde nelere bakılmalı?</p>
      </article>

      <article class="vcard">
        <button class="vcard-poster" data-video="<?php echo esc_attr(drre_video('botulinum')); ?>" data-en-boy="9/16"
                data-baslik="Botulinum toksin uygulaması alerjisi olanlara yapılabilir mi?"
                aria-label="Botulinum toksin uygulaması alerjisi olanlara yapılabilir mi? — videoyu izle (0:40)">
          <?php /* drre-vkapak: gercek kapak, kendi sunucumuzdan (i.ytimg'e
                   ziyaretci istegi YOK); dosya yoksa soyut poster gosterilir */
          $vkId = drre_video('botulinum');
          $vkYol = '/assets/img/video/' . $vkId . '.jpg';
          if ($vkId && file_exists(dirname(ABSPATH) . $vkYol)) : ?>
          <img src="<?php echo esc_url($vkYol); ?>" alt="" loading="lazy" decoding="async"
               style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:inherit">
          <?php else : ?>
          <svg viewBox="0 0 270 480" preserveAspectRatio="xMidYMid slice" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="vp9" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#F3EFE4"/><stop offset="1" stop-color="#E3DCC7"/></linearGradient></defs><rect width="270" height="480" fill="url(#vp9)"/><path d="M-10 360q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="3.5" stroke-linecap="round" opacity=".45"/><path d="M-10 396q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="2.5" stroke-linecap="round" opacity=".3"/><circle cx="205" cy="86" r="4" fill="#B98A3B" opacity=".65"/><circle cx="228" cy="120" r="2.5" fill="#B98A3B" opacity=".45"/><circle cx="52" cy="104" r="3" fill="#2E7C78" opacity=".35"/></svg>
          <?php endif; ?>
          <span class="vcard-play" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
          <span class="vcard-sure" aria-hidden="true">0:40</span>
        </button>
        <h3>Botulinum toksin uygulaması alerjisi olanlara yapılabilir mi?</h3>
        <p class="sm muted">Lateks, lokal anestezik ve yumurta alerjisi gibi başlıklar bu kararda neden önemli?</p>
      </article>

    </div>
  </div>
</section>


<!-- ═══ KANAL + DOKTOR NOTU ═══ -->
<section class="section">
  <div class="wrap wrap-narrow" style="padding-inline:0">

    <div class="doctor-note">
      <div class="dn-body">
        <p>“Videoları tek bir amaçla çekiyorum: muayene odasında on beş dakikada anlatmaya çalıştığımız konuları, hastalarımızın evde sakin kafayla, istedikleri kadar tekrar izleyerek dinleyebilmesi. Video izlemek muayenenin yerine geçmez; ama muayeneye hazırlıklı gelmenizi ve sorularınızı netleştirmenizi sağlar. Aradığınız konu kütüphanede henüz yoksa kanala göz atın — büyük ihtimalle orada bir karşılığı vardır.”</p>
        <span class="dn-who">Uzm. Dr. Ramazan Ersoy · İç Hastalıkları, Alerji ve Klinik İmmünoloji</span>
      </div>
    </div>

    <div class="btn-row" style="justify-content:center;margin-top:2rem">
      <a class="btn btn--primary" href="https://www.youtube.com/@dr.ramazanersoy1012" target="_blank" rel="noopener">Tüm videolar: YouTube kanalı</a>
      <a class="btn btn--wa" data-wa="Merhaba, video kütüphanenizi inceledim. Randevu almak istiyorum." data-wa-src="video-kutuphanesi" href="#">WhatsApp'tan yazın</a>
      <a class="btn btn--ghost" href="tel:+902127099396">0212 709 93 96</a>
    </div>

    <p class="xs muted center" style="margin-top:1.5rem">Videolardaki bilgiler genel bilgilendirme amaçlıdır; hekim muayenesinin, tanı ve tedavinin yerine geçmez. Kişisel durumunuz için hekiminize başvurunuz.</p>
  </div>
</section>

</main>

<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"CollectionPage",
  "name":"Dr. Ersoy anlatıyor — video kütüphanesi",
  "url":"https://drramazanersoy.tr/araclar/video-kutuphanesi/",
  "inLanguage":"tr",
  "description":"Alerji ve astım konularındaki hasta bilgilendirme videolarının konuya göre düzenlenmiş kütüphanesi.",
  "about":[
    {"@type":"MedicalCondition","name":"Alerjik Rinit"},
    {"@type":"MedicalCondition","name":"Astım"},
    {"@type":"MedicalCondition","name":"Besin Alerjisi"},
    {"@type":"MedicalCondition","name":"İlaç Alerjisi"}
  ],
  "author":{
    "@type":"Physician",
    "name":"Uzm. Dr. Ramazan Ersoy",
    "medicalSpecialty":"Allergy",
    "url":"https://drramazanersoy.tr/dr-ramazan-ersoy/"
  }
}
</script>
<?php get_footer(); ?>
