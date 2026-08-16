<?php
/**
 * Genel şablon — WordPress bir sayfa için daha özel bir şablon
 * bulamazsa buraya düşer. Yazı listesi ve tekil yazı için ortak.
 *
 * Tasarım sınıfları statik siteyle AYNI (.section, .wrap, .article-layout,
 * .card) — böylece site.css ek kural gerektirmeden çalışır.
 */
if (!defined('ABSPATH')) exit;
get_header();
?>

<section class="section">
  <div class="wrap-narrow">

    <?php if (is_singular()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article class="article-layout">
          <p class="eyebrow"><?php echo esc_html(get_the_date('j F Y')); ?></p>
          <h1><?php the_title(); ?></h1>
          <div class="prose"><?php the_content(); ?></div>

          <?php /* İçerik künyesi — 12.11.2025/33075 md.5/1-ı: bilgilendirme
                   içeriğinde son güncelleme tarihi ve sorumlusu bulunmalı.
                   Statik sitede bu elle yazılıyordu ve 26 sayfada DONMUŞTU;
                   burada yayın sisteminden otomatik geliyor, donamaz. */ ?>
          <p class="xs muted" style="margin-top:2rem;border-top:1px solid var(--line);padding-top:1rem">
            Yazan / tıbbi inceleme: <strong>Uzm. Dr. Ramazan Ersoy</strong> —
            İç Hastalıkları, Alerji ve Klinik İmmünoloji<br>
            Son güncelleme: <?php echo esc_html(get_the_modified_date('j F Y')); ?><br>
            Bu içerik bilgilendirme amaçlıdır, hekim muayenesinin yerine geçmez.
          </p>
        </article>
      <?php endwhile; ?>

    <?php elseif (have_posts()) : ?>
      <div class="section-head">
        <p class="eyebrow">Alerji Rehberi</p>
        <h1><?php echo esc_html(is_archive() ? get_the_archive_title() : 'Yazılar'); ?></h1>
      </div>
      <div class="grid-3">
        <?php while (have_posts()) : the_post(); ?>
          <article class="card">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="sm muted"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
          </article>
        <?php endwhile; ?>
      </div>
      <?php the_posts_pagination(['mid_size' => 1, 'prev_text' => '←', 'next_text' => '→']); ?>

    <?php else : ?>
      <div class="section-head">
        <h1>İçerik bulunamadı</h1>
        <p>Aradığınız sayfa taşınmış ya da kaldırılmış olabilir.
           <a href="<?php echo esc_url(DRRE_KOK); ?>">Anasayfaya dönün</a>.</p>
      </div>
    <?php endif; ?>

  </div>
</section>

<?php get_footer(); ?>
