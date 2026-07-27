/* ============================================================
   AlerjiAsistan — Uzm. Dr. Ramazan Ersoy sitesi sohbet widget'ı v1
   ------------------------------------------------------------
   MİMARİ (bakirkoy-tip-v2/chatbot.js'ten uyarlandı):
   1. DETERMİNİSTİK KAPILAR istemcide, LLM'e HİÇ GİTMEDEN çalışır.
      Acil (anafilaksi) kapısı her girdide İLK sırada; tetiklenirse
      sohbet kilitlenir. Sunucudaki sistem talimatı ikinci kat korumadır.
   2. AI köprüsü OPSİYONELDİR. chat-api.php yoksa (statik önizleme,
      PHP'siz sunucu) veya 503/502/429 dönerse widget kural motoruyla
      çalışmaya devam eder — asla boş ekran ya da çökme olmaz.
   3. GEÇMİŞ YALNIZ BELLEKTE. sessionStorage/localStorage KULLANILMAZ:
      sohbet içeriği özel nitelikli sağlık verisi sayılabilir (KVKK).
   4. GÖRSEL GÖNDERİLMEZ. Sunucu tıbbi fotoğraf/tahlil yorumunu
      reddediyor; bu yüzden istemcide fotoğraf düğmesi hiç yok.
   5. Tasarım dili "Sessiz Lüks": EMOJİ YASAK — yalnız çizgi SVG.
   6. ES5 uyumlu (var/function; ok fonksiyonu ve template literal YOK).
   ============================================================ */
(function () {
  'use strict';

  /* ============ 1) SABİTLER ============ */
  var TEL_GORUNEN = '0212 709 93 96';
  var TEL_HREF = 'tel:+902127099396';
  var WA_NO = '905355062688';
  var ADRES = 'Harbiye Mah. Teşvikiye Cad. 37/3, Şişli / İstanbul';
  var CSS_SURUM = '1';
  var GECMIS_SINIR = 14; /* sunucu en fazla 16 mesaj kabul ediyor — pay bırakıldı */
  var GIRDI_SINIR = 500; /* sunucu her içeriği 500 karaktere kırpıyor */

  /* ============ 2) YOL ÇÖZÜMLEMESİ ============
     Sayfalar iki derinlikte: kökte (index.html) ve alt klasörde
     (hastaliklar/astim.html). basePath location.pathname'den HESAPLANIR;
     document.currentScript'e güvenilmez (defer/bundle ile kaybolabilir). */
  var ALT_KLASORLER = ['hastaliklar', 'testler', 'tedaviler', 'araclar',
    'hasta-merkezi', 'alerji-rehberi', 'fiyatlar', 'en'];

  function kokYolu() {
    var parcalar = location.pathname.split('/');
    /* son parça dosya adı (ya da dizin sonu boşluğu); bir öncesi klasör */
    var klasor = parcalar[parcalar.length - 2] || '';
    for (var i = 0; i < ALT_KLASORLER.length; i++) {
      if (klasor === ALT_KLASORLER[i]) return '../';
    }
    return '';
  }
  var KOK = kokYolu();
  var AI_URL = KOK + 'chat-api.php';

  /* ============ 3) YARDIMCILAR ============ */
  /* TR küçültme + diakritik katlama.
     Referans dosya yalnız ı→i katlıyordu; kullanıcılar sıklıkla Türkçe
     karakter kullanmadan yazdığı için ("bogazim sisti", "nefes darligi")
     acil kapısının kaçırmaması adına TÜM diakritikler katlanır.
     'I'.toLocaleLowerCase('tr-TR') = 'ı' → 'i'; 'İ' → 'i'. Böylece
     "ACIL", "Acil", "acıl" ve "acil" aynı dizgeye iner. */
  var KATLA = { 'ı': 'i', 'ğ': 'g', 'ş': 's', 'ç': 'c', 'ö': 'o', 'ü': 'u', 'â': 'a', 'î': 'i', 'û': 'u' };
  function norm(s) {
    return String(s == null ? '' : s)
      .toLocaleLowerCase('tr-TR')
      .replace(/[ığşçöüâîû]/g, function (h) { return KATLA[h] || h; })
      /* Kıvrık kesme/tırnak işaretleri DÜZ karşılığına iner. iOS ve Android
         klavyelerinde kıvrık apostrof VARSAYILANDIR: "can’t breathe" (U+2019)
         listedeki "can't breathe" ile eşleşmiyordu ve acil kapısı sessizce
         ölüyordu. Türkçe tarafta da "boğazım kapanıyor’" gibi girdileri düzler. */
      .replace(/[‘’ʼ´`]/g, "'")
      .replace(/[“”]/g, '"')
      .replace(/\s+/g, ' ');
  }
  function tokenla(s) {
    return norm(s).split(/[^a-z0-9]+/).filter(Boolean);
  }
  /* Tek kelimelik KISA anahtarlar token başlangıcıyla eşleşir ("doz" →
     "dozu" evet, "kordoz" hayır); uzun kelimeler ve çok kelimeli kalıplar
     alt dizgiyle eşleşir (ek/çekim farklarını yakalamak için). */
  function eslesir(t, tokens, anahtar) {
    var k = norm(anahtar);
    if (k.indexOf(' ') === -1 && k.length <= 6) {
      for (var i = 0; i < tokens.length; i++) {
        if (tokens[i].indexOf(k) === 0) return true;
      }
      return false;
    }
    return t.indexOf(k) !== -1;
  }
  function herhangi(t, tokens, liste) {
    for (var i = 0; i < liste.length; i++) {
      if (eslesir(t, tokens, liste[i])) return true;
    }
    return false;
  }
  function kacir(s) {
    return String(s == null ? '' : s)
      .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
  }
  /* Çalışma: Pzt-Cum 09:00-18:00 · Cmt 09:00-14:00 · Pazar kapalı */
  function mesaiIcinde() {
    var d = new Date(), g = d.getDay(), s = d.getHours() + d.getMinutes() / 60;
    if (g === 0) return false;
    if (g === 6) return s >= 9 && s < 14;
    return s >= 9 && s < 18;
  }
  function el(etiket, sinif) {
    var e = document.createElement(etiket);
    if (sinif) e.className = sinif;
    return e;
  }

  /* ============ 4) DİL ============
     Sayfanın <html lang> değeri "en" ise İngilizce modda başlanır. */
  var kokLang = (document.documentElement.getAttribute('lang') || 'tr').toLowerCase();
  var dil = kokLang.indexOf('en') === 0 ? 'en' : 'tr';
  function TR() { return dil === 'tr'; }

  /* ============ 5) METİN SÖZLÜĞÜ ============ */
  var M = {
    tr: {
      fabEtiket: 'AlerjiAsistan sohbetini aç',
      panelEtiket: 'AlerjiAsistan sohbet penceresi',
      bot: 'AlerjiAsistan',
      altBilgi: 'Yapay zeka asistanı',
      kapat: 'Sohbeti kapat',
      gonder: 'Gönder',
      yer: 'Sorunuzu yazın',
      kilitliYer: 'Acil yönlendirme etkin',
      mikroNot: 'Bilgilendirme amaçlıdır, muayene yerine geçmez.',
      /* (a) birinci seviye bildirim — açılıştaki ilk balon */
      karsilama: 'Ben AlerjiAsistan — Dr. Ersoy’un sitesinin yapay zeka asistanıyım. Tanı koyamam, tıbbi tavsiye veremem. Acil durumda 112’yi arayın.',
      nudge: 'Merhaba, ben AlerjiAsistan. Randevu, testler ve alerji aşısı sorularınız için buradayım.',
      nudgeKapat: 'Karşılama balonunu kapat',
      araBtn: TEL_GORUNEN + '’yı ara',
      randevuBtn: 'Randevu talebi oluştur',
      anaMenuBtn: 'Ana menüye dön',
      serbestAcik: 'Sorunuzu yazabilirsiniz. Tanı, ilaç dozu ve ücret bilgisi veremediğimi hatırlatayım.',
      serbestKapali: 'Serbest soru şu an yanıtlanamıyor. Aşağıdaki başlıklardan seçebilir ya da WhatsApp’tan yazabilirsiniz.',
      aiLimit: 'Bu saat içindeki soru sınırına ulaşıldı. Aşağıdaki başlıklardan seçebilir ya da doğrudan arayabilirsiniz.',
      aiHata: 'Şu an yanıt üretemedim. Aşağıdaki başlıklardan seçebilir ya da WhatsApp’tan yazabilirsiniz.',
      yaziyor: 'Asistan yazıyor',
      waUyari: 'WhatsApp yurt dışı sunucularda çalışır; lütfen tahlil sonucu, fotoğraf veya ayrıntılı tıbbi öykü paylaşmayın.',
      waBtn: 'WhatsApp’tan yaz',
      formBtn: 'Randevu formunu aç',
      mesaiIci: 'Şu an çalışma saatleri içindeyiz; talebinize aynı gün dönülür.',
      mesaiDisi: 'Şu an mesai saatleri dışındayız; talebinize ertesi iş günü dönülür.'
    },
    en: {
      fabEtiket: 'Open the AlerjiAsistan chat',
      panelEtiket: 'AlerjiAsistan chat window',
      bot: 'AlerjiAsistan',
      altBilgi: 'AI assistant',
      kapat: 'Close the chat',
      gonder: 'Send',
      yer: 'Type your question',
      kilitliYer: 'Emergency guidance active',
      mikroNot: 'For information only; not a substitute for a medical examination.',
      karsilama: 'I am AlerjiAsistan, the AI assistant of Dr. Ersoy’s website. I cannot diagnose or give medical advice. In an emergency, call 112.',
      nudge: 'Hello, I am AlerjiAsistan. Ask me about appointments, tests and allergy immunotherapy.',
      nudgeKapat: 'Dismiss the greeting',
      araBtn: 'Call ' + TEL_GORUNEN,
      randevuBtn: 'Request an appointment',
      anaMenuBtn: 'Back to main menu',
      serbestAcik: 'Go ahead and type your question. A reminder: I cannot diagnose, give drug doses or share fees.',
      serbestKapali: 'Free-text questions cannot be answered right now. Please pick a topic below or message us on WhatsApp.',
      aiLimit: 'The hourly question limit has been reached. Please pick a topic below or call us directly.',
      aiHata: 'I could not produce an answer just now. Please pick a topic below or message us on WhatsApp.',
      yaziyor: 'Assistant is typing',
      waUyari: 'WhatsApp runs on servers abroad; please do not share test results, photos or detailed medical history.',
      waBtn: 'Message on WhatsApp',
      formBtn: 'Open the appointment form',
      mesaiIci: 'We are within working hours; your request will be answered the same day.',
      mesaiDisi: 'We are outside working hours; your request will be answered on the next business day.'
    }
  };
  function T(anahtar) { return M[dil][anahtar]; }
  function mesaiNotu() { return mesaiIcinde() ? T('mesaiIci') : T('mesaiDisi'); }

  /* ============ 6) SAYFA ADLARI ============
     Yanıt metninde geçen [yol.html] işaretleri butona çevrilir.
     Bu haritada OLMAYAN yol için buton ÜRETİLMEZ (sessizce atılır) —
     böylece model uydurma bir yol yazsa bile kırık link doğmaz. */
  var SAYFA_AD = {
    'randevu.html': 'Randevu talebi',
    'iletisim.html': 'İletişim ve ulaşım',
    'dr-ramazan-ersoy.html': 'Dr. Ramazan Ersoy',
    'yayinlar-ve-oduller.html': 'Yayınlar ve ödüller',
    'basinda.html': 'Basında',
    'kvkk-aydinlatma.html': 'KVKK aydınlatma metni',
    'testler/index.html': 'Hangi test bana uygun?',
    'testler/deri-prick-testi.html': 'Deri prick testi',
    'testler/yama-testi.html': 'Yama testi',
    'testler/spesifik-ige-kan-testi.html': 'Spesifik IgE kan testi',
    'testler/solunum-fonksiyon-testi.html': 'Solunum fonksiyon testi',
    'testler/provokasyon-testleri.html': 'Provokasyon testleri',
    'hastaliklar/alerjik-rinit.html': 'Alerjik rinit',
    'hastaliklar/astim.html': 'Astım',
    'hastaliklar/urtiker.html': 'Ürtiker (kurdeşen)',
    'hastaliklar/besin-alerjisi.html': 'Besin alerjisi',
    'hastaliklar/ilac-alerjisi.html': 'İlaç alerjisi',
    'hastaliklar/ari-alerjisi.html': 'Arı alerjisi',
    'hastaliklar/anafilaksi.html': 'Anafilaksi rehberi',
    'hastaliklar/herediter-anjiyoodem.html': 'Herediter anjiyoödem',
    'hastaliklar/mastositoz.html': 'Mastositoz',
    'tedaviler/alerji-asisi-immunoterapi.html': 'Alerji aşısı (immünoterapi)',
    'tedaviler/alerji-asisi-sss.html': 'Alerji aşısı — sık sorulanlar',
    'araclar/polen-takvimi.html': 'Polen takvimi',
    'araclar/astim-kontrol-testi.html': 'Astım kontrol testi',
    'araclar/alerji-mi-soguk-alginligi-mi.html': 'Alerji mi, soğuk algınlığı mı?',
    'araclar/video-kutuphanesi.html': 'Video kütüphanesi',
    'alerji-rehberi/index.html': 'Alerji rehberi',
    'alerji-rehberi/ev-tozu-akari-yatak-odasi.html': 'Ev tozu akarı: yatak odası',
    'alerji-rehberi/evcil-hayvan-alerjisi.html': 'Evcil hayvan alerjisi',
    'alerji-rehberi/gebelikte-alerji-ve-astim.html': 'Gebelikte alerji ve astım',
    'alerji-rehberi/klima-ve-ic-ortam-alerjenleri.html': 'Klima ve iç ortam alerjenleri',
    'alerji-rehberi/yetiskinlikte-baslayan-astim.html': 'Yetişkinlikte başlayan astım',
    'hasta-merkezi/randevunuza-hazirlanin.html': 'Randevunuza hazırlanın',
    'hasta-merkezi/online-on-degerlendirme.html': 'Online ön değerlendirme',
    'hasta-merkezi/ikinci-gorus.html': 'İkinci görüş',
    'fiyatlar/alerji-testi-fiyatlari-2026.html': 'Alerji testi ücret bilgisi',
    'en/international-patients.html': 'International patients'
  };

  /* ============ 7) ANAHTAR KELİME LİSTELERİ ============ */

  /* --- ACİL (anafilaksi) — EN KRİTİK LİSTE ---
     Girdiler doğal Türkçe yazılır; norm() her ikisini de aynı katlanmış
     dizgeye indirdiği için "bogazim sisti" de "Boğazım Şişti" de yakalanır.
     Bilinçli olarak GENİŞ tutuldu: yanlış pozitifin bedeli (sohbetin
     kilitlenmesi) yanlış negatifin bedelinden (dakika kaybı) küçüktür. */
  var ACIL_TR = [
    'nefes darligi', 'nefes alamiyor', 'nefes alamadim', 'nefes almakta zorlaniyorum',
    'nefesim daraliyor', 'nefesim daraldi', 'soluk alamiyor', 'soluğum daraldi',
    'hirilti', 'hisilti',
    'bogazim sisti', 'bogazim sisiyor', 'bogazimda sislik', 'bogazim kapaniyor',
    'dilim sisti', 'dilim sisiyor', 'dudagim sisti', 'dudagim sisiyor',
    'yuzum sisti', 'yuzum sisiyor',
    'ses kisikligi', 'sesim kisildi',
    'bayilacak gibi', 'bayildim',
    'basim donuyor ve sisiyor',
    'morarma', 'morardim', 'moraruyor',
    'anafilaksi', 'alerjik sok',
    'tansiyonum dustu',
    'otoenjektor yaptim', 'otoenjektor uyguladim', 'epipen yaptim', 'adrenalin yaptim',

    /* AĞIR ASTIM ATAĞI — bu sözlük tümüyle eksikti. Astım uzmanı sitesinde
       en olası acil tablo buydu ve deterministik kapı tamamen kördü.
       Kalıplar EN KISA gövdeyle yazılır: alt dizge eşleşmesi olduğu için
       'konusamiyor' hem "konuşamıyorum" hem "konuşamıyor"u yakalar;
       'konusamiyorum' yazılsaydı 3. şahıs anlatımı kaçardı. */
    'gogsum sikis', 'gogsumde sikis', 'gogsume baski', 'gogsum daral',
    'konusamiyor', 'cumle kuramiyor', 'cumleyi tamamlayamiyor',
    'astim atagi', 'astim krizi', 'atak geciriyor',
    'boguluyor', 'havasiz kaldim', 'nefesim kesil', 'nefesim tikan',
    'yutkunamiyor', 'bogazim kapandi', 'sesim gitti', 'sesim cikmiyor',
    'dudaklarim morardi', 'dudaklari morardi', 'dudagi morardi'
  ];

  /* --- KÖK-ÇİFTİ KALIPLARI (acil) ---
     Sözlükteki çok kelimeli kalıplar BİTİŞİK alt dizge arıyordu; bu yüzden
     kip/şahıs/araya-kelime değişince toptan ölüyorlardı:
       "boğazım kapandı"     → listede yalnız 'bogazim kapaniyor' (şimdiki z.)
       "dudakları morardı"   → 'morarma/morardim/moraruyor' hiçbiri tutmuyor
       "tansiyonum ÇOK düştü"→ 'tansiyonum dustu' bitişik değil
     Çözüm: bölge kökü + belirti kökü arasına 15 karaktere kadar araya girmeye
     izin veren regex. İyelik ekinden ve şahıstan bağımsız çalışır, böylece
     "oğlumun dudakları şişti" (3. şahıs) de yakalanır. */
  var ACIL_KALIP = [
    /\b(bogaz|dudak|dil|girtlak|girtlag)\w*.{0,15}?(sis|kapan|daral|tikan|morar)/,
    /\b(tansiyon|nefes|solunum)\w*.{0,15}?(dus|kesil|daral|alam|yetmi|tikan)/,
    /\b(ventolin|pompa|sprey|inhaler|nefes acici)\w*.{0,25}?(fayda etmedi|ise yaramiyor|ise yaramadi|etkisiz|yetmiyor|ise yaramadi)/
  ];
  function acilKalipVar(t) {
    for (var i = 0; i < ACIL_KALIP.length; i++) {
      if (ACIL_KALIP[i].test(t)) return true;
    }
    return false;
  }

  /* --- BİRLİKTE-GEÇME KURALLARI (acil) ---
     Bileşik kalıplar ("ari soktu ve sisti") DOĞAL cümlede kaçıyordu:
     "arı soktu ve HER YERİM şişti" araya kelime girdiği için eşleşmiyor,
     oysa bu klasik anafilaksi tablosu. Bu yüzden kalıp yerine iki sinyal
     GRUBUNUN aynı cümlede birlikte geçmesine bakılıyor.
     Not: tek başına "elim şişti" (yerel reaksiyon) acil DEĞİLDİR —
     bu yüzden şişlik ancak YAYGINLIK ya da TETİKLEYİCİ ile birleşince sayılır. */
  var YAYGINLIK = ['her yerim', 'her tarafim', 'her yer', 'tum vucud', 'butun vucud',
    'vucudumun her', 'vucudum', 'yaygin', 'bastan asagi'];
  var REAKSIYON = ['sisti', 'sisiyor', 'sislik', 'kizardi', 'kizariyor', 'kizariklik',
    'kurdesen', 'dokuntu', 'kabardi', 'kasiniyor', 'kasindi', 'kasinti',
    'karincalan', 'uyusma', 'kabariyor'];
  /* Tetikleyicide BİTİŞİK kalıp yerine basit geçmiş zaman KÖKleri kullanılır:
     'yedim ve' kalıbı "fıstık yedim, boğazım kaşınıyor" cümlesinde araya
     virgül girdiği için ölüyordu — ders kitabı erken anafilaksi tablosu. */
  var TETIKLEYICI = ['ari sok', 'ari beni', 'bocek sok', 'esek arisi', 'yaban arisi',
    'igneden sonra', 'asidan sonra', 'ilaci aldiktan sonra', 'ilac aldiktan sonra',
    'yedikten sonra', 'ictikten sonra',
    /* 'yedi' ve 'icti' BİLEREK yok: token-önek eşleşmesinde SAYI olan "yedi"
       ile çakışıyorlar ("yedi gündür halsizim" → yanlış acil). 3. şahıs
       anlatımı ACIL_KALIP regexleri ve çocuk ön-kontrolüyle karşılanıyor. */
    'yedim', 'ictim', 'soktu', 'isirdi',
    'asi oldum', 'igne oldum', 'ilaci aldim', 'ilac aldim'];
  /* SİSTEMİK sinyaller GÜÇ'e göre ikiye ayrılır. Eski tek liste iki ayrı
     soruna yol açıyordu:
     · "aşıdan sonra halsizlik oluyor, normal mi?" (immünoterapi hastasının
       EN SIK sorusu) tetikleyici+sistemik kuralına düşüp acil kartı açıyor
       ve sohbeti kalıcı kilitliyordu — ciddi bir yanlış pozitif.
     · Buna karşılık "kustum, çarpıntım var, halsizim" gibi tetikleyicisi
       YAZILMAMIŞ çok-sistemli tablo hiçbir kurala girmiyordu — hasta çoğu
       zaman tetikleyiciyi bilmez (idiyopatik, bifazik, gıda-egzersiz). */
  var SISTEMIK_GUCLU = ['carpinti', 'kalbim hizli', 'bayil', 'morar', 'tansiyon',
    'nefes', 'bogaz', 'dil sis', 'goz kararma', 'bilincim', 'sesim kisil',
    'yutkunamiyor', 'boguluyor'];
  var SISTEMIK_ZAYIF = ['kusma', 'kustum', 'kusuyorum', 'ishal', 'karin agri',
    'mide bulan', 'halsiz', 'terleme'];

  /* BİLGİ SORUSU çerçevesi: "normal mi / olağan mı / her seferinde" gibi
     ifadeler akut bir olayı değil GENEL bir merakı anlatır. Yalnızca ZAYIF
     yolu iptal eder — güçlü sinyaller (nefes, morarma, tansiyon) ya da
     yaygın reaksiyon varsa bu çerçeveye BAKILMAZ, çünkü "arı soktu, her
     yerim şişti, bu normal mi?" gerçek bir acildir. */
  var BILGI_CERCEVE = ['normal mi', 'olagan mi', 'sik mi', 'her seferinde',
    'genelde', 'genellikle', 'olur mu', 'oluyor mu', 'beklenir mi', 'dogal mi'];

  /* Sinyal gruplarının kesişimi varsa acil kabul edilir. */
  function acilBirlikte(t, tokens) {
    var yayginVar    = herhangi(t, tokens, YAYGINLIK);
    var reaksiyonVar = herhangi(t, tokens, REAKSIYON);
    var tetikVar     = herhangi(t, tokens, TETIKLEYICI);
    var gucluVar     = herhangi(t, tokens, SISTEMIK_GUCLU);
    var zayifVar     = herhangi(t, tokens, SISTEMIK_ZAYIF);
    var bilgiSorusu  = herhangi(t, tokens, BILGI_CERCEVE);

    /* 1) yaygın + reaksiyon → "her yerim şişti", "tüm vücudum kızardı" */
    if (yayginVar && reaksiyonVar) return true;
    /* 2) tetikleyici + GÜÇLÜ sistemik → "arı soktu, nefesim daralıyor" */
    if (tetikVar && gucluVar) return true;
    /* 3) tetikleyici + reaksiyon → "fıstık yedim, dudaklarım şişti" */
    if (tetikVar && reaksiyonVar) return true;
    /* 4) ÇOK SİSTEMLİ tablo: klinik anafilaksi ölçütü iki organ sistemi
          tutulumudur; tetikleyici yazılmamış olsa bile acildir. */
    if (gucluVar && (zayifVar || reaksiyonVar)) return true;
    /* 5) tetikleyici + ZAYIF sistemik → "arı soktu, kusuyorum".
          Bilgi sorusu çerçevesi varsa akut sayılmaz. */
    if (tetikVar && zayifVar && !bilgiSorusu) return true;
    return false;
  }
  /* İngilizce liste de kalıp-bağımlıydı: "lip swelling" vardı ama hastanın
     doğal yazımı "my lips are swollen"dır. Kısa gövdelerle genişletildi.
     (Kıvrık apostrof sorunu norm() içinde çözüldü.) */
  var ACIL_EN = [
    'anaphylaxis', 'anaphylactic', 'cannot breathe', "can't breathe", 'cant breathe',
    'trouble breathing', 'difficulty breathing', 'hard to breathe', 'short of breath',
    'throat swelling', 'throat is closing', 'throat closing', 'throat closed',
    'tongue swelling', 'tongue is swollen', 'lip swelling', 'lips are swollen',
    'swollen lips', 'swollen tongue', 'swollen throat',
    'chest tightness', 'chest is tight', 'tight chest', 'cannot speak', 'cant speak',
    'wheezing', 'fainting', 'passing out', 'passed out', 'blue lips', 'turning blue',
    'hives all over', 'allergic shock', 'epipen', 'auto-injector', 'inhaler not working'
  ];

  /* --- FİYAT kapısı --- */
  /* 'tutar' çıkarıldı: 5 harfli olduğu için token-öneki modunda çalışıyor ve
     "sonuçlar TUTARLI mı, güvenilir mi?" sorusunu ücret sorusu sanıp
     güvenilirlik sorusuna "mevzuat gereği ücret paylaşılamıyor" döndürüyordu.
     Yerine ekle çekimli spesifik biçimler kondu. */
  var FIYAT_TR = ['fiyat', 'ucret', 'kac para', 'ne kadar', 'tutari', 'ne tutar', 'indirim',
    'kampanya', 'taksit', 'sgk oder mi', 'sgk karsiliyor', 'kaca'];
  var FIYAT_EN = ['price', 'pricing', 'cost', 'how much', 'fee', 'discount', 'installment'];
  /* "ne kadar sürer / ne kadar zaman" bir SÜRE sorusudur, ücret sorusu değil;
     "ücretsiz otopark" da fiyat kapısına düşmemeli. Bu kalıplar metinden
     SİLİNİR (bkz. kapilar) — böylece cümlenin geri kalanındaki gerçek ücret
     sorusu görünmeye devam eder. */
  var FIYAT_ISTISNA_SIL = /ne kadar sur\w*|ne kadar zaman|ne kadar bekle\w*|ne kadar once|ne kadar siklik\w*|ucretsiz|how long|free of charge/g;

  /* --- İLAÇ DOZU kapısı --- */
  /* "günde ne kadar almalıyım" kalıpları EKSİKTİ: 'ne kadar' fiyat listesinde
     olduğu için doz sorusu ÜCRET kapısına düşüyor ve hastaya doz uyarısı
     yerine "mevzuat gereği ücret paylaşılamıyor" dönüyordu. */
  var DOZ_TR = ['kac mg', 'doz', 'kac tablet', 'gunde kac', 'kac kez kullan',
    'ilacimi kesmeli miyim', 'ilaci kesmeli miyim', 'ilaci birakmali miyim',
    'hangi ilaci icsem', 'hangi ilaci kullansam', 'ilac onerir misin', 'ilac onerebilir misin',
    'hangi hapi', 'recete yazar misin', 'kac gun kullan',
    'gunde ne kadar', 'ne kadar almali', 'ne kadar icmeli', 'ne kadar kullanmali',
    'ne siklikla', 'kac kere al', 'kac kere icmeli', 'sabah mi aksam mi',
    'ac karnina mi', 'tok karnina mi'];
  var DOZ_EN = ['how many mg', 'dosage', 'dose', 'how many tablets', 'which medicine should i',
    'recommend a medicine', 'stop my medication', 'prescribe', 'how often should i take'];
  /* Serbest miligram/tablet yazımı da doz sorusudur: "10 mg mı 20 mg mı" */
  var DOZ_KALIP = /\b\d+\s*(mg|miligram|ml|tablet|hap|damla|puf)\b/;

  /* --- ÇOCUK kapısı (yalnız yetişkin hasta kabul edilir) --- */
  var COCUK_TR = ['cocugum', 'kizim', 'oglum', 'bebek', 'bebegim', 'cocuk', 'evladim',
    'torunum', 'kizimin', 'oglumun'];
  var COCUK_EN = ['my child', 'my son', 'my daughter', 'my baby', 'infant', 'toddler',
    'my kid', 'paediatric', 'pediatric'];
  /* (COCUK_ISTISNA listesi ISTISNA_SIL regexine dönüştürüldü — liste hâli
     kapının tamamını veto ediyordu, regex hâli yalnız o parçayı siliyor.) */
  /* 1-17 arası bağımsız yaş sayısı da çocuk kapısını açar; "45 yasindayim"
     tetiklemez çünkü sayının solunda rakam vardır.
     'yas' çıplak hâli KELİME SONU şartına bağlandı: "5 yaşımdan beri astımım
     var" cümlesinde eski regex "5 yas" parçasını "yasimdan" içinde yakalayıp
     YETİŞKİN hastayı çocuk uzmanına yolluyordu. 'yasin' 1. tekil iyelik
     ekiyle ("yasimda") eşleşmez, 3. şahıs ekiyle ("yasinda") eşleşir. */
  var YAS_18ALTI = /(^|[^0-9])([1-9]|1[0-7])\s*(yasin|yas\b|year)/;
  /* Yetişkin anlatısı kalıplarını METİNDEN SİLİP öyle bakarız; eski kod
     istisna görünce kapının TAMAMINI iptal ediyordu, oysa "çocukluğumdan
     beri alerjim var; 7 yaşındaki oğlumda da başladı" cümlesinde hem
     yetişkin geçmişi hem GERÇEK bir çocuk sorusu birlikte var. */
  var ISTISNA_SIL = /cocuklug\w*|cocukken|cocuklukta|bebeklig\w*|bebekken|kucukken|ufakken|in my childhood|as a child|childhood/g;

  /* --- TEŞHİS / SONUÇ YORUMU kapısı --- */
  var TESHIS_TR = ['bende ne var', 'bende hangi', 'hangi hastalik', 'teshis', 'tani koy',
    'tani koyar', 'sonucumu yorumla', 'sonuclarimi yorumla', 'tahlilim', 'tahlilimi',
    'kan degerim', 'ige degerim', 'sonucum ne anlama', 'raporumu yorumla', 'ne hastaligi'];
  var TESHIS_EN = ['what do i have', 'which disease', 'diagnose', 'diagnosis',
    'interpret my result', 'read my results', 'my blood value', 'my ige'];

  /* --- Serbest metinden hızlı menü akışlarına niyet eşleme ---
     (AI olmasa da bot işe yarar kalsın diye; ACİL ve kapılardan SONRA çalışır) */
  var NIYETLER = [
    { k: ['randevu', 'muayene olmak', 'saat almak', 'gorusmek istiyorum', 'appointment', 'book'], ad: 'randevu' },
    { k: ['hangi test', 'test yaptirmak', 'prick', 'deri testi', 'kan testi', 'yama testi',
      'solunum testi', 'which test', 'skin test'], ad: 'test' },
    { k: ['testten once', 'test oncesi', 'hazirlan', 'antihistamin', 'ilac kesme',
      'before the test', 'preparation'], ad: 'hazirlik' },
    { k: ['alerji asisi', 'immunoterapi', 'asi tedavi', 'immunotherapy', 'allergy shot'], ad: 'asi' },
    { k: ['polen', 'polen takvimi', 'agac poleni', 'cim poleni', 'pollen'], ad: 'polen' },
    { k: ['adres', 'nerede', 'nasil gelinir', 'ulasim', 'calisma saat', 'kacta', 'acik mi',
      'metro', 'otopark', 'address', 'opening hours', 'where'], ad: 'adres' }
  ];

  /* ============ 8) DURUM ============ */
  var kilit = false;          /* acil kapısı tetiklendiyse sohbet kilitlenir */
  var serbestMod = false;     /* "Başka bir sorum var" seçildiyse true */
  var gecmis = [];            /* YALNIZ BELLEKTE — {rol:'user'|'bot', icerik} */
  var aiDurum = 'bilinmiyor'; /* 'bilinmiyor' | 'var' | 'yok' */
  var acildiMi = false;

  /* ============ 9) STİL VE İSKELET ============
     Sınıf adları assets/css/chatbot.css sözleşmesidir (cb-* öneki):
     .cb-balon .cb-karsilama .cb-pencere .cb-baslik .cb-rozet .cb-kapat
     .cb-govde .cb-msg(--bot|--kul) .cb-secenekler .cb-sec .cb-linkler
     .cb-link(--dis) .cb-acil .cb-uyari .cb-yaziyor .cb-yaz .cb-gonder
     .cb-alt-not · body.cb-kilit
     .cb-secenekler / .cb-linkler / .cb-uyari / .cb-acil GÖVDENİN doğrudan
     çocuklarıdır (align-self:stretch) — balon içine gömülmez. */
  var stil = document.createElement('link');
  stil.rel = 'stylesheet';
  stil.href = KOK + 'assets/css/chatbot.css?v=' + CSS_SURUM;
  document.head.appendChild(stil);

  /* çizgi SVG ikonlar — emoji YASAK */
  var IKON = {
    sohbet: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12a8 8 0 0 1-8 8H8l-5 3 1.4-4.2A8 8 0 0 1 13 4a8 8 0 0 1 8 8z"/><path d="M9 11h8M9 15h5"/></svg>',
    kapat: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg>',
    gonder: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12h15M13 6l6 6-6 6"/></svg>',
    ok: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 6l6 6-6 6"/></svg>',
    tel: '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.6 10.8a15 15 0 006.6 6.6l2.2-2.2a1 1 0 011-.25 11.4 11.4 0 003.6.57 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1 11.4 11.4 0 00.57 3.6 1 1 0 01-.25 1z"/></svg>',
    wa: '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 00-8.6 15L2 22l5.2-1.4A10 10 0 1012 2zm5.3 14.1c-.2.6-1.2 1.2-1.7 1.2-.5.1-1 .1-1.6-.1-.4-.1-.9-.3-1.5-.6a11 11 0 01-4.2-3.7c-.3-.4-.8-1.2-.8-2.3s.6-1.6.8-1.9c.2-.2.4-.3.6-.3h.5c.1 0 .3 0 .5.4l.7 1.6c.1.1.1.3 0 .5l-.3.4-.3.3c-.1.1-.2.2 0 .5.2.3.7 1.1 1.4 1.7.9.8 1.6 1 1.9 1.2.2.1.4.1.5-.1l.7-.8c.2-.2.3-.2.5-.1l1.5.7c.2.1.4.2.4.3.1.1.1.5-.1 1z"/></svg>'
  };

  var balon = el('button', 'cb-balon');
  balon.type = 'button';
  balon.setAttribute('aria-label', T('fabEtiket'));
  balon.setAttribute('aria-expanded', 'false');
  balon.innerHTML = IKON.sohbet + '<span class="cb-balon-et">' + kacir(T('bot')) + '</span>';

  var pencere = el('div', 'cb-pencere');
  pencere.setAttribute('role', 'dialog');
  pencere.setAttribute('aria-label', T('panelEtiket'));
  pencere.setAttribute('aria-hidden', 'true');
  pencere.innerHTML =
    '<div class="cb-baslik">' +
      IKON.sohbet +
      '<div class="cb-baslik-metin">' +
        '<strong>' + kacir(T('bot')) + '</strong>' +
        '<span>' + kacir(T('altBilgi')) + '</span>' +
      '</div>' +
      /* (c) üçüncü seviye bildirim: "AI" rozeti — kullanıcı insanla
         konuşmadığını baştan bilsin. AI köprüsü kapalıysa data-durum
         "kapali" olur (renk düşer; kırmızı KULLANILMAZ). */
      '<span class="cb-rozet" id="cbRozet">AI</span>' +
      '<button type="button" class="cb-kapat" aria-label="' + kacir(T('kapat')) + '">' + IKON.kapat + '</button>' +
    '</div>' +
    '<div class="cb-govde" id="cbGovde" aria-live="polite" aria-atomic="false"></div>' +
    '<div class="cb-yaz">' +
      '<input id="cbGiris" type="text" autocomplete="off" maxlength="' + GIRDI_SINIR + '"' +
        ' aria-label="' + kacir(T('yer')) + '" placeholder="' + kacir(T('yer')) + '">' +
      '<button type="button" class="cb-gonder" aria-label="' + kacir(T('gonder')) + '">' + IKON.gonder + '</button>' +
    '</div>' +
    /* (b) ikinci seviye bildirim: pencerenin altında KALICI mikro-metin */
    '<p class="cb-alt-not">' + kacir(T('mikroNot')) + '</p>';

  document.body.appendChild(balon);
  document.body.appendChild(pencere);

  var govde = pencere.querySelector('#cbGovde');
  var giris = pencere.querySelector('#cbGiris');
  var gonderBtn = pencere.querySelector('.cb-gonder');
  var rozet = pencere.querySelector('#cbRozet');

  function kaydir() { govde.scrollTop = govde.scrollHeight; }
  function sil(e) { if (e && e.parentNode) e.parentNode.removeChild(e); }

  /* AI erişilemezse rozet sessizce "kapalı" görünümüne geçer */
  function rozetGuncelle() {
    if (aiDurum === 'yok') {
      rozet.setAttribute('data-durum', 'kapali');
      rozet.setAttribute('title', TR() ? 'Serbest soru şu an kapalı — kural motoru çalışıyor'
        : 'Free-text answering is off — rule engine active');
    } else {
      rozet.removeAttribute('data-durum');
      rozet.removeAttribute('title');
    }
  }

  /* ============ 10) GÖVDE ÖĞELERİ ============ */
  function botMsj(html) {
    var m = el('div', 'cb-msg cb-msg--bot');
    m.innerHTML = html;
    govde.appendChild(m);
    kaydir();
    return m;
  }
  function kulMsj(metin) {
    var m = el('div', 'cb-msg cb-msg--kul');
    m.appendChild(document.createTextNode(metin));
    govde.appendChild(m);
    kaydir();
  }
  /* Hedef mutlak/protokollü değilse KOK ile site köküne göre kurulur —
     hem kökteki hem alt klasördeki sayfalardan doğru çalışır. */
  function yol(hedef) {
    if (/^(https?:|tel:|mailto:|#)/i.test(hedef)) return hedef;
    return KOK + hedef;
  }
  /* liste: [{h:hedef, e:etiket, dis:bool, ikon:'ok'|'tel'|'wa', yeni:bool}] */
  function linkKutu(liste) {
    if (!liste.length) return null;
    var k = el('div', 'cb-linkler');
    for (var i = 0; i < liste.length; i++) {
      var o = liste[i];
      var a = el('a', 'cb-link' + (o.dis ? ' cb-link--dis' : ''));
      a.setAttribute('href', yol(o.h));
      if (o.yeni) { a.setAttribute('target', '_blank'); a.setAttribute('rel', 'noopener'); }
      a.innerHTML = '<span>' + kacir(o.e) + '</span>' + (IKON[o.ikon || 'ok'] || IKON.ok);
      k.appendChild(a);
    }
    govde.appendChild(k);
    kaydir();
    return k;
  }
  /* --amber uyarı kutusu (KVKK / WhatsApp / AI erişilemez) */
  function uyariKutu(html) {
    var u = el('div', 'cb-uyari');
    u.innerHTML = html;
    govde.appendChild(u);
    kaydir();
    return u;
  }
  /* Hazır link tanımları */
  function telLink() { return { h: TEL_HREF, e: T('araBtn'), dis: true, ikon: 'tel' }; }
  function waLink(mesaj) {
    return {
      h: 'https://wa.me/' + WA_NO + '?text=' + encodeURIComponent(mesaj),
      e: T('waBtn'), dis: true, ikon: 'wa', yeni: true
    };
  }
  function sayfaLink(sayfa, disMi) {
    return { h: sayfa, e: SAYFA_AD[sayfa] || sayfa, dis: !!disMi };
  }
  /* WhatsApp butonu ASLA tek başına gösterilmez; bu uyarı hep önünde durur */
  function waUyarisi() { uyariKutu('<strong>' + (TR() ? 'Not' : 'Note') + ':</strong> ' + kacir(T('waUyari'))); }

  /* Seçenek butonları — aynı anda yalnız bir set durur */
  function secenekKutu(secenekler) {
    sil(govde.querySelector('.cb-secenekler'));
    if (kilit) return;
    var k = el('div', 'cb-secenekler');
    k.setAttribute('role', 'group');
    for (var i = 0; i < secenekler.length; i++) {
      (function (s) {
        var b = el('button', 'cb-sec');
        b.type = 'button';
        b.textContent = s[0];
        b.addEventListener('click', function () {
          if (kilit) return;
          sil(k);
          kulMsj(s[0]);
          s[1]();
        });
        k.appendChild(b);
      })(secenekler[i]);
    }
    govde.appendChild(k);
    kaydir();
  }

  /* ============ 11) İŞARET → BUTON ============
     Yanıtta geçen [yol.html] işaretleri metinden ÇIKARILIR ve altta şık
     butonlara çevrilir. Bilinmeyen yol için buton ÜRETİLMEZ (model uydurma
     bir yol yazsa bile kırık link doğmaz); aynı yol iki kez geçerse tek
     buton kalır. */
  function isaretleriCoz(metin) {
    var gorulen = {}, liste = [];
    var kalan = String(metin).replace(/\[([a-z0-9\-\/]+\.html)\]/gi, function (tam, sayfa) {
      var s = sayfa.toLowerCase();
      if (SAYFA_AD[s] && !gorulen[s]) {
        gorulen[s] = true;
        liste.push(sayfaLink(s, liste.length > 0));
      }
      return '';
    });
    /* işaret çıkınca oluşan boşluk ve noktalama artıkları toparlanır */
    kalan = kalan.replace(/[ \t]+/g, ' ').replace(/ ([.,;:!?])/g, '$1')
      .replace(/\n{3,}/g, '\n\n').trim();
    return { metin: kalan, linkler: liste };
  }
  /* AI yanıtını ekrana basar: metin kaçırılır, işaretler butona döner */
  /* İÇERİK KÜNYESİ — 12.11.2025/33075 Tanıtım Yönetmeliği md.5/1-i:
     bilgilendirme içeriğinde son güncelleme tarihi ve sorumlusu bulunmalı.
     AI yanıtı anlık üretildiği için önceden onaylanmış bir metin değildir;
     bu yüzden yanıtın yapay zeka ürünü olduğu ve tıbbi içerik sorumlusunun
     kim olduğu HER AI yanıtının altında açıkça yazılır. Kural motorundan
     gelen sabit yanıtlarda gösterilmez — onlar hekim onaylı metinlerdir. */
  var ICERIK_SORUMLU = 'Uzm. Dr. Ramazan Ersoy';
  var ICERIK_GUNCEL  = '27.07.2026';
  function aiYaz(metin) {
    var c = isaretleriCoz(metin);
    botMsj(kacir(c.metin).replace(/\n+/g, '<br>'));
    var k = el('div', 'cb-kunye');
    k.textContent = TR()
      ? 'Yapay zeka tarafından üretildi · Tıbbi içerik sorumlusu: ' + ICERIK_SORUMLU + ' · Son güncelleme: ' + ICERIK_GUNCEL
      : 'Generated by AI · Medical content owner: ' + ICERIK_SORUMLU + ' · Last updated: ' + ICERIK_GUNCEL;
    govde.appendChild(k);
    linkKutu(c.linkler);
  }

  /* ============ 12) ACİL KAPISI ============
     Her kullanıcı girdisinde İLK bu çalışır; LLM'e HİÇ gitmez.
     Tetiklenirse sohbet KİLİTLENİR: seçenekler kaldırılır, giriş kapanır,
     başka soru sorulmaz, ekranda yalnız acil kartı kalır.
     KURAL: acil durumda insana/WhatsApp'a DEVREDİLMEZ — dakika kaybettirir.
     Tek çıkış 112'dir. */
  function kilitle() {
    kilit = true;
    sil(govde.querySelector('.cb-secenekler'));
    giris.value = '';
    giris.disabled = true;
    gonderBtn.disabled = true;
    giris.placeholder = T('kilitliYer');
    giris.setAttribute('aria-label', T('kilitliYer'));
  }

  function acilKarti() {
    var k = el('div', 'cb-acil');
    /* role=alert: ekran okuyucu beklemeden okur (gövde yalnız polite) */
    k.setAttribute('role', 'alert');
    var ic;
    if (TR()) {
      ic = '<strong>Acil olabilir — vakit kaybetmeyin</strong>' +
        '<ol>' +
          '<li>Hemen <b>112</b>’yi arayın ve “anafilaksi şüphesi” olduğunu söyleyin.</li>' +
          '<li>Reçeteli adrenalin otoenjektörünüz varsa <b>BEKLEMEDEN</b> uyluğunuzun dış yanına uygulayın (giysi üzerinden olabilir).</li>' +
          '<li><b>Yatın, ayağa kalkmayın.</b> 5 dakikada düzelme yoksa ikinci enjektör uygulanabilir.</li>' +
          '<li>Kendinizi iyi hissetseniz bile <b>mutlaka acile gidin</b> (belirtiler saatler sonra tekrarlayabilir).</li>' +
        '</ol>' +
        '<div>Bu asistan tıbbi tavsiye vermez. Bu bir acil yönlendirmesidir.</div>' +
        '<a href="tel:112">' + IKON.tel + '<span>112’yi Ara</span></a>';
    } else {
      ic = '<strong>This may be an emergency — do not lose time</strong>' +
        '<ol>' +
          '<li>Call <b>112</b> now and say there is a <b>suspected anaphylaxis</b>.</li>' +
          '<li>If you carry a prescribed adrenaline auto-injector, use it on the outer thigh <b>WITHOUT WAITING</b> (it can be given through clothing).</li>' +
          '<li><b>Lie down; do not stand up.</b> If there is no improvement within 5 minutes, a second injector may be given.</li>' +
          '<li>Even if you feel better, <b>go to an emergency department</b> (symptoms can return hours later).</li>' +
        '</ol>' +
        '<div>This assistant does not give medical advice. This is emergency guidance.</div>' +
        '<a href="tel:112">' + IKON.tel + '<span>Call 112</span></a>';
    }
    k.innerHTML = ic;
    govde.appendChild(k);
    /* Anafilaksi rehberi kartın DIŞINDA: .cb-acil a kırmızı CTA'dır,
       ikincil bağlantı oraya girmemeli. */
    linkKutu([{ h: 'hastaliklar/anafilaksi.html', e: TR() ? 'Anafilaksi rehberi' : 'Anaphylaxis guide', dis: true }]);
    kilitle();
    kaydir();
  }

  /* Acil tespiti. "112" bağımsız sayı olarak geçerse de kart açılır; ama
     mesaj telefon numarası gibiyse (9+ rakam) tetiklenmez — "0532 112 33 44"
     yanlış pozitif vermesin. */
  function acilMi(hamMetin, t, tokens) {
    var rakamAdet = hamMetin.replace(/\D/g, '').length;
    if (rakamAdet < 9 && /(^|\D)112(\D|$)/.test(hamMetin)) return true;
    if (herhangi(t, tokens, ACIL_TR)) return true;
    for (var i = 0; i < ACIL_EN.length; i++) {
      if (t.indexOf(norm(ACIL_EN[i])) !== -1) return true;
    }
    /* Kök-çifti kalıpları: kip/şahıs/araya-kelime değişimine dayanıklı
       ("boğazım kapandı", "oğlumun dudakları şişti", "tansiyonum çok düştü") */
    if (acilKalipVar(t)) return true;
    /* ÇOCUKTA ACİL ÖNCELİĞİ: çocuk işareti + herhangi bir reaksiyon/sistemik
       sinyal doğrudan acildir. Aksi hâlde kapilar() içindeki ÇOCUK kapısı
       tabloyu yutuyor ve panikteki ebeveyne 112 kartı yerine "çocuk
       uzmanına başvurun" sevk mesajı dönüyordu. Çocukta eşik DÜŞER. */
    if (herhangi(t, tokens, COCUK_TR) || herhangi(t, tokens, COCUK_EN)) {
      if (herhangi(t, tokens, REAKSIYON) || herhangi(t, tokens, SISTEMIK_GUCLU)) return true;
    }
    /* Birlikte-geçme kuralları: tek kalıpla yakalanamayan doğal anlatımlar
       ("arı soktu ve her yerim şişti", "yedikten sonra kusuyorum ve şiştim") */
    if (acilBirlikte(t, tokens)) return true;
    return false;
  }

  /* ============ 13) DİĞER DETERMİNİSTİK KAPILAR ============
     ACİL'den SONRA, AI'dan ÖNCE çalışır; hepsi sabit yanıt döner.
     Sıra bilinçli: ÇOCUK kapısı önce gelir, çünkü çocuk için sorulan bir
     fiyat/test sorusunun doğru yanıtı da "yetişkin hasta kabul edilir"dir. */

  function kapiCocuk() {
    botMsj(TR()
      ? 'Bu muayenehanede <strong>yetişkin hastalar</strong> kabul edilmektedir; çocuğunuz için <strong>çocuk alerji ve immünoloji</strong> uzmanına başvurmanızı öneririz. Acil belirti varsa 112’yi arayın.'
      : 'This practice sees <strong>adult patients only</strong>. For your child, please consult a <strong>paediatric allergy and immunology</strong> specialist. If there are emergency symptoms, call 112.');
    linkKutu([{ h: 'tel:112', e: TR() ? '112’yi Ara' : 'Call 112', dis: true, ikon: 'tel' }]);
    anaMenu();
  }

  function kapiFiyat() {
    botMsj(TR()
      ? 'Mevzuat gereği ücret bilgisi internette paylaşılamıyor. <strong>' + TEL_GORUNEN + '</strong>’yı arayarak öğrenebilirsiniz.'
      : 'Under Turkish health regulations, fees cannot be published online. Please call <strong>' + TEL_GORUNEN + '</strong> to find out.');
    linkKutu([telLink(), sayfaLink('fiyatlar/alerji-testi-fiyatlari-2026.html', true)]);
    anaMenu();
  }

  function kapiDoz() {
    botMsj(TR()
      ? 'İlaç dozu ve kullanım kararı kişiye özeldir; bunu ancak muayenede hekiminiz belirleyebilir.'
      : 'Drug doses and treatment decisions are individual; only your physician can determine them during an examination.');
    linkKutu([{ h: 'randevu.html', e: T('randevuBtn') }]);
    anaMenu();
  }

  function kapiTeshis() {
    botMsj(TR()
      ? 'Sonuç yorumu ve tanı ancak muayenede yapılabilir.'
      : 'Interpreting results and making a diagnosis is only possible during an examination.');
    linkKutu([{ h: 'randevu.html', e: T('randevuBtn') }, sayfaLink('testler/index.html', true)]);
    anaMenu();
  }

  /* Kapı sırası tek yerde toplanır ki isle() okunur kalsın.
     Dönüş: true = kapı yanıtladı, AI'ya gitmeyecek. */
  function kapilar(t, tokens) {
    /* ÇOCUK — yetişkin anlatısı kalıpları metinden SİLİNİR, kalanda çocuk
       işareti aranır. Böylece "çocukluğumdan beri alerjim var" kapıyı
       açmaz ama "...7 yaşındaki oğlumda da başladı" açar. */
    var tCocuk = t.replace(ISTISNA_SIL, ' ');
    var tokCocuk = tCocuk.split(/[^a-z0-9]+/).filter(Boolean);
    if (herhangi(tCocuk, tokCocuk, COCUK_TR) || herhangi(tCocuk, tokCocuk, COCUK_EN) || YAS_18ALTI.test(tCocuk)) {
      kapiCocuk(); return true;
    }
    /* DOZ, FİYAT'tan ÖNCE gelir. "Zyrtec'i günde ne kadar almalıyım?" içindeki
       "ne kadar" fiyat listesindeydi ve doz sorusuna ÜCRET yanıtı dönüyordu —
       yani ilaç dozu kapısı hiç çalışmıyordu. Doz her zaman daha spesifiktir. */
    if (herhangi(t, tokens, DOZ_TR) || herhangi(t, tokens, DOZ_EN) || DOZ_KALIP.test(t)) { kapiDoz(); return true; }
    /* FİYAT — istisna kalıpları metinden SİLİNİR, kalanda ücret sinyali aranır.
       Eski kod istisna görünce kapıyı TAMAMEN iptal ediyordu: "İlk görüşme
       ücretsiz mi? Değilse tutarı ne kadar?" cümlesinde 'ucretsiz' yüzünden
       apaçık ücret sorusu AI'ya düşüyordu. Silme yöntemi ikisini de doğru
       çözer: "ücretsiz otopark" kapıyı açmaz, yukarıdaki cümle açar. */
    var tFiyat = t.replace(FIYAT_ISTISNA_SIL, ' ');
    var tokFiyat = tFiyat.split(/[^a-z0-9]+/).filter(Boolean);
    if (herhangi(tFiyat, tokFiyat, FIYAT_TR) || herhangi(tFiyat, tokFiyat, FIYAT_EN)) {
      kapiFiyat(); return true;
    }
    if (herhangi(t, tokens, TESHIS_TR) || herhangi(t, tokens, TESHIS_EN)) { kapiTeshis(); return true; }
    return false;
  }

  /* ============ 14) HIZLI MENÜ ============ */
  function anaMenu(gecikme) {
    if (kilit) return;
    setTimeout(function () {
      if (kilit) return;
      secenekKutu(TR() ? [
        ['Randevu almak istiyorum', akisRandevu],
        ['Hangi test bana uygun?', akisTest],
        ['Testten önce ne yapmalıyım?', akisHazirlik],
        ['Alerji aşısı hakkında', akisAsi],
        ['Polen takvimi', akisPolen],
        ['Adres ve çalışma saatleri', akisAdres],
        ['Başka bir sorum var', akisSerbest]
      ] : [
        ['I would like an appointment', akisRandevu],
        ['Which test suits me?', akisTest],
        ['What should I do before the test?', akisHazirlik],
        ['About allergy immunotherapy', akisAsi],
        ['Pollen calendar', akisPolen],
        ['Address and opening hours', akisAdres],
        ['I have another question', akisSerbest]
      ]);
    }, gecikme || 260);
  }

  /* ============ 15) AKIŞLAR (AI GEREKMEZ) ============ */

  function akisTest() {
    botMsj(TR()
      ? 'Hangi testin uygun olduğu şikayetinize, kullandığınız ilaçlara ve öykünüze göre değişir: deri prick testi, spesifik IgE kan testi, yama testi, solunum fonksiyon testi ve provokasyon testleri farklı sorulara yanıt verir. Karar rehberinde adım adım karşılaştırabilirsiniz; <strong>nihai seçim muayenede hekime aittir</strong>.'
      : 'Which test fits depends on your symptoms, your medication and your history: skin prick testing, specific IgE blood testing, patch testing, lung function testing and provocation tests answer different questions. The decision guide compares them step by step; <strong>the final choice belongs to the physician during the examination</strong>.');
    linkKutu([sayfaLink('testler/index.html'), sayfaLink('testler/deri-prick-testi.html', true)]);
    anaMenu();
  }

  function akisHazirlik() {
    botMsj(TR()
      ? 'Deri testleri için antihistaminiklerin genellikle <strong>yaklaşık 10 gün</strong> önce kesilmesi gerekir; aksi hâlde deri yanıtı baskılanır ve sonuç yanıltıcı olabilir. <strong>Hangi ilacın kesileceğine — ve kesilip kesilemeyeceğine — yalnızca hekiminiz karar verir</strong>; kendi başınıza ilaç bırakmayın. Kan testinde (spesifik IgE) ilaç kesmek gerekmez.'
      : 'For skin testing, antihistamines usually need to be stopped <strong>about 10 days</strong> beforehand; otherwise the skin response is suppressed and the result can be misleading. <strong>Only your physician decides which medication may be stopped</strong> — never stop a medicine on your own. For the specific IgE blood test, no medication needs to be stopped.');
    linkKutu([sayfaLink('hasta-merkezi/randevunuza-hazirlanin.html'),
      sayfaLink('testler/spesifik-ige-kan-testi.html', true)]);
    anaMenu();
  }

  function akisAsi() {
    botMsj(TR()
      ? 'Alerji aşısı (immünoterapi), alerjinin kaynağını hedefleyen ve <strong>3-5 yıl</strong> süren bir tedavidir. Etkisi çoğu hastada <strong>ilk 6 ay içinde</strong> görülmeye başlar; ancak yanıt kişiden kişiye değişir ve kimin uygun olduğu muayeneyle belirlenir. Bu genel bir bilgilendirmedir, muayenenin yerine geçmez.'
      : 'Allergy immunotherapy targets the cause of the allergy and lasts <strong>3-5 years</strong>. In most patients the effect starts to appear <strong>within the first 6 months</strong>, but the response varies from person to person and suitability is determined by examination. This is general information and not a substitute for an examination.');
    linkKutu([sayfaLink('tedaviler/alerji-asisi-immunoterapi.html'),
      sayfaLink('tedaviler/alerji-asisi-sss.html', true)]);
    anaMenu();
  }

  /* İstanbul için kaba mevsim tablosu — kesin ölçüm değil, yıla ve havaya
     göre kayar; bu yüzden yanıtta değişkenlik notu ZORUNLU. */
  var POLEN_TR = [
    'iç ortam alerjenleri (ev tozu akarı, küf) ön planda, polen düzeyi düşük',
    'erken ağaç polenleri başlıyor (kavak, dişbudak, ardıç)',
    'ağaç poleni yükseliyor (huş, meşe, çınar)',
    'ağaç poleni zirveye yakın, çim polenleri başlıyor',
    'çim (çayır) poleni zirvede, zeytin poleni de ekleniyor',
    'çim poleni hâlâ yüksek',
    'çim poleni azalıyor, yabancı ot polenleri başlıyor',
    'yabancı ot polenleri (pelin, ısırgan) ve küf sporları artıyor',
    'yabancı ot polenleri sürüyor, küf sporları yüksek',
    'küf sporları ön planda, polen düzeyi düşüyor',
    'polen düşük, iç ortam alerjenleri belirleyici',
    'iç ortam alerjenleri (akar, küf, evcil hayvan) ön planda'
  ];
  var POLEN_EN = [
    'indoor allergens (house dust mite, mould) dominate and pollen is low',
    'early tree pollen begins (poplar, ash, juniper)',
    'tree pollen is rising (birch, oak, plane)',
    'tree pollen is near its peak and grass pollen starts',
    'grass pollen peaks and olive pollen is added',
    'grass pollen is still high',
    'grass pollen declines and weed pollen begins',
    'weed pollen (mugwort, nettle) and mould spores increase',
    'weed pollen continues and mould spores are high',
    'mould spores dominate and pollen is falling',
    'pollen is low and indoor allergens are decisive',
    'indoor allergens (mite, mould, pets) dominate'
  ];
  var AY_TR = ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz',
    'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];
  var AY_EN = ['January', 'February', 'March', 'April', 'May', 'June', 'July',
    'August', 'September', 'October', 'November', 'December'];

  function akisPolen() {
    var ay = new Date().getMonth();
    botMsj(TR()
      ? '<strong>' + AY_TR[ay] + '</strong> ayında İstanbul’da genellikle ' + POLEN_TR[ay] +
        '. Polen yoğunluğu yıla, sıcaklığa ve rüzgâra göre kayar; takvim yön göstericidir, kesin ölçüm değildir.'
      : 'In <strong>' + AY_EN[ay] + '</strong>, in Istanbul, ' + POLEN_EN[ay] +
        '. Pollen levels shift with the year, temperature and wind; the calendar is indicative, not an exact measurement.');
    linkKutu([sayfaLink('araclar/polen-takvimi.html'), sayfaLink('hastaliklar/alerjik-rinit.html', true)]);
    anaMenu();
  }

  function akisAdres() {
    botMsj(TR()
      ? '<strong>Adres:</strong> ' + ADRES + ' (Nişantaşı; Osmanbey metrosuna yürüme mesafesi).<br>' +
        '<strong>Çalışma saatleri:</strong> Pazartesi-Cuma 09:00-18:00 · Cumartesi 09:00-14:00 · Pazar kapalı.<br>' + mesaiNotu()
      : '<strong>Address:</strong> ' + ADRES + ' (Nisantasi; walking distance from Osmanbey metro).<br>' +
        '<strong>Opening hours:</strong> Monday-Friday 09:00-18:00 · Saturday 09:00-14:00 · Sunday closed.<br>' + mesaiNotu());
    linkKutu([sayfaLink('iletisim.html'), telLink()]);
    anaMenu();
  }

  function akisSerbest() {
    serbestMod = true;
    if (aiDurum === 'yok') {
      botMsj(kacir(T('serbestKapali')));
      waUyarisi();
      linkKutu([waLink(TR() ? 'Merhaba, bir sorum var.' : 'Hello, I have a question.'), telLink()]);
      anaMenu();
      return;
    }
    botMsj(kacir(T('serbestAcik')));
    giris.focus();
  }

  /* ---- RANDEVU AKIŞI (KVKK: SAĞLIK VERİSİ TOPLAMAZ) ----
     Adım 1: şikayet KATEGORİSİ seçimi, yalnız BUTONLARLA — serbest metin yok.
     Adım 2: iletim kanalı.
     Ad, telefon, TC ASLA sorulmaz; kimlik ve iletişim bilgisi almak
     sekreteryanın işidir — bot yalnız talebi kanala taşır. */
  var KATEGORI_TR = [
    ['Burun / hapşırık', 'burun/hapşırık şikayetlerim'],
    ['Öksürük / nefes', 'öksürük/nefes şikayetlerim'],
    ['Cilt / kaşıntı', 'cilt/kaşıntı şikayetlerim'],
    ['Besin', 'besin alerjisi şikayetlerim'],
    ['İlaç', 'ilaç alerjisi şikayetlerim'],
    ['Arı', 'arı sokması alerjisi'],
    ['Alerji aşısı', 'alerji aşısı (immünoterapi)'],
    ['Diğer', 'alerji şikayetlerim']
  ];
  var KATEGORI_EN = [
    ['Nose / sneezing', 'nasal and sneezing symptoms'],
    ['Cough / breathing', 'cough and breathing symptoms'],
    ['Skin / itching', 'skin and itching symptoms'],
    ['Food', 'a food allergy'],
    ['Medication', 'a drug allergy'],
    ['Bee or wasp sting', 'an insect sting allergy'],
    ['Immunotherapy', 'allergy immunotherapy'],
    ['Other', 'allergy symptoms']
  ];

  function akisRandevu() {
    var liste = TR() ? KATEGORI_TR : KATEGORI_EN;
    botMsj((TR()
      ? 'Randevu <strong>talep usulüyle</strong> alınır: talebiniz iletilir, sekreterlik arayarak kesinleştirir. '
      : 'Appointments work <strong>by request</strong>: your request is passed on and the secretary calls to confirm it. ') +
      mesaiNotu() + '<br><br>' +
      (TR() ? 'Hangi konuda görüşmek istiyorsunuz?' : 'What would you like to be seen for?'));
    var secenekler = [];
    for (var i = 0; i < liste.length; i++) {
      (function (k) {
        secenekler.push([k[0], function () { randevuKanal(k[1]); }]);
      })(liste[i]);
    }
    secenekler.push([T('anaMenuBtn'), function () { anaMenu(0); }]);
    secenekKutu(secenekler);
  }

  function randevuKanal(kategoriMetni) {
    var waMesaj = TR()
      ? 'Merhaba, ' + kategoriMetni + ' için randevu almak istiyorum.'
      : 'Hello, I would like an appointment for ' + kategoriMetni + '.';
    botMsj(TR()
      ? 'Not aldım. Randevu talebinizi nasıl iletmek istersiniz?'
      : 'Noted. How would you like to send your appointment request?');
    /* WhatsApp butonundan ÖNCE KVKK uyarısı */
    waUyarisi();
    linkKutu([waLink(waMesaj), { h: 'randevu.html', e: T('formBtn'), dis: true }]);
    secenekKutu([[T('anaMenuBtn'), function () { anaMenu(0); }]]);
  }

  /* niyet adından akışa dağıtım (serbest metin eşleşmeleri için) */
  var AKIS = {
    randevu: akisRandevu, test: akisTest, hazirlik: akisHazirlik,
    asi: akisAsi, polen: akisPolen, adres: akisAdres
  };
  function niyetDene(t, tokens) {
    for (var i = 0; i < NIYETLER.length; i++) {
      if (herhangi(t, tokens, NIYETLER[i].k)) {
        var f = AKIS[NIYETLER[i].ad];
        if (f) { f(); return true; }
      }
    }
    return false;
  }

  /* ============ 16) AI KÖPRÜSÜ ============
     Sözleşme (DEĞİŞTİRİLMEZ):
       POST (KOK) + 'chat-api.php'
       gövde {"mesajlar":[{"rol":"user"|"bot","icerik":"..."}],"dil":"tr"|"en"}
       en fazla 16 mesaj, her içerik en fazla 500 karakter, GÖRSEL YOK
       başarı {"yanit":"metin"} · hata {"hata":"kod"} + 4xx/5xx
       429 = saatlik limit · 503 = anahtar/yapılandırma yok · 502 = sağlayıcı */

  /* Sessiz yoklama: PHP çalışan sunucuda HEAD 405 döner (uç yalnız POST
     kabul ediyor) — bu "var" demektir. 404/403 = dosya yok, 503 = anahtar
     yok → "yok". Statik sunucu .php'yi düz dosya olarak 200 ile servis
     edebilir; bu belirsizdir, 'bilinmiyor' bırakılır ve ilk POST'ta anlaşılır
     (JSON ayrıştırma hatası yedeğe düşürür). */
  function aiYokla() {
    if (!window.fetch) { aiDurum = 'yok'; rozetGuncelle(); return; }
    try {
      fetch(AI_URL, { method: 'HEAD' }).then(function (r) {
        if (r.status === 405 || r.status === 400) aiDurum = 'var';
        else if (r.status === 404 || r.status === 403 || r.status === 503) aiDurum = 'yok';
        rozetGuncelle();
      })['catch'](function () { aiDurum = 'yok'; rozetGuncelle(); });
    } catch (e) { aiDurum = 'yok'; rozetGuncelle(); }
  }

  function yaziyorGoster() {
    var y = el('div', 'cb-yaziyor');
    y.setAttribute('aria-label', T('yaziyor'));
    y.innerHTML = '<i></i><i></i><i></i>';
    govde.appendChild(y);
    kaydir();
    return y;
  }

  /* AI kapalıysa/başarısızsa: ASLA boş ekran — açıklama + WhatsApp + menü */
  function aiYedek(mesajAnahtari, kullaniciMetni) {
    botMsj(kacir(T(mesajAnahtari)));
    waUyarisi();
    linkKutu([
      waLink((TR() ? 'Merhaba, bir sorum var: ' : 'Hello, I have a question: ') + kullaniciMetni.slice(0, 120)),
      telLink()
    ]);
    anaMenu();
  }

  function aiSor(metin) {
    if (!window.fetch) { aiDurum = 'yok'; rozetGuncelle(); aiYedek('serbestKapali', metin); return; }
    var yaziyor = yaziyorGoster();
    gonderBtn.disabled = true;
    fetch(AI_URL, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ mesajlar: gecmis.slice(-GECMIS_SINIR), dil: dil })
    }).then(function (r) {
      if (r.status === 404 || r.status === 503) { aiDurum = 'yok'; throw new Error('yok'); }
      if (r.status === 429) throw new Error('limit');
      if (!r.ok) throw new Error('http');
      aiDurum = 'var';
      return r.json();
    }).then(function (j) {
      sil(yaziyor);
      if (!kilit) gonderBtn.disabled = false;
      rozetGuncelle();
      if (!j || !j.yanit) throw new Error('bos');
      /* SUNUCU ACİL BAYRAĞI: chat-api.php kendi deterministik acil kapısında
         bir şey yakalarsa acil:true döner. İstemci kapısının kaçırdığı bir
         tablo burada yakalanmış demektir; düz bot balonu yerine KIRMIZI
         acil kartı gösterilir (ikinci ağ, birinci ağla aynı görünür). */
      if (j.acil) { acilKarti(); return; }
      gecmis.push({ rol: 'bot', icerik: String(j.yanit).slice(0, GIRDI_SINIR) });
      if (gecmis.length > GECMIS_SINIR) gecmis = gecmis.slice(-GECMIS_SINIR);
      aiYaz(j.yanit);
      anaMenu(500);
    })['catch'](function (hata) {
      sil(yaziyor);
      if (!kilit) gonderBtn.disabled = false;
      rozetGuncelle();
      var kod = hata && hata.message;
      if (kod === 'limit') { aiYedek('aiLimit', metin); return; }
      if (kod === 'yok') { aiYedek('serbestKapali', metin); return; }
      aiYedek('aiHata', metin);
    });
  }

  /* ============ 17) GİRDİ İŞLEME ZİNCİRİ ============
     Sıra: ACİL → diğer kapılar → niyet eşleme → AI (varsa) → yedek. */
  function isle(hamMetin) {
    if (kilit) return;
    var metin = String(hamMetin).slice(0, GIRDI_SINIR); /* 500 sınırı istemcide de */
    var t = norm(metin);
    var tokens = tokenla(metin);

    /* 1) ACİL KAPISI — her şeyden önce, LLM'e gitmeden */
    if (acilMi(metin, t, tokens)) { acilKarti(); return; }

    /* 2) Diğer deterministik kapılar */
    if (kapilar(t, tokens)) return;

    /* 3) Buton akışlarına niyet eşleme (AI olmasa da bot işe yarar kalsın).
       "Başka bir sorum var" seçildiyse ATLANIR: kullanıcı bilinçli olarak
       serbest soru modundadır, menü akışına geri çekilmemeli. */
    if (!serbestMod && niyetDene(t, tokens)) return;

    /* 4) Serbest soru: AI köprüsü varsa ona, yoksa yedeğe */
    gecmis.push({ rol: 'user', icerik: metin });
    if (gecmis.length > GECMIS_SINIR) gecmis = gecmis.slice(-GECMIS_SINIR);
    if (aiDurum === 'yok') { aiYedek('serbestKapali', metin); return; }

    /* KVKK RIZA KAPISI — YALNIZCA BURADA.
       1-3. adımlar tamamen istemcide çalışır ve hiçbir veri yurt dışına
       çıkmaz; bu yüzden acil kartı, menü akışları ve sabit kapı yanıtları
       ONAY İSTEMEDEN çalışır. Anafilaksi tarif eden birini onay kutusuyla
       bekletmek kabul edilemez — acil kapısı 1. sırada ve rızadan öncedir.
       Onay ancak metin OpenAI'ye (ABD) gidecekse sorulur. */
    if (!rizaVar()) { rizaSor(metin); return; }
    aiSor(metin);
  }

  /* ---- KVKK açık rıza yönetimi ----
     Rıza bayrağı sessionStorage'da tutulur: sağlık verisi DEĞİLDİR (yalnız
     "onayladı" bilgisi) ve sekme kapanınca silinir — kalıcı bir iz bırakmaz.
     Sohbet İÇERİĞİ hiçbir yerde saklanmaz, o kural aynen geçerli. */
  var RIZA_ANAHTAR = 'ersoy_ai_riza';
  var rizaBellek = false;
  function rizaVar() {
    if (rizaBellek) return true;
    try { if (window.sessionStorage && sessionStorage.getItem(RIZA_ANAHTAR) === '1') { rizaBellek = true; return true; } }
    catch (e) { /* gizli sekmede erişim engellenebilir; belleğe düşeriz */ }
    return false;
  }
  function rizaYaz() {
    rizaBellek = true;
    try { if (window.sessionStorage) sessionStorage.setItem(RIZA_ANAHTAR, '1'); } catch (e) {}
  }
  function rizaSor(bekleyenMetin) {
    var k = el('div', 'cb-riza');
    k.setAttribute('role', 'group');
    k.innerHTML = TR()
      ? '<b>Devam etmeden önce:</b> Serbest yazdığınız mesaj, yanıt üretilebilmesi için ' +
        '<b>OpenAI</b>’ın <b>ABD’deki</b> sunucularına iletilir. Sohbet içeriği bizde ' +
        '<b>saklanmaz</b>. T.C. kimlik, telefon ve e-posta sunucumuzda otomatik gizlenir. ' +
        'Lütfen tahlil sonucu, fotoğraf ya da ayrıntılı tıbbi öykü yazmayın. ' +
        '<a href="' + KOK + 'kvkk-aydinlatma.html#yurt-disi" target="_blank" rel="noopener">Aydınlatma metni</a>'
      : '<b>Before you continue:</b> Your free-text message is sent to <b>OpenAI</b>’s servers in the ' +
        '<b>United States</b> to generate a reply. We do <b>not</b> store the conversation. ' +
        'National ID, phone and e-mail are masked automatically on our server. ' +
        'Please do not write test results, photos or detailed medical history. ' +
        '<a href="' + KOK + 'kvkk-aydinlatma.html#yurt-disi" target="_blank" rel="noopener">Privacy notice</a>';

    var d = el('div', 'cb-riza-dugmeler');
    var onay = el('button', 'cb-riza-onay');
    onay.type = 'button';
    onay.textContent = TR() ? 'Onaylıyorum, devam et' : 'I agree, continue';
    var vaz = el('button', 'cb-riza-vazgec');
    vaz.type = 'button';
    vaz.textContent = TR() ? 'İstemiyorum' : 'No thanks';

    onay.addEventListener('click', function () {
      rizaYaz();
      sil(k);
      aiSor(bekleyenMetin);
    });
    vaz.addEventListener('click', function () {
      sil(k);
      /* Reddeden kullanıcı boşta bırakılmaz: veri göndermeyen kanallara yönlendirilir */
      botMsj(kacir(TR()
        ? 'Sorun değil. Aşağıdaki başlıkları kullanabilir ya da doğrudan arayabilirsiniz — bu yollarda hiçbir bilgi yurt dışına iletilmez.'
        : 'No problem. You can use the topics below or call us directly — these channels send nothing abroad.'));
      linkKutu([{ h: 'tel:+902127099396', e: TR() ? '0212 709 93 96’yı ara' : 'Call 0212 709 93 96', dis: true, ikon: 'tel' }]);
      anaMenu(300);
    });
    d.appendChild(onay); d.appendChild(vaz);
    k.appendChild(d);
    govde.appendChild(k);
    kaydir();
    onay.focus();
  }

  function gonder() {
    if (kilit) return;
    var v = giris.value.replace(/\s+/g, ' ').trim();
    if (!v) return;
    giris.value = '';
    kulMsj(v);
    setTimeout(function () { isle(v); }, 180);
  }

  /* ============ 18) AÇ / KAPAT VE ERİŞİLEBİLİRLİK ============ */
  /* Mobilde pencere tam ekrandır; arka plan kaydırması kilitlenir.
     Masaüstünde pencere köşede durduğu için kilit UYGULANMAZ. */
  function mobilMi() {
    return window.matchMedia ? window.matchMedia('(max-width:820px)').matches : window.innerWidth <= 820;
  }
  function acKapat(ac) {
    /* toggle'ın ikinci (force) parametresi eski tarayıcılarda yok — açıkça add/remove */
    if (ac) pencere.classList.add('acik'); else pencere.classList.remove('acik');
    pencere.setAttribute('aria-hidden', ac ? 'false' : 'true');
    balon.setAttribute('aria-expanded', ac ? 'true' : 'false');
    if (ac) balon.setAttribute('hidden', 'hidden'); else balon.removeAttribute('hidden');
    if (ac && mobilMi()) document.body.classList.add('cb-kilit');
    else document.body.classList.remove('cb-kilit');
    if (ac && !kilit) giris.focus();
  }

  balon.addEventListener('click', function () {
    acKapat(true);
    karsilamaKaldir();
    if (!acildiMi) {
      acildiMi = true;
      aiYokla();
      /* (a) birinci seviye bildirim: açılıştaki ilk balon */
      botMsj(kacir(T('karsilama')));
      anaMenu(320);
    }
  });
  pencere.querySelector('.cb-kapat').addEventListener('click', function () {
    acKapat(false);
    balon.focus();
  });
  /* Escape kapatır (yalnız pencere açıkken) */
  document.addEventListener('keydown', function (e) {
    if ((e.key === 'Escape' || e.keyCode === 27) && pencere.classList.contains('acik')) {
      acKapat(false);
      balon.focus();
    }
  });
  gonderBtn.addEventListener('click', gonder);
  giris.addEventListener('keydown', function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) { e.preventDefault(); gonder(); }
  });

  /* ============ 19) OTOMATİK KARŞILAMA BALONCUĞU ============
     Yalnız bellekte sayılır: sayfa yüklemesi başına bir kez gösterilir.
     sessionStorage KULLANILMAZ — bu widget tarayıcıda hiçbir iz bırakmaz. */
  var karsilama = null;
  function karsilamaKaldir() {
    if (karsilama) { sil(karsilama); karsilama = null; }
  }
  function karsilamaKur() {
    karsilama = el('div', 'cb-karsilama');
    karsilama.innerHTML =
      '<button type="button" class="cb-karsilama-x" aria-label="' + kacir(T('nudgeKapat')) + '">' + IKON.kapat + '</button>' +
      '<strong>' + kacir(T('bot')) + '</strong>' + kacir(T('nudge'));
    document.body.appendChild(karsilama);
    setTimeout(function () { if (karsilama) karsilama.classList.add('acik'); }, 1600);
    karsilama.querySelector('.cb-karsilama-x').addEventListener('click', function (e) {
      e.stopPropagation();
      karsilamaKaldir();
    });
    karsilama.addEventListener('click', function () { karsilamaKaldir(); balon.click(); });
    setTimeout(karsilamaKaldir, 30000);
  }
  setTimeout(function () { if (!acildiMi) karsilamaKur(); }, 2400);
})();
