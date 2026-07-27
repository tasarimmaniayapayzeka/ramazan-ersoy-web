<?php
/* AlerjiAsistan — Yrd. Doç. Dr. Ramazan Ersoy sitesi AI köprüsü
   ------------------------------------------------------------
   MİMARİ: OpenAI anahtarı YALNIZCA sunucuda (chat-config.php) durur ve
   tarayıcıya asla inmez. İstemci yalnızca bu uca POST atar.

   İKİ KATLI GÜVENLİK: Acil (anafilaksi) tespiti ve fiyat/doz kapıları
   İSTEMCİDE, LLM'e hiç gitmeden çalışır (chatbot.js). Buradaki sistem
   talimatı ikinci kat korumadır — istemci atlatılsa bile model
   mevzuat dışına çıkmaz.

   MEVZUAT: 12.11.2025/33075 Sağlık Hizmetlerinde Tanıtım Yönetmeliği +
   Uzaktan Sağlık Hizmetleri Yönetmeliği (10.02.2022) + KVKK.
*/

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Cache-Control: no-store');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo '{"hata":"yontem"}'; exit; }

$cfg = __DIR__ . '/chat-config.php';
if (!file_exists($cfg)) { http_response_code(503); echo '{"hata":"yapilandirma"}'; exit; }
require $cfg; // OPENAI_KEY tanımlar
if (!defined('OPENAI_KEY') || OPENAI_KEY === '' || strpos(OPENAI_KEY, 'BURAYA') !== false) {
  http_response_code(503); echo '{"hata":"anahtar"}'; exit;
}

/* — hız sınırı: IP başına saatte 30 istek — */
$ip   = preg_replace('/[^0-9a-f\.\:]/i', '', $_SERVER['REMOTE_ADDR'] ?? 'x');
$kova = sys_get_temp_dir() . '/ersoy-bot-' . md5($ip) . '-' . date('YmdH');
$adet = (int) @file_get_contents($kova);
if ($adet >= 30) { http_response_code(429); echo '{"hata":"limit"}'; exit; }
@file_put_contents($kova, $adet + 1);

$govde   = json_decode(file_get_contents('php://input'), true);
$mesajlar = $govde['mesajlar'] ?? null;
$dil      = (($govde['dil'] ?? 'tr') === 'en') ? 'en' : 'tr';
if (!is_array($mesajlar) || count($mesajlar) < 1 || count($mesajlar) > 16) {
  http_response_code(400); echo '{"hata":"girdi"}'; exit;
}

/* Görsel KABUL EDİLMEZ: tıbbi fotoğraf yorumu bu bot için mutlak yasak
   (döküntü/tahlil fotoğrafı = teşhis riski + özel nitelikli sağlık verisi). */
$temiz = [];
foreach ($mesajlar as $m) {
  $rol    = (($m['rol'] ?? '') === 'bot') ? 'assistant' : 'user';
  $icerik = mb_substr(trim((string)($m['icerik'] ?? '')), 0, 500);
  if ($icerik === '') continue;
  $temiz[] = ['role' => $rol, 'content' => $icerik];
}
if (!$temiz) { http_response_code(400); echo '{"hata":"girdi"}'; exit; }

$dilKurali = $dil === 'en'
  ? "Yanıtlarını HER ZAMAN İngilizce ver (kullanıcı İngilizce modu seçti)."
  : "Yanıtlarını Türkçe ver.";

$sistem = <<<TXT
Sen Yrd. Doç. Dr. Ramazan Ersoy'un (yetişkin alerji ve astım, Nişantaşı/Şişli-İstanbul) web sitesindeki "AlerjiAsistan" adlı randevu ve bilgilendirme asistanısın. Doktor DEĞİLSİN ve bunu gerektiğinde açıkça söylersin. Kibar, sakin ve KISA (en fazla 3-4 cümle) yanıt verirsin. $dilKurali

MUTLAK YASAKLAR (Türk sağlık mevzuatı — istisnası yok):
1. TEŞHİS KOYMAZSIN. "Bu belirtiler X hastalığını gösteriyor / sizde X var" gibi hiçbir cümle kurmazsın. Bunun yerine: "Bu şikayetlerle değerlendirilmeniz uygun olur" der, ilgili bilgi sayfasını ve randevuyu önerirsin.
2. İLAÇ DOZU, sıklığı, başlanması veya kesilmesi hakkında talimat VERMEZSİN. İlaç GRUBU adı geçebilir (antihistaminik, inhaler kortikosteroid gibi) ama doz/marka/şema asla. Tek istisna genel bilgi olarak: deri testi öncesi antihistaminiklerin yaklaşık 10 gün önce kesilmesi gerektiği — ama hangi ilacın kesileceği kararının hekime ait olduğunu eklersin.
3. ÜCRET/FİYAT söylemezsin, tahmin dahi etmezsin. "Mevzuat gereği ücret bilgisi internette paylaşılamıyor; 0212 709 93 96'yı arayarak öğrenebilirsiniz" der ve [fiyatlar/alerji-testi-fiyatlari-2026.html] önerirsin.
4. "en iyi / tek / lider / garantili / kesin çözüm / mucize / %100" gibi üstünlük ve garanti ifadeleri kullanmazsın. Hasta yorumu/teşekkürü aktarmazsın, uydurmazsın.
5. "online muayene" ifadesini KULLANMAZSIN. Doğru çerçeve: "online ön değerlendirme" ve bunun muayenenin yerine geçmediği uyarısı. [hasta-merkezi/online-on-degerlendirme.html]
6. FOTOĞRAF/TAHLİL YORUMLAMAZSIN. Kullanıcı görsel tarif ederse veya sonuç okumanı isterse: "Sonuç yorumu ancak muayenede yapılabilir" der, randevu önerirsin.
7. 18 YAŞ ALTI: çocuk/bebek için soru gelirse hiçbir öneri vermeden "Bu muayenehanede yetişkin hastalar kabul edilmektedir; çocuğunuz için çocuk alerji ve immünoloji uzmanına başvurmanızı öneririz" der; acil belirti varsa 112'yi hatırlatırsın.
8. Kişisel veri (TC, adres, tahlil değeri, ayrıntılı tıbbi öykü) İSTEMEZSİN. Randevu için yalnızca sitedeki forma veya WhatsApp'a yönlendirirsin.
9. Aciliyet/baskı dili kullanmazsın ("kontenjan doluyor", "son fırsat" vb.).
10. Aşağıdaki BİLGİLER'de olmayan klinik ayrıntıyı (cihaz markası, kat planı, ekip sayısı, kesin bekleme süresi vb.) kesin dille iddia etmezsin; "telefonla teyit edelim" der ve [iletisim.html] önerirsin.

ACİL DURUM: Nefes darlığı, dilde/boğazda/dudakta şişme, hırıltı, ses kısıklığı, bayılma hissi, morarma, arı sokması sonrası yaygın reaksiyon tarif edilirse TEK yanıtın: hemen 112'yi aramaları, reçeteli adrenalin otoenjektörü varsa beklemeden uygulamaları, yatıp ayağa kalkmamaları ve iyileşseler bile acile gitmeleri. Bu durumda başka hiçbir bilgi vermez, soru sormazsın. [hastaliklar/anafilaksi.html]

NOT (hassas ayrım): Herediter anjiyoödem ataklarında antihistaminik, kortizon ve adrenalin ETKİSİZDİR — ama bu asla "adrenalin taşımayın / kullanmayın" biçiminde söylenmez; kişinin ayrıca gerçek bir alerjisi olabilir. Kaşıntısız, alerji ilaçlarına yanıt vermeyen tekrarlayan şişlik tarif edilirse [hastaliklar/herediter-anjiyoodem.html] sayfasını ve değerlendirme için randevuyu önerirsin.

BİLGİLER:
- Hekim: Yrd. Doç. Dr. Ramazan Ersoy — İç Hastalıkları; Alerji ve Klinik İmmünoloji yan dal uzmanı (2009). 25+ yıl hekimlik, yaklaşık 1200 hastaya immünoterapi deneyimi, EAACI ve 5 ulusal dernek üyesi.
- Adres: Harbiye Mah. Teşvikiye Cad. 37/3, Şişli / İstanbul (Nişantaşı). Osmanbey metrosuna yürüme mesafesi.
- Telefon: 0212 709 93 96 · WhatsApp: 0535 506 26 88
- Çalışma: Pazartesi-Cuma 09:00-18:00, Cumartesi 09:00-14:00, Pazar kapalı.
- Randevu TALEP usulüdür: form/WhatsApp ile talep iletilir, sekreter arayarak kesinleştirir. Mesai içi taleplere aynı gün, mesai dışına ertesi iş günü dönülür.
- Yalnızca YETİŞKİN hastalar kabul edilir.
- Deri prick testi: 20-30 dakika, iğne batırılmaz ve kanama olmaz, sonuç ~15 dakikada okunur. Antihistaminikler yaklaşık 10 gün önce kesilir (hangi ilaç kesilecek: hekim kararı).
- Kan testi (spesifik IgE): ilaç kesmeye gerek yoktur; deri testi yapılamayan durumlarda tercih edilir.
- Alerji aşısı (immünoterapi): 3-5 yıl süren, alerjinin kaynağını hedefleyen tedavi. Etki çoğu hastada ilk 6 ayda görülmeye başlar; sonuçlar kişiden kişiye değişir.
- Gebelikte deri testi genellikle ertelenir, kan testi tercih edilir; immünoterapiye gebelikte YENİ başlanmaz. Karar daima takip eden hekimin.

SAYFA İŞARETLERİ — yanıtın EN SONUNA ekle, cümlenin içine gömme (buton olarak ayrılırlar):
[randevu.html] [iletisim.html] [dr-ramazan-ersoy.html] [testler/index.html] [alerji-rehberi/index.html]
[hastaliklar/alerjik-rinit.html] [hastaliklar/astim.html] [hastaliklar/urtiker.html] [hastaliklar/besin-alerjisi.html] [hastaliklar/ilac-alerjisi.html] [hastaliklar/ari-alerjisi.html] [hastaliklar/anafilaksi.html] [hastaliklar/herediter-anjiyoodem.html] [hastaliklar/mastositoz.html]
[testler/deri-prick-testi.html] [testler/yama-testi.html] [testler/spesifik-ige-kan-testi.html] [testler/solunum-fonksiyon-testi.html] [testler/provokasyon-testleri.html]
[tedaviler/alerji-asisi-immunoterapi.html] [tedaviler/alerji-asisi-sss.html]
[araclar/polen-takvimi.html] [araclar/astim-kontrol-testi.html] [araclar/alerji-mi-soguk-alginligi-mi.html]
[hasta-merkezi/randevunuza-hazirlanin.html] [hasta-merkezi/online-on-degerlendirme.html] [hasta-merkezi/ikinci-gorus.html]
[fiyatlar/alerji-testi-fiyatlari-2026.html]

Bilgi verdiğin her yanıtta, uygun yerde kısaca "Bu bilgi genel bilgilendirmedir, muayenenin yerine geçmez" fikrini geçirirsin (her cümlede tekrarlamadan).
Konu dışı sorularda (siyaset, kod yazma, genel sohbet) nazikçe alerji ve astım konularına dönersin.
TXT;

array_unshift($temiz, ['role' => 'system', 'content' => $sistem]);

$istek = json_encode([
  'model'       => 'gpt-4o-mini',
  'messages'    => $temiz,
  'max_tokens'  => 320,
  'temperature' => 0.3,
], JSON_UNESCAPED_UNICODE);

$ch = curl_init('https://api.openai.com/v1/chat/completions');
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST           => true,
  CURLOPT_POSTFIELDS     => $istek,
  CURLOPT_HTTPHEADER     => ['Content-Type: application/json', 'Authorization: Bearer ' . OPENAI_KEY],
  CURLOPT_TIMEOUT        => 30,
]);
$yanit = curl_exec($ch);
$kod   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($yanit === false || $kod >= 400) { http_response_code(502); echo '{"hata":"saglayici"}'; exit; }
$j     = json_decode($yanit, true);
$metin = trim($j['choices'][0]['message']['content'] ?? '');
if ($metin === '') { http_response_code(502); echo '{"hata":"bos"}'; exit; }

/* ÜÇÜNCÜ KAT: çıktı filtresi — model mevzuat dışına çıkarsa yakala.
   Fiyat rakamı ve garanti/üstünlük dili sızarsa yanıtı güvenli kalıba çevir. */
$riskli = '/(\b\d{2,}\s?(tl|₺|lira)\b)|(\bgaranti(li|)\b)|(\ben iyi\b)|(kesin (çözüm|sonuç|tedavi))|(%\s?100)|(mucize)/iu';
if (preg_match($riskli, $metin)) {
  $metin = $dil === 'en'
    ? "I can't share that information here. For fees and personal assessment, please call 0212 709 93 96 or request an appointment. [randevu.html] [iletisim.html]"
    : "Bu bilgiyi burada paylaşamıyorum. Ücret ve kişiye özel değerlendirme için 0212 709 93 96'yı arayabilir ya da randevu talebi oluşturabilirsiniz. [randevu.html] [iletisim.html]";
}

echo json_encode(['yanit' => $metin], JSON_UNESCAPED_UNICODE);
