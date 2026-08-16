<?php
/**
 * WordPress yükleyici — "kendi dizininde WordPress" düzeni.
 *
 * WP dosyaları /wp-yeni/ altında durur (WordPress Adresi), site kökten
 * yayın yapar (Site Adresi). Bu dosya kökteki tek WP giriş noktasıdır;
 * .htaccess'teki geri-düşüş kuralı, diskte karşılığı olmayan her adresi
 * buraya getirir (/hastaliklar/astim/ gibi).
 *
 * DirectoryIndex "index.html index.php" olduğu için kök adres (/) hâlâ
 * statik anasayfayı servis eder — bu dosya onu ETKİLEMEZ. Anasayfa ve
 * diğer statik sayfalar 2. faz WP şablonları yazılınca taşınacak.
 */
define('WP_USE_THEMES', true);
require __DIR__ . '/wp-yeni/wp-blog-header.php';
