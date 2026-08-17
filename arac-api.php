<?php
/* AlerjiAsistan ARAÇLARI — ortak AI ucu
   ------------------------------------------------------------
   İki mod:
     etiket : içindekiler listesinde seçili alerjenlerin gizli adlarını bulur
     rota   : serbest metin şikayeti sitedeki doğru sayfalara yönlendirir

   GÜVENLİK MİMARİSİ chat-api.php ile AYNI SOYDAN:
   - anahtar yalnız sunucuda (chat-config.php); dosya yoksa araçlar
     SÖZLÜK/DETERMİNİSTİK modda çalışmaya devam eder, ölmez
   - rota modunda acil tarama AI'DAN ÖNCE (ersoyAcilMi kopyası)
   - KVKK maskeleme yurt dışına çıkmadan önce
   - AI çıktısı sunucuda DOĞRULANIR: bulgu 'kaynak'ı metinde geçmiyorsa
     atılır (halüsinasyon süzgeci), sayfa slug'ı beyaz liste dışındaysa atılır
   - hiçbir girdi/çıktı diske yazılmaz
*/

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Cache-Control: no-store');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo '{"hata":"yontem"}'; exit; }

/* — hız sınırı: IP başına saatte 20 (chatbot kovasından ayrı) — */
$ip   = preg_replace('/[^0-9a-f\.\:]/i', '', $_SERVER['REMOTE_ADDR'] ?? 'x');
$kova = sys_get_temp_dir() . '/ersoy-arac-' . md5($ip) . '-' . date('YmdH');
$adet = (int) @file_get_contents($kova);
if ($adet >= 20) { http_response_code(429); echo '{"hata":"limit"}'; exit; }
@file_put_contents($kova, $adet + 1);

$govde = json_decode(file_get_contents('php://input'), true);
$mod   = $govde['mod'] ?? '';

/* ---------- chat-api ile ortak yardımcılar (kopya — tek dosya bağımsızlığı) ---------- */
function aracMaskele($s) {
  $s = preg_replace('/\b[1-9][0-9]{10}\b/u', '[gizlendi]', $s);
  $s = preg_replace('/\b[\w.+-]+@[\w-]+\.[\w.]{2,}\b/u', '[gizlendi]', $s);
  $s = preg_replace('/(?:\+?90[\s.-]?)?\(?0?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{2}[\s.-]?\d{2}\b/u', '[gizlendi]', $s);
  return $s;
}
function aracKatla($s) {
  $s = mb_strtolower($s, 'UTF-8');
  return strtr($s, [
    'ı'=>'i','İ'=>'i','ğ'=>'g','Ğ'=>'g','ş'=>'s','Ş'=>'s','ç'=>'c','Ç'=>'c',
    'ö'=>'o','Ö'=>'o','ü'=>'u','Ü'=>'u','â'=>'a','î'=>'i','û'=>'u',
    '’'=>"'", '‘'=>"'", '´'=>"'"
  ]);
}
function aracAcilMi($ham) {
  $t = aracKatla($ham);
  $kalip = [
    '/(bogaz|dudak|dil|girtlak)\w*.{0,15}?(sis|kapan|daral|tikan|morar)/u',
    '/(tansiyon|nefes|solunum)\w*.{0,15}?(dus|kesil|daral|alam|yetmi|tikan)/u',
    '/(nefes darligi|nefes alamiyor|hirilti|gogsum sikis|konusamiyor|cumle kuramiyor)/u',
    '/(astim atagi|astim krizi|boguluyor|yutkunamiyor|sesim kisil|havasiz kaldim)/u',
    '/(anafilaksi|alerjik sok|epipen|otoenjektor|adrenalin yaptim)/u',
    '/(anaphylaxis|anaphylactic|can\'t breathe|cannot breathe|cant breathe)/u',
    '/(difficulty breathing|throat clos|swollen (lips|tongue|throat)|passed out|blue lips)/u',
  ];
  foreach ($kalip as $k) { if (preg_match($k, $t)) return true; }
  $yaygin = '/(her yerim|her tarafim|tum vucud|butun vucud|vucudum|yaygin|bastan asagi|all over)/u';
  $reaksiyon = '/(sis|kizar|kurdesen|dokuntu|kabar|kasin|hives)/u';
  if (preg_match($yaygin, $t) && preg_match($reaksiyon, $t)) return true;
  return false;
}

/* AI erişimi opsiyonel: yoksa deterministik moda düşülür */
$aiVar = false;
$cfg = __DIR__ . '/chat-config.php';
if (file_exists($cfg)) {
  require $cfg;
  $aiVar = defined('OPENAI_KEY') && OPENAI_KEY !== '' && strpos(OPENAI_KEY, 'BURAYA') === false;
}

function aracAiSor($sistem, $kullanici) {
  $ch = curl_init('https://api.openai.com/v1/chat/completions');
  curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 20,
    CURLOPT_HTTPHEADER => [
      'Content-Type: application/json',
      'Authorization: Bearer ' . OPENAI_KEY,
    ],
    CURLOPT_POSTFIELDS => json_encode([
      'model' => 'gpt-4o-mini',
      'temperature' => 0.2,
      'max_tokens' => 700,
      'response_format' => ['type' => 'json_object'],
      'messages' => [
        ['role' => 'system', 'content' => $sistem],
        ['role' => 'user', 'content' => $kullanici],
      ],
    ], JSON_UNESCAPED_UNICODE),
  ]);
  $yanit = curl_exec($ch);
  curl_close($ch);
  if (!$yanit) return null;
  $j = json_decode($yanit, true);
  $icerik = $j['choices'][0]['message']['content'] ?? null;
  return $icerik ? json_decode($icerik, true) : null;
}

/* ============================================================
   MOD 1: ETİKET
   ============================================================ */
if ($mod === 'etiket') {
  $ALERJENLER = [
    'sut' => 'Süt', 'yumurta' => 'Yumurta', 'yer-fistigi' => 'Yer fıstığı',
    'agac-yemisi' => 'Ağaç yemişleri', 'soya' => 'Soya', 'gluten' => 'Buğday / gluten',
    'deniz' => 'Kabuklu deniz ürünleri', 'balik' => 'Balık', 'susam' => 'Susam',
  ];

  $secili = array_values(array_intersect(array_keys($ALERJENLER), (array) ($govde['alerjenler'] ?? [])));
  $metin  = trim((string) ($govde['metin'] ?? ''));
  if (!$secili || $metin === '' || mb_strlen($metin) > 2500) {
    http_response_code(400); echo '{"hata":"girdi"}'; exit;
  }
  $metin = aracMaskele($metin);
  $katli = aracKatla($metin);

  /* — GÜVENLİK AĞI SÖZLÜĞÜ: AI kapalıyken de yakalanan bilinen gizli adlar — */
  $SOZLUK = [
    'sut' => ['kazein','kazeinat','peynir alti suyu','peyniralti suyu','laktoz','laktalbumin','laktoglobulin','tereyag','sut tozu','krema','yogurt tozu','ghee'],
    'yumurta' => ['albumin','ovalbumin','lizozim','globulin','mayonez','lesitin (yumurta)'],
    'yer-fistigi' => ['yer fistigi','arasit','arachis','fistik ezmesi','fistik yagi (yer)'],
    'agac-yemisi' => ['badem','findik','ceviz','kaju','antep fistigi','pekan','macadamia','pinyon','cam fistigi','marzipan','pralin','nugat'],
    'soya' => ['soya','soja','e322','e-322','lesitin','tofu','miso','edamame','tempeh','bitkisel protein (soya)'],
    'gluten' => ['bugday','arpa','cavdar','yulaf','irmik','bulgur','nisasta (bugday)','malt','glüten','gluten','seitan','kuskus'],
    'deniz' => ['karides','yengec','istakoz','midye','istiridye','kalamar','ahtapot','surimi','deniz mahsul'],
    'balik' => ['balik','hamsi','ancuez','ansuez','ton baligi','somon','balik sosu','worcester'],
    'susam' => ['susam','tahin','sesam','sesamol','helva'],
  ];

  $bulgular = [];
  foreach ($secili as $a) {
    foreach ($SOZLUK[$a] as $ad) {
      if (mb_strpos($katli, aracKatla($ad)) !== false) {
        $bulgular[] = [
          'tur' => 'kesin', 'kaynak' => $ad, 'alerjen' => $ALERJENLER[$a],
          'aciklama' => '"' . $ad . '" ifadesi ' . $ALERJENLER[$a] . ' kaynaklıdır ya da içerebilir.',
        ];
      }
    }
  }

  $motor = 'sozluk';
  if ($aiVar) {
    $sistem = 'Sen bir gıda etiketi analiz aracısın. SADECE JSON döndür: '
      . '{"bulgular":[{"tur":"kesin|olasi","kaynak":"metinde GEÇEN ifade","alerjen":"' . implode('|', array_map(fn($k) => $ALERJENLER[$k], $secili)) . '","aciklama":"tek cümle"}]}. '
      . 'KURALLAR: (1) kaynak alanı, kullanıcının metninde HARFİYEN geçen bir ifade olmalı — uydurma. '
      . '(2) yalnız listelenen alerjenler için bulgu üret. (3) emin değilsen tur=olasi. '
      . '(4) teşhis, tedavi, tıbbi öneri YAZMA. (5) bulgu yoksa boş dizi.';
    $ai = aracAiSor($sistem, "Alerjenler: " . implode(', ', array_map(fn($k) => $ALERJENLER[$k], $secili))
      . "\nİçindekiler: " . $metin);
    if (is_array($ai) && isset($ai['bulgular']) && is_array($ai['bulgular'])) {
      $motor = 'ai';
      foreach ($ai['bulgular'] as $b) {
        $kaynak = trim((string) ($b['kaynak'] ?? ''));
        $alerjen = trim((string) ($b['alerjen'] ?? ''));
        $tur = ($b['tur'] ?? '') === 'kesin' ? 'kesin' : 'olasi';
        /* HALÜSİNASYON SÜZGECİ: kaynak metinde geçmek zorunda */
        if ($kaynak === '' || mb_strpos($katli, aracKatla($kaynak)) === false) continue;
        if (!in_array($alerjen, array_map(fn($k) => $ALERJENLER[$k], $secili), true)) continue;
        /* sözlük zaten bulduysa yineleme */
        $var = false;
        foreach ($bulgular as $m) if (aracKatla($m['kaynak']) === aracKatla($kaynak)) { $var = true; break; }
        if ($var) continue;
        $aciklama = mb_substr(trim((string) ($b['aciklama'] ?? '')), 0, 200);
        /* çıktı süzgeci: tıbbi öneri/teşhis dili sızmasın */
        if (preg_match('/(teşhis|tanı koy|tedavi|ilaç|doz|kullanabilirsiniz|güvenlidir)/ui', $aciklama)) {
          $aciklama = '"' . $kaynak . '" ifadesi ' . $alerjen . ' ile ilişkili olabilir.';
        }
        $bulgular[] = ['tur' => $tur, 'kaynak' => $kaynak, 'alerjen' => $alerjen, 'aciklama' => $aciklama];
      }
    }
  }

  echo json_encode([
    'bulgular' => array_slice($bulgular, 0, 12),
    'temiz' => count($bulgular) === 0,
    'motor' => $motor,
  ], JSON_UNESCAPED_UNICODE);
  exit;
}

/* ============================================================
   MOD 2: ROTA
   ============================================================ */
if ($mod === 'rota') {
  $metin = trim((string) ($govde['metin'] ?? ''));
  if ($metin === '' || mb_strlen($metin) > 800) { http_response_code(400); echo '{"hata":"girdi"}'; exit; }

  /* ACİL — AI'dan ÖNCE, her zaman */
  if (aracAcilMi($metin)) { echo '{"acil":true}'; exit; }

  /* Beyaz liste: AI yalnız SLUG seçer, kart verisi buradan çıkar */
  $SAYFALAR = [
    'astim' => ['Yetişkinlerde Astım', '/hastaliklar/astim/', 'Gece öksürüğü, hırıltı, eforla nefes darlığı'],
    'alerjik-rinit' => ['Alerjik Rinit', '/hastaliklar/alerjik-rinit/', 'Hapşırık, burun akıntısı ve tıkanıklık'],
    'urtiker' => ['Ürtiker (Kurdeşen)', '/hastaliklar/urtiker/', 'Gezici, kaşıntılı kabarıklıklar'],
    'besin-alerjisi' => ['Besin Alerjisi', '/hastaliklar/besin-alerjisi/', 'Yemek sonrası tepkiler'],
    'ilac-alerjisi' => ['İlaç Alerjisi', '/hastaliklar/ilac-alerjisi/', 'İlaç sonrası döküntü ve reaksiyon'],
    'ari-alerjisi' => ['Arı Alerjisi', '/hastaliklar/ari-alerjisi/', 'Sokma sonrası büyüyen reaksiyonlar'],
    'herediter-anjiyoodem' => ['Herediter Anjiyoödem', '/hastaliklar/herediter-anjiyoodem/', 'Kaşıntısız, tekrarlayan şişlik atakları'],
    'anafilaksi' => ['Anafilaksi', '/hastaliklar/anafilaksi/', 'Ağır alerjik reaksiyonu tanıma ve hazırlık'],
    'deri-prick-testi' => ['Deri Prick Testi', '/testler/deri-prick-testi/', '15 dakikada sonuç veren temel alerji testi'],
    'spesifik-ige' => ['Spesifik IgE Kan Testi', '/testler/spesifik-ige-kan-testi/', 'İlaç kesmeden yapılabilen kan testi'],
    'sft' => ['Solunum Fonksiyon Testi', '/testler/solunum-fonksiyon-testi/', 'Astım tanısının temeli'],
    'yama-testi' => ['Yama Testi', '/testler/yama-testi/', 'Temas alerjisi (egzama) araştırması'],
    'immunoterapi' => ['Alerji Aşısı', '/tedaviler/alerji-asisi-immunoterapi/', 'Nedene yönelen tek tedavi'],
    'act' => ['Astım Kontrol Testi', '/araclar/astim-kontrol-testi/', '5 soruluk öz değerlendirme'],
    'alerji-mi' => ['Alerji mi, Soğuk Algınlığı mı?', '/araclar/alerji-mi-soguk-alginligi-mi/', '2 dakikalık ayırt etme testi'],
    'polen' => ['İstanbul Polen Takvimi', '/araclar/polen-takvimi/', 'Şikayetiniz hangi dönemde artıyor?'],
    'randevu' => ['Randevu Talebi', '/randevu/', 'Aynı gün dönüş'],
  ];

  $sonuc = null;
  if ($aiVar) {
    $sistem = 'Bir alerji muayenehanesi sitesinde yönlendirme aracısın. SADECE JSON döndür: '
      . '{"mesaj":"2-3 cümle","sayfalar":["slug","slug"]}. '
      . 'Slug listesi (SADECE bunlardan seç, en fazla 3): ' . implode(', ', array_keys($SAYFALAR)) . '. '
      . 'KURALLAR: (1) ASLA teşhis koyma; "olabilir", "değerlendirme gerektirir" de, hastalık adını '
      . 'kesinlik bildirerek söyleme. (2) İlaç, doz, tedavi önerme. (3) "en iyi", fiyat, garanti dili yasak. '
      . '(4) mesaj Türkçe, nazik, kısa; hekim değerlendirmesine yönlendir. '
      . '(5) 18 yaş altı için: muayenehanenin yalnız yetişkin kabul ettiğini söyle, çocuk alerji uzmanına yönlendir.';
    $ai = aracAiSor($sistem, aracMaskele($metin));
    if (is_array($ai) && isset($ai['mesaj'], $ai['sayfalar'])) {
      $sluglar = array_values(array_intersect(array_keys($SAYFALAR), (array) $ai['sayfalar']));
      $mesaj = mb_substr(trim((string) $ai['mesaj']), 0, 400);
      /* çıktı süzgeci: chat-api ile aynı sınıf yasaklar */
      if (preg_match('/(garanti|kesin (çözüm|tanı|teşhis)|%\s?100|mucize|fiyat|ücret|₺|\bTL\b)/ui', $mesaj)) $mesaj = '';
      if ($mesaj !== '' && $sluglar) $sonuc = ['mesaj' => $mesaj, 'sluglar' => $sluglar];
    }
  }

  if (!$sonuc) {
    /* deterministik yedek: anahtar kelime → sayfa */
    $k = aracKatla($metin);
    $puan = [];
    $anahtar = [
      'astim' => ['oksur','hirilti','nefes','gogus','gece uyan'],
      'alerjik-rinit' => ['burun','hapsir','geniz','tikan','bahar'],
      'urtiker' => ['kurdesen','kabar','kasin','dokuntu'],
      'besin-alerjisi' => ['yemek','yedik','gida','besin','findik','fistik','karides','sut ic'],
      'ilac-alerjisi' => ['ilac','antibiyotik','agri kesici','penisilin'],
      'ari-alerjisi' => ['ari','sokt','sokma','esek arisi'],
      'yama-testi' => ['egzama','temas','nikel','sac boyasi','kozmetik'],
      'polen' => ['polen','mevsim','bahar','cimen'],
    ];
    foreach ($anahtar as $slug => $kelimeler) {
      foreach ($kelimeler as $kel) if (mb_strpos($k, $kel) !== false) $puan[$slug] = ($puan[$slug] ?? 0) + 1;
    }
    arsort($puan);
    $sluglar = array_slice(array_keys($puan), 0, 2);
    if (!$sluglar) $sluglar = ['alerji-mi', 'deri-prick-testi'];
    $sluglar[] = 'randevu';
    $sonuc = [
      'mesaj' => 'Anlattıklarınız bir alerji uzmanının değerlendirmesini hak ediyor olabilir. Kesin değerlendirmeyi muayene yapar; şu sayfalar yolunuzu kısaltacaktır:',
      'sluglar' => array_slice(array_unique($sluglar), 0, 3),
    ];
  }

  $kartlar = [];
  foreach ($sonuc['sluglar'] as $s) {
    $kartlar[] = ['baslik' => $SAYFALAR[$s][0], 'url' => $SAYFALAR[$s][1], 'kisa' => $SAYFALAR[$s][2]];
  }
  echo json_encode(['acil' => false, 'mesaj' => $sonuc['mesaj'], 'kartlar' => $kartlar], JSON_UNESCAPED_UNICODE);
  exit;
}

http_response_code(400);
echo '{"hata":"mod"}';
