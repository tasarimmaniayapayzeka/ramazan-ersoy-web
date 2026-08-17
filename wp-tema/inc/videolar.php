<?php
/**
 * Video yönetimi — Ayarlar → Videolar
 *
 * Kartlardaki videolar panelden değiştirilebilir: her kartın sabit bir
 * anahtarı var, YouTube linki yapıştırılır, kayıt sırasında video KİMLİĞİ
 * ayıklanıp saklanır. Boş bırakılan alan varsayılana (17 Ağu 2026'da
 * kanaldan eşleştirilen liste) düşer.
 *
 * Şablonlar drre_video('anahtar') çağırır — panel > varsayılan sırası.
 */
if (!defined('ABSPATH')) exit;

/** Kart anahtarı → [etiket, varsayılan YouTube ID] */
function drre_video_tanimlari() {
    return [
        'tanisma'        => ['Tanışma videosu (hero)', 'pMxCCGR86Po'],
        'neye-bakar'     => ['Yetişkin alerji uzmanı neye bakar?', 'b4gM8bPd4ao'],
        'ne-zaman'       => ['Ne zaman doktora başvurmalıyız?', 'P6ksVuCXZQs'],
        'muayene'        => ['Muayene süreci nasıl ilerler?', 'zO8t9mkWcFI'],
        'testler'        => ['Alerji testleri nedir, nasıl yapılır?', 's1uHCixSa38'],
        'sikayetim-yok'  => ['Şikayetim yok, test yaptırmalı mıyım?', 'w8QPcBg9kUM'],
        'alerjik-astim'  => ['Alerjik astım nedir?', 'lVL4awdjuwM'],
        'nefes-darligi'  => ['Her nefes darlığı astım mıdır?', 'Za2qrG1CkSE'],
        'atopik'         => ['Atopik dermatit ve mezoterapi', 'yDVpLkwEumE'],
        'botulinum'      => ['Botulinum toksin ve alerji', 'qn2yFmpNci0'],
    ];
}

/** Şablonların kullandığı tek kapı */
function drre_video($anahtar) {
    $tanim = drre_video_tanimlari();
    if (!isset($tanim[$anahtar])) return '';
    $kayit = get_option('drre_videolar', []);
    $id = isset($kayit[$anahtar]) ? trim((string) $kayit[$anahtar]) : '';
    return $id !== '' ? $id : $tanim[$anahtar][1];
}

/** YouTube linkinden kimlik ayıkla (watch?v= / youtu.be/ / shorts/ / embed/) */
function drre_video_id_ayikla($girdi) {
    $girdi = trim((string) $girdi);
    if ($girdi === '') return '';
    if (preg_match('~^[A-Za-z0-9_-]{6,20}$~', $girdi)) return $girdi;  /* zaten ID */
    if (preg_match('~(?:v=|youtu\.be/|shorts/|embed/)([A-Za-z0-9_-]{6,20})~', $girdi, $e)) {
        return $e[1];
    }
    return '';
}

/* ---------- Ayar sayfası ---------- */
add_action('admin_menu', function () {
    add_options_page('Videolar', 'Videolar', 'manage_options', 'drre-videolar', 'drre_video_sayfasi');
});

add_action('admin_init', function () {
    register_setting('drre_videolar_grubu', 'drre_videolar', [
        'type' => 'array',
        'sanitize_callback' => function ($girdi) {
            $temiz = [];
            foreach (drre_video_tanimlari() as $anahtar => $t) {
                $temiz[$anahtar] = drre_video_id_ayikla($girdi[$anahtar] ?? '');
            }
            /* yeni girilen videonun kapagini kendi sunucumuza indir —
               ziyaretci tarayicisi i.ytimg'e hic gitmesin (KVKK durusu) */
            foreach ( as ) {
                if () drre_video_kapak_indir();
            }
            return ;
        },
    ]);
});

function drre_video_sayfasi() {
    if (!current_user_can('manage_options')) return;
    $kayit = get_option('drre_videolar', []);
    ?>
    <div class="wrap">
      <h1>Videolar</h1>
      <p>YouTube linkini olduğu gibi yapıştırın (Shorts linki de olur) — kayıt sırasında
         video kimliği kendiliğinden ayıklanır. <strong>Boş bırakılan alan varsayılan
         videoya döner.</strong> Değişiklik anında sitede görünür.</p>
      <form method="post" action="options.php">
        <?php settings_fields('drre_videolar_grubu'); ?>
        <table class="form-table" role="presentation">
          <?php foreach (drre_video_tanimlari() as $anahtar => [$etiket, $varsayilan]) :
              $deger = $kayit[$anahtar] ?? ''; ?>
            <tr>
              <th scope="row"><label for="dv-<?php echo esc_attr($anahtar); ?>"><?php echo esc_html($etiket); ?></label></th>
              <td>
                <input type="text" class="regular-text" id="dv-<?php echo esc_attr($anahtar); ?>"
                       name="drre_videolar[<?php echo esc_attr($anahtar); ?>]"
                       value="<?php echo esc_attr($deger); ?>"
                       placeholder="varsayılan: https://www.youtube.com/shorts/<?php echo esc_attr($varsayilan); ?>">
                <p class="description">Şu an oynayan:
                  <a href="https://www.youtube.com/shorts/<?php echo esc_attr(drre_video($anahtar)); ?>" target="_blank" rel="noopener">
                    <?php echo esc_html(drre_video($anahtar)); ?></a></p>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
        <?php submit_button('Kaydet'); ?>
      </form>
    </div>
    <?php
}

/** Kapagi assets/img/video/{id}.jpg olarak indirir (varsa dokunmaz). */
function drre_video_kapak_indir() {
     = dirname(ABSPATH) . '/assets/img/video/' .  . '.jpg';
    if (file_exists()) return;
    foreach (['oar2', 'maxresdefault', 'hqdefault'] as ) {
         = wp_remote_get('https://i.ytimg.com/vi/' .  . '/' .  . '.jpg', ['timeout' => 8]);
        if (!is_wp_error() && wp_remote_retrieve_response_code() === 200) {
            @file_put_contents(, wp_remote_retrieve_body());
            return;
        }
    }
}
