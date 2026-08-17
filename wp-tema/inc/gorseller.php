<?php
/**
 * Görsel yönetimi — Ayarlar → Görseller
 *
 * Sitenin sabit-adresli anahtar görselleri (portre, hero, paylaşım kartı)
 * panelden değiştirilir. Yüklenen dosya slota göre yeniden boyutlandırılır
 * ve HEP AYNI dosya adına yazılır — şablonlara dokunmak gerekmez, önbellek
 * kırıcı sürüm damgası otomatik artar.
 *
 * İçerik sayfası görselleri BURADA DEĞİL: her yazının kendi "Öne çıkan
 * görsel" alanından değiştirilir (WP standardı, slug-sözleşmeli varsayılanı
 * ezer). Video kapakları da Ayarlar → Videolar kaydında otomatik iner.
 */
if (!defined('ABSPATH')) exit;

/** Slot tanımları: ad → [etiket, hedef genişlik, hedef yükseklik(0=serbest), açıklama] */
function drre_gorsel_slotlari() {
    return [
        'portre' => ['Doktor portresi (Merhaba bölümü)', 900, 900,
            'Kare kırpılır. Anasayfadaki "Merhaba, ben Dr. Ramazan Ersoy" bölümünde görünür.'],
        'hero' => ['Hero görseli (anasayfa üst)', 1080, 1920,
            'Dikey 9:16 kırpılır. Boş bırakılırsa tanışma videosunun kapağı kullanılır.'],
        'og' => ['Paylaşım kartı (WhatsApp/sosyal önizleme)', 1200, 630,
            'Site linki paylaşıldığında görünen yatay kart.'],
    ];
}

/** Slot → hedef dosya yolları (uzantısız kök) */
function drre_gorsel_hedefi($slot) {
    $kok = dirname(ABSPATH);
    $harita = [
        'portre' => $kok . '/assets/img/dr-ersoy-portre',
        'hero'   => $kok . '/assets/img/hero-ozel',
        'og'     => $kok . '/assets/img/og',   /* og.jpg — mevcut adres korunur */
    ];
    return $harita[$slot] ?? null;
}

add_action('admin_menu', function () {
    add_options_page('Görseller', 'Görseller', 'manage_options', 'drre-gorseller', 'drre_gorsel_sayfasi');
});

function drre_gorsel_sayfasi() {
    if (!current_user_can('manage_options')) return;

    $mesaj = '';
    if (!empty($_POST['drre_gorsel_slot']) && check_admin_referer('drre_gorsel_yukle')) {
        $slot = sanitize_key($_POST['drre_gorsel_slot']);
        $mesaj = drre_gorsel_isle($slot);
    }

    $slotlar = drre_gorsel_slotlari();
    ?>
    <div class="wrap">
      <h1>Görseller</h1>
      <p>Görsel seçin, "Yükle"ye basın — slota göre otomatik kırpılır ve site anında güncellenir.
         Yüksek çözünürlüklü, yatay/dikey fark etmeksizin fotoğraf yükleyebilirsiniz.</p>
      <?php if ($mesaj) echo '<div class="notice notice-info"><p>' . esc_html($mesaj) . '</p></div>'; ?>

      <?php foreach ($slotlar as $slot => [$etiket, $g, $y, $aciklama]) :
          $hedef = drre_gorsel_hedefi($slot);
          $varJpg = file_exists($hedef . '.jpg');
          $onizleme = $varJpg ? str_replace(dirname(ABSPATH), '', $hedef) . '.jpg?v=' . filemtime($hedef . '.jpg') : '';
      ?>
      <div style="border:1px solid #dcdcde;border-radius:8px;padding:16px 20px;margin:14px 0;max-width:720px;background:#fff">
        <h2 style="margin:0 0 4px"><?php echo esc_html($etiket); ?></h2>
        <p style="margin:0 0 10px;color:#646970"><?php echo esc_html($aciklama); ?>
           Hedef boyut: <?php echo (int) $g; ?>×<?php echo (int) $y; ?>.</p>
        <?php if ($onizleme) : ?>
          <img src="<?php echo esc_url($onizleme); ?>" alt=""
               style="max-width:180px;max-height:180px;border-radius:6px;display:block;margin-bottom:10px">
        <?php else : ?>
          <p style="color:#646970"><em>Henüz yüklenmemiş — şablon varsayılanı kullanılıyor.</em></p>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
          <?php wp_nonce_field('drre_gorsel_yukle'); ?>
          <input type="hidden" name="drre_gorsel_slot" value="<?php echo esc_attr($slot); ?>">
          <input type="file" name="drre_gorsel_dosya" accept="image/jpeg,image/png,image/webp" required>
          <?php submit_button('Yükle', 'primary', 'submit', false); ?>
        </form>
      </div>
      <?php endforeach; ?>
    </div>
    <?php
}

/** Yüklemeyi işler: doğrula → slot boyutuna kırp → jpg (+webp) yaz. */
function drre_gorsel_isle($slot) {
    $slotlar = drre_gorsel_slotlari();
    if (!isset($slotlar[$slot])) return 'Bilinmeyen alan.';
    if (empty($_FILES['drre_gorsel_dosya']['tmp_name'])) return 'Dosya seçilmedi.';

    $dosya = $_FILES['drre_gorsel_dosya'];
    if (!empty($dosya['error'])) return 'Yükleme hatası (kod ' . (int) $dosya['error'] . ').';

    $tur = wp_check_filetype_and_ext($dosya['tmp_name'], $dosya['name']);
    if (empty($tur['ext']) || !in_array($tur['ext'], ['jpg', 'jpeg', 'png', 'webp'], true)) {
        return 'Yalnızca JPG, PNG ya da WebP yükleyin.';
    }

    [$etiket, $g, $y] = $slotlar[$slot];
    $hedef = drre_gorsel_hedefi($slot);

    $editor = wp_get_image_editor($dosya['tmp_name']);
    if (is_wp_error($editor)) return 'Görsel açılamadı: ' . $editor->get_error_message();

    /* slot boyutuna ORANLI kırp (crop=true → taşan kenarlar atılır) */
    $editor->resize($g, $y, true);

    $j = $editor->save($hedef . '.jpg', 'image/jpeg');
    if (is_wp_error($j)) return 'Kaydedilemedi: ' . $j->get_error_message();

    /* webp destekleniyorsa onu da yaz (şablonlar önce webp'e bakar) */
    $editor2 = wp_get_image_editor($hedef . '.jpg');
    if (!is_wp_error($editor2)) {
        $w = $editor2->save($hedef . '.webp', 'image/webp');
        if (is_wp_error($w)) @unlink($hedef . '.webp'); /* jpg tek başına yeter */
    }

    return $etiket . ' güncellendi — sitede anında görünür.';
}
