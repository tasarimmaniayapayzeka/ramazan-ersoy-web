<?php
/**
 * Tekil içerik şablonu — hastalik / test / tedavi / rehber
 *
 * NEDEN TEK DOSYA: dört içerik tipi aynı iskeleti paylaşıyor
 * (kırıntı → başlık → öne çıkan cevap → görsel → içindekiler →
 * gövde → SSS → künye → CTA). Dört ayrı single-*.php tutmak,
 * ileride birinde yapılan düzeltmenin diğer üçüne taşınmaması
 * demekti. Tipe göre değişen tek şey üst kırıntı ve etiket.
 *
 * SSS burada YAZILMAZ: drre_sss_yaz() çağrılır ve o da şemayla
 * AYNI meta alanından üretir (bkz. inc/sema.php). Tek kaynak.
 */
if (!defined('ABSPATH')) exit;

$k   = DRRE_KOK;
$tip = get_post_type();

/* Tipe göre üst kırıntı ve gözlük etiketi */
$ust = [
    'hastalik' => ['ad' => 'Şikayetler',     'yol' => $k . 'hastaliklar/'],
    'test'     => ['ad' => 'Testler',        'yol' => $k . 'testler/'],
    'tedavi'   => ['ad' => 'Tedaviler',      'yol' => $k . 'tedaviler/'],
    'rehber'   => ['ad' => 'Alerji Rehberi', 'yol' => $k . 'alerji-rehberi/'],
][$tip] ?? ['ad' => 'İçerik', 'yol' => $k];

get_header();

while (have_posts()) : the_post();
    $id   = get_the_ID();
    $ozet = trim((string) get_post_meta($id, 'drre_ozet', true));
?>

<div class="wrap">
  <nav class="crumbs" aria-label="Sayfa yolu">
    <a href="<?php echo esc_url($k); ?>">Anasayfa</a> <span aria-hidden="true">›</span>
    <a href="<?php echo esc_url($ust['yol']); ?>"><?php echo esc_html($ust['ad']); ?></a>
    <span aria-hidden="true">›</span>
    <span aria-current="page"><?php the_title(); ?></span>
  </nav>
</div>

<section class="section section--tight">
  <div class="wrap">
    <p class="eyebrow"><?php echo esc_html($ust['ad']); ?></p>
    <h1><?php the_title(); ?></h1>

    <?php /* Öne çıkan cevap: Google'ın snippet olarak seçmesini hedefleyen
             40-55 kelimelik doğrudan yanıt. speakable şeması da bu bloğu
             işaret ediyor — sesli asistan sayfayı okurken buradan başlar. */ ?>
    <?php if ($ozet) : ?>
      <p class="hero-lede" style="max-width:62ch"><?php echo esc_html($ozet); ?></p>
    <?php endif; ?>

    <div class="btn-row">
      <a class="btn btn--primary" href="<?php echo esc_url($k); ?>randevu.html">Randevu Talep Et</a>
      <a class="btn btn--wa"
         data-wa="Merhaba, <?php echo esc_attr(get_the_title()); ?> hakkında randevu almak istiyorum."
         data-wa-src="<?php echo esc_attr($tip . '-' . get_post_field('post_name', $id)); ?>"
         href="#">WhatsApp'tan yazın</a>
    </div>
  </div>
</section>

<?php if (has_post_thumbnail()) : ?>
<div class="wrap" style="margin-bottom:2rem">
  <figure style="margin:0">
    <?php the_post_thumbnail('full', [
        'style'    => 'width:100%;height:auto;border-radius:var(--r-lg);display:block',
        'loading'  => 'lazy',
        'decoding' => 'async',
    ]); ?>
    <?php /* Görsellerin tamamı yapay zekâ ile üretildi; ifşa her sayfada durur. */ ?>
    <figcaption class="xs muted" style="margin-top:.5rem">Görsel yapay zekâ ile üretilmiştir.</figcaption>
  </figure>
</div>
<?php endif; ?>

<section class="section section--tight" style="padding-top:0">
  <div class="wrap">
    <div class="article-layout">

      <?php
      /* İçindekiler: gövdedeki h2'lerden ÜRETİLİR, elle yazılmaz.
         Statik sitede bu liste elle tutuluyordu ve başlık değişince
         geride kalıyordu. Burada sapması yapısal olarak imkânsız. */
      $govde = apply_filters('the_content', get_the_content());
      if (preg_match_all('/<h2[^>]*id="([^"]+)"[^>]*>(.*?)<\/h2>/is', $govde, $bulunan, PREG_SET_ORDER)) : ?>
        <aside class="toc">
          <h2>İçindekiler</h2>
          <ol>
            <?php foreach ($bulunan as $b) : ?>
              <li><a href="#<?php echo esc_attr($b[1]); ?>"><?php echo esc_html(wp_strip_all_tags($b[2])); ?></a></li>
            <?php endforeach; ?>
            <?php if (drre_sss_ayikla($id)) : ?>
              <li><a href="#sss">Sık sorulan sorular</a></li>
            <?php endif; ?>
          </ol>
        </aside>
      <?php endif; ?>

      <article class="prose">
        <?php echo $govde; ?>
      </article>

    </div>
  </div>
</section>

<?php
/* SSS bloğu — FAQPage şemasıyla aynı meta alanından üretilir */
drre_sss_yaz($id);
?>

<section class="section section--tight" style="padding-top:0">
  <div class="wrap">
    <div class="article-layout">
      <div></div>
      <?php
      /* İçerik künyesi — 12.11.2025/33075 md.5/1-ı gereği zorunlu.
         Statik sitede elle yazıldığı için 26 sayfada donmuştu;
         burada yayın sisteminden gelir, donamaz. */
      $inceleme = get_post_meta($id, 'drre_inceleme', true);
      ?>
      <p class="xs muted" style="border-top:1px solid var(--line);padding-top:1rem">
        Yazan ve tıbbi açıdan gözden geçiren:
        <strong>Uzm. Dr. Ramazan Ersoy</strong> — İç Hastalıkları, Alerji ve Klinik İmmünoloji.<br>
        Son güncelleme: <?php echo esc_html(get_the_modified_date('j F Y')); ?><?php
          if ($inceleme) {
            echo ' · Tıbbi inceleme: ' . esc_html(date_i18n('j F Y', strtotime($inceleme)));
          } ?>.
        İçerik sorumlusu: <a href="<?php echo esc_url($k); ?>iletisim.html">iletişim sayfası</a>.<br>
        Bu sayfa yalnızca bilgilendirme amaçlıdır ve hekim muayenesinin yerine geçmez.
        Tanı ve tedavi kararları kişiye özeldir. Acil durumlarda <a href="tel:112">112</a>'yi arayınız.
      </p>
    </div>
  </div>
</section>

<section class="section section--cream">
  <div class="wrap wrap-narrow center" style="padding-inline:0">
    <p class="eyebrow" style="justify-content:center">Randevu</p>
    <h2>Şikayetinizi bir uzmanla değerlendirelim</h2>
    <p>Randevu talebinize <strong>aynı gün içinde</strong> dönüş yapılır;
       randevunuz sekreterimiz sizinle görüştükten sonra kesinleşir.</p>
    <div class="btn-row" style="justify-content:center;margin:1.5rem 0">
      <a class="btn btn--primary" href="<?php echo esc_url($k); ?>randevu.html">Randevu Talep Et</a>
      <a class="btn btn--ghost" href="tel:+902127099396">0212 709 93 96</a>
    </div>
    <p class="sm muted">Harbiye Mah. Teşvikiye Cad. 37/3 · Şişli / İstanbul (Nişantaşı)</p>
  </div>
</section>

<?php endwhile; get_footer(); ?>
