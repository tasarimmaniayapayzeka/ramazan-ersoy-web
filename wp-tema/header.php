<?php
/**
 * Başlık — statik siteden birebir taşındı.
 *
 * MENÜ NEDEN wp_nav_menu DEĞİL: Açılır menüler özel işaretlemeye dayanıyor
 * (.has-drop / .drop / açıklama için <small>) ve site.js bu yapıya göre
 * çalışıyor (mouseenter/focusin, 140 ms gecikmeli kapanma, Escape).
 * WordPress menü sistemi bu yapıyı üretemez; walker yazmak gerekirdi ve
 * panelden yanlışlıkla bozulabilirdi. Menü nadiren değişir, bilerek kodda.
 *
 * YOLLAR: DRRE_KOK sabiti üzerinden. WP şu an /wp-yeni/ altında, içerik
 * sayfaları hâlâ kökteki statik HTML'ler. Yayına geçildiğinde bağlantılar
 * tek yerden çevrilecek.
 */
if (!defined('ABSPATH')) exit;
$k = DRRE_KOK;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<a class="skip-link" href="#icerik">İçeriğe geç</a>

<div class="topbar">
  <div class="wrap">
    <div class="tb-group">
      <span>Nişantaşı, Şişli — İstanbul</span>
      <span>Pzt–Cum 09:00–18:00 · Cmt 09:00–14:00</span>
    </div>
    <div class="tb-group">
      <a href="tel:+902127099396">0212 709 93 96</a>
      <a href="<?php echo esc_url($k . 'en/index.html'); ?>" hreflang="en">EN</a>
    </div>
  </div>
</div>

<header class="site-header">
  <div class="wrap">
    <a class="brand" href="<?php echo esc_url($k); ?>" aria-label="Anasayfa — Uzm. Dr. Ramazan Ersoy">
      <img class="brand-mark" src="<?php echo esc_url($k . 'assets/img/logo-amblem.svg'); ?>" alt=""
           width="58" height="48" decoding="async">
      <span class="brand-text">
        <strong>Uzm. Dr. Ramazan Ersoy</strong>
        <span>Yetişkin Alerji ve İç Hastalıkları Uzmanı</span>
      </span>
    </a>

    <button class="nav-toggle" aria-expanded="false" aria-controls="ana-menu">Menü</button>

    <nav class="nav" id="ana-menu" aria-label="Ana menü">
      <div class="has-drop" data-open="false">
        <button aria-expanded="false">Şikayetler</button>
        <div class="drop">
          <a href="<?php echo esc_url($k); ?>hastaliklar/alerjik-rinit.html">Alerjik Rinit <small>Burun akıntısı, tıkanıklık, hapşırık</small></a>
          <a href="<?php echo esc_url($k); ?>hastaliklar/astim.html">Yetişkinlerde Astım <small>Öksürük, hırıltı, nefes darlığı</small></a>
          <a href="<?php echo esc_url($k); ?>hastaliklar/urtiker.html">Ürtiker (Kurdeşen) <small>Kaşıntılı kabarıklıklar</small></a>
          <a href="<?php echo esc_url($k); ?>hastaliklar/besin-alerjisi.html">Besin Alerjisi <small>Yiyeceklere karşı reaksiyon</small></a>
          <a href="<?php echo esc_url($k); ?>hastaliklar/ilac-alerjisi.html">İlaç Alerjisi <small>İlaç reaksiyonları</small></a>
          <a href="<?php echo esc_url($k); ?>hastaliklar/ari-alerjisi.html">Arı Alerjisi <small>Arı sokması reaksiyonları</small></a>
          <a href="<?php echo esc_url($k); ?>hastaliklar/herediter-anjiyoodem.html">Herediter Anjiyoödem <small>Tekrarlayan kaşıntısız şişlik</small></a>
          <a href="<?php echo esc_url($k); ?>hastaliklar/mastositoz.html">Mastositoz <small>Ani kızarma, ciltte lekeler</small></a>
        </div>
      </div>
      <div class="has-drop" data-open="false">
        <button aria-expanded="false">Testler</button>
        <div class="drop">
          <a href="<?php echo esc_url($k); ?>testler/deri-prick-testi.html">Deri Prick Testi <small>20-30 dk · kanatmaz · 15 dk'da sonuç</small></a>
          <a href="<?php echo esc_url($k); ?>testler/yama-testi.html">Yama Testi <small>Temas alerjisi · 48-72 saat</small></a>
          <a href="<?php echo esc_url($k); ?>testler/spesifik-ige-kan-testi.html">Kan Testi (Spesifik IgE) <small>İlaç kesmeden · moleküler tanı</small></a>
          <a href="<?php echo esc_url($k); ?>testler/solunum-fonksiyon-testi.html">Solunum Fonksiyon Testi <small>Astım tanısı · 10-15 dk</small></a>
          <a href="<?php echo esc_url($k); ?>testler/provokasyon-testleri.html">Provokasyon Testleri <small>Kontrollü doğrulama</small></a>
          <a href="<?php echo esc_url($k); ?>testler/index.html">Tüm testler <small>Yama, IgE, solunum fonksiyon testi</small></a>
        </div>
      </div>
      <a href="<?php echo esc_url($k); ?>tedaviler/alerji-asisi-immunoterapi.html">Alerji Aşısı</a>
      <a href="<?php echo esc_url($k); ?>dr-ramazan-ersoy.html">Doktor</a>
      <a href="<?php echo esc_url($k); ?>alerji-rehberi/index.html">Alerji Rehberi</a>
      <a href="<?php echo esc_url($k); ?>araclar/polen-takvimi.html">Polen Takvimi</a>
      <a href="<?php echo esc_url($k); ?>iletisim.html">İletişim</a>
      <span class="nav-cta"><a class="btn btn--primary btn--sm" href="<?php echo esc_url($k); ?>randevu.html">Randevu Talep Et</a></span>
    </nav>
  </div>
</header>

<main id="icerik">
