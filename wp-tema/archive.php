<?php
/**
 * Liste şablonu — /hastaliklar/ · /testler/ · /tedaviler/ · /alerji-rehberi/
 *
 * Bu sayfalar SEO'da "pillar" işini görür: alt sayfalara bağ dağıtır ve
 * ziyaretçiyi doğru başlığa yönlendirir. Bu yüzden salt link listesi
 * değil, her kayıt için öne çıkan cevabın ilk cümlesini de gösteriyoruz.
 */
if (!defined('ABSPATH')) exit;

$tip = get_post_type() ?: get_query_var('post_type');
$giris = [
    'hastalik' => 'Yetişkinlerde en sık karşılaştığımız alerjik şikayetler ve hastalıklar.',
    'test'     => 'Alerji tanısında kullanılan testler: hangisi ne zaman, nasıl uygulanır.',
    'tedavi'   => 'Şikayeti bastırmakla yetinmeyip nedene yönelen tedavi seçenekleri.',
    'rehber'   => 'Günlük hayatta işinize yarayacak, uygulanabilir alerji rehberleri.',
][$tip] ?? '';

get_header();
?>

<section class="section">
  <div class="wrap">
    <div class="section-head">
      <p class="eyebrow"><?php echo esc_html(post_type_archive_title('', false)); ?></p>
      <h1><?php echo esc_html(post_type_archive_title('', false)); ?></h1>
      <?php if ($giris) : ?><p class="hero-lede" style="max-width:62ch"><?php echo esc_html($giris); ?></p><?php endif; ?>
    </div>

    <?php if (have_posts()) : ?>
      <div class="grid-3">
        <?php while (have_posts()) : the_post();
          $ozet = trim((string) get_post_meta(get_the_ID(), 'drre_ozet', true));
          if ($ozet === '') $ozet = wp_strip_all_tags(get_the_excerpt());
          /* İlk cümle yeter: kart içinde uzun metin okunmuyor, tıklamayı azaltıyor */
          $ilk = preg_split('/(?<=[.!?])\s+/u', $ozet)[0] ?? $ozet;
        ?>
          <a class="tool-card" href="<?php the_permalink(); ?>">
            <h3><?php the_title(); ?></h3>
            <p><?php echo esc_html(wp_trim_words($ilk, 26)); ?></p>
          </a>
        <?php endwhile; ?>
      </div>
      <?php the_posts_pagination(['mid_size' => 1, 'prev_text' => '←', 'next_text' => '→']); ?>

    <?php else : ?>
      <p>Bu bölümde henüz içerik yayımlanmadı.</p>
    <?php endif; ?>
  </div>
</section>

<section class="section section--cream">
  <div class="wrap wrap-narrow center" style="padding-inline:0">
    <h2>Aradığınızı bulamadınız mı?</h2>
    <p>Şikayetinizi kısaca yazın, hangi başlığın size uyduğunu birlikte belirleyelim.</p>
    <div class="btn-row" style="justify-content:center;margin:1.5rem 0">
      <a class="btn btn--primary" href="<?php echo esc_url(DRRE_KOK); ?>randevu.html">Randevu Talep Et</a>
      <a class="btn btn--ghost" href="tel:+902127099396">0212 709 93 96</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
