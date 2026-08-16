<?php
/**
 * Alt bilgi — statik siteden birebir taşındı.
 * Mevzuat kalkanı (.legal-shield) ve mobil sticky bar dahil; bunlar
 * her sayfada bulunmak zorunda olduğu için temaya gömülü.
 */
if (!defined('ABSPATH')) exit;
$k = DRRE_KOK;
?>
</main>

<footer class="site-footer">
  <div class="wrap">
    <div class="footer-grid">
      <div>
        <h4>Uzm. Dr. Ramazan Ersoy</h4>
        <p>Yetişkin Alerji ve Astım<br>İç Hastalıkları, Alerji ve Klinik İmmünoloji</p>
        <p>Harbiye Mah. Teşvikiye Cad. 37/3<br>Şişli / İstanbul</p>
        <p><a href="tel:+902127099396">0212 709 93 96</a></p>
        <p>WhatsApp: <a data-wa="Merhaba, randevu hakkında bilgi almak istiyorum." data-wa-src="footer-wa" href="#">0535 506 26 88</a></p>
      </div>
      <div>
        <h4>Şikayetler</h4>
        <ul>
          <li><a href="<?php echo esc_url($k); ?>hastaliklar/alerjik-rinit.html">Alerjik Rinit</a></li>
          <li><a href="<?php echo esc_url($k); ?>hastaliklar/astim.html">Astım</a></li>
          <li><a href="<?php echo esc_url($k); ?>hastaliklar/urtiker.html">Ürtiker</a></li>
          <li><a href="<?php echo esc_url($k); ?>hastaliklar/besin-alerjisi.html">Besin Alerjisi</a></li>
          <li><a href="<?php echo esc_url($k); ?>hastaliklar/ilac-alerjisi.html">İlaç Alerjisi</a></li>
          <li><a href="<?php echo esc_url($k); ?>hastaliklar/ari-alerjisi.html">Arı Alerjisi</a></li>
          <li><a href="<?php echo esc_url($k); ?>hastaliklar/herediter-anjiyoodem.html">Herediter Anjiyoödem</a></li>
          <li><a href="<?php echo esc_url($k); ?>hastaliklar/mastositoz.html">Mastositoz</a></li>
        </ul>
      </div>
      <div>
        <h4>Testler &amp; Tedavi</h4>
        <ul>
          <li><a href="<?php echo esc_url($k); ?>testler/deri-prick-testi.html">Deri Prick Testi</a></li>
          <li><a href="<?php echo esc_url($k); ?>testler/index.html">Tüm testler</a></li>
          <li><a href="<?php echo esc_url($k); ?>tedaviler/alerji-asisi-immunoterapi.html">Alerji Aşısı</a></li>
          <li><a href="<?php echo esc_url($k); ?>tedaviler/alerji-asisi-sss.html">Aşı hakkında SSS</a></li>
        </ul>
      </div>
      <div>
        <h4>Hasta merkezi</h4>
        <ul>
          <li><a href="<?php echo esc_url($k); ?>randevu.html">Randevu talebi</a></li>
          <li><a href="<?php echo esc_url($k); ?>hasta-merkezi/randevunuza-hazirlanin.html">Randevunuza hazırlanın</a></li>
          <li><a href="<?php echo esc_url($k); ?>araclar/astim-kontrol-testi.html">Astım Kontrol Testi</a></li>
          <li><a href="<?php echo esc_url($k); ?>araclar/alerji-mi-soguk-alginligi-mi.html">Alerji mi Soğuk Algınlığı mı?</a></li>
          <li><a href="<?php echo esc_url($k); ?>araclar/video-kutuphanesi.html">Video Kütüphanesi</a></li>
        </ul>
      </div>
    </div>
    <p class="legal-shield">
      Bu site sağlık hizmeti vermemektedir; içerik yalnızca bilgilendirme amaçlıdır ve hekim muayenesinin yerine geçmez.
      Tanı ve tedavi için hekiminize başvurunuz. Acil durumlarda 112'yi arayınız.
    </p>
    <div class="footer-legal">
      <span>© <?php echo esc_html(date('Y')); ?> Uzm. Dr. Ramazan Ersoy · Tüm hakları saklıdır.</span>
      <span>
        <a href="<?php echo esc_url($k); ?>kvkk-aydinlatma.html">KVKK Aydınlatma</a> ·
        <a href="<?php echo esc_url($k); ?>cerez-politikasi.html">Çerez Politikası</a> ·
        <a href="<?php echo esc_url($k); ?>yasal-uyari.html">Yasal Uyarı</a>
      </span>
    </div>
  </div>
</footer>

<nav class="sticky-bar" aria-label="Hızlı iletişim">
  <a href="tel:+902127099396">
    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.6 10.8a15 15 0 006.6 6.6l2.2-2.2a1 1 0 011-.25 11.4 11.4 0 003.6.57 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1 11.4 11.4 0 00.57 3.6 1 1 0 01-.25 1z"/></svg>
    Ara
  </a>
  <a class="sb-wa" data-wa="Merhaba, Dr. Ramazan Ersoy için randevu almak istiyorum." data-wa-src="sticky" href="#">
    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 00-8.6 15L2 22l5.2-1.4A10 10 0 1012 2zm5.3 14.1c-.2.6-1.2 1.2-1.7 1.2-.5.1-1 .1-1.6-.1-.4-.1-.9-.3-1.5-.6a11 11 0 01-4.2-3.7c-.3-.4-.8-1.2-.8-2.3s.6-1.6.8-1.9c.2-.2.4-.3.6-.3h.5c.1 0 .3 0 .5.4l.7 1.6c.1.1.1.3 0 .5l-.3.4-.3.3c-.1.1-.2.2 0 .5.2.3.7 1.1 1.4 1.7.9.8 1.6 1 1.9 1.2.2.1.4.1.5-.1l.7-.8c.2-.2.3-.2.5-.1l1.5.7c.2.1.4.2.4.3.1.1.1.5-.1 1z"/></svg>
    WhatsApp
  </a>
  <a href="<?php echo esc_url($k); ?>randevu.html">
    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M7 2v2H5a2 2 0 00-2 2v13a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2h-2V2h-2v2H9V2H7zm12 8v9H5v-9h14z"/></svg>
    Randevu
  </a>
</nav>

<?php wp_footer(); ?>
</body>
</html>
