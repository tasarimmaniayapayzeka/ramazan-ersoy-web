<?php
/**
 * TEK SEFERLİK bakım — Yoast adres tablosu tazeleme (17 Ağu 2026).
 *
 * NEDEN: içerik tipi slug'ları düzeltilmeden (tekil /hastalik → çoğul
 * /hastaliklar) önce Yoast, kalıcı adresleri kendi indexable tablosuna
 * yazmıştı; canonical etiketi bu yüzden bazı sayfalarda eski adresi
 * gösteriyordu. Paneldeki "SEO veri optimizasyonu" düğmesi kullanıcıda
 * açılmadığı için temizlik buradan yapılıyor.
 *
 * NE YAPAR: bizim dört içerik tipine ait indexable satırlarını SİLER.
 * Yoast, kaydı olmayan bir sayfa ilk kez görüntülendiğinde kaydı güncel
 * kalıcı adresle kendisi yeniden oluşturur — veri kaybı yoktur, tablo
 * kendi kendini onarır.
 *
 * Çalıştıktan sonra seçenek bayrağıyla kilitlenir; işi bitince bu dosya
 * depodan silinecek.
 */
if (!defined('ABSPATH')) exit;

add_action('init', function () {
    if (get_option('drre_yoast_tazeleme_2026_08_17')) return;

    global $wpdb;
    $tablo = $wpdb->prefix . 'yoast_indexable';

    /* Tablo yoksa (Yoast kaldırıldıysa) sessizce çık */
    if ($wpdb->get_var($wpdb->prepare('SHOW TABLES LIKE %s', $tablo)) !== $tablo) {
        update_option('drre_yoast_tazeleme_2026_08_17', 'tablo-yok', false);
        return;
    }

    $silinen = $wpdb->query(
        "DELETE FROM {$tablo}
          WHERE object_type = 'post'
            AND object_sub_type IN ('hastalik','test','tedavi','rehber')"
    );

    update_option('drre_yoast_tazeleme_2026_08_17', 'silindi:' . (int) $silinen, false);
}, 99);
