<?php
/**
 * Template Name: Alerji mi, Soğuk Algınlığı mı?
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
    <span aria-current="page">Alerji mi, soğuk algınlığı mı?</span>
  </nav>
</div>

<!-- ═══ BAŞLIK ═══ -->
<section class="section section--tight">
  <div class="wrap">
    <p class="eyebrow">Ücretsiz araçlar · 60 saniyelik değerlendirme</p>
    <h1>Alerji mi, soğuk algınlığı mı?</h1>
    <p class="hero-lede" style="max-width:62ch">“Yine üşüttüm herhalde” dediğiniz şikayetler haftalardır sürüyorsa, ortada bir soğuk algınlığı olmayabilir. Aşağıdaki 6 soruluk kısa değerlendirme, belirtilerinizin hangi tabloya daha yakın durduğu hakkında size fikir verir — tanı koymaz, yön gösterir.</p>
    <div class="byline">
      <span>Hazırlayan / İnceleyen: <b>Uzm. Dr. Ramazan Ersoy</b></span>
      <span>Yayın: 19 Temmuz 2026</span>
      <span>Son güncelleme: 19 Temmuz 2026</span>
      <span class="xs">Bu araç genel bilgilendirme amaçlıdır; tanı aracı değildir.</span>
    </div>
  </div>
</section>

<!-- ═══ TEST ═══ -->
<section class="section section--mint" id="test">
  <div class="wrap-narrow">
    <div class="section-head reveal">
      <p class="eyebrow">Kısa test</p>
      <h2>6 soruda fikir edinin</h2>
      <p>Her soruda size en yakın seçeneği işaretleyin. Dilerseniz önceki soruya dönüp yanıtınızı değiştirebilirsiniz.</p>
    </div>

    <div class="form-card reveal" aria-label="Alerji mi, soğuk algınlığı mı testi">

      <!-- İlerleme -->
      <div style="display:flex;align-items:center;justify-content:space-between;gap:1rem;margin-bottom:.6rem">
        <p class="sm" style="margin:0"><b id="q-progress-text">Soru 1 / 6</b></p>
        <button type="button" id="q-restart" class="btn btn--ghost btn--sm" hidden>↻ Baştan başla</button>
      </div>
      <div aria-hidden="true" style="height:8px;background:var(--mint-bg);border:1px solid var(--mint-line);border-radius:var(--r-pill);overflow:hidden;margin-bottom:1.5rem">
        <div id="q-progress-bar" style="height:100%;width:0%;background:var(--mint);border-radius:var(--r-pill);transition:width var(--t-mid) var(--ease)"></div>
      </div>

      <!-- Soru ekranı -->
      <div id="q-screen">
        <h3 id="q-question" tabindex="-1" style="margin-bottom:.4rem">Sorular yükleniyor…</h3>
        <p id="q-hint" class="sm muted" style="margin-bottom:1.25rem"></p>
        <div id="q-answers" class="stack" style="gap:.65rem"></div>
        <div style="margin-top:1.25rem">
          <button type="button" id="q-back" class="btn btn--ghost btn--sm" hidden>← Önceki soru</button>
        </div>
      </div>

      <!-- Sonuç (canlı bölge — panellerin üçü de sayfada hazır bekler) -->
      <div id="q-result" role="status" aria-live="polite">

        <div id="res-alerji" hidden>
          <span class="badge">Değerlendirme sonucu</span>
          <h3 tabindex="-1" style="margin:.8rem 0 .5rem">Belirtileriniz alerjiyi düşündürmektedir</h3>
          <p class="sm">Verdiğiniz yanıtlar — özellikle şikayetlerin uzun sürmesi, göz kaşıntısı, hapşırık nöbetleri ve belirli mevsim ya da ortamlarda artış — alerjik rinit ile uyumlu bir örüntüye işaret ediyor. Bu örüntü tek başına hastalık anlamına gelmez; ancak şikayetlerinizin bir alerji değerlendirmesinden geçmesi yerinde olur. Sorumlu alerjen deri testi ile çoğu zaman aynı muayenede belirlenebilir.</p>
          <div class="caution">
            <b>Bu test tanı aracı değildir;</b> yalnızca genel bilgilendirme amaçlıdır. Kesin değerlendirme için hekime başvurun.
          </div>
          <div class="btn-row" style="margin-top:1.1rem">
            <a class="btn btn--primary" href="/randevu/">Randevu Talep Et</a>
            <a class="btn btn--wa" data-wa="Merhaba, 'Alerji mi, soğuk algınlığı mı?' testini yaptım; sonuç alerjiyi düşündürüyor. Değerlendirme için randevu almak istiyorum." data-wa-src="alerji-testi-sonuc-alerji" href="#">WhatsApp'tan yazın</a>
          </div>
          <p class="xs muted" style="margin:1rem 0 0">Hatırlatma: Deri testi planlanırsa antihistaminik grubu ilaçların genellikle yaklaşık 10 gün önce kesilmesi gerekir. Randevu alırken kullandığınız ilaçları bildirin; kendi başınıza ilaç kesmeyin.</p>
          <p style="margin:1.25rem 0 0"><button type="button" class="btn btn--ghost btn--sm" data-restart>↻ Testi yeniden yapın</button></p>
        </div>

        <div id="res-soguk" hidden>
          <span class="badge">Değerlendirme sonucu</span>
          <h3 tabindex="-1" style="margin:.8rem 0 .5rem">Belirtileriniz soğuk algınlığına daha yakın görünmektedir</h3>
          <p class="sm">Verdiğiniz yanıtlar — kısa süreli şikayet, ateş ve koyu renkli akıntı gibi bulgular — öncelikle viral bir enfeksiyonu (soğuk algınlığı) düşündürüyor. Soğuk algınlığı genellikle 7–10 gün içinde kendiliğinden geriler; bol sıvı ve dinlenme çoğu zaman yeterlidir.</p>
          <p class="sm">Ancak şu durumlarda tabloyu yeniden değerlendirmek gerekir: şikayetleriniz <b>10 günden uzun</b> sürerse, her yıl aynı dönemde ya da aynı ortamda <b>tekrarlıyorsa</b>, tabloya öksürük, hırıltı veya nefes darlığı eklenirse.</p>
          <div class="caution">
            <b>Bu test tanı aracı değildir;</b> yalnızca genel bilgilendirme amaçlıdır. Kesin değerlendirme için hekime başvurun.
          </div>
          <p class="sm" style="margin-top:1rem"><a class="link-arrow" href="/hastaliklar/alerjik-rinit/">“Sürekli grip oluyorum” diyorsanız bu yazıyı okuyun</a></p>
          <p style="margin:1.25rem 0 0"><button type="button" class="btn btn--ghost btn--sm" data-restart>↻ Testi yeniden yapın</button></p>
        </div>

        <div id="res-karisik" hidden>
          <span class="badge">Değerlendirme sonucu</span>
          <h3 tabindex="-1" style="margin:.8rem 0 .5rem">Karışık tablo</h3>
          <p class="sm">Yanıtlarınız iki yönü de işaret ediyor: bazı bulgularınız alerjiye, bazıları enfeksiyona daha yakın. Bu iki durum bir arada da bulunabilir — alerjik zemin üzerine binen bir soğuk algınlığı sık görülen bir tablodur. Şikayetleriniz sürüyor ya da yaşam kalitenizi etkiliyorsa, ayrımı muayene ile netleştirmek en sağlıklısıdır.</p>
          <div class="caution">
            <b>Bu test tanı aracı değildir;</b> yalnızca genel bilgilendirme amaçlıdır. Kesin değerlendirme için hekime başvurun.
          </div>
          <div class="btn-row" style="margin-top:1.1rem">
            <a class="btn btn--primary" href="/randevu/">Randevu Talep Et</a>
            <a class="btn btn--wa" data-wa="Merhaba, 'Alerji mi, soğuk algınlığı mı?' testini yaptım; sonuç karışık tablo çıktı. Ayrımın netleşmesi için değerlendirme randevusu almak istiyorum." data-wa-src="alerji-testi-sonuc-karisik" href="#">WhatsApp'tan yazın</a>
            <a class="btn btn--ghost" href="tel:+902127099396">0212 709 93 96</a>
          </div>
          <p style="margin:1.25rem 0 0"><button type="button" class="btn btn--ghost btn--sm" data-restart>↻ Testi yeniden yapın</button></p>
        </div>

      </div>

      <noscript>
        <div class="caution">
          <b>Bu test, tarayıcınızda JavaScript açıkken çalışır.</b> JavaScript kullanmıyorsanız aşağıdaki belirti karşılaştırma tablosundan aynı bilgilere ulaşabilirsiniz.
        </div>
      </noscript>

      <p class="form-note">Yanıtlarınız yalnızca kendi cihazınızda değerlendirilir; kaydedilmez ve hiçbir yere gönderilmez. (Demo sürüm — bu sayfa bilgilendirme amaçlıdır.)</p>
    </div>
  </div>
</section>

<!-- ═══ KARŞILAŞTIRMA TABLOSU ═══ -->
<section class="section">
  <div class="wrap-narrow prose">
    <p class="eyebrow">Arka plan</p>
    <h2 style="margin-top:0" id="tablo">Belirti belirti karşılaştırma</h2>
    <p>Testteki soruların dayandığı ayrım noktaları aşağıdadır. İki tablonun en güvenilir ayırıcıları <strong>süre</strong>, <strong>kaşıntı</strong>, <strong>ateş</strong> ve <strong>tekrarlama düzeni</strong>dir.</p>

    <div class="tablewrap">
      <table>
        <thead>
          <tr><th>Belirti</th><th>Alerjik rinit</th><th>Soğuk algınlığı</th></tr>
        </thead>
        <tbody>
          <tr><td><b>Başlangıç</b></td><td>Alerjenle karşılaşınca dakikalar içinde, aniden</td><td>1–3 gün içinde yavaş yavaş</td></tr>
          <tr><td><b>Süre</b></td><td>Haftalar–aylar; maruziyet sürdükçe devam eder</td><td>Genellikle 7–10 gün içinde geçer</td></tr>
          <tr><td><b>Ateş</b></td><td>Yok</td><td>Olabilir (özellikle ilk günlerde)</td></tr>
          <tr><td><b>Kaşıntı (burun, damak, göz)</b></td><td>Belirgin — en ayırt edici bulgu</td><td>Nadir veya yok</td></tr>
          <tr><td><b>Göz sulanması / kızarıklık</b></td><td>Sık eşlik eder</td><td>Hafif olabilir, ön planda değildir</td></tr>
          <tr><td><b>Akıntının rengi</b></td><td>Su gibi berrak, sulu kalır</td><td>Başta berrak, birkaç gün sonra koyulaşabilir</td></tr>
          <tr><td><b>Hapşırık</b></td><td>Nöbetler hâlinde, arka arkaya</td><td>Ara sıra, tek tük</td></tr>
          <tr><td><b>Boğaz ağrısı / kas ağrısı</b></td><td>Beklenmez (geniz akıntısına bağlı gıcık olabilir)</td><td>Sık</td></tr>
          <tr><td><b>Tekrarlama düzeni</b></td><td>Her yıl aynı mevsimde ya da aynı ortamda</td><td>Rastgele; kış aylarında daha sık</td></tr>
          <tr><td><b>Çevredekilere bulaşma</b></td><td>Bulaşmaz</td><td>Bulaşır</td></tr>
        </tbody>
      </table>
    </div>

    <div class="caution">
      <b>Bu tablo bir tanı aracı değildir.</b> ARIA ve benzeri rehber belgelerdeki genel bilgiler esas alınmıştır; belirtiler kişiden kişiye farklılık gösterebilir ve iki durum bir arada bulunabilir. Kesin ayrım muayene ve gerektiğinde testle yapılır.
    </div>

    <h2 id="ne-zaman-doktora">Testten bağımsız: ne zaman hekime başvurmalı?</h2>
    <p>Test sonucunuz ne çıkarsa çıksın, aşağıdaki durumlardan biri sizde varsa bir değerlendirme için başvurmanız yerinde olur:</p>
    <ul>
      <li>Şikayetleriniz <b>iki haftadan uzun</b> sürüyor ya da her yıl aynı dönemde tekrarlıyorsa.</li>
      <li>Uykunuz bölünüyor, gündüz kendinizi yorgun ve dikkatiniz dağınık hissediyorsanız.</li>
      <li>Eczaneden aldığınız ilaçlar geçici rahatlatıyor, şikayet ilaç bitince geri geliyorsa.</li>
      <li>Tabloya <b>öksürük, göğüste hırıltı veya nefes darlığı</b> eklendiyse.</li>
      <li>Koku alma duyunuz azaldıysa, tıkanıklık tek taraflıysa ya da yüzde baskı-ağrı hissi varsa.</li>
      <li>Yılda birkaç kez sinüzit tanısı alıyor, tekrarlayan antibiyotik kullanıyorsanız.</li>
    </ul>
    <p class="sm muted">Muayenehanede <b>yetişkin hastalar</b> kabul edilmektedir. 18 yaş altı için çocuk alerji ve immünoloji uzmanına başvurmanızı öneririz.</p>

    <div class="emergency" style="margin:1.75rem 0">
      <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2L1 21h22L12 2zm1 14h-2v2h2v-2zm0-6h-2v5h2v-5z"/></svg>
      <div>
        <strong>Acil durumlar için</strong>
        <p>Nefes darlığı, dilde veya boğazda şişme, konuşmakta zorlanma, baygınlık hissi veya yaygın döküntü varsa bu sayfayla vakit kaybetmeyin — hemen <a href="tel:112">112</a>'yi arayın.</p>
      </div>
    </div>

    <p class="xs muted">Bu sayfadaki bilgiler genel bilgilendirme amaçlıdır; hekim muayenesinin, tanı ve tedavinin yerine geçmez. Kişisel durumunuz için hekiminize başvurunuz.</p>
  </div>
</section>

<!-- ═══ İLGİLİ SAYFALAR ═══ -->
<section class="section section--mint">
  <div class="wrap">
    <div class="section-head reveal">
      <p class="eyebrow">Devamı</p>
      <h2>Bu aracı kullananlar bunlara da baktı</h2>
    </div>
    <div class="grid-3 reveal">
      <a class="tool-card" href="/hastaliklar/alerjik-rinit/">
        <svg class="t-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M16 5v10M11 15h10M9 22q7 5 14 0"/><circle cx="16" cy="15" r="2.5"/></svg>
        <h3>Alerjik Rinit</h3>
        <p>Burun akıntısı, tıkanıklık ve hapşırık nöbetleri — nedenleri, tanısı ve tedavi basamakları.</p>
      </a>
      <a class="tool-card" href="/araclar/astim-kontrol-testi/">
        <svg class="t-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 24l6-8 5 5 6-11 7 9"/><path d="M4 28h24"/></svg>
        <h3>Astım Kontrol Testi</h3>
        <p>Astımınız kontrol altında mı? Standart 5 soruluk ACT ile ölçün.</p>
      </a>
      <a class="tool-card" href="/araclar/polen-takvimi/">
        <svg class="t-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><rect x="4" y="7" width="24" height="21" rx="3"/><path d="M4 14h24M11 4v6M21 4v6"/></svg>
        <h3>İstanbul Polen Takvimi</h3>
        <p>Bu ay havada ne var? Ağaç, çim ve yabani ot polenlerinin aylık dağılımı.</p>
      </a>
    </div>
  </div>
</section>

<!-- ═══ KAPANIŞ CTA ═══ -->
<section class="section section--cream">
  <div class="wrap wrap-narrow center" style="padding-inline:0">
    <p class="eyebrow">Randevu</p>
    <h2>Şikayetinizin adını birlikte koyalım</h2>
    <p>Test size yalnızca fikir verir; ayrımı netleştiren şey muayenedir. Formu doldurun ya da doğrudan yazın; <strong>aynı gün içinde</strong> sizi arayalım.</p>
    <div class="btn-row" style="justify-content:center;margin-top:1.5rem">
      <a class="btn btn--primary" href="/randevu/">Randevu Talep Et</a>
      <a class="btn btn--wa" data-wa="Merhaba, 'Alerji mi, soğuk algınlığı mı?' testini yaptım. Şikayetlerimin değerlendirilmesi için randevu almak istiyorum." data-wa-src="alerji-testi-kapanis" href="#">WhatsApp'tan yazın</a>
      <a class="btn btn--ghost" href="tel:+902127099396">0212 709 93 96</a>
    </div>
    <p class="sm muted" style="margin-top:1.25rem">Harbiye Mah. Teşvikiye Cad. 37/3 · Şişli / İstanbul (Nişantaşı)</p>
  </div>
</section>

</main>

<!-- KURTARILAN INLINE BETIK (script-kurtar.js): statik sayfada </main> sonrasindaydi,
     donusturucu almamisti; arac islevselligi bu bloklara bagli -->
<script>
(function () {
  'use strict';

  /* Puanlama: her yanıt "a" (alerji) ve "c" (soğuk algınlığı) puanı toplar.
     Sonuç: a - c >= 3  → alerjiyi düşündürür
            c - a >= 3  → soğuk algınlığına daha yakın
            aradaysa    → karışık tablo
     Bu eşikler bilgilendirme amaçlıdır; hiçbir sonuç tanı değildir. */
  var QUESTIONS = [
    {
      q: 'Şikayetleriniz 10 günden uzun süredir mi devam ediyor?',
      hint: 'Soğuk algınlığı çoğu zaman 7–10 gün içinde kendiliğinden geriler; alerjik şikayetler maruziyet sürdükçe haftalarca sürebilir.',
      opts: [
        { label: 'Evet, 10 günden uzun sürüyor', a: 2, c: 0 },
        { label: 'Hayır, birkaç gündür var', a: 0, c: 1 }
      ]
    },
    {
      q: 'Ateşiniz var mı ya da son günlerde oldu mu?',
      hint: 'Alerjide ateş beklenmez; ateş öncelikle enfeksiyon lehine bir bulgudur.',
      opts: [
        { label: 'Evet, ateşim var / oldu', a: 0, c: 2 },
        { label: 'Hayır, ateşim olmadı', a: 1, c: 0 }
      ]
    },
    {
      q: 'Gözlerinizde kaşıntı, sulanma veya kızarıklık var mı?',
      hint: 'Göz kaşıntısı ve sulanması alerjik tabloya sık eşlik eder; soğuk algınlığında bu kadar belirgin olması beklenmez.',
      opts: [
        { label: 'Evet, gözlerim kaşınıyor / sulanıyor', a: 2, c: 0 },
        { label: 'Hayır, göz şikayetim yok', a: 0, c: 1 }
      ]
    },
    {
      q: 'Hapşırıklarınız nöbetler hâlinde, art arda mı geliyor?',
      hint: 'Arka arkaya beş-on kez gelen hapşırık nöbetleri alerjik rinit için tipiktir.',
      opts: [
        { label: 'Evet, art arda geliyor', a: 2, c: 0 },
        { label: 'Hayır, ara sıra tek tük hapşırıyorum', a: 0, c: 1 }
      ]
    },
    {
      q: 'Şikayetleriniz belirli bir mevsimde ya da belirli bir ortamda mı artıyor?',
      hint: 'Örneğin her ilkbahar, açık havada, ev temizliğinde ya da hayvanla temasta artış — alerjiyi düşündüren bir düzendir.',
      opts: [
        { label: 'Evet, belirli mevsim/ortamda artıyor', a: 2, c: 0 },
        { label: 'Hayır, böyle bir düzen fark etmedim', a: 0, c: 1 }
      ]
    },
    {
      q: 'Burun akıntınız nasıl?',
      hint: 'Alerjide akıntı genellikle su gibi berrak kalır; enfeksiyonda birkaç gün içinde koyulaşabilir.',
      opts: [
        { label: 'Şeffaf, su gibi akıyor', a: 2, c: 0 },
        { label: 'Koyu (sarı-yeşil) renkte', a: 0, c: 2 },
        { label: 'Belirgin akıntım yok / emin değilim', a: 0, c: 0 }
      ]
    }
  ];

  var screen   = document.getElementById('q-screen');
  var qEl      = document.getElementById('q-question');
  var hintEl   = document.getElementById('q-hint');
  var answers  = document.getElementById('q-answers');
  var backBtn  = document.getElementById('q-back');
  var restart  = document.getElementById('q-restart');
  var barEl    = document.getElementById('q-progress-bar');
  var textEl   = document.getElementById('q-progress-text');
  var panels   = {
    alerji:  document.getElementById('res-alerji'),
    soguk:   document.getElementById('res-soguk'),
    karisik: document.getElementById('res-karisik')
  };
  if (!screen || !qEl || !answers) return;

  var idx = 0;
  var chosen = []; // her sorunun seçilen seçenek indeksi

  function hidePanels() {
    Object.keys(panels).forEach(function (k) {
      if (panels[k]) panels[k].hidden = true;
    });
  }

  function render(moveFocus) {
    hidePanels();
    screen.hidden = false;
    var item = QUESTIONS[idx];
    textEl.textContent = 'Soru ' + (idx + 1) + ' / ' + QUESTIONS.length;
    barEl.style.width = (((idx + 1) / QUESTIONS.length) * 100).toFixed(1) + '%';
    qEl.textContent = item.q;
    hintEl.textContent = item.hint;

    answers.innerHTML = '';
    item.opts.forEach(function (opt, i) {
      var btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'btn btn--ghost';
      btn.style.cssText = 'width:100%;justify-content:flex-start;text-align:left;line-height:1.35';
      btn.textContent = opt.label;
      if (chosen[idx] === i) {
        btn.setAttribute('aria-pressed', 'true');
        btn.style.background = 'var(--mint-bg)';
        btn.style.borderColor = 'var(--mint-ink)';
      }
      btn.addEventListener('click', function () {
        chosen[idx] = i;
        if (idx < QUESTIONS.length - 1) {
          idx++;
          render(true);
        } else {
          showResult();
        }
      });
      answers.appendChild(btn);
    });

    backBtn.hidden = idx === 0;
    restart.hidden = idx === 0 && chosen.length === 0;
    if (moveFocus) qEl.focus();
  }

  function showResult() {
    var a = 0, c = 0;
    QUESTIONS.forEach(function (item, qi) {
      var opt = item.opts[chosen[qi]];
      if (opt) { a += opt.a; c += opt.c; }
    });
    var key = 'karisik';
    if (a - c >= 3) key = 'alerji';
    else if (c - a >= 3) key = 'soguk';

    screen.hidden = true;
    hidePanels();
    textEl.textContent = 'Test tamamlandı';
    barEl.style.width = '100%';
    restart.hidden = false;

    var panel = panels[key];
    if (panel) {
      panel.hidden = false;
      var h = panel.querySelector('h3');
      if (h) h.focus();
    }
  }

  function resetQuiz() {
    idx = 0;
    chosen = [];
    render(true);
  }

  backBtn.addEventListener('click', function () {
    if (idx > 0) { idx--; render(true); }
  });
  restart.addEventListener('click', resetQuiz);
  document.querySelectorAll('[data-restart]').forEach(function (btn) {
    btn.addEventListener('click', resetQuiz);
  });

  render(false);
})();
</script>
<?php get_footer(); ?>
