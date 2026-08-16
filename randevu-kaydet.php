<?php
/* Randevu talebi kaydı — Uzm. Dr. Ramazan Ersoy
   ------------------------------------------------------------
   NEDEN VAR: Formlar bugüne kadar HİÇBİR YERE göndermiyordu.
   site.js gönderimi preventDefault() ile durduruyor, doğruluyor ve
   "talebiniz alındı" kutusunu açıyordu; hasta talebini ilettiğini
   sanıyor, muayenehaneye hiçbir şey ulaşmıyordu.

   AKIŞ: form -> buraya POST (kayıt + e-posta) -> ardından hastanın
   WhatsApp'ı ön-dolu mesajla açılır. İkisi birden: kayıt kaybolmasın,
   muayenehane de anında haberdar olsun.

   KVKK: şikayet alanı SERBEST METİN DEĞİL, sabit seçenek listesidir —
   ayrıntılı tıbbi öykü toplanmaz. Kayıt web kökünün DIŞINA yazılır
   (public_html'in bir üstü), tarayıcıdan erişilemez. Onay kutusu
   zorunludur; onaysız kayıt tutulmaz.
*/

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Cache-Control: no-store');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo '{"hata":"yontem"}'; exit; }

/* — hız sınırı: IP başına saatte 10 talep (chat-api.php ile aynı desen) — */
$ip   = preg_replace('/[^0-9a-f\.\:]/i', '', $_SERVER['REMOTE_ADDR'] ?? 'x');
$kova = sys_get_temp_dir() . '/ersoy-randevu-' . md5($ip) . '-' . date('YmdH');
$adet = (int) @file_get_contents($kova);
if ($adet >= 10) { http_response_code(429); echo '{"hata":"limit"}'; exit; }
@file_put_contents($kova, $adet + 1);

$g = json_decode(file_get_contents('php://input'), true);
if (!is_array($g)) { http_response_code(400); echo '{"hata":"girdi"}'; exit; }

/* Bal küpü: gerçek kullanıcı bu alanı görmez ve doldurmaz; doluysa bot.
   Sessizce başarılı dönülür ki bot yeniden denemesin. */
if (trim((string)($g['website'] ?? '')) !== '') { echo '{"durum":"ok"}'; exit; }

function tek($s, $sinir) { return mb_substr(trim(preg_replace('/\s+/u', ' ', (string)$s)), 0, $sinir); }

$ad  = tek($g['ad'] ?? '', 80);
$tel = preg_replace('/[^0-9+]/', '', (string)($g['tel'] ?? ''));
$kvkk = !empty($g['kvkk']);

/* Şikayet ve gün SABİT LİSTEDEN gelmeli — serbest metin kabul edilmez.
   Böylece hem enjeksiyon hem de istenmeyen sağlık verisi girişi engellenir. */
$SIKAYET = ['', 'Burun akıntısı / tıkanıklık', 'Öksürük / nefes darlığı',
  'Ciltte kaşıntı / kurdeşen', 'Besin alerjisi şüphesi',
  'İlaç alerjisi şüphesi', 'Alerji aşısı hakkında bilgi', 'Diğer'];
$GUN = ['', 'Hafta içi sabah', 'Hafta içi öğleden sonra', 'Cumartesi'];

$sikayet = in_array($g['sikayet'] ?? '', $SIKAYET, true) ? (string)$g['sikayet'] : '';
$gun     = in_array($g['gun'] ?? '', $GUN, true) ? (string)$g['gun'] : '';
$ticari  = !empty($g['ticari']);

$rakam = strlen(preg_replace('/\D/', '', $tel));
if (mb_strlen($ad) < 2 || $rakam < 10 || $rakam > 15 || !$kvkk) {
  http_response_code(400); echo '{"hata":"dogrulama"}'; exit;
}

/* — kayıt: public_html'in DIŞINA, aylık dosyalar hâlinde — */
$dizin = dirname(__DIR__) . '/gizli/randevu';
if (!is_dir($dizin)) @mkdir($dizin, 0700, true);

$kayit = [
  'tarih'   => date('c'),
  'ad'      => $ad,
  'tel'     => $tel,
  'sikayet' => $sikayet,
  'gun'     => $gun,
  'ticari'  => $ticari ? 1 : 0,
  'kaynak'  => tek($g['kaynak'] ?? '', 60),   /* hangi sayfadan geldi */
];
$dosya = $dizin . '/' . date('Y-m') . '.jsonl';
$satir = json_encode($kayit, JSON_UNESCAPED_UNICODE) . "\n";
$yazildi = @file_put_contents($dosya, $satir, FILE_APPEND | LOCK_EX);
/* Dosya varsayılan umask ile 0644 doğuyor; içinde hasta adı ve telefonu var.
   Dizin 0700 olduğu için dışarıdan girilemiyor ama dosyayı da kısıtlıyoruz —
   paylaşımlı barındırmada ikinci kat koruma. Koşulsuz çalışır: yalnız yeni
   dosyada yapılsaydı önceden 0644 doğmuş dosyalar öyle kalırdı. */
if ($yazildi !== false && (@fileperms($dosya) & 0777) !== 0600) @chmod($dosya, 0600);

/* — bildirim e-postası (adres varsa) — */
$cfg = dirname(__DIR__) . '/gizli/randevu-config.php';
if (is_file($cfg)) {
  require $cfg;   /* RANDEVU_EPOSTA tanımlar */
  if (defined('RANDEVU_EPOSTA') && filter_var(RANDEVU_EPOSTA, FILTER_VALIDATE_EMAIL)) {
    $govde = "Yeni randevu talebi\n\n"
      . "Ad Soyad : $ad\n"
      . "Telefon  : $tel\n"
      . "Şikayet  : " . ($sikayet !== '' ? $sikayet : '-') . "\n"
      . "Tercih   : " . ($gun !== '' ? $gun : 'Fark etmez') . "\n"
      . "Bilgi izni: " . ($ticari ? 'evet' : 'hayır') . "\n"
      . "Tarih    : " . date('d.m.Y H:i') . "\n";
    @mail(RANDEVU_EPOSTA, 'Randevu talebi — ' . $ad,
      $govde, "From: site@drramazanersoy.tr\r\nContent-Type: text/plain; charset=UTF-8\r\n");
  }
}

/* Kayıt yazılamasa bile hastayı kaybetmiyoruz: istemci yine de WhatsApp'ı
   açacak. Durumu dönüyoruz ki gerektiğinde teşhis edilebilsin. */
echo json_encode(['durum' => $yazildi === false ? 'kayitsiz' : 'ok'], JSON_UNESCAPED_UNICODE);
