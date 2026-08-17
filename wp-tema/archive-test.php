<?php
/**
 * test arşivi — statik pillar sayfasından devşirildi (tam-devir.js).
 * Anlatı + SSS + kart yapısı aynen korunur; WP yalnız adresi sahiplenir.
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
<main id="icerik">

<div class="wrap">
  <nav class="crumbs" aria-label="Sayfa yolu">
    <a href="/">Anasayfa</a> <span aria-hidden="true">›</span>
    <span aria-current="page">Testler</span>
  </nav>
</div>

<section class="section section--tight">
  <div class="wrap">
    <p class="eyebrow">Alerji testleri</p>
    <h1>Hangi alerji testi bana gerekiyor?</h1>
    <p class="hero-lede" style="max-width:62ch">Alerji tanısında her şeyi gösteren tek bir test yoktur. Doğru testi şikayetinizin türü, ne zaman başladığı ve kullandığınız ilaçlar belirler. Burun ve nefes şikayetlerinde deri testi öne çıkar, temas kaynaklı döküntülerde yama testi gerekir. Bu sayfa hangi testin hangi soruyu yanıtladığını sade bir dille anlatır.</p>
    <div class="btn-row" style="margin:1.25rem 0 0">
      <a class="btn btn--primary" href="/randevu/">Randevu talep et</a>
      <a class="btn btn--ghost" href="/hasta-merkezi/randevunuza-hazirlanin/">Randevunuza hazırlanın</a>
    </div>
  </div>
</section>

<div class="wrap" style="margin-bottom:2rem">
  <figure style="margin:0">
    <img src="../assets/img/icerik/testler-index-1440.webp"
         srcset="../assets/img/icerik/testler-index-640.webp 640w, ../assets/img/icerik/testler-index-960.webp 960w, ../assets/img/icerik/testler-index-1440.webp 1440w, ../assets/img/icerik/testler-index-1920.webp 1920w"
         sizes="(max-width:900px) 100vw, 1140px"
         width="1440" height="804" loading="lazy" decoding="async"
         alt="Krem zeminde tepeden çekilmiş test malzemeleri: damlalıklı şişe, lanset, üç tüp, ağızlık, yamalar ve altın tepsi."
         style="width:100%;height:auto;border-radius:var(--r-lg);display:block">
    <figcaption class="xs muted" style="margin-top:.5rem">Görsel yapay zekâ ile üretilmiştir.</figcaption>
  </figure>
</div>

<section class="section section--tight" style="padding-top:0">
  <div class="wrap">
    <div class="article-layout">

      <aside class="toc">
        <h2>İçindekiler</h2>
        <ol>
            <li><a href="#bir-bakista">Bir bakışta</a></li>
            <li><a href="#test-ne-olcer">Alerji testi aslında neyi ölçüyor?</a></li>
            <li><a href="#ilac-birakma">Testten önce hangi ilaçları bırakmam gerekir?</a></li>
            <li><a href="#deri-prick-testi">Deri prick testi nasıl yapılıyor, acıtır mı?</a></li>
            <li><a href="#yama-testi">Temas kaynaklı döküntüde neden yama testi isteniyor?</a></li>
            <li><a href="#kan-testi">Kan testi deri testinin yerine geçer mi?</a></li>
            <li><a href="#solunum-testi">Nefes şikayetimde neden üfleme testi yapılıyor?</a></li>
            <li><a href="#provokasyon-testi">Testler net cevap vermezse ne yapıyoruz?</a></li>
            <li><a href="#sikayete-gore-test">Hangi şikayette hangi test öne çıkıyor?</a></li>
            <li><a href="#pozitif-sonuc">Testim pozitif çıktı, alerjim var demek mi?</a></li>
            <li><a href="#randevu">Ne zaman randevu almalıyım?</a></li>
            <li><a href="#sss">Sık sorulan sorular</a></li>
        </ol>
      </aside>

      <article class="prose">

        <div class="at-glance" id="bir-bakista">
          <h3>
            <svg viewBox="0 0 20 20" fill="currentColor" width="18" height="18" aria-hidden="true"><path d="M10 3C5.5 3 2 10 2 10s3.5 7 8 7 8-7 8-7-3.5-7-8-7zm0 11a4 4 0 110-8 4 4 0 010 8zm0-2a2 2 0 100-4 2 2 0 000 4z"/></svg>
            Bir bakışta
          </h3>
          <ul>
            <li><b>Temel ilke</b> Her şeyi gösteren tek bir alerji testi yoktur; doğru test şikayetinizin türüne, süresine ve kullandığınız ilaçlara göre seçilir.</li>
            <li><b>Deri prick testi</b> Ani tip alerjiyi yaklaşık 15 dakikada gösterir; öncesinde antihistaminik ilaçlara yaklaşık 10 gün ara vermek gerekir.</li>
            <li><b>Yama testi</b> Takı, kozmetik ve saç boyası gibi temas alerjilerini arar; bantlar 48 saat sırtta kalır, süreç üç-dört güne yayılır.</li>
            <li><b>Kan testi</b> Spesifik IgE ölçümü ilaç kesintisi istemez; gebelikte, yaygın egzamada ve ağır reaksiyon öyküsünde öne çıkar.</li>
            <li><b>Sonuç yorumu</b> Pozitif sonuç tek başına hastalık kanıtı değildir; sonuç her zaman şikayet öykünüzle birlikte değerlendirilir.</li>
            <li><b>Acil durum</b> Nefes darlığı, dilde veya boğazda şişme ya da baygınlık hissi varsa test veya randevu beklemeyin; hemen 112'yi arayın.</li>
            <li><b>Yaş kapsamı</b> Muayenehanemiz yalnızca yetişkin hastalara hizmet verir; 18 yaş altı için çocuk alerji ve klinik immünoloji uzmanına başvurulmalıdır.</li>
          </ul>
        </div>

        <h2 id="test-ne-olcer">Alerji testi aslında neyi ölçüyor?</h2>
        <p>Alerji, bağışıklık sisteminizin zararsız bir maddeyi tehdit sanmasıyla başlar. Vücut o maddeye karşı <strong>IgE</strong> adlı bir antikor üretir. Bu antikor, cildinizdeki ve mukozanızdaki hücrelerin yüzeyine yerleşir. Aynı maddeyle yeniden karşılaştığınızda hücreler histamin salar. Hapşırık, kaşıntı, kabarıklık ve hırıltı işte bu zincirin sonucudur.</p>
        <p>Testlerin büyük bölümü aynı mekanizmaya iki ayrı pencereden bakar. Birinci pencere derinizdir: alerjeni yüzeye temas ettirir, vücudunuzun canlı tepkisini izleriz. İkinci pencere kanınızdır: laboratuvar, o alerjene özgü IgE miktarını ölçer. Dolayısıyla iki yöntem birbirinin rakibi değil, aynı sorunun iki farklı yanıtıdır.</p>
        <p>Ancak her alerji IgE ile ilerlemez. Nikel, kozmetik, saç boyası ve koruyucu maddelere karşı gelişen tepkiler saatler, hatta günler sonra ortaya çıkar. Bu grup farklı bir hücresel yolu kullanır. Bu nedenle deri prick testi bu tabloyu göstermez; devreye <a href="/testler/yama-testi/">yama testi</a> girer.</p>
        <p>Üçüncü bir grup test ise alerjenle hiç ilgilenmez. Onlar alerjinin organınızda ne yaptığını ölçer. Astım şüphesinde istediğimiz <a href="/testler/solunum-fonksiyon-testi/">solunum fonksiyon testi</a> bunun en bilinen örneğidir. Kısacası test seçimi, sizin sorunuza göre değişir.</p>

        <h2 id="ilac-birakma">Testten önce hangi ilaçları bırakmam gerekir?</h2>
        <p>Muayenehanede en sık karşılaştığımız sorun budur. <strong>Deri prick testi</strong> yaptıracaksanız antihistaminik grubu ilaçları yaklaşık 10 gün önce bırakmanız gerekir. Bu ilaçlar tam olarak ölçmeye çalıştığımız kaşıntı-kızarıklık yanıtını bastırır. İlaç etkisi sürerken yapılan test, gerçekte alerjiniz olsa bile negatif çıkabilir. Buna karşılık <a href="/testler/yama-testi/">yama testinde</a> antihistaminik genellikle sorun çıkarmaz; orada asıl dikkat edilecek olan kortizon grubu ilaçlar ve sırta sürülen kortizonlu kremlerdir. Yani hangi ilacı ne zaman bırakacağınız, hangi testi yaptıracağınıza göre değişir.</p>
        <p>Gözden kaçan ilaçlara ayrıca dikkat edin. Bazı mide ve reflü ilaçları, bazı soğuk algınlığı kombinasyonları ve uyku yardımcısı olarak kullanılan bazı ürünler de antihistaminik etkilidir. Bu nedenle kutuları yanınızda getirin. Vitamin ve bitkisel takviyeleri de listeye ekleyin.</p>
        <p>Buna karşılık astım, tansiyon, kalp ve psikiyatri ilaçlarınızı <strong>kendi başınıza asla bırakmayın</strong>. Bunların bir kısmı testi etkiler, fakat bırakma kararını yalnızca hekiminiz verir. Randevu alırken kullandığınız tüm ilaçları bildirin; hangisinin ne zaman duracağını size özel olarak söyleriz.</p>
        <p>İlacınızı bırakamıyorsanız çözüm testi ertelemek değildir. Bu durumda testi değiştiririz: <a href="/testler/spesifik-ige-kan-testi/">spesifik IgE kan testi</a> hiçbir ilaç kesintisi istemez. Randevu öncesi hazırlığın tamamını <a href="/hasta-merkezi/randevunuza-hazirlanin/">randevunuza hazırlanın</a> sayfasında topladık.</p>

        <h2 id="deri-prick-testi">Deri prick testi nasıl yapılıyor, acıtır mı?</h2>
        <p>Alerji polikliniğinin en hızlı testidir. Polen, ev tozu akarı, küf, hayvan tüyü ve sık besinlerin standart sıvı özlerini ön kolunuza birkaç santim aralıkla damlatırız. Ardından her damlanın üzerinden, tek kullanımlık plastik uçlu bir lansetle derinin yalnızca en üst tabakasına ulaşan ve bir milimetreyi geçmeyen çok yüzeysel bir batırma yaparız. Enjeksiyon yapmayız, damara ya da kasa girmeyiz, kan almayız; kanama beklenmez. Bu his çoğunlukla ağrı olarak değil, kısa bir dokunma ya da karıncalanma olarak tarif edilir.</p>
        <p>O alerjene duyarlıysanız ilgili noktada 15 dakika içinde sivrisinek ısırığına benzer kabarık bir alan belirir. Aynı seansta iki de kontrol uygularız. Biri yanıt vermesi gereken pozitif kontrol, diğeri yanıt vermemesi gereken negatif kontroldür. Bu ikili, derinizin o gün normal davranıp davranmadığını gösterir. Yani test kendi kendini denetler.</p>
        <p>Süre hazırlıkla birlikte 20-30 dakikadır. Sonucu aynı muayenede konuşuruz, ikinci bir randevu gerekmez. Pozitif noktalarda kaşıntı hissedebilirsiniz; bu beklenen bir yanıttır ve genellikle kısa sürede geçer.</p>
        <p>Her hasta bu teste uygun değildir. Yaygın egzaması, dermografizmi olan veya antihistaminiğini bırakamayan kişilerde sonucu güvenle okuyamayız. Gebelikte de tercih etmeyiz. Testin adımlarını ayrıntılı okumak isterseniz <a href="/testler/deri-prick-testi/">deri prick testi</a> sayfasına göz atın.</p>

        <h2 id="yama-testi">Temas kaynaklı döküntüde neden yama testi isteniyor?</h2>
        <p>Bazı alerjiler dakikada değil, günde ortaya çıkar. Küpe taktığınız kulakta kaşıntılı kızarıklık, saç boyasından sonra kafa derisinde döküntü, iş yerinde kullandığınız bir maddeden sonra ellerde çatlayan egzama; hepsi <strong>alerjik kontakt dermatit</strong> başlığına girer. Bu tablo deri prick testinde görünmez.</p>
        <p>Yama testinde şüpheli maddelerin standart serilerini küçük odacıklara yerleştirir, sırtınıza bantlarız. Bantlar <strong>48 saat sırtta kalır</strong>. Bu süre boyunca sırtınızı ıslatmamanız gerekir. Terleten egzersizden ve doğrudan güneşten de uzak durun.</p>
        <p>Kırk sekizinci saatte bantları çıkarır, ilk okumayı yaparız. İkinci okuma genellikle 72. saatte gelir, çünkü bazı reaksiyonlar geç belirir. Dolayısıyla süreç toplamda üç-dört güne yayılır ve kliniğe birkaç kez gelmeniz gerekir.</p>
        <p>Bu yüzden planlamayı önceden yapmak önemlidir. Test hafta ortasında başlarsa okumalar hafta sonuna denk gelebilir. Randevu alırken çalışma ve seyahat programınızı söyleyin. Ayrıntılar için <a href="/testler/yama-testi/">yama (patch) testi</a> sayfasına bakabilirsiniz.</p>

        <h2 id="kan-testi">Kan testi deri testinin yerine geçer mi?</h2>
        <p>Kan testi bir yedek değil, ayrı bir araçtır. Koldan aldığımız tek örnekte laboratuvar, belirli alerjenlere karşı üretilmiş IgE miktarını ölçer. Deri testiyle aynı mekanizmaya bakar, ama cildinize hiç dokunmadan. Bu özelliği onu bazı durumlarda vazgeçilmez kılar.</p>
        <p>En büyük pratik avantajı ilaç kesintisi istememesidir. Antihistaminiğini bırakınca şikayetleri dayanılmaz hale gelen hastalar gün kaybetmez. Ayrıca yaygın egzaması ya da dermografizmi olan kişilerde deri yanıtı güvenle okunamadığı için kan testi öne çıkar. Gebelikte ve ağır reaksiyon öyküsü olan hastalarda da çoğunlukla ilk tercih budur.</p>
        <p>Buna karşılık sonuç birkaç iş günü sürer. Ayrıca bakılacak alerjen sayısı istenen panele bağlıdır. Bu nedenle “her ihtimale karşı hepsine bakalım” yaklaşımını doğru bulmuyoruz. Hikâyenizde karşılığı olmayan alerjenler yalnızca gereksiz pozitiflik ve gereksiz kaygı üretir.</p>
        <p>Bazı hastalarda bir adım daha ileri gideriz. Klasik test size fındığa duyarlı olduğunuzu söyler; moleküler (komponent bazlı) test ise fındığın hangi protein parçasına duyarlı olduğunuzu gösterir. Bu ayrım, ağızda karıncalanmayla sınırlı kalan bir tabloyla daha ciddi bir tabloyu birbirinden ayırmaya yardımcı olur. Aynı bilgi <a href="/tedaviler/alerji-asisi-immunoterapi/">alerji aşısı</a> kararında da işe yarar. Kan testinin ayrıntısı için <a href="/testler/spesifik-ige-kan-testi/">spesifik IgE kan testi</a> sayfasına bakın.</p>

        <h2 id="solunum-testi">Nefes şikayetimde neden üfleme testi yapılıyor?</h2>
        <p>Solunum fonksiyon testi bir alerji testi değildir. O, alerjinin akciğerinizde bıraktığı izi ölçer. Uzun süren öksürük, hırıltı ya da efor sırasında nefes darlığı varsa bu testi isteriz.</p>
        <p>Uygulaması basittir. Cihaza bağlı ağızlığa derin bir nefes alır, ardından <strong>olabildiğince hızlı ve uzun</strong> üflersiniz. Cihaz havanın ne kadar hızlı ve ne kadar çok çıktığını kaydeder. Astımda hava yolları daraldığı için nefes verme hızı düşer.</p>
        <p>Asıl kritik aşama çoğu zaman ikincisidir. Bronş genişletici bir ilaçtan sonra testi tekrarlarız. Daralmanın ilaçla geri dönmesi, <a href="/hastaliklar/astim/">astım</a> tanısını güçlü biçimde destekleyen bulgulardan biridir. Sonucu anında görürsünüz.</p>
        <p>Testin doğruluğu tamamen üfleme performansınıza bağlıdır. Bu yüzden teknisyen size birkaç kez tekrarlatabilir; bu bir sorun işareti değildir. Astımınızın kontrol altında olup olmadığını evde ölçmek isterseniz <a href="/araclar/astim-kontrol-testi/">astım kontrol testi</a> beş soruda size fikir verir.</p>
        <p>Bir noktayı özellikle ekleyelim: tek bir normal ölçüm astımı dışlamaz. Astımda hava yolları değişkendir ve iyi bir gününüzde değerler tamamen normal çıkabilir. Ölçüm o anın fotoğrafını verir, filmin tamamını değil. Şikayetiniz sürüyorsa testi şikayetli bir dönemde tekrarlar, nefesteki nitrik oksidi ölçer ya da evde PEF takibi planlarız. Ayrıntıları <a href="/testler/solunum-fonksiyon-testi/">solunum fonksiyon testi</a> sayfasında anlattık.</p>

        <h2 id="provokasyon-testi">Testler net cevap vermezse ne yapıyoruz?</h2>
        <p>Bazen deri ve kan testi soruyu kapatmaz. Örneğin bir antibiyotikten sonra döküntü çıkmıştır, fakat testler negatiftir. Hasta ise o ilaç grubundan ömür boyu kaçınmaktan korkar. İşte bu noktada son sözü <strong>provokasyon testi</strong> söyler.</p>
        <p>Yöntem şudur: şüpheli maddeyi hekim gözetiminde, çok küçük dozdan başlayarak kademeli veririz ve her adımda sizi gözleriz. Diğer testler ipucu toplar; bu yöntem cevabı doğrudan gösterdiği için bilimsel literatürde altın standart olarak anılır. Aynı zamanda reaksiyon ihtimali en yüksek olan testtir. Bu yüzden asla ayaküstü yapmayız; planlı bir randevu ve genellikle yarım güne yayılan bir uygulama ile gözlem gerekir.</p>
        <p>Sonuç çoğu zaman rahatlatıcı çıkar. İlaç provokasyonu, yıllardır gereksiz yere kaçınılan bir ilacı hastaya geri kazandırabilir. Besin provokasyonu ise test pozitifliği ile gerçek hayattaki tolerans arasındaki farkı ortaya koyar ve gereksiz diyet kısıtlamalarını kaldırır. Ayrıntılar <a href="/testler/provokasyon-testleri/">provokasyon testleri</a> sayfasında.</p>
        <p>Şüpheli bir ilacı veya besini evde “deneyip görmek” için almayın. Kontrolsüz denemeler, klinikte önlenebilen riskleri önlenemez hale getirir. <strong>Nefes darlığı, dilde veya boğazda şişme, ses kısıklığı, yaygın kurdeşenle birlikte baygınlık hissi varsa beklemeyin: hemen <a href="tel:112">112</a>'yi arayın.</strong> Bu tablo <a href="/hastaliklar/anafilaksi/">anafilaksi</a> olabilir ve evde değil, hastanede müdahale ister.</p>

        <h2 id="sikayete-gore-test">Hangi şikayette hangi test öne çıkıyor?</h2>
        <p>Testlerin hepsi aynı soruya cevap vermez. Kimi tetikleyicinin adını arar, kimi organınızın o tetikleyiciden ne kadar etkilendiğini ölçer. Bu yüzden seçim, şikayetinizin türüyle başlar. Aşağıda en sık karşılaştığımız tabloları ve her birinde ilk sıraya geçen testi topladık.</p>
        <p>Baharda artan hapşırık, burun akıntısı ve göz kaşıntısında polen paneliyle <a href="/testler/deri-prick-testi/">deri prick testine</a> başlarız; bu test ani tip alerjiyi dakikalar içinde gösterdiği için tetikleyiciyi bulmanın en hızlı yoludur. Şikayetlerinizin hangi ayda tırmandığını görmek için <a href="/araclar/polen-takvimi/">İstanbul polen takvimi</a> işinizi kolaylaştırır. Tablonun tamamı için <a href="/hastaliklar/alerjik-rinit/">alerjik rinit</a> sayfasına bakabilirsiniz.</p>
        <p>Yıl boyu süren, evde ve sabahları artan burun tıkanıklığında akar, küf ve hayvan alerjenlerine yöneliriz. Gece öksürüğü, hırıltı ve efor nefes darlığında ise önce solunum fonksiyon testini isteriz; bu ölçüm alerjeni değil, hava yolundaki daralmayı gösterir. Tetikleyiciyi bulmak için deri testini ekleriz.</p>
        <p>Yiyecek sonrası ağızda karıncalanma, döküntü veya şişme yaşadıysanız deri ve kan testini birlikte değerlendiririz; spesifik IgE ölçümü ilaç bırakamayan ya da cildi teste uygun olmayan hastalara da kapı açar. Gerekirse moleküler tanıyla riski ayırırız; ayrıntı için <a href="/hastaliklar/besin-alerjisi/">besin alerjisi</a> sayfasına göz atın. İlaç sonrası reaksiyonlarda ayrıntılı öykü her testten önce gelir, kararsız kalınan durumlarda son sözü provokasyon söyler; sonrasını <a href="/hastaliklar/ilac-alerjisi/">ilaç alerjisi</a> sayfasında anlattık.</p>
        <p>Takı, kozmetik ya da saç boyası sonrası çıkan kaşıntılı kızarıklıkta ve el egzamasında ilk sıra yama testinindir; çünkü günler sonra beliren temas egzaması ancak bu yöntemle görünür. Tekrarlayan kurdeşende ise geniş panel çoğu zaman gerekmez; öykü ve hedefli kan tetkikleri daha çok işe yarar. Bunun nedenini <a href="/hastaliklar/urtiker/">ürtiker</a> sayfasında açıkladık.</p>
        <p>Arı sokmasından sonra yaygın reaksiyon geçirdiyseniz venom deri testi ve kan testini birlikte kullanırız; sonuçlar aşı kararını da belirler. Ayrıntılar <a href="/hastaliklar/ari-alerjisi/">arı alerjisi</a> sayfasında. Buna karşılık kaşıntısız, tekrarlayan ve alerji ilaçlarına yanıt vermeyen şişliklerde yön tamamen değişir: kanda C4 ile C1-inhibitör düzey ve fonksiyon testine bakarız. Bu tablo <a href="/hastaliklar/herediter-anjiyoodem/">herediter anjiyoödem</a> olabilir. Ani kızarma ve ciltte kalıcı lekeler eşlik ediyorsa <a href="/hastaliklar/mastositoz/">mastositoz</a> yönünde ek tetkik isteriz.</p>

        <h2 id="pozitif-sonuc">Testim pozitif çıktı, alerjim var demek mi?</h2>
        <p>Tam olarak değil. Pozitiflik, vücudunuzun o maddeye karşı duyarlandığını gösterir. Duyarlanma ile hastalık ise aynı şey değildir. Toplumda hiçbir şikayeti olmadan test pozitifliği taşıyan azımsanmayacak sayıda kişi vardır.</p>
        <p>Bir pozitifliğin anlamlı sayılması için, o alerjenle karşılaştığınızda şikayetlerinizin gerçekten artması gerekir. Kedisi olmayan ve kediyle hiç temas etmeyen birinde çıkan “kedi pozitif” sonucu, hayatı yeniden düzenlemeyi gerektirmez. Bu nedenle sonucu hikâyenizle birlikte okuruz.</p>
        <p>Negatif sonuç da bir çıkmaz değildir. Şikayetinizin arkasında alerjik olmayan rinit, reflüye bağlı öksürük, burun içi yapısal sorunlar ya da kronik spontan ürtiker olabilir. Bunlar standart deri testinde görünmez. Negatif sonuç aslında şunu söyler: aramayı yandaki koridorda sürdürelim.</p>
        <p>Peki sonucun büyüklüğü şiddeti gösterir mi? Kısmen. Yüksek değerler genellikle daha yüksek klinik olasılıkla ilişkilidir, ancak bu bir şiddet cetveli değildir. Küçük bir pozitiflik ciddi bir tabloyla, büyük bir pozitiflik ise hiç şikayetsiz seyredebilir. Sonuçların klinik karşılığı <strong>kişiden kişiye değişir</strong>.</p>

        <h2 id="randevu">Ne zaman randevu almalıyım?</h2>
        <p>Hangi testin gerektiğine önceden karar vermeniz gerekmez. Doğru adım, şikayetinizi anlatmak üzere değerlendirilmektir. Burun akıntısı, tıkanıklık ya da hapşırık yılda birkaç haftadan uzun sürüyorsa veya her yıl aynı mevsimde tekrarlıyorsa randevu alın.</p>
        <p>Sekiz haftadan uzun süren, geceleri ya da efordan sonra artan öksürük de değerlendirme ister. Ciltte tekrarlayan kaşıntılı kabarıklıklar altı haftayı geçtiyse aynı şey geçerlidir. Belirli bir eşya, kozmetik veya iş ortamıyla ilişkilendirebildiğiniz döküntüler de listeye girer.</p>
        <p>Bir yiyecek, ilaç ya da arı sokmasından sonra döküntü, şişme veya nefes şikayeti yaşadıysanız değerlendirme ertelenmemelidir. Nefes darlığı, boğazda ve dilde şişme ya da baygınlık hissi o an varsa <strong>randevu beklemeyin; doğrudan <a href="tel:112">112</a>'yi arayın</strong>.</p>
        <p>Muayenehanemiz Nişantaşı'nda, Şişli'dedir ve yetişkin alerji hastalıklarına odaklanır; 18 yaş altındaki hastaların değerlendirmesi çocuk alerji ve immünoloji uzmanlığının alanına girer. Randevu ve yol bilgisi için <a href="/iletisim/">iletişim</a> sayfasına bakabilir, talebinizi <a href="/randevu/">randevu</a> formundan iletebilirsiniz.</p>

        <h2 id="sss">Sık sorulan sorular</h2>
        <details class="faq"><summary>Alerji testi öncesi hangi ilaçları bırakmam gerekir?</summary>
          <div class="faq-body"><p>Deri prick testi yaptıracaksanız antihistaminik grubu ilaçları yaklaşık 10 gün önce bırakmanız gerekir. Bazı mide ilaçları ve soğuk algınlığı kombinasyonları da antihistaminik etkilidir; bunlar sıkça gözden kaçar. Buna karşılık astım, tansiyon, kalp ve psikiyatri ilaçlarınızı kendi başınıza bırakmayın; bırakma kararını yalnızca hekiminiz verir. Randevu alırken kullandığınız tüm ilaçları, vitamin ve bitkisel takviyeler dahil bildirin. <a href="/testler/spesifik-ige-kan-testi/">Spesifik IgE kan testi</a> için hiçbir ilacı bırakmanız gerekmez; <a href="/testler/yama-testi/">yama testi</a> için ise antihistaminik kesmek çoğunlukla gerekmez.</p></div>
        </details>
        <details class="faq"><summary>Testlerin hepsini aynı gün yaptırabilir miyim?</summary>
          <div class="faq-body"><p>Bir kısmını evet, hepsini hayır. Deri prick testi ile kan örneğini çoğu zaman aynı randevuda alabiliriz; <a href="/testler/solunum-fonksiyon-testi/">solunum fonksiyon testi</a> de aynı güne sığar. Buna karşılık <a href="/testler/yama-testi/">yama testi</a> üç ayrı ziyaret ister, <a href="/testler/provokasyon-testleri/">provokasyon testleri</a> ise başlı başına bir gün gerektirir. Ayrıca prick testi için ilaç kesmek gerekir, kan testi için gerekmez; bu da takvimi belirler. Sıralamayı ilk muayenede birlikte kurarız.</p></div>
        </details>
        <details class="faq"><summary>Test sonuçları ne zaman çıkar?</summary>
          <div class="faq-body"><p>Deri prick testinin sonucunu yaklaşık 15 dakikada okur, aynı muayenede konuşuruz. Kliniğe bir kez gelmeniz yeterlidir. <a href="/testler/yama-testi/">Yama testi</a> ise 48. ve 72. saatte iki ayrı okuma ister, bu nedenle süreç üç-dört güne yayılır. Spesifik IgE ve moleküler testler laboratuvara göre genellikle birkaç iş günü sürer. <a href="/testler/solunum-fonksiyon-testi/">Solunum fonksiyon testi</a> sonucu anında verir.</p></div>
        </details>
        <details class="faq"><summary>İki merkez farklı sonuç verdi, hangisine güveneyim?</summary>
          <div class="faq-body"><p>Önce iki testin aynı yöntem olup olmadığına bakarız; deri testi ile kan testi zaten aynı ölçüyü vermez ve farklı çıkmaları çelişki sayılmaz. Sonra tarihe bakarız, çünkü duyarlanma zamanla değişir. Deri testinde o gün kullanılan ilaçlar ve kontrol damlalarının davranışı da sonucu değiştirir. Bu yüzden eski raporlarınızı tarihleriyle birlikte getirin. Hangi sonucun sizin tablonuzu açıkladığını, şikayetlerinizin hikâyesine bakarak birlikte kararlaştırırız.</p></div>
        </details>
        <details class="faq"><summary>Kan testi mi deri testi mi daha doğru sonuç verir?</summary>
          <div class="faq-body"><p>İkisi birbirinin rakibi değildir; aynı olayı iki ayrı yerden ölçerler. Deri testi daha hızlıdır ve sonucu aynı gün konuşursunuz. Kan testi ise ilaç bırakılamadığında, yaygın egzama veya dermografizm gibi cilt sorunları olduğunda, gebelikte ve reaksiyon riski yüksek olduğunda öne çıkar. Bazen iki sonuç birbirinden farklı çıkar; bu bir çelişki değil, ek bilgidir. Hangisinin sizin tablonuzu daha iyi açıkladığını muayenede birlikte değerlendiririz.</p></div>
        </details>
        <details class="faq"><summary>Eczaneden veya internetten alınan ev tipi alerji test kitleri güvenilir mi?</summary>
          <div class="faq-body"><p>Bu kitlerin bir kısmı kanda toplam ya da spesifik IgE'ye bakar; ancak örnek alma tekniği, ölçüm kalitesi ve bakılan alerjen listesi üründen ürüne büyük fark gösterir. Daha önemlisi, sonuç tek başına anlam taşımaz: pozitiflik hastalık kanıtı değildir, negatiflik de şikayetinizi açıklamaz. Elinizde böyle bir sonuç varsa getirin, birlikte değerlendiririz; ancak tanı için öykü, muayene ve standart yöntemlerle planlanan testleri bir arada yürütmek daha güvenli bir yoldur.</p></div>
        </details>
        <details class="faq"><summary>Tek seferde bütün alerjenlere baktırsam olmaz mı?</summary>
          <div class="faq-body"><p>Bu istek çok anlaşılır, ancak pratikte işe yaramaz. Hikâyenizde karşılığı olmayan alerjenlere bakmak, klinik anlamı olmayan pozitiflikler üretir. Bu pozitiflikler sonra gereksiz kaçınmalara ve gereksiz diyet kısıtlamalarına yol açar. Bu yüzden paneli şikayetinize, mevsiminize ve yaşam ortamınıza göre daraltırız. Hangi alerjenlerin sizin için anlamlı olduğunu, şikayetlerinizin hangi aylarda arttığına bakarak da netleştiririz; <a href="/araclar/polen-takvimi/">polen takvimi</a> bu konuda iyi bir başlangıçtır.</p></div>
        </details>
        <details class="faq"><summary>Besin intoleransı (IgG) testi bir alerji testi midir?</summary>
          <div class="faq-body"><p>Hayır. Besinlere karşı IgG ya da IgG4 antikorlarının bulunması, o besinle sık karşılaşıldığını gösteren olağan bir bağışıklık yanıtıdır; alerji ya da intolerans kanıtı değildir. Uluslararası alerji ve immünoloji dernekleri bu testlerin tanı amacıyla kullanılmasını önermez. Bu panellere dayanarak yapılan geniş diyet kısıtlamaları gereksizdir ve beslenmeyi bozabilir. Besinle ilişkili bir şikayetiniz varsa doğru yol öykü, spesifik IgE ve gerektiğinde <a href="/testler/provokasyon-testleri/">provokasyon testidir</a>.</p></div>
        </details>
        <details class="faq"><summary>Deri testi için belirli bir mevsimi beklemem gerekir mi?</summary>
          <div class="faq-body"><p>Hayır, deri prick testi yılın her döneminde yapılabilir; polen duyarlılığı mevsim dışında da deriden okunur. Yine de zamanlamayı birlikte planlarız: şikayetlerin tepe yaptığı dönemde antihistaminiğe ara vermek zor olabilir, ciltte yaygın döküntünün olduğu bir dönem de okumanın güvenilirliğini düşürür. Böyle bir dönemdeyseniz testi birkaç hafta kaydırabilir ya da <a href="/testler/spesifik-ige-kan-testi/">kan testiyle</a> başlayabiliriz.</p></div>
        </details>
        <details class="faq"><summary>Test sırasında ciddi bir reaksiyon gelişir mi?</summary>
          <div class="faq-body"><p>Deri prick testinde ciddi reaksiyon çok nadirdir. Yine de testi daima gerekli müdahale koşullarının bulunduğu bir ortamda ve gözlem altında yaparız. Test sonrası kısa süre klinikte beklemenizi isteyebiliriz. <a href="/testler/provokasyon-testleri/">Provokasyon testleri</a> doğası gereği reaksiyon ihtimali en yüksek olanlardır; bu nedenle asla ayaküstü değil, planlı ve kontrollü koşullarda uygularız. Daha önce ağır bir reaksiyon geçirdiyseniz bunu mutlaka önceden bildirin; belirtileri <a href="/hastaliklar/anafilaksi/">anafilaksi</a> sayfasında anlattık.</p></div>
        </details>
        <details class="faq"><summary>Alerji şikayetim için önce hangi uzmana başvurmalıyım?</summary>
          <div class="faq-body"><p>Burun, göz, cilt ve nefes şikayetleri farklı uzmanlıkların kesişiminde durur; kararsızlık bu yüzden çok doğaldır. Şikayetiniz mevsimsel tekrarlıyor, belirli bir temasla tetikleniyor ya da birden fazla organı birden ilgilendiriyorsa erişkin alerji ve klinik immünoloji değerlendirmesi uygun bir başlangıç noktasıdır. Gerektiğinde kulak burun boğaz, göğüs hastalıkları ve dermatoloji ile iş birliği yaparız; alerji testlerinin seçimi ve yorumu ise alerji uzmanlığının alanıdır.</p></div>
        </details>
        <details class="faq"><summary>Başka bir merkezde yaptırdığım test sonuçları işe yarar mı?</summary>
          <div class="faq-body"><p>Kesinlikle yarar, mutlaka getirin. Eski sonuçlar hem gereksiz tekrarı önler hem de zaman içindeki değişimi gösterir. Sonuç kâğıtlarının aslını ya da net bir fotoğrafını, tarihleriyle birlikte yanınızda bulundurun. Kullandığınız ilaçların kutularını da ekleyin; hangi ilacın testi etkilediğini birlikte görürüz. Ne getirmeniz gerektiğini <a href="/hasta-merkezi/randevunuza-hazirlanin/">randevunuza hazırlanın</a> sayfasında maddeler halinde yazdık.</p></div>
        </details>
        <details class="faq"><summary>Çocuğuma da alerji testi yaptırabilir miyim?</summary>
          <div class="faq-body"><p>Muayenehanemiz yetişkin alerji alanında hizmet vermektedir. 18 yaş altında test seçimi, uygulama ve sonuçların yorumu ayrı bir uzmanlık gerektirir; bu nedenle çocuğunuz için doğrudan çocuk alerji ve klinik immünoloji uzmanından randevu almanız uygun olur. Elinizdeki eski sonuçlar ve şikayet öyküsü orada da işe yarayacaktır. Kendi şikayetleriniz için değerlendirme isterseniz <a href="/iletisim/">iletişim</a> sayfasından bize ulaşabilirsiniz.</p></div>
        </details>

        <p>Alerji testleri doğru soruyla istendiğinde yıllardır süren bir belirsizliği tek seansta kapatabilir. Ancak hangi testin gerçekten gerektiğine ve sonucun sizin hayatınızda ne anlama geldiğine yalnızca sizi dinleyen ve muayene eden hekim karar verir. Şikayetinizi birlikte değerlendirmek için <a href="/randevu/">randevu talebinizi</a> iletebilir ya da <a href="/iletisim/">iletişim</a> sayfasından bize ulaşabilirsiniz.</p>

        <div class="doctor-note" style="margin:2.5rem 0 0">
      <div class="dn-body">
        <p>“Muayenehaneme gelen hastaların önemli bir kısmı, elinde birkaç yıllık test sonuçlarıyla ve tek bir soruyla geliyor: <em>‘Peki ben şimdi ne yapacağım?’</em> O kâğıtlar bazen doğru, bazen eksik, bazen de hiç sorulmaması gereken sorulara verilmiş cevaplar oluyor.”</p>
        <p>“Benim işim, test istemeden önce sizi dinlemek. Şikayetiniz hangi ayda başlıyor, evinizde halı var mı, işte ne kullanıyorsunuz, hangi ilaçtan sonra ne oldu — bunlar bilinmeden istenen test, en iyi ihtimalle eksik bir cevap verir. Doğru soruyla istenen bir test ise çoğu zaman yıllardır süren bir belirsizliği tek seansta bitirir.”</p>
        <p>“Testten korkmanıza gerek yok. Ama testten sihir de beklemeyin. Asıl değerli olan, sonucun sizin hayatınızda ne anlama geldiğini birlikte konuşabilmek.”</p>
        <span class="dn-who">Uzm. Dr. Ramazan Ersoy · İç Hastalıkları, Alerji ve Klinik İmmünoloji</span>
      </div>
    </div>


        <p class="xs muted" style="margin-top:2rem;border-top:1px solid var(--line);padding-top:1rem">
          Yazan ve tıbbi açıdan gözden geçiren: <strong>Uzm. Dr. Ramazan Ersoy</strong> —
          İç Hastalıkları, Alerji ve Klinik İmmünoloji.<br>
          Son güncelleme: 16 Ağustos 2026. İçerik sorumlusu ile iletişim:
          <a href="tel:+902127099396">0212 709 93 96</a> ·
          <a href="/iletisim/">iletişim sayfası</a>.<br>
          Bu sayfa yalnızca bilgilendirme amaçlıdır ve hekim muayenesinin yerine geçmez.
          Tanı ve tedavi kararları kişiye özeldir. Acil durumlarda <a href="tel:112">112</a>'yi arayınız.
        </p>

      </article>
    </div>
  </div>
</section>

</main>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "@id": "https://drramazanersoy.tr/testler/#sss",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Alerji testi öncesi hangi ilaçları bırakmam gerekir?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Deri prick testi yaptıracaksanız antihistaminik grubu ilaçları yaklaşık 10 gün önce bırakmanız gerekir. Bazı mide ilaçları ve soğuk algınlığı kombinasyonları da antihistaminik etkilidir; bunlar sıkça gözden kaçar. Buna karşılık astım, tansiyon, kalp ve psikiyatri ilaçlarınızı kendi başınıza bırakmayın; bırakma kararını yalnızca hekiminiz verir. Randevu alırken kullandığınız tüm ilaçları, vitamin ve bitkisel takviyeler dahil bildirin. Spesifik IgE kan testi için hiçbir ilacı bırakmanız gerekmez; yama testi için ise antihistaminik kesmek çoğunlukla gerekmez."
      }
    },
    {
      "@type": "Question",
      "name": "Testlerin hepsini aynı gün yaptırabilir miyim?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Bir kısmını evet, hepsini hayır. Deri prick testi ile kan örneğini çoğu zaman aynı randevuda alabiliriz; solunum fonksiyon testi de aynı güne sığar. Buna karşılık yama testi üç ayrı ziyaret ister, provokasyon testleri ise başlı başına bir gün gerektirir. Ayrıca prick testi için ilaç kesmek gerekir, kan testi için gerekmez; bu da takvimi belirler. Sıralamayı ilk muayenede birlikte kurarız."
      }
    },
    {
      "@type": "Question",
      "name": "Test sonuçları ne zaman çıkar?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Deri prick testinin sonucunu yaklaşık 15 dakikada okur, aynı muayenede konuşuruz. Kliniğe bir kez gelmeniz yeterlidir. Yama testi ise 48. ve 72. saatte iki ayrı okuma ister, bu nedenle süreç üç-dört güne yayılır. Spesifik IgE ve moleküler testler laboratuvara göre genellikle birkaç iş günü sürer. Solunum fonksiyon testi sonucu anında verir."
      }
    },
    {
      "@type": "Question",
      "name": "İki merkez farklı sonuç verdi, hangisine güveneyim?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Önce iki testin aynı yöntem olup olmadığına bakarız; deri testi ile kan testi zaten aynı ölçüyü vermez ve farklı çıkmaları çelişki sayılmaz. Sonra tarihe bakarız, çünkü duyarlanma zamanla değişir. Deri testinde o gün kullanılan ilaçlar ve kontrol damlalarının davranışı da sonucu değiştirir. Bu yüzden eski raporlarınızı tarihleriyle birlikte getirin. Hangi sonucun sizin tablonuzu açıkladığını, şikayetlerinizin hikâyesine bakarak birlikte kararlaştırırız."
      }
    },
    {
      "@type": "Question",
      "name": "Kan testi mi deri testi mi daha doğru sonuç verir?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "İkisi birbirinin rakibi değildir; aynı olayı iki ayrı yerden ölçerler. Deri testi daha hızlıdır ve sonucu aynı gün konuşursunuz. Kan testi ise ilaç bırakılamadığında, yaygın egzama veya dermografizm gibi cilt sorunları olduğunda, gebelikte ve reaksiyon riski yüksek olduğunda öne çıkar. Bazen iki sonuç birbirinden farklı çıkar; bu bir çelişki değil, ek bilgidir. Hangisinin sizin tablonuzu daha iyi açıkladığını muayenede birlikte değerlendiririz."
      }
    },
    {
      "@type": "Question",
      "name": "Eczaneden veya internetten alınan ev tipi alerji test kitleri güvenilir mi?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Bu kitlerin bir kısmı kanda toplam ya da spesifik IgE'ye bakar; ancak örnek alma tekniği, ölçüm kalitesi ve bakılan alerjen listesi üründen ürüne büyük fark gösterir. Daha önemlisi, sonuç tek başına anlam taşımaz: pozitiflik hastalık kanıtı değildir, negatiflik de şikayetinizi açıklamaz. Elinizde böyle bir sonuç varsa getirin, birlikte değerlendiririz; ancak tanı için öykü, muayene ve standart yöntemlerle planlanan testleri bir arada yürütmek daha güvenli bir yoldur."
      }
    },
    {
      "@type": "Question",
      "name": "Tek seferde bütün alerjenlere baktırsam olmaz mı?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Bu istek çok anlaşılır, ancak pratikte işe yaramaz. Hikâyenizde karşılığı olmayan alerjenlere bakmak, klinik anlamı olmayan pozitiflikler üretir. Bu pozitiflikler sonra gereksiz kaçınmalara ve gereksiz diyet kısıtlamalarına yol açar. Bu yüzden paneli şikayetinize, mevsiminize ve yaşam ortamınıza göre daraltırız. Hangi alerjenlerin sizin için anlamlı olduğunu, şikayetlerinizin hangi aylarda arttığına bakarak da netleştiririz; polen takvimi bu konuda iyi bir başlangıçtır."
      }
    },
    {
      "@type": "Question",
      "name": "Besin intoleransı (IgG) testi bir alerji testi midir?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Hayır. Besinlere karşı IgG ya da IgG4 antikorlarının bulunması, o besinle sık karşılaşıldığını gösteren olağan bir bağışıklık yanıtıdır; alerji ya da intolerans kanıtı değildir. Uluslararası alerji ve immünoloji dernekleri bu testlerin tanı amacıyla kullanılmasını önermez. Bu panellere dayanarak yapılan geniş diyet kısıtlamaları gereksizdir ve beslenmeyi bozabilir. Besinle ilişkili bir şikayetiniz varsa doğru yol öykü, spesifik IgE ve gerektiğinde provokasyon testidir."
      }
    },
    {
      "@type": "Question",
      "name": "Deri testi için belirli bir mevsimi beklemem gerekir mi?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Hayır, deri prick testi yılın her döneminde yapılabilir; polen duyarlılığı mevsim dışında da deriden okunur. Yine de zamanlamayı birlikte planlarız: şikayetlerin tepe yaptığı dönemde antihistaminiğe ara vermek zor olabilir, ciltte yaygın döküntünün olduğu bir dönem de okumanın güvenilirliğini düşürür. Böyle bir dönemdeyseniz testi birkaç hafta kaydırabilir ya da kan testiyle başlayabiliriz."
      }
    },
    {
      "@type": "Question",
      "name": "Test sırasında ciddi bir reaksiyon gelişir mi?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Deri prick testinde ciddi reaksiyon çok nadirdir. Yine de testi daima gerekli müdahale koşullarının bulunduğu bir ortamda ve gözlem altında yaparız. Test sonrası kısa süre klinikte beklemenizi isteyebiliriz. Provokasyon testleri doğası gereği reaksiyon ihtimali en yüksek olanlardır; bu nedenle asla ayaküstü değil, planlı ve kontrollü koşullarda uygularız. Daha önce ağır bir reaksiyon geçirdiyseniz bunu mutlaka önceden bildirin; belirtileri anafilaksi sayfasında anlattık."
      }
    },
    {
      "@type": "Question",
      "name": "Alerji şikayetim için önce hangi uzmana başvurmalıyım?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Burun, göz, cilt ve nefes şikayetleri farklı uzmanlıkların kesişiminde durur; kararsızlık bu yüzden çok doğaldır. Şikayetiniz mevsimsel tekrarlıyor, belirli bir temasla tetikleniyor ya da birden fazla organı birden ilgilendiriyorsa erişkin alerji ve klinik immünoloji değerlendirmesi uygun bir başlangıç noktasıdır. Gerektiğinde kulak burun boğaz, göğüs hastalıkları ve dermatoloji ile iş birliği yaparız; alerji testlerinin seçimi ve yorumu ise alerji uzmanlığının alanıdır."
      }
    },
    {
      "@type": "Question",
      "name": "Başka bir merkezde yaptırdığım test sonuçları işe yarar mı?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Kesinlikle yarar, mutlaka getirin. Eski sonuçlar hem gereksiz tekrarı önler hem de zaman içindeki değişimi gösterir. Sonuç kâğıtlarının aslını ya da net bir fotoğrafını, tarihleriyle birlikte yanınızda bulundurun. Kullandığınız ilaçların kutularını da ekleyin; hangi ilacın testi etkilediğini birlikte görürüz. Ne getirmeniz gerektiğini randevunuza hazırlanın sayfasında maddeler halinde yazdık."
      }
    },
    {
      "@type": "Question",
      "name": "Çocuğuma da alerji testi yaptırabilir miyim?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Muayenehanemiz yetişkin alerji alanında hizmet vermektedir. 18 yaş altında test seçimi, uygulama ve sonuçların yorumu ayrı bir uzmanlık gerektirir; bu nedenle çocuğunuz için doğrudan çocuk alerji ve klinik immünoloji uzmanından randevu almanız uygun olur. Elinizdeki eski sonuçlar ve şikayet öyküsü orada da işe yarayacaktır. Kendi şikayetleriniz için değerlendirme isterseniz iletişim sayfasından bize ulaşabilirsiniz."
      }
    }
  ]
}
</script>
<?php get_footer(); ?>
