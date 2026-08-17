<?php
/**
 * Anasayfa — statik index.html'den devşirildi (tam-devir.js).
 * front-page.php, Ayarlar > Okuma'dan bağımsız olarak kök adreste kazanır.
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
<main id="icerik">

<!-- ═══ 1 · HERO ═══ -->
<section class="hero">
  <div class="wrap hero-grid">
    <div class="hero-copy">
      <p class="eyebrow">Yetişkin Alerji ve Astım Uzmanı · İstanbul</p>
      <h1>Rahat nefes almak için ilk adım</h1>
      <p class="hero-lede">Alerjinizi bastırmayın; kaynağını bulalım, birlikte çözelim. Yıllarca “bahar nezlesi” denip geçilen şikayetlerin ardında çoğu zaman teşhis edilebilir bir alerji vardır.</p>
      <div class="btn-row">
        <a class="btn btn--primary" href="/randevu/">Randevu Talep Et</a>
        <a class="btn btn--ghost" href="#sikayet">Şikayetinize göre başlayın ↓</a>
      </div>
      <p class="hero-assure">
        <span><svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 1l2.6 5.3 5.9.9-4.3 4.1 1 5.8L10 14.4 4.8 17.1l1-5.8L1.5 7.2l5.9-.9z"/></svg> 25+ yıl hekimlik</span>
        <span><svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zm3.7 6.2l-4.4 4.4a1 1 0 01-1.4 0L6 10.7l1.4-1.4 1.2 1.2 3.7-3.7z"/></svg> EAACI üyesi</span>
        <span><svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M4 3h12v2H4zm0 4h12v2H4zm0 4h8v2H4z"/></svg> Aynı gün geri dönüş</span>
      </p>
    </div>

    <figure class="hero-media" style="margin:0">
      <?php
      /* Hero görseli: tanışma videosunun GERÇEK karesi (kendi sunucumuzdan,
         hekim kendi videosunda göründüğü için foto izni sorunu yok).
         Kapak dosyası yoksa AI oda görseline düşer. Kullanıcı geri bildirimi
         (17 Ağu): "play rozeti var ama kare boş görünüyor" — video karesi
         hekim yüzü gösterince davet gerçek oldu. */
      $heroVid = drre_video('tanisma');
      $heroKapak = '/assets/img/video/' . $heroVid . '.jpg';
      if ($heroVid && file_exists(dirname(ABSPATH) . $heroKapak)) : ?>
      <img src="<?php echo esc_url($heroKapak); ?>"
           alt="Uzm. Dr. Ramazan Ersoy, tanışma videosundan bir kare — muayenehanesinde konuşuyor"
           width="405" height="720" fetchpriority="high"
           style="width:100%;height:100%;object-fit:cover;border-radius:inherit">
      <?php else : ?>
      <!-- Yedek: yapay zekâ üretimi oda görseli (nano_banana_pro 4K) -->
      <img src="assets/img/icerik/hero-dikey-960.webp"
           srcset="assets/img/icerik/hero-dikey-640.webp 640w, assets/img/icerik/hero-dikey-960.webp 960w, assets/img/icerik/hero-dikey-1440.webp 1440w"
           sizes="(max-width:900px) 100vw, 560px"
           alt="Muayenehanede tül perdeli pencere önünde koyu yeşil koltuk, yanında stetoskop ve zeytin dalı duran ahşap sehpa"
           width="800" height="1000" fetchpriority="high">
      <?php endif; ?>
      <button class="play-badge" data-video="<?php echo esc_attr(drre_video('tanisma')); ?>" data-en-boy="9/16"
              data-baslik="Uzm. Dr. Ramazan Ersoy — tanışma"
              aria-label="Uzm. Dr. Ramazan Ersoy tanışma videosunu izle (36 saniye)">
        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
      </button>
      <!-- Süre GERÇEK videodan: kanaldaki tanışma videosu 0:36.
           Önceki "90 saniye" ibaresi temsilîydi ve gerçeği yansıtmıyordu. -->
      <figcaption class="play-label">Tanışma videosu · 36 saniye</figcaption>
    </figure>
  </div>
  <svg class="wave-divider" viewBox="0 0 1200 48" preserveAspectRatio="none" aria-hidden="true">
    <path d="M0,24 C180,52 360,-4 600,20 C840,44 1020,4 1200,26 L1200,48 L0,48 Z" fill="#FFFFFF"/>
  </svg>
</section>

<!-- ═══ 1b · YOL HARİTASI ŞERİDİ (araç ailesi girişi) ═══ -->
<section class="section section--tight" id="yol-haritasi-serit" style="padding-top:0;padding-bottom:0">
  <div class="wrap">
    <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:1rem;border:1.5px solid var(--line);border-radius:14px;padding:1.1rem 1.4rem;background:var(--cream)">
      <p style="margin:0;font-size:.95rem"><strong>Nereden başlayacağınızı bilmiyor musunuz?</strong>
        Şikayetinizi kendi cümlelerinizle yazın, size doğru sayfayı ve testi önerelim.</p>
      <a class="btn btn--primary" href="/araclar/belirti-yol-haritasi/">Belirti Yol Haritası</a>
    </div>
  </div>
</section>

<!-- ═══ 2 · SEMPTOM KAPISI (konseptin imzası) ═══ -->
<section class="section section--tight" id="sikayet">
  <div class="wrap">
    <div class="section-head reveal">
      <p class="eyebrow">Nereden başlamalı?</p>
      <h2>Hangisini yaşıyorsunuz?</h2>
      <p>Tıbbi adını bilmenize gerek yok. Kendi cümlenizi seçin, doğru sayfaya birlikte gidelim.</p>
    </div>
    <div class="symptom-grid reveal">
      <a class="symptom-card" href="/hastaliklar/alerjik-rinit/">
        <svg class="sym-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M16 5v10M11 15h10M9 22q7 5 14 0"/><circle cx="16" cy="15" r="2.5"/></svg>
        <p class="quote">“Burnum sürekli akıyor, tıkanıyor.”</p>
        <p class="term"><b>Alerjik Rinit</b> · hapşırık, geniz akıntısı</p>
      </a>
      <a class="symptom-card" href="/hastaliklar/astim/">
        <svg class="sym-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M16 6v8M10 14q-4 2-4 7t5 5 4-5v-7M22 14q4 2 4 7t-5 5-4-5v-7"/></svg>
        <p class="quote">“Geceleri öksürüyorum, göğsümde hırıltı var.”</p>
        <p class="term"><b>Astım</b> · nefes darlığı, gece öksürüğü</p>
      </a>
      <a class="symptom-card" href="/hastaliklar/urtiker/">
        <svg class="sym-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M6 20q5-6 10 0t10 0"/><circle cx="11" cy="11" r="2.5"/><circle cx="20" cy="9" r="2"/><circle cx="24" cy="14" r="1.6"/></svg>
        <p class="quote">“Cildim kaşınıyor, kurdeşen döküyorum.”</p>
        <p class="term"><b>Ürtiker &amp; Egzama</b> · kabarıklık, kaşıntı</p>
      </a>
      <a class="symptom-card" href="/hastaliklar/besin-alerjisi/">
        <svg class="sym-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M9 6v9a4 4 0 008 0V6M13 6v6M23 6q3 4 0 9v11"/></svg>
        <p class="quote">“Bazı yiyecekler bana dokunuyor.”</p>
        <p class="term"><b>Besin Alerjisi</b> · döküntü, şişme, mide şikayeti</p>
      </a>
      <a class="symptom-card" href="/hastaliklar/ilac-alerjisi/">
        <svg class="sym-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><rect x="5" y="13" width="22" height="8" rx="4"/><path d="M16 13v8"/></svg>
        <p class="quote">“İlaç kullanınca reaksiyon oldu.”</p>
        <p class="term"><b>İlaç Alerjisi</b> · döküntü, şişlik</p>
      </a>
      <a class="symptom-card" href="/hastaliklar/ari-alerjisi/">
        <svg class="sym-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><ellipse cx="16" cy="19" rx="6" ry="7"/><path d="M10 16h12M10 21h12M12 11l-4-4M20 11l4-4"/></svg>
        <p class="quote">“Arı soktu, çok kötü geçirdim.”</p>
        <p class="term"><b>Arı Alerjisi</b> · yaygın reaksiyon riski</p>
      </a>
      <a class="symptom-card" href="/hastaliklar/herediter-anjiyoodem/">
        <svg class="sym-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M16 8q6 0 6 5.5T16 24q-6-5-6-10.5T16 8z"/><path d="M6 12l-2-2M26 12l2-2M6 20l-2 2M26 20l2 2"/></svg>
        <p class="quote">“Şişliklerim kaşıntısız, ilaçlar geçirmiyor.”</p>
        <p class="term"><b>Herediter Anjiyoödem</b> · tekrarlayan ödem atakları</p>
      </a>
      <a class="symptom-card" href="/hastaliklar/mastositoz/">
        <svg class="sym-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><rect x="5" y="7" width="22" height="18" rx="4"/><circle cx="12" cy="13" r="1.6"/><circle cx="19" cy="11.5" r="1.2"/><circle cx="22" cy="17" r="1.6"/><circle cx="13" cy="19.5" r="1.2"/></svg>
        <p class="quote">“Ciltte kahverengi lekeler, ani kızarma oluyor.”</p>
        <p class="term"><b>Mastositoz</b> · flushing, kaşıntı, atak riski</p>
      </a>
    </div>
    <p class="reveal center sm muted" style="margin-top:1.5rem">
      Şikayetiniz burada yok mu, hangisi olduğundan emin değil misiniz?
      <a class="link-arrow" href="/randevu/" style="display:inline-flex">Bize yazın, birlikte bakalım</a>
    </p>
  </div>
</section>

<!-- ═══ 3 · TIKLANABİLİR SAYAÇ BANDI (KÜRSÜ aşısı) ═══ -->
<section class="proof-band">
  <div class="wrap">
    <div class="proof-grid">
      <a class="proof-item" href="/dr-ramazan-ersoy/">
        <span class="num"><span data-count="25" data-suffix="+">25+</span></span>
        <span class="lbl">yıl hekimlik deneyimi</span>
        <span class="go">Özgeçmişi görün →</span>
      </a>
      <?php /* "~1200 hasta" sayacı bilinçli emekli edildi: doğrulanamaz
               niceliksel deneyim iddiası (gece denetimi bulgusu, mevzuat
               riski). Yerine belgeyle doğrulanabilir yıl bilgisi. */ ?>
      <a class="proof-item" href="/tedaviler/alerji-asisi-immunoterapi/">
        <span class="num"><span data-count="2009">2009</span></span>
        <span class="lbl">'dan beri immünoterapi uygulaması</span>
        <span class="go">Aşı tedavisini okuyun →</span>
      </a>
      <a class="proof-item" href="/yayinlar-ve-oduller/">
        <span class="num"><span data-count="10">10</span></span>
        <span class="lbl">bilimsel yayın + 2 kongre ödülü</span>
        <span class="go">Yayınları inceleyin →</span>
      </a>
      <a class="proof-item" href="/dr-ramazan-ersoy/#uyelikler">
        <span class="num">EAACI</span>
        <span class="lbl">üyesi + 5 ulusal dernek</span>
        <span class="go">Üyelikleri görün →</span>
      </a>
    </div>
    <p class="proof-note">Rakamlar yaklaşık değerlerdir ve doğrulanabilir kaynaklara dayanır. Her başlık kendi kanıt sayfasına bağlıdır.</p>
  </div>
</section>

<!-- ═══ 4 · MERHABA, BEN DR. RAMAZAN ERSOY ═══ -->
<section class="section section--cream">
  <div class="wrap split">
    <div class="reveal">
      <figure style="margin:0;border-radius:var(--r-lg);overflow:hidden;box-shadow:var(--shadow-md);position:relative">
        <img src="assets/img/portrait-placeholder.svg" alt="Uzm. Dr. Ramazan Ersoy" width="400" height="400">
      </figure>
    </div>
    <div class="reveal">
      <p class="eyebrow">Tanışalım</p>
      <h2>Merhaba, ben Dr. Ramazan Ersoy</h2>
      <div class="doctor-note" style="background:#fff;border-color:var(--line);margin:1.25rem 0">
        <div class="dn-body">
          <p>“Yıllarca <em>bahar nezlesi</em> ya da <em>kronik grip</em> denip geçilen şikayetlerin ardında çoğu zaman teşhis edilebilir bir alerji vardır. İşim, o kaynağı bulmak — ve size şikayetinizi bastıran değil, sebebini hedefleyen bir plan sunmak.”</p>
          <span class="dn-who">Uzm. Dr. Ramazan Ersoy · İç Hastalıkları, Alerji ve Klinik İmmünoloji</span>
        </div>
      </div>
      <ul class="timeline" style="margin-top:1.5rem">
        <li><span class="tl-when">1993</span><span class="tl-what">İstanbul Üniversitesi Tıp Fakültesi</span></li>
        <li><span class="tl-when">2009</span><span class="tl-what">Alerji ve Klinik İmmünoloji yan dal uzmanlığı</span></li>
        <li class="is-gold"><span class="tl-when">Yedikule EAH</span><span class="tl-what">Alerji laboratuvarının kuruluşu</span><p>Hastanenin alerji test altyapısını kurdu ve yönetti.</p></li>
        <li><span class="tl-when">2017 — bugün</span><span class="tl-what">Nişantaşı, İstanbul</span></li>
      </ul>
      <a class="link-arrow" href="/dr-ramazan-ersoy/">Doktoru yakından tanıyın</a>
    </div>
  </div>
</section>

<!-- ═══ 5 · YAYINLAR & ÖDÜLLER MİNİ VİTRİNİ (KÜRSÜ aşısı) ═══ -->
<section class="section section--tight">
  <div class="wrap">
    <div class="section-head reveal">
      <p class="eyebrow">Kanıt</p>
      <h2>Bilimsel yayınlar ve ödüller</h2>
      <p>İddia değil, kayıt. Yayınların tamamı doğrulanabilir künyeleriyle listelenmiştir.</p>
    </div>
    <div class="grid-3 reveal">
      <article class="card">
        <span class="badge badge--gold">2007 · Birincilik</span>
        <h3 style="margin-top:.75rem">Zeytin poleni immünoterapisi</h3>
        <p class="sm muted">Ulusal Alerji ve Klinik İmmünoloji Kongresi — bildiri birincilik ödülü.</p>
      </article>
      <article class="card">
        <span class="badge badge--gold">2007 · Üçüncülük</span>
        <h3 style="margin-top:.75rem">Lateks alerjisi çalışması</h3>
        <p class="sm muted">Ulusal kongre bildiri üçüncülük ödülü.</p>
      </article>
      <article class="card">
        <span class="badge">10 yayın</span>
        <h3 style="margin-top:.75rem">Hakemli dergilerde yayınlar</h3>
        <p class="sm muted">Alerjik hastalıklar ve immünoterapi alanında ulusal ve uluslararası yayınlar.</p>
        <a class="link-arrow sm" href="/yayinlar-ve-oduller/">Tümünü görün</a>
      </article>
    </div>
  </div>
</section>

<!-- ═══ 6 · NASIL ÇALIŞIYORUZ ═══ -->
<section class="section section--mint">
  <div class="wrap">
    <div class="section-head reveal">
      <p class="eyebrow">Süreç</p>
      <h2>Nasıl çalışıyoruz?</h2>
      <p>İlk görüşmeden tedavi planına kadar dört adım. Her adımda ne olacağını önceden bilirsiniz.</p>
    </div>
    <ol class="steps reveal">
      <li>
        <span class="step-n">1</span>
        <h3>Dinliyoruz</h3>
        <p>İlk muayenede hikâyenizi baştan anlatırsınız: şikayetleriniz ne zaman başladı, hangi mevsimde artıyor, evinizde ve işinizde neler var.</p>
      </li>
      <li>
        <span class="step-n">2</span>
        <h3>Test ediyoruz</h3>
        <p>Gerekli görülürse deri testi (20–30 dakika, kanatmaz, sonucu 15 dakikada okunur), kan testi veya solunum fonksiyon testi yapılır.</p>
      </li>
      <li>
        <span class="step-n">3</span>
        <h3>Adlandırıyoruz</h3>
        <p>Şikayetinizin adını ve kaynağını netleştirir, size özel yazılı bir plan çıkarırız. Neden kaçınacağınızı ve neyi tedavi edeceğimizi birlikte konuşuruz.</p>
      </li>
      <li>
        <span class="step-n">4</span>
        <h3>Yanınızda kalıyoruz</h3>
        <p>Kontrol randevuları ve gerektiğinde alerji aşısı (immünoterapi) ile süreç takip edilir. Değişen şikayetlere göre plan güncellenir.</p>
      </li>
    </ol>
  </div>
</section>

<!-- ═══ 7 · İMMÜNOTERAPİ VİTRİNİ (ticari kalp) ═══ -->
<section class="section">
  <div class="wrap split">
    <div class="reveal">
      <p class="eyebrow">Alerji aşısı · İmmünoterapi</p>
      <h2>Alerjiyi bastırmak değil, kaynağından çözmek</h2>
      <p>İlaçlar şikayetinizi baskılar; immünoterapi ise bağışıklık sisteminizi alerjene karşı yeniden eğitir. 2009'dan bu yana süren immünoterapi deneyimiyle, size uygun olup olmadığını birlikte değerlendiriyoruz.</p>
      <div class="caution">
        <b>Not:</b> Tedaviye yanıt kişiden kişiye farklılık gösterebilir. İmmünoterapinin uygunluğu ancak muayene ve test sonrasında belirlenir.
      </div>
      <div class="btn-row" style="margin-top:1.25rem">
        <a class="btn btn--primary" href="/tedaviler/alerji-asisi-immunoterapi/">Alerji aşısı rehberi</a>
        <a class="btn btn--ghost" href="/tedaviler/alerji-asisi-sss/">Sık sorulan 18 soru</a>
      </div>
    </div>
    <div class="reveal">
      <div class="card">
        <h3 style="margin-bottom:1.25rem">Tedavi yolculuğu</h3>
        <ul class="timeline">
          <li><span class="tl-when">Adım 1</span><span class="tl-what">Deri testi ile alerjen belirlenir</span></li>
          <li><span class="tl-when">Adım 2</span><span class="tl-what">Aşı kararı ve uygunluk değerlendirmesi</span></li>
          <li><span class="tl-when">Başlangıç fazı</span><span class="tl-what">Haftalık uygulamalar</span></li>
          <li><span class="tl-when">İdame fazı</span><span class="tl-what">Aylık uygulamalar</span></li>
          <li class="is-gold"><span class="tl-when">~6. ay</span><span class="tl-what">Şikayetlerde ilk belirgin azalma</span><p>Süre kişiye göre değişebilir.</p></li>
          <li class="is-gold"><span class="tl-when">3–5 yıl</span><span class="tl-what">Tedavi tamamlanır</span><p>Amaç, tedavi bittikten sonra da süren kalıcı bir rahatlama sağlamaktır.</p></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ═══ 8 · KAYGI-KIRICI TESTLER ═══ -->
<section class="section section--mint">
  <div class="wrap">
    <div class="section-head reveal">
      <p class="eyebrow">Testler</p>
      <h2>Merak etmeyin, hepsi bu kadar basit</h2>
      <p>En çok sorulan üç soruyu her testin başına yazdık: ne kadar sürer, acıtır mı, önceden ne yapmalıyım.</p>
    </div>
    <div class="grid-3 reveal">
      <article class="test-card">
        <h3>Deri Prick Testi</h3>
        <ul class="test-facts">
          <li><svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 8V5H9v6h5v-2z"/></svg><span><b>20–30 dakika</b> sürer</span></li>
          <li><svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zm3.7 6.2l-4.4 4.4a1 1 0 01-1.4 0L6 10.7l1.4-1.4 1.2 1.2 3.7-3.7z"/></svg><span><b>Kanatmaz</b>, iğne batırılmaz — yüzeysel çiziktir</span></li>
          <li><svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M3 4h14v2H3zm0 5h14v2H3zm0 5h9v2H3z"/></svg><span>Antihistaminikler <b>yaklaşık 10 gün önce</b> kesilmelidir</span></li>
        </ul>
        <a class="link-arrow sm" href="/testler/deri-prick-testi/">Testi tanıyın</a>
      </article>
      <article class="test-card">
        <h3>Solunum Fonksiyon Testi</h3>
        <ul class="test-facts">
          <li><svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 8V5H9v6h5v-2z"/></svg><span><b>10–15 dakika</b> sürer</span></li>
          <li><svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zm3.7 6.2l-4.4 4.4a1 1 0 01-1.4 0L6 10.7l1.4-1.4 1.2 1.2 3.7-3.7z"/></svg><span><b>Ağrısızdır</b> — bir cihaza derin nefes verirsiniz</span></li>
          <li><svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M3 4h14v2H3zm0 5h14v2H3zm0 5h9v2H3z"/></svg><span>Test öncesi bazı nefes ilaçları geçici olarak durdurulabilir</span></li>
        </ul>
        <a class="link-arrow sm" href="/testler/">Testi tanıyın</a>
      </article>
      <article class="test-card">
        <h3>Kan Testi (spesifik IgE)</h3>
        <ul class="test-facts">
          <li><svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 8V5H9v6h5v-2z"/></svg><span>Kan alımı <b>birkaç dakika</b></span></li>
          <li><svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zm3.7 6.2l-4.4 4.4a1 1 0 01-1.4 0L6 10.7l1.4-1.4 1.2 1.2 3.7-3.7z"/></svg><span>İlaç kesmeye <b>gerek yoktur</b></span></li>
          <li><svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M3 4h14v2H3zm0 5h14v2H3zm0 5h9v2H3z"/></svg><span>Deri testi yapılamayan durumlarda tercih edilir</span></li>
        </ul>
        <a class="link-arrow sm" href="/testler/">Testi tanıyın</a>
      </article>
    </div>
  </div>
</section>

<!-- ═══ 9 · KLİNİĞE GELMEDEN YAPABİLECEKLERİNİZ (BREATHE aşısı) ═══ -->
<section class="section">
  <div class="wrap">
    <div class="section-head reveal">
      <p class="eyebrow">Dijital hizmetler</p>
      <h2>Kliniğe gelmeden yapabilecekleriniz</h2>
    </div>
    <div class="grid-3 reveal">
      <article class="tool-card">
        <svg class="t-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><rect x="4" y="6" width="24" height="17" rx="3"/><path d="M12 27h8M16 23v4"/></svg>
        <h3>Online ön değerlendirme</h3>
        <p>Şikayetlerinizi ve varsa önceki tetkiklerinizi paylaşın; süreci birlikte planlayalım.</p>
        <p class="xs muted">Muayene ve kesin tanının yerine geçmez; acil durumlarda kullanılmaz.</p>
        <a class="link-arrow sm" href="/hasta-merkezi/online-on-degerlendirme/">Nasıl çalışır?</a>
      </article>
      <article class="tool-card">
        <svg class="t-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M16 21V7M11 12l5-5 5 5"/><path d="M6 21v3a2 2 0 002 2h16a2 2 0 002-2v-3"/></svg>
        <h3>Sonucunuzu yükleyin</h3>
        <p>Başka bir merkezde yaptırdığınız test sonuçlarını güvenli bağlantı üzerinden iletin, ikinci görüş alın.</p>
        <p class="xs muted">Dosyalarınız şifreli bağlantı ile iletilir; açık rızanız olmadan işlenmez.</p>
        <a class="link-arrow sm" href="/hasta-merkezi/ikinci-gorus/">Dosya gönder</a>
      </article>
      <article class="tool-card">
        <svg class="t-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M9 4h14a2 2 0 012 2v20a2 2 0 01-2 2H9a2 2 0 01-2-2V6a2 2 0 012-2z"/><path d="M12 12h8M12 17h8M12 22h5"/></svg>
        <h3>Randevunuza hazırlanın</h3>
        <p>Yanınızda ne getirmelisiniz, hangi ilaçlar ne zaman kesilmeli, hangi soruları sormalısınız?</p>
        <p class="xs muted">Test öncesi ilaç kesme süreleri hekim onaylıdır.</p>
        <a class="link-arrow sm" href="/hasta-merkezi/randevunuza-hazirlanin/">Hazırlık listesi</a>
      </article>
    </div>
    <p class="sm muted center" style="margin-top:1.5rem">
      <a href="/en/international-patients.html" hreflang="en">International patients: English service available →</a>
    </p>
  </div>
</section>

<!-- ═══ 10 · ARAÇLAR BENTOSU + POLEN TAKVİMİ ═══ -->
<section class="section section--mint" id="araclar">
  <div class="wrap">
    <div class="section-head reveal">
      <p class="eyebrow">Ücretsiz araçlar</p>
      <h2>Bu ay havada ne var?</h2>
      <p>İstanbul’un polen takvimi ve alerjinizi anlamanıza yardımcı olacak kısa araçlar.</p>
    </div>

    <div class="card reveal" style="margin-bottom:1.25rem">
      <h3>İstanbul polen takvimi — <span data-now-month>Temmuz</span></h3>
      <div class="pollen-cal" role="img" aria-label="İstanbul aylık polen yoğunluğu takvimi: ağaç polenleri şubat-nisan, çim polenleri mayıs-temmuz, yabani ot polenleri ağustos-ekim döneminde yoğundur">
        <div class="pc-col"><div class="pc-month">O</div><div class="pc-bar" style="background:#CFE7E3"></div></div>
        <div class="pc-col"><div class="pc-month">Ş</div><div class="pc-bar" style="background:#8FC9C2"></div></div>
        <div class="pc-col"><div class="pc-month">M</div><div class="pc-bar" style="background:#4E9E96"></div></div>
        <div class="pc-col"><div class="pc-month">N</div><div class="pc-bar" style="background:#4E9E96"></div></div>
        <div class="pc-col"><div class="pc-month">M</div><div class="pc-bar" style="background:#B08D4A"></div></div>
        <div class="pc-col"><div class="pc-month">H</div><div class="pc-bar" style="background:#B08D4A"></div></div>
        <div class="pc-col"><div class="pc-month">T</div><div class="pc-bar" style="background:#C9A96B"></div></div>
        <div class="pc-col"><div class="pc-month">A</div><div class="pc-bar" style="background:#B45309"></div></div>
        <div class="pc-col"><div class="pc-month">E</div><div class="pc-bar" style="background:#B45309"></div></div>
        <div class="pc-col"><div class="pc-month">E</div><div class="pc-bar" style="background:#D9A05B"></div></div>
        <div class="pc-col"><div class="pc-month">K</div><div class="pc-bar" style="background:#CFE7E3"></div></div>
        <div class="pc-col"><div class="pc-month">A</div><div class="pc-bar" style="background:#CFE7E3"></div></div>
      </div>
      <div class="pc-legend">
        <span><i style="background:#4E9E96"></i> Ağaç polenleri (Şub–Nis)</span>
        <span><i style="background:#B08D4A"></i> Çim polenleri (May–Tem)</span>
        <span><i style="background:#B45309"></i> Yabani ot polenleri (Ağu–Eki)</span>
      </div>
      <p class="xs muted" style="margin-top:.9rem">Takvim genel bilgilendirme amaçlıdır; yıllık hava koşullarına göre değişebilir.</p>
      <a class="link-arrow sm" href="/araclar/polen-takvimi/">Tam takvimi ve korunma önerilerini görün</a>
    </div>

    <div class="grid-3 reveal">
      <a class="tool-card" href="/araclar/etiket-dedektifi/">
        <svg class="t-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="14" cy="14" r="8"/><path d="M20 20l7 7"/><path d="M11 14h6M14 11v6"/></svg>
        <h3>Etiket Dedektifi</h3>
        <p>İçindekiler listesini yapıştırın; kazein, E-322 gibi gizli alerjen adlarını sizin için tarayalım.</p>
      </a>
      <a class="tool-card" href="/araclar/belirti-yol-haritasi/">
        <svg class="t-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M6 26V10l7-4 6 4 7-4v16l-7 4-6-4-7 4z"/><path d="M13 6v16M19 10v16"/></svg>
        <h3>Belirti Yol Haritası</h3>
        <p>Şikayetinizi kendi cümlelerinizle yazın; doğru sayfayı ve size uygun testi önerelim.</p>
      </a>
      <a class="tool-card" href="/araclar/acil-plan-karti/">
        <svg class="t-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><rect x="4" y="8" width="24" height="16" rx="2"/><path d="M16 12v8M12 16h8"/></svg>
        <h3>Acil Plan Kartı</h3>
        <p>Anafilaksi riski taşıyanlar için kişisel cüzdan kartı + buzdolabı sayfası — yazdırmaya hazır.</p>
      </a>
      <a class="tool-card" href="/araclar/ev-ortami-risk-haritasi/">
        <svg class="t-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M5 15L16 6l11 9"/><path d="M8 14v12h16V14"/><path d="M13 26v-6h6v6"/></svg>
        <h3>Ev Ortamı Risk Haritası</h3>
        <p>10 soruda evinizin alerjen yükü; sonunda önceliklere göre sıralı eylem planı.</p>
      </a>
      <a class="tool-card" href="/araclar/alerji-mi-soguk-alginligi-mi/">
        <svg class="t-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="16" cy="16" r="12"/><path d="M12 13a4 4 0 116 3.5V19"/><path d="M16 23v.5"/></svg>
        <h3>Alerji mi, soğuk algınlığı mı?</h3>
        <p>6 soruluk kısa değerlendirme — 60 saniyede fikir edinin.</p>
      </a>
      <a class="tool-card" href="/alerji-rehberi/ev-tozu-akari-yatak-odasi/">
        <svg class="t-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 24V12h24v12"/><path d="M4 24h24M7 12V8h8v4"/><circle cx="22" cy="8" r="2"/></svg>
        <h3>Ev tozu akarı ve yatak odası</h3>
        <p>Sabah tıkanıklığının en sık nedeni: akarlara karşı yatak odası düzenleme rehberi.</p>
      </a>
    </div>
  </div>
</section>

<!-- ═══ 11 · ÜÇLÜ LOGO ŞERİDİ (KÜRSÜ aşısı) ═══ -->
<section class="section section--tight">
  <div class="wrap">
    <div class="section-head reveal" style="margin-bottom:1.5rem">
      <p class="eyebrow">Kurumsal geçmiş</p>
      <h2>Eğitim, üyelikler ve basın</h2>
    </div>
    <div class="logo-strip reveal">
      <div class="logo-row">
        <span class="row-label">Eğitim</span>
        <span class="logo-chip">İstanbul Üniversitesi Tıp Fakültesi</span>
        <span class="logo-chip">Ege Üniversitesi</span>
        <span class="logo-chip">Yedikule Göğüs Hastalıkları EAH</span>
      </div>
      <div class="logo-row">
        <span class="row-label">Üyelikler</span>
        <span class="logo-chip">EAACI</span>
        <span class="logo-chip">Astım Alerji İmmünoloji Derneği</span>
        <span class="logo-chip">Türk Toraks Derneği</span>
        <span class="logo-chip">TÜSAD</span>
        <span class="logo-chip">İstanbul Tabip Odası</span>
      </div>
      <div class="logo-row">
        <span class="row-label">Basında</span>
        <span class="logo-chip">Habertürk</span>
        <span class="logo-chip">Sağlıklı Hayat TV</span>
        <a class="logo-chip" href="/basinda/">Tüm basın kayıtları →</a>
      </div>
    </div>
    <p class="xs muted" style="margin-top:1rem">Kurum ve dernek adları yalnızca eğitim geçmişi ve üyelik bilgisi olarak yer almaktadır.</p>
  </div>
</section>

<!-- ═══ 12 · VİDEO ŞERİDİ ═══ -->
<section class="section section--tight">
  <div class="wrap">
    <div class="section-head reveal">
      <p class="eyebrow">Video</p>
      <h2>Dr. Ersoy anlatıyor</h2>
      <p>Merak edilen konular kısa videolarda: kimlere bakılıyor, ne zaman başvurmalı, muayenede ne oluyor ve testler nasıl yapılıyor.</p>
    </div>
    <div class="vgrid reveal">

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
          <svg viewBox="0 0 270 480" preserveAspectRatio="xMidYMid slice" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="hv0" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#EAF6F4"/><stop offset="1" stop-color="#CFE7E3"/></linearGradient></defs><rect width="270" height="480" fill="url(#hv0)"/><path d="M-10 360q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="3.5" stroke-linecap="round" opacity=".45"/><path d="M-10 396q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="2.5" stroke-linecap="round" opacity=".3"/><circle cx="205" cy="86" r="4" fill="#B98A3B" opacity=".65"/><circle cx="52" cy="104" r="3" fill="#2E7C78" opacity=".35"/></svg>
          <?php endif; ?>
          <span class="vcard-play" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
          <span class="vcard-sure" aria-hidden="true">0:44</span>
        </button>
        <h3>Yetişkin alerji uzmanı neye bakar?</h3>
        <p class="sm muted">Alerjik hastalıklar yalnızca kaşıntı ve hapşırıktan ibaret değil.</p>
      </article>

      <article class="vcard">
        <button class="vcard-poster" data-video="<?php echo esc_attr(drre_video('ne-zaman')); ?>" data-en-boy="9/16"
                data-baslik="Ne zaman doktora başvurmalıyız?"
                aria-label="Ne zaman doktora başvurmalıyız? — videoyu izle (0:38)">
          <?php /* drre-vkapak: gercek kapak, kendi sunucumuzdan (i.ytimg'e
                   ziyaretci istegi YOK); dosya yoksa soyut poster gosterilir */
          $vkId = drre_video('ne-zaman');
          $vkYol = '/assets/img/video/' . $vkId . '.jpg';
          if ($vkId && file_exists(dirname(ABSPATH) . $vkYol)) : ?>
          <img src="<?php echo esc_url($vkYol); ?>" alt="" loading="lazy" decoding="async"
               style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:inherit">
          <?php else : ?>
          <svg viewBox="0 0 270 480" preserveAspectRatio="xMidYMid slice" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="hv1" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#F3EFE4"/><stop offset="1" stop-color="#E3DCC7"/></linearGradient></defs><rect width="270" height="480" fill="url(#hv1)"/><path d="M-10 360q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="3.5" stroke-linecap="round" opacity=".45"/><path d="M-10 396q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="2.5" stroke-linecap="round" opacity=".3"/><circle cx="205" cy="86" r="4" fill="#B98A3B" opacity=".65"/><circle cx="52" cy="104" r="3" fill="#2E7C78" opacity=".35"/></svg>
          <?php endif; ?>
          <span class="vcard-play" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
          <span class="vcard-sure" aria-hidden="true">0:38</span>
        </button>
        <h3>Ne zaman doktora başvurmalıyız?</h3>
        <p class="sm muted">“Geçer” diye beklenen şikayetler alerjik bir hastalığın belirtisi olabilir.</p>
      </article>

      <article class="vcard">
        <button class="vcard-poster" data-video="<?php echo esc_attr(drre_video('muayene')); ?>" data-en-boy="9/16"
                data-baslik="Muayene süreci nasıl ilerler?"
                aria-label="Muayene süreci nasıl ilerler? — videoyu izle (0:37)">
          <?php /* drre-vkapak: gercek kapak, kendi sunucumuzdan (i.ytimg'e
                   ziyaretci istegi YOK); dosya yoksa soyut poster gosterilir */
          $vkId = drre_video('muayene');
          $vkYol = '/assets/img/video/' . $vkId . '.jpg';
          if ($vkId && file_exists(dirname(ABSPATH) . $vkYol)) : ?>
          <img src="<?php echo esc_url($vkYol); ?>" alt="" loading="lazy" decoding="async"
               style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:inherit">
          <?php else : ?>
          <svg viewBox="0 0 270 480" preserveAspectRatio="xMidYMid slice" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="hv2" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#EDF4F7"/><stop offset="1" stop-color="#D5E6EE"/></linearGradient></defs><rect width="270" height="480" fill="url(#hv2)"/><path d="M-10 360q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="3.5" stroke-linecap="round" opacity=".45"/><path d="M-10 396q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="2.5" stroke-linecap="round" opacity=".3"/><circle cx="205" cy="86" r="4" fill="#B98A3B" opacity=".65"/><circle cx="52" cy="104" r="3" fill="#2E7C78" opacity=".35"/></svg>
          <?php endif; ?>
          <span class="vcard-play" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
          <span class="vcard-sure" aria-hidden="true">0:37</span>
        </button>
        <h3>Muayene süreci nasıl ilerler?</h3>
        <p class="sm muted">İlk adım test değil, hikâyeyi dinlemektir.</p>
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
          <svg viewBox="0 0 270 480" preserveAspectRatio="xMidYMid slice" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="hv3" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#F1F0F6"/><stop offset="1" stop-color="#DEDBEA"/></linearGradient></defs><rect width="270" height="480" fill="url(#hv3)"/><path d="M-10 360q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="3.5" stroke-linecap="round" opacity=".45"/><path d="M-10 396q50-52 90 0t90 0 90 0 90 0" fill="none" stroke="#6DBEBB" stroke-width="2.5" stroke-linecap="round" opacity=".3"/><circle cx="205" cy="86" r="4" fill="#B98A3B" opacity=".65"/><circle cx="52" cy="104" r="3" fill="#2E7C78" opacity=".35"/></svg>
          <?php endif; ?>
          <span class="vcard-play" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
          <span class="vcard-sure" aria-hidden="true">0:47</span>
        </button>
        <h3>Alerji testleri nedir, nasıl yapılır?</h3>
        <p class="sm muted">Deri prick testi başta olmak üzere yöntemler ve değerlendirmesi.</p>
      </article>

    </div>
    <p class="center" style="margin-top:1.75rem"><a class="link-arrow" href="/araclar/video-kutuphanesi/">Tüm videolar</a></p>
  </div>
</section>


<!-- ═══ 13 · SSS ═══ -->
<section class="section section--cream">
  <div class="wrap wrap-narrow" style="padding-inline:0">
    <div class="section-head reveal">
      <p class="eyebrow">Sık sorulanlar</p>
      <h2>Merak ettikleriniz</h2>
    </div>
    <div class="reveal">
      <details class="faq"><summary>Alerji testi yaptırmadan önce ilaçlarımı kesmeli miyim?</summary>
        <div class="faq-body"><p>Deri testi yapılacaksa antihistaminik grubu ilaçların genellikle <strong>yaklaşık 10 gün önce</strong> kesilmesi gerekir; aksi halde test sonucu yanlış çıkabilir. Astım ve tansiyon ilaçlarınız için kendi başınıza karar vermeyin — randevunuzu alırken kullandığınız ilaçları bildirin, kesilmesi gerekenleri size özel olarak söyleyelim.</p></div>
      </details>
      <details class="faq"><summary>Deri testi acıtır mı?</summary>
        <div class="faq-body"><p>Hayır. Deri prick testinde iğne batırılmaz; ön kol derisine damlatılan alerjen sıvıların üzerinden çok yüzeysel bir çizik yapılır. Kanama olmaz. Test sırasında hafif kaşıntı hissedebilirsiniz, bu beklenen bir durumdur ve kısa sürede geçer.</p></div>
      </details>
      <details class="faq"><summary>Aynı gün sonuç alabilir miyim?</summary>
        <div class="faq-body"><p>Deri testinin sonucu <strong>yaklaşık 15 dakikada</strong> okunur; aynı muayenede değerlendirilir. Kan testi (spesifik IgE) sonuçları laboratuvara göre birkaç iş günü sürer.</p></div>
      </details>
      <details class="faq"><summary>Randevuya ne getirmeliyim?</summary>
        <div class="faq-body"><p>Daha önce yaptırdığınız test sonuçlarını, kullandığınız ilaçların listesini (kutularını getirmeniz en pratiğidir) ve varsa önceki reçetelerinizi getirin. Şikayetlerinizin ne zaman arttığını not etmeniz de çok yardımcı olur.</p></div>
      </details>
      <details class="faq"><summary>Alerji aşısı ne kadar sürer?</summary>
        <div class="faq-body"><p>İmmünoterapi genellikle <strong>3–5 yıl</strong> süren bir tedavidir. Haftalık uygulamalarla başlar, ardından aylık idame dönemine geçilir. Şikayetlerde belirgin azalma çoğu hastada ilk 6 ay içinde görülmeye başlar; ancak süre ve yanıt kişiden kişiye değişebilir.</p></div>
      </details>
      <details class="faq"><summary>Çocuğum için de randevu alabilir miyim?</summary>
        <div class="faq-body"><p>Muayenehanemizde <strong>yetişkin hastalar</strong> kabul edilmektedir. 18 yaş altı için çocuk alerji ve immünoloji uzmanına başvurmanızı öneririz.</p></div>
      </details>
    </div>
    <p class="center" style="margin-top:1.5rem"><a class="link-arrow" href="/hasta-merkezi/randevunuza-hazirlanin/">Randevunuza hazırlanın</a></p>
  </div>
</section>

<!-- ═══ 14 · ZİYARET BLOĞU ═══ -->
<section class="section">
  <div class="wrap split">
    <div class="reveal">
      <p class="eyebrow">Ulaşım</p>
      <h2>Bizi bulmak kolay</h2>
      <p><strong>Harbiye Mah. Teşvikiye Cad. 37/3</strong><br>Şişli / İstanbul (Nişantaşı)</p>
      <p class="sm">Osmanbey metro durağına yürüme mesafesindedir. Çevrede ücretli otopark bulunmaktadır.</p>
      <div class="tablewrap" style="border:1px solid var(--line);border-radius:var(--r-md);overflow:hidden;margin:1.25rem 0">
        <table style="width:100%;border-collapse:collapse;font-size:var(--fs-sm)">
          <tbody>
            <tr><td style="padding:.6rem 1rem;border-bottom:1px solid var(--line)">Pazartesi – Cuma</td><td style="padding:.6rem 1rem;border-bottom:1px solid var(--line);text-align:right"><b>09:00 – 18:00</b></td></tr>
            <tr><td style="padding:.6rem 1rem;border-bottom:1px solid var(--line)">Cumartesi</td><td style="padding:.6rem 1rem;border-bottom:1px solid var(--line);text-align:right"><b>09:00 – 14:00</b></td></tr>
            <tr><td style="padding:.6rem 1rem">Pazar</td><td style="padding:.6rem 1rem;text-align:right;color:var(--muted)">Kapalı</td></tr>
          </tbody>
        </table>
      </div>
      <div class="btn-row">
        <a class="btn btn--primary" href="tel:+902127099396">0212 709 93 96</a>
        <a class="btn btn--ghost" href="/iletisim/">Yol tarifi</a>
      </div>
    </div>
    <div class="reveal">
      <div style="border-radius:var(--r-lg);overflow:hidden;box-shadow:var(--shadow-md);background:var(--mint-bg);aspect-ratio:4/3">
        <iframe src="https://www.google.com/maps/embed?origin=mfe&pb=!1m3!2m1!1zVGXFn3Zpa2l5ZSBDYWRkZXNpIDM3IMWeacWfbGkgxLBzdGFuYnVs!6i16!3m1!1str!5m1!1str" title="Muayenehane konumu — Teşvikiye Caddesi, Nişantaşı" width="100%" height="100%" style="border:0;min-height:320px" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
      </div>
      <p style="margin-top:.9rem"><a class="btn btn--ghost btn--sm" href="https://www.google.com/maps/dir/?api=1&destination=Te%C5%9Fvikiye+Caddesi+37%2C+%C5%9Ei%C5%9Fli+%C4%B0stanbul" target="_blank" rel="noopener">Yol tarifi al</a></p>
    </div>
  </div>
</section>

<!-- ═══ 15 · KAPANIŞ CTA + FORM ═══ -->
<section class="section section--cream" id="randevu">
  <div class="wrap split">
    <div class="reveal">
      <p class="eyebrow">Randevu</p>
      <h2>İlk adım bir mesaj kadar yakın</h2>
      <p>Formu doldurun ya da doğrudan yazın; mesai saatleri içinde iletilen taleplerde <strong>aynı gün içinde</strong> sizi arayalım (mesai dışı talepler ertesi iş günü yanıtlanır). Randevunuz, sekreterimiz sizinle görüştükten sonra kesinleşir.</p>
      <div class="btn-row" style="margin:1.5rem 0">
        <a class="btn btn--wa" data-wa="Merhaba, Dr. Ramazan Ersoy için randevu almak istiyorum." data-wa-src="anasayfa" href="#">WhatsApp'tan yazın</a>
        <a class="btn btn--ghost" href="tel:+902127099396">Telefonla arayın</a>
      </div>
      <div class="emergency">
        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2L1 21h22L12 2zm1 14h-2v2h2v-2zm0-6h-2v5h2v-5z"/></svg>
        <div>
          <strong>Acil durumlar için</strong>
          <p>Nefes darlığı, dilde veya boğazda şişme, baygınlık hissi varsa beklemeyin — hemen <a href="tel:112">112</a>'yi arayın.</p>
        </div>
      </div>
    </div>

    <div class="reveal">
      <div class="form-card">
        <form data-appointment-form novalidate>
          <div class="field">
            <label for="ad">Ad Soyad <span class="req">*</span></label>
            <input type="text" id="ad" name="ad" autocomplete="name" required>
            <span class="err">Lütfen adınızı yazın.</span>
          </div>
          <div class="field">
            <label for="tel">Telefon <span class="req">*</span></label>
            <input type="tel" id="tel" name="tel" autocomplete="tel" placeholder="05XX XXX XX XX" required>
            <span class="err">Size ulaşabilmemiz için geçerli bir numara gerekiyor.</span>
          </div>
          <div class="field">
            <label for="sikayet">Şikayetiniz</label>
            <select id="sikayet" name="sikayet">
              <option value="">Seçiniz (isteğe bağlı)</option>
              <option>Burun akıntısı / tıkanıklık</option>
              <option>Öksürük / nefes darlığı</option>
              <option>Ciltte kaşıntı / kurdeşen</option>
              <option>Besin alerjisi şüphesi</option>
              <option>İlaç alerjisi şüphesi</option>
              <option>Alerji aşısı hakkında bilgi</option>
              <option>Diğer</option>
            </select>
            <span class="hint">Lütfen bu alana tıbbi ayrıntı yazmayınız.</span>
          </div>
          <div class="field">
            <label for="gun">Tercih ettiğiniz gün</label>
            <select id="gun" name="gun">
              <option value="">Fark etmez</option>
              <option>Hafta içi sabah</option>
              <option>Hafta içi öğleden sonra</option>
              <option>Cumartesi</option>
            </select>
          </div>
          <div class="consent">
            <input type="checkbox" id="kvkk" name="kvkk" required>
            <label for="kvkk" style="font-weight:400">
              <a href="/kvkk-aydinlatma/">KVKK Aydınlatma Metni</a>'ni okudum; iletişim bilgilerimin randevu amacıyla işlenmesini kabul ediyorum. <span class="req">*</span>
            </label>
          </div>
          <div class="consent">
            <input type="checkbox" id="ticari" name="ticari">
            <label for="ticari" style="font-weight:400">Bilgilendirme mesajları almak istiyorum. (İsteğe bağlıdır, randevu için gerekli değildir.)</label>
          </div>
          <div aria-hidden="true" style="position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden">
            <label>Web sitesi<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
          </div>
          <button class="btn btn--primary" type="submit" style="width:100%">Randevu talebi gönder</button>
          <p class="form-note">Bu form bir randevu <strong>talebidir</strong>; randevunuz, sekreterimizin sizi araması ile kesinleşir.</p>
        </form>
        <div class="form-ok" data-appointment-done>
          <strong>Talebiniz alındı.</strong>
          <p style="margin:.5rem 0 0">Mesai saatleri içindeyse aynı gün, mesai dışıysa ertesi iş günü sizi arayacağız. Acil bir durumunuz varsa lütfen <a href="tel:112">112</a>'yi arayın.</p>
          <p class="xs muted" style="margin:.75rem 0 0" data-kayit-notu></p>
        </div>
      </div>
    </div>
  </div>
</section>

</main>

<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"Physician",
  "name":"Uzm. Dr. Ramazan Ersoy",
  "medicalSpecialty":["Allergy","Pulmonary"],
  "description":"Yetişkin alerji ve astım uzmanı. Alerjik rinit, astım, ürtiker, egzama, besin ve ilaç alerjisi; deri testleri ve alerji aşısı (immünoterapi).",
  "url":"https://drramazanersoy.tr/",
  "telephone":"+902127099396",
  "address":{
    "@type":"PostalAddress",
    "streetAddress":"Harbiye Mah. Teşvikiye Cad. 37/3",
    "addressLocality":"Şişli",
    "addressRegion":"İstanbul",
    "addressCountry":"TR"
  },
  "geo":{"@type":"GeoCoordinates","latitude":41.0491,"longitude":28.9862},
  "openingHoursSpecification":[
    {"@type":"OpeningHoursSpecification","dayOfWeek":["Monday","Tuesday","Wednesday","Thursday","Friday"],"opens":"09:00","closes":"18:00"},
    {"@type":"OpeningHoursSpecification","dayOfWeek":"Saturday","opens":"09:00","closes":"14:00"}
  ],
  "memberOf":[
    {"@type":"Organization","name":"European Academy of Allergy and Clinical Immunology (EAACI)"},
    {"@type":"Organization","name":"Astım Alerji İmmünoloji Derneği"},
    {"@type":"Organization","name":"Türk Toraks Derneği"}
  ],
  "availableService":[
    {"@type":"MedicalTest","name":"Alerji deri testi (prick test)"},
    {"@type":"MedicalTherapy","name":"Alerji aşısı (immünoterapi)"}
  ]
}
</script>
<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"FAQPage",
  "mainEntity":[
    {"@type":"Question","name":"Alerji testi yaptırmadan önce ilaçlarımı kesmeli miyim?","acceptedAnswer":{"@type":"Answer","text":"Deri testi yapılacaksa antihistaminik grubu ilaçların genellikle yaklaşık 10 gün önce kesilmesi gerekir; aksi halde test sonucu yanlış çıkabilir. Astım ve tansiyon ilaçlarınız için kendi başınıza karar vermeyin — randevunuzu alırken kullandığınız ilaçları bildirin, kesilmesi gerekenleri size özel olarak söyleyelim."}},
    {"@type":"Question","name":"Deri testi acıtır mı?","acceptedAnswer":{"@type":"Answer","text":"Hayır. Deri prick testinde iğne batırılmaz; ön kol derisine damlatılan alerjen sıvıların üzerinden çok yüzeysel bir çizik yapılır. Kanama olmaz. Test sırasında hafif kaşıntı hissedebilirsiniz, bu beklenen bir durumdur ve kısa sürede geçer."}},
    {"@type":"Question","name":"Aynı gün sonuç alabilir miyim?","acceptedAnswer":{"@type":"Answer","text":"Deri testinin sonucu yaklaşık 15 dakikada okunur; aynı muayenede değerlendirilir. Kan testi (spesifik IgE) sonuçları laboratuvara göre birkaç iş günü sürer."}},
    {"@type":"Question","name":"Randevuya ne getirmeliyim?","acceptedAnswer":{"@type":"Answer","text":"Daha önce yaptırdığınız test sonuçlarını, kullandığınız ilaçların listesini (kutularını getirmeniz en pratiğidir) ve varsa önceki reçetelerinizi getirin. Şikayetlerinizin ne zaman arttığını not etmeniz de çok yardımcı olur."}},
    {"@type":"Question","name":"Alerji aşısı ne kadar sürer?","acceptedAnswer":{"@type":"Answer","text":"İmmünoterapi genellikle 3–5 yıl süren bir tedavidir. Haftalık uygulamalarla başlar, ardından aylık idame dönemine geçilir. Şikayetlerde belirgin azalma çoğu hastada ilk 6 ay içinde görülmeye başlar; ancak süre ve yanıt kişiden kişiye değişebilir."}},
    {"@type":"Question","name":"Çocuğum için de randevu alabilir miyim?","acceptedAnswer":{"@type":"Answer","text":"Muayenehanemizde yetişkin hastalar kabul edilmektedir. 18 yaş altı için çocuk alerji ve immünoloji uzmanına başvurmanızı öneririz."}}
  ]
}
</script>
<div class="wrap">
  <p class="xs muted" style="border-top:1px solid var(--line);padding-top:1rem;margin:2rem 0 1rem">
    Sitedeki tıbbi içerik <strong>Uzm. Dr. Ramazan Ersoy</strong> (İç Hastalıkları,
    Alerji ve Klinik İmmünoloji) tarafından hazırlanmış ve gözden geçirilmiştir.
    Son güncelleme: <?php echo esc_html(date_i18n('j F Y', strtotime('2026-08-17'))); ?> ·
    Sayfadaki görseller yapay zekâ ile üretilmiştir ·
    İçerik sorumlusu: <a href="/iletisim/">iletişim sayfası</a>.
    Acil durumlarda <a href="tel:112">112</a>'yi arayınız.
  </p>
</div>
<?php get_footer(); ?>
