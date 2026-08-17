<?php
/** 404 — statik 404.html'den devşirildi. */
if (!defined('ABSPATH')) exit;
get_header();
?>
<main id="icerik">
  <section class="hero" style="min-height:70vh;display:flex;align-items:center">
    <div class="wrap split">
      <div>
        <p class="eyebrow">404 — Sayfa bulunamadı</p>
        <h1>Aradığınız sayfa burada değil</h1>
        <p class="hero-lede">Adres değişmiş ya da yanlış yazılmış olabilir. Ama merak etmeyin — aradığınız bilgi büyük ihtimalle bir tık uzağınızda.</p>
        <div class="btn-row" style="margin-bottom:1.5rem">
          <a class="btn btn--primary" href="/">Anasayfaya dön</a>
          <a class="btn btn--ghost" href="/randevu/">Randevu talep et</a>
        </div>
        <div class="card card--flat" style="background:var(--mint-bg);border-color:var(--mint-line)">
          <p class="sm" style="margin-bottom:.6rem"><strong>Sık aranan sayfalar:</strong></p>
          <ul class="sm" style="margin:0;columns:2;column-gap:2rem">
            <li><a href="/hastaliklar/alerjik-rinit/">Alerjik Rinit</a></li>
            <li><a href="/hastaliklar/astim/">Astım</a></li>
            <li><a href="/testler/deri-prick-testi/">Deri Testi</a></li>
            <li><a href="/tedaviler/alerji-asisi-immunoterapi/">Alerji Aşısı</a></li>
            <li><a href="/araclar/polen-takvimi/">Polen Takvimi</a></li>
            <li><a href="/iletisim/">İletişim</a></li>
          </ul>
        </div>
      </div>
      <div aria-hidden="true" style="display:flex;align-items:center;justify-content:center">
        <svg viewBox="0 0 300 220" style="max-width:340px" role="img" aria-label="Rüzgarda savrulan polen taneleri illüstrasyonu">
          <path d="M20 160 q60-70 130-40 t130-30" fill="none" stroke="#6DBEBB" stroke-width="3" stroke-linecap="round" stroke-dasharray="1 10" opacity=".8"/>
          <path d="M10 190 q70-50 140-25 t140-40" fill="none" stroke="#2E7C78" stroke-width="2.5" stroke-linecap="round" opacity=".45"/>
          <g fill="#B98A3B">
            <circle cx="70" cy="120" r="8" opacity=".55"/>
            <circle cx="150" cy="95" r="12" opacity=".4"/>
            <circle cx="215" cy="120" r="6" opacity=".6"/>
            <circle cx="255" cy="80" r="9" opacity=".35"/>
            <circle cx="110" cy="70" r="5" opacity=".5"/>
          </g>
          <text x="150" y="205" text-anchor="middle" font-family="Georgia,serif" font-size="15" fill="#6B7A77" font-style="italic">Bu sayfa rüzgarda savrulmuş…</text>
        </svg>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
