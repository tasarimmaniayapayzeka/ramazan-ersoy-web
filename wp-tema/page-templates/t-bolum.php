<?php
/**
 * Template Name: Bölüm listesi
 * araclar/ ve hasta-merkezi/ ebeveyn sayfaları: çocuk sayfaları kartlarla listeler.
 * (Statik sitede bu adresler 404'tü; devirle kazanılmış ara sayfalar.)
 */
if (!defined('ABSPATH')) exit;
get_header();
$cocuklar = get_pages(['parent' => get_the_ID(), 'sort_column' => 'menu_order,post_title']);
?>
<main id="icerik">
<section class="section">
  <div class="wrap">
    <div class="section-head">
      <h1><?php the_title(); ?></h1>
    </div>
    <div class="grid-2">
      <?php foreach ($cocuklar as $c) : ?>
        <a class="tool-card" href="<?php echo esc_url(get_permalink($c)); ?>">
          <h3><?php echo esc_html($c->post_title); ?></h3>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</main>
<?php get_footer(); ?>
