<?php
/* ============================================================
   ÖRNEK DOSYA — bu dosyayı SUNUCUDA "chat-config.php" adıyla
   kopyalayıp içine gerçek anahtarı yazın.
   ------------------------------------------------------------
   NEDEN AYRI DOSYA: OpenAI anahtarı repoya ASLA girmemeli.
   chat-config.php .gitignore'da; bu örnek dosya repoda kalır.

   KURULUM (cPanel → Dosya Yöneticisi → public_html):
   1. Bu dosyayı kopyalayın, adını "chat-config.php" yapın.
   2. Aşağıdaki BURAYA_ANAHTARI_YAZIN kısmını gerçek anahtarla
      değiştirin (sk-... ile başlar).
   3. Kaydedin. İzni 0600 yapmanız iyi olur.
   4. chat-api.php anahtar yoksa 503 "yapilandirma" döner —
      yani bot sessizce çalışmaz, sorunu belli eder.

   NOT: Anahtar yalnızca sunucuda PHP tarafından okunur; tarayıcıya
   hiçbir zaman gönderilmez. Bu yüzden statik siteye gömülemez.
   ============================================================ */

define('OPENAI_KEY', 'BURAYA_ANAHTARI_YAZIN');
