<?php
/**
 * Template Name: Astım Kontrol Testi (ACT): 5 Soruda Ölçün
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
    <a href="/araclar/polen-takvimi/">Araçlar</a> <span aria-hidden="true">›</span>
    <span aria-current="page">Astım Kontrol Testi (ACT)</span>
  </nav>
</div>

<!-- ═══ BAŞLIK ═══ -->
<section class="section section--tight">
  <div class="wrap">
    <p class="eyebrow">Ücretsiz araç · 5 soru · yaklaşık 2 dakika</p>
    <h1>Astım Kontrol Testi (ACT)</h1>
    <p class="hero-lede" style="max-width:62ch">Astım tedavisinin amacı yalnızca krizleri önlemek değil; gündüzleri rahat çalışabildiğiniz, geceleri bölünmeden uyuyabildiğiniz bir <strong>kontrol</strong> durumu sağlamaktır. Astım Kontrol Testi (ACT), son 4 haftadaki kontrolünüzü 5 soruyla puanlayan, bilimsel geçerliliği gösterilmiş standart bir ankettir. Aşağıdaki soruları yanıtlayın; puanınız anında hesaplansın.</p>
    <div class="btn-row" style="margin-top:1.25rem">
      <a class="btn btn--primary" href="#act-test">Teste başlayın ↓</a>
      <a class="btn btn--wa" data-wa="Merhaba, Astım Kontrol Testi (ACT) sayfanızı inceledim. Astımımın değerlendirilmesi için randevu almak istiyorum." data-wa-src="astim-kontrol-testi" href="#">WhatsApp'tan yazın</a>
    </div>
  </div>
</section>

<!-- ═══ GÖVDE ═══ -->
<section class="section" style="padding-top:0">
  <div class="wrap wrap-narrow" style="padding-inline:0">

    <!-- BİR BAKIŞTA -->
    <div class="at-glance">
      <h3>
        <svg viewBox="0 0 20 20" fill="currentColor" width="18" height="18" aria-hidden="true"><path d="M10 3C5.5 3 2 10 2 10s3.5 7 8 7 8-7 8-7-3.5-7-8-7zm0 11a4 4 0 110-8 4 4 0 010 8zm0-2a2 2 0 100-4 2 2 0 000 4z"/></svg>
        Bir bakışta
      </h3>
      <ul>
        <li><b>Ne ölçer?</b> Son 4 haftadaki astım kontrolünüzü: aktivite kısıtlanması, nefes darlığı, gece belirtileri, rahatlatıcı ilaç kullanımı ve kendi değerlendirmeniz.</li>
        <li><b>Nasıl puanlanır?</b> 5 soru, her biri 1–5 puan; toplam <b>5–25</b> arasında bir puan elde edilir.</li>
        <li><b>Kim için?</b> Astım tanısı almış <b>yetişkinler</b> için tasarlanmıştır; tanı koymak için kullanılmaz.</li>
        <li><b>Sonuç ne anlama gelir?</b> 25 puan tam kontrolü, 20–24 puan iyi kontrolü düşündürür; 20'nin altı, kontrolün yetersiz olabileceğine işaret eder.</li>
        <li><b>Unutmayın:</b> ACT bir <b>tarama aracıdır</b>; muayenenin, tanının ve tedavi kararının yerine geçmez.</li>
      </ul>
    </div>

    <!-- KÜNYE -->
    <div class="byline">
      <span>Yazan / İnceleyen: <b>Uzm. Dr. Ramazan Ersoy</b></span>
      <span>Yayın: 19 Temmuz 2026</span>
      <span>Son güncelleme: 19 Temmuz 2026</span>
      <span class="xs">Kaynak notu: GINA raporu ve ACT geçerlilik çalışmaları (Nathan 2004, Schatz 2006) esas alınmıştır.</span>
    </div>

    <!-- ACİL KUTUSU -->
    <div class="emergency" style="margin:1.5rem 0">
      <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2L1 21h22L12 2zm1 14h-2v2h2v-2zm0-6h-2v5h2v-5z"/></svg>
      <div>
        <strong>Acil durumlar için</strong>
        <p>Şu anda şiddetli nefes darlığınız varsa, konuşurken cümleyi tamamlayamıyorsanız, dudaklarınızda morarma veya baygınlık hissi varsa bu sayfada zaman kaybetmeyin — hemen <a href="tel:112">112</a>'yi arayın. Bu test acil durum değerlendirmesi için uygun değildir.</p>
      </div>
    </div>

    <!-- ═══ HESAPLAYICI ═══ -->
    <div class="form-card" id="act-test">
      <h2 style="font-size:var(--fs-h3);margin-bottom:.5rem">Son 4 haftanızı düşünerek yanıtlayın</h2>
      <p class="sm muted" style="margin-bottom:1.5rem">Her soru için size en yakın gelen tek seçeneği işaretleyin. Doğru ya da yanlış cevap yoktur; önemli olan son 4 haftayı olduğu gibi yansıtmanızdır.</p>

      <noscript>
        <div class="caution"><b>Not:</b> Bu hesaplayıcının çalışabilmesi için tarayıcınızda JavaScript'in açık olması gerekir. JavaScript kapalıysa soruları yanıtlayıp puanları (her soru 1–5) kendiniz toplayabilirsiniz; toplam 5–25 arasındadır.</div>
      </noscript>

      <form id="act-form" novalidate>

        <fieldset style="border:1px solid var(--line);border-radius:var(--r-md);padding:1.15rem 1.3rem 1.3rem;margin:0 0 1.15rem;min-width:0">
          <legend style="font-weight:700;color:var(--ink);font-size:1.0625rem;line-height:1.45;padding:0 .35rem">1. Son 4 hafta içinde astımınız; işinizde, okulunuzda veya evinizde yapmak istediklerinizi ne sıklıkta engelledi?</legend>
          <div style="display:grid;gap:.5rem;margin-top:.6rem">
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q1" value="1" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Her zaman</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q1" value="2" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Çoğu zaman</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q1" value="3" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Bazen</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q1" value="4" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Nadiren</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q1" value="5" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Hiçbir zaman</label>
          </div>
        </fieldset>

        <fieldset style="border:1px solid var(--line);border-radius:var(--r-md);padding:1.15rem 1.3rem 1.3rem;margin:0 0 1.15rem;min-width:0">
          <legend style="font-weight:700;color:var(--ink);font-size:1.0625rem;line-height:1.45;padding:0 .35rem">2. Son 4 hafta içinde ne sıklıkta nefes darlığı yaşadınız?</legend>
          <div style="display:grid;gap:.5rem;margin-top:.6rem">
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q2" value="1" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Günde birden fazla kez</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q2" value="2" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Günde bir kez</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q2" value="3" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Haftada 3–6 kez</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q2" value="4" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Haftada 1–2 kez</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q2" value="5" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Hiç yaşamadım</label>
          </div>
        </fieldset>

        <fieldset style="border:1px solid var(--line);border-radius:var(--r-md);padding:1.15rem 1.3rem 1.3rem;margin:0 0 1.15rem;min-width:0">
          <legend style="font-weight:700;color:var(--ink);font-size:1.0625rem;line-height:1.45;padding:0 .35rem">3. Son 4 hafta içinde astım belirtileriniz (hırıltı, öksürük, nefes darlığı, göğüste sıkışma veya ağrı) nedeniyle ne sıklıkta gece uyandınız veya sabah normalden erken uyandınız?</legend>
          <div style="display:grid;gap:.5rem;margin-top:.6rem">
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q3" value="1" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Haftada 4 gece veya daha fazla</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q3" value="2" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Haftada 2–3 gece</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q3" value="3" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Haftada bir kez</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q3" value="4" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Son 4 haftada yalnızca bir-iki kez</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q3" value="5" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Hiç uyanmadım</label>
          </div>
        </fieldset>

        <fieldset style="border:1px solid var(--line);border-radius:var(--r-md);padding:1.15rem 1.3rem 1.3rem;margin:0 0 1.15rem;min-width:0">
          <legend style="font-weight:700;color:var(--ink);font-size:1.0625rem;line-height:1.45;padding:0 .35rem">4. Son 4 hafta içinde rahatlatıcı (kurtarıcı) ilacınızı veya nebülizatörünüzü ne sıklıkta kullandınız?</legend>
          <div style="display:grid;gap:.5rem;margin-top:.6rem">
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q4" value="1" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Günde 3 kez veya daha fazla</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q4" value="2" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Günde 1–2 kez</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q4" value="3" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Haftada 2–3 kez</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q4" value="4" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Haftada bir kez veya daha az</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q4" value="5" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Hiç kullanmadım</label>
          </div>
        </fieldset>

        <fieldset style="border:1px solid var(--line);border-radius:var(--r-md);padding:1.15rem 1.3rem 1.3rem;margin:0 0 1.15rem;min-width:0">
          <legend style="font-weight:700;color:var(--ink);font-size:1.0625rem;line-height:1.45;padding:0 .35rem">5. Son 4 hafta içinde astımınızı ne ölçüde kontrol altında tutabildiğinizi düşünüyorsunuz?</legend>
          <div style="display:grid;gap:.5rem;margin-top:.6rem">
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q5" value="1" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Hiç kontrol altında değildi</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q5" value="2" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Kötü kontrol altındaydı</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q5" value="3" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Biraz kontrol altındaydı</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q5" value="4" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> İyi kontrol altındaydı</label>
            <label style="display:flex;gap:.65rem;align-items:flex-start;padding:.55rem .7rem;border:1px solid var(--line);border-radius:var(--r-sm);cursor:pointer;font-size:var(--fs-sm);margin:0"><input type="radio" name="q5" value="5" style="accent-color:var(--coral);width:20px;height:20px;flex:none;margin:.05rem 0 0"> Tam kontrol altındaydı</label>
          </div>
        </fieldset>

        <div class="btn-row">
          <button class="btn btn--primary" type="submit">Puanımı hesapla</button>
          <button class="btn btn--ghost" type="button" id="act-sifirla">Yanıtları temizle</button>
        </div>
        <p class="form-note">Bu araç bir demo sürümüdür. Yanıtlarınız yalnızca tarayıcınızda hesaplanır; hiçbir yere gönderilmez ve kaydedilmez.</p>
      </form>

      <!-- SONUÇ BÖLGESİ -->
      <div id="act-sonuc" aria-live="polite" style="margin-top:1.25rem"></div>
    </div>

    <!-- ═══ BİLİMSEL GEÇERLİLİK ═══ -->
    <div class="prose" style="margin-top:2.5rem">
      <h2 id="gecerlilik">ACT ne kadar güvenilir bir araçtır?</h2>
      <p>Astım Kontrol Testi, Nathan ve arkadaşları tarafından geliştirilmiş ve 2004 yılında <em>Journal of Allergy and Clinical Immunology</em> dergisinde yayımlanmıştır. Geliştirme çalışmasında anketin, uzman hekim değerlendirmesi ve solunum fonksiyon ölçümleriyle anlamlı düzeyde uyumlu sonuçlar verdiği gösterilmiştir. 2006 yılında yayımlanan izlem çalışması (Schatz ve ark.) ise 20 puan ve üzerinin "kontrol altında" ayrımı için uygun bir eşik olduğunu doğrulamıştır.</p>
      <p>Küresel astım rehberi <strong>GINA</strong> (Global Initiative for Asthma), astım kontrolünün düzenli aralıklarla ve yapılandırılmış biçimde değerlendirilmesini önerir; ACT bu amaçla kullanılan, geçerliliği gösterilmiş anketler arasında yer alır. Muayenehanemizde de kontrol muayenelerinde bu tür puanlamalardan yararlanıyoruz — çünkü "İyiyim doktor bey" cümlesi ile son 4 haftanın gerçek tablosu her zaman örtüşmüyor.</p>
      <div class="caution">
        <b>Kaynak ve ihtiyat notu:</b> Yukarıdaki bilgiler ACT geçerlilik çalışmalarına (Nathan 2004, Schatz 2006) ve GINA raporunun genel yaklaşımına dayanmaktadır. Eşik değerlerin duyarlılığı çalışmadan çalışmaya değişebilir; anket sonuçları kişiden kişiye farklılık gösterebilir. ACT bir tarama aracıdır; muayenenin, solunum fonksiyon testinin ve hekim değerlendirmesinin yerine geçmez.
      </div>

      <h2 id="puan-anlami">Puanınız ne anlama geliyor?</h2>
      <div class="tablewrap">
        <table>
          <thead>
            <tr><th>Toplam puan</th><th>Ne düşündürür?</th><th>Önerilen adım</th></tr>
          </thead>
          <tbody>
            <tr><td><b>25</b></td><td>Son 4 haftada tam kontrol</td><td>Mevcut tedavi düzeninizi hekiminizin bilgisi dahilinde sürdürün; kontrol muayenelerinizi aksatmayın.</td></tr>
            <tr><td><b>20–24</b></td><td>İyi kontrol; ancak tam kontrol değil</td><td>Sonucu bir sonraki muayenenizde hekiminizle paylaşın; tedavide küçük düzenlemeler gündeme gelebilir.</td></tr>
            <tr><td><b>20'nin altı</b></td><td>Kontrol yetersiz olabilir</td><td>Sonucunuzu hekiminizle görüşmeniz uygun olur; tedavinizin gözden geçirilmesi için değerlendirme randevusu oluşturabilirsiniz.</td></tr>
          </tbody>
        </table>
      </div>
      <p class="sm muted">Puanınız düşük çıktıysa bu bir "alarm" değil, bir işarettir: tedavinizin, tetikleyicilerinizin ya da ilaç kullanım tekniğinizin gözden geçirilmesi gerekebilir. Bunların her biri muayenede düzeltilebilir konulardır.</p>

      <h2 id="sss">Sık sorulan sorular</h2>

      <details class="faq"><summary>ACT ile astım tanısı konur mu?</summary>
        <div class="faq-body"><p>Hayır. ACT, <strong>astım tanısı almış</strong> kişilerde son 4 haftadaki kontrol düzeyini ölçmek için tasarlanmıştır. Astımınız olup olmadığını merak ediyorsanız doğru yol anket değil; muayene ve solunum fonksiyon testidir. Öksürük, hırıltı veya nefes darlığı şikayetiniz varsa <a href="/hastaliklar/astim/">yetişkinlerde astım sayfamıza</a> bakabilir, değerlendirme için başvurabilirsiniz.</p></div>
      </details>

      <details class="faq"><summary>Testi ne sıklıkla tekrarlamalıyım?</summary>
        <div class="faq-body"><p>ACT son 4 haftayı sorguladığı için 4 haftadan kısa aralıklarla tekrarlamak ek bilgi sağlamaz. Kontrol muayeneleri öncesinde doldurup sonucu hekiminizle paylaşmanız pratik bir yaklaşımdır. Tedavinizde değişiklik yapıldıysa, yeni düzenin etkisini görmek için hekiminizin önerdiği aralıklarla tekrarlanabilir.</p></div>
      </details>

      <details class="faq"><summary>Puanım yüksek; ilaçlarımı bırakabilir miyim?</summary>
        <div class="faq-body"><p>Hayır — kendi kararınızla bırakmayın. Puanınızın yüksek olması çoğu zaman tedavinizin <em>işe yaradığını</em> gösterir; ilacın gereksiz olduğunu değil. Tedavi basamağının azaltılması mümkün olabilir, ancak bu karar solunum fonksiyonları ve genel tablo birlikte değerlendirilerek hekim tarafından verilir.</p></div>
      </details>

      <details class="faq"><summary>Puanım düşük çıktı; bu kesin bir sonuç mu?</summary>
        <div class="faq-body"><p>Hayır. Düşük puan, kontrolün yetersiz <em>olabileceğini</em> düşündüren bir tarama bulgusudur. Araya giren bir enfeksiyon, mevsimsel alerjen yükü veya ilacın yanlış teknikle kullanılması da puanı düşürebilir. Kesin değerlendirme muayene ile yapılır; sonucunuzu hekiminizle paylaşın.</p></div>
      </details>

      <p class="xs muted" style="margin-top:1.5rem">Bu sayfadaki bilgiler genel bilgilendirme amaçlıdır; hekim muayenesinin, tanı ve tedavinin yerine geçmez. Kişisel durumunuz için hekiminize başvurunuz. Muayenehanede yetişkin hastalar kabul edilmektedir.</p>
    </div>

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
      <a class="tool-card" href="/hastaliklar/astim/">
        <svg class="t-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M16 6v8M10 14q-4 2-4 7t5 5 4-5v-7M22 14q4 2 4 7t-5 5-4-5v-7"/></svg>
        <h3>Yetişkinlerde Astım</h3>
        <p>Gece öksürüğü, hırıltı ve nefes darlığı — belirtiler, tanı ve tedavi basamakları.</p>
      </a>
      <a class="tool-card" href="/araclar/alerji-mi-soguk-alginligi-mi/">
        <svg class="t-icon" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="16" cy="16" r="12"/><path d="M12 13a4 4 0 116 3.5V19"/><path d="M16 23v.5"/></svg>
        <h3>Alerji mi, soğuk algınlığı mı?</h3>
        <p>6 soruluk kısa değerlendirme — 60 saniyede fikir edinin.</p>
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
    <h2>Sonucunuzu birlikte değerlendirelim</h2>
    <p>ACT puanınız ne çıkarsa çıksın, astım takibi düzenli değerlendirme ister. Formu doldurun ya da doğrudan yazın; <strong>aynı gün içinde</strong> sizi arayalım.</p>
    <div class="btn-row" style="justify-content:center;margin-top:1.5rem">
      <a class="btn btn--primary" href="/randevu/">Randevu Talep Et</a>
      <a class="btn btn--wa" data-wa="Merhaba, Astım Kontrol Testi (ACT) değerlendirmesini yaptım. Astımımın değerlendirilmesi için randevu almak istiyorum." data-wa-src="astim-kontrol-testi-kapanis" href="#">WhatsApp'tan yazın</a>
      <a class="btn btn--ghost" href="tel:+902127099396">0212 709 93 96</a>
    </div>
    <p class="sm muted" style="margin-top:1.25rem">Harbiye Mah. Teşvikiye Cad. 37/3 · Şişli / İstanbul (Nişantaşı)</p>
  </div>
</section>

</main>

<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"BreadcrumbList",
  "itemListElement":[
    {"@type":"ListItem","position":1,"name":"Anasayfa","item":"https://drramazanersoy.tr/"},
    {"@type":"ListItem","position":2,"name":"Araçlar","item":"https://drramazanersoy.tr/araclar/"},
    {"@type":"ListItem","position":3,"name":"Astım Kontrol Testi (ACT)","item":"https://drramazanersoy.tr/araclar/astim-kontrol-testi.html"}
  ]
}
</script>
<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"MedicalWebPage",
  "name":"Astım Kontrol Testi (ACT)",
  "url":"https://drramazanersoy.tr/araclar/astim-kontrol-testi.html",
  "inLanguage":"tr",
  "datePublished":"2026-07-19",
  "dateModified":"2026-07-19",
  "audience":{"@type":"MedicalAudience","audienceType":"Patient"},
  "reviewedBy":{
    "@type":"Physician",
    "name":"Uzm. Dr. Ramazan Ersoy",
    "medicalSpecialty":["Allergy","Pulmonary"],
    "url":"https://drramazanersoy.tr/dr-ramazan-ersoy.html"
  },
  "mainEntity":{
    "@type":"MedicalRiskCalculator",
    "name":"Astım Kontrol Testi (ACT)",
    "alternateName":"Asthma Control Test",
    "estimatesRiskOf":{"@type":"MedicalCondition","name":"Kontrolsüz astım"},
    "includedRiskFactor":[
      {"@type":"MedicalRiskFactor","name":"Günlük aktivitelerin astım nedeniyle kısıtlanması"},
      {"@type":"MedicalRiskFactor","name":"Nefes darlığı sıklığı"},
      {"@type":"MedicalRiskFactor","name":"Gece ve sabah erken uyandıran astım belirtileri"},
      {"@type":"MedicalRiskFactor","name":"Rahatlatıcı (kurtarıcı) ilaç kullanım sıklığı"},
      {"@type":"MedicalRiskFactor","name":"Hastanın kendi kontrol değerlendirmesi"}
    ]
  }
}
</script>
<!-- KURTARILAN INLINE BETIK (script-kurtar.js): statik sayfada </main> sonrasindaydi,
     donusturucu almamisti; arac islevselligi bu bloklara bagli -->
<script>
(function(){
  'use strict';
  var form   = document.getElementById('act-form');
  var out    = document.getElementById('act-sonuc');
  var reset  = document.getElementById('act-sifirla');
  if(!form || !out) return;

  var SORULAR = ['q1','q2','q3','q4','q5'];

  function esc(s){ return String(s).replace(/[&<>"']/g, function(c){
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c];
  }); }

  function cevapAl(ad){
    var secili = form.querySelector('input[name="' + ad + '"]:checked');
    return secili ? parseInt(secili.value, 10) : null;
  }

  function uyariGoster(eksikNo){
    out.innerHTML =
      '<div class="caution" role="alert">' +
        '<b>Eksik yanıt:</b> Lütfen ' + eksikNo + '. soruyu da yanıtlayın. ' +
        'Puanın hesaplanabilmesi için 5 sorunun tamamının yanıtlanması gerekir.' +
      '</div>';
    var fs = form.querySelectorAll('fieldset')[eksikNo - 1];
    if(fs){
      fs.style.borderColor = 'var(--amber)';
      var ilkRadio = fs.querySelector('input[type="radio"]');
      if(ilkRadio) ilkRadio.focus();
      fs.scrollIntoView({behavior:'smooth', block:'center'});
    }
  }

  function kenarliklariSifirla(){
    var fsler = form.querySelectorAll('fieldset');
    for(var i = 0; i < fsler.length; i++){ fsler[i].style.borderColor = 'var(--line)'; }
  }

  function sonucGoster(puan){
    var baslik, aciklama, rozetStil, cta = '';

    if(puan === 25){
      baslik = 'Tam kontrol';
      aciklama = 'Son 4 haftada astımınız <strong>tam kontrol altında</strong> görünüyor. Bu tablo, tedavinizin ve günlük düzeninizin iyi işlediğini düşündürür. Mevcut düzeninizi hekiminizin bilgisi dahilinde sürdürün ve kontrol muayenelerinizi aksatmayın.';
      rozetStil = 'background:var(--mint-bg);color:var(--mint-ink);border:1px solid var(--mint-line)';
    } else if(puan >= 20){
      baslik = 'İyi kontrol';
      aciklama = 'Son 4 haftada astımınız <strong>kontrol altında</strong> görünüyor; ancak puanınız tam kontrole (25) ulaşmamış. Bu, tedavinizde küçük düzenlemelerle daha rahat bir döneme geçilebileceğini düşündürebilir. Sonucunuzu bir sonraki muayenenizde hekiminizle paylaşmanız yeterlidir.';
      rozetStil = 'background:var(--mint-bg);color:var(--mint-ink);border:1px solid var(--mint-line)';
      cta =
        '<div class="btn-row" style="margin-top:1.1rem">' +
          '<a class="btn btn--ghost" href="../randevu.html?sikayet=astim">Kontrolü tam hedefliyorsanız değerlendirme için randevu oluşturabilirsiniz</a>' +
        '</div>';
    } else {
      baslik = 'Kontrol yetersiz olabilir';
      aciklama = 'Puanınız 20\'nin altında. Bu, son 4 haftada <strong>astım kontrolünüzün yetersiz olabileceğini</strong> düşündüren bir tarama bulgusudur — kesin bir sonuç değildir. Tedavinizin, tetikleyicilerinizin ve ilaç kullanım tekniğinizin gözden geçirilmesi için bir değerlendirme randevusu oluşturabilirsiniz.';
      rozetStil = 'background:#FFFBF3;color:#92400E;border:1px solid var(--amber)';
      cta =
        '<div class="btn-row" style="margin-top:1.1rem">' +
          '<a class="btn btn--primary" href="../randevu.html?sikayet=astim">Değerlendirme için randevu oluşturun</a>' +
          '<a class="btn btn--ghost" href="tel:+902127099396">0212 709 93 96</a>' +
        '</div>';
    }

    out.innerHTML =
      '<div class="card" style="border-color:var(--mint-line)">' +
        '<p class="eyebrow" style="margin-bottom:.4rem">Sonucunuz</p>' +
        '<p style="margin:0 0 .35rem"><span class="tnum" style="font-family:var(--font-display);font-size:2.6rem;font-weight:600;color:var(--ink);line-height:1">' + puan + '</span>' +
        '<span class="muted" style="font-size:1.05rem"> / 25 puan</span></p>' +
        '<p style="margin:0 0 .9rem"><span style="display:inline-block;font-size:var(--fs-xs);font-weight:700;letter-spacing:.05em;text-transform:uppercase;padding:.3rem .75rem;border-radius:var(--r-pill);' + rozetStil + '">' + esc(baslik) + '</span></p>' +
        '<p class="sm" style="margin-bottom:0">' + aciklama + '</p>' +
        cta +
        '<p style="margin:1.1rem 0 0"><button class="btn btn--ghost" type="button" onclick="window.print()">Sonucu yazdır</button></p>' +
        '<div class="caution" style="margin-bottom:0;margin-top:1.1rem">' +
          '<b>Önemli:</b> ACT bir <b>tarama aracıdır</b>; tanı ve tedavi kararının yerine geçmez. ' +
          'Sonucunuzu mutlaka hekiminizle paylaşın. Sonuçlar kişiden kişiye farklılık gösterebilir.' +
        '</div>' +
      '</div>';

    /* WhatsApp mesajını puana göre güncelle (data-wa + href birlikte) */
    var waMsg = 'Merhaba, ACT testinden ' + puan + ' puan aldım, değerlendirme randevusu istiyorum.';
    document.querySelectorAll('a[data-wa]').forEach(function(wa){
      wa.setAttribute('data-wa', waMsg);
      var h = wa.getAttribute('href') || '';
      if(h.indexOf('wa.me') !== -1) wa.setAttribute('href', h.split('?')[0] + '?text=' + encodeURIComponent(waMsg));
    });

    out.scrollIntoView({behavior:'smooth', block:'nearest'});
  }

  form.addEventListener('submit', function(e){
    e.preventDefault();
    kenarliklariSifirla();
    var toplam = 0;
    for(var i = 0; i < SORULAR.length; i++){
      var deger = cevapAl(SORULAR[i]);
      if(deger === null){ uyariGoster(i + 1); return; }
      toplam += deger;
    }
    sonucGoster(toplam);
  });

  if(reset){
    reset.addEventListener('click', function(){
      form.reset();
      kenarliklariSifirla();
      out.innerHTML = '';
    });
  }
})();
</script>
<?php get_footer(); ?>
