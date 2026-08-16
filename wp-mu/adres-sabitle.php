<?php
/**
 * Adres sabitleyici (mu-plugin) — 17 Ağu 2026 hibrit geçiş.
 *
 * NEDEN VAR: Ayarlar > Genel'de WordPress adresi yanlışlıkla kök adrese
 * çevrilip kaydedildi ve yönetim paneli kilitlendi. Bu dosya iki adresi
 * KODDAN sabitler; veritabanındaki değer ne olursa olsun bunlar geçerlidir.
 * Böylece aynı kaza bir daha yaşanamaz.
 *
 * - siteurl: WP çekirdeğinin durduğu yer (yönetim paneli buradan çalışır)
 * - home   : sitenin ziyaretçiye görünen kökü
 * Panelden adres değiştirmek gerekirse ÖNCE bu dosya güncellenmeli.
 */
add_filter('pre_option_siteurl', function () {
    return 'https://drramazanersoy.tr/wp-yeni';
});
add_filter('pre_option_home', function () {
    return 'https://drramazanersoy.tr';
});
