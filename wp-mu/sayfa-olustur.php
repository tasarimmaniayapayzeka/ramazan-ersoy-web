<?php
/**
 * TEK SEFERLİK — tam devir sayfa oluşturucu (17 Ağu 2026).
 * Statikten devşirilen şablonlara bağlı WP sayfalarını kurar.
 * Var olan slug'a dokunmaz; bitince bayrakla kilitlenir.
 */
if (!defined('ABSPATH')) exit;

add_action('init', function () {
    if (get_option('drre_sayfa_olustur_2026_08_17')) return;

    $tanimlar = [
        ['slug' => 'basinda', 'ebeveyn' => '', 'baslik' => 'Basında Uzm. Dr. Ramazan Ersoy — Haber, TV ve YouTube', 'aciklama' => 'Dr. Ramazan Ersoy\'un basında yer alan haberleri: Habertürk haberi, Sağlıklı Hayat TV katılımı ve 70\'ten fazla bilgilendirme videosu — İstanbul Nişantaşı.', 'sablon' => 'page-templates/t-basinda.php'],
        ['slug' => 'cerez-politikasi', 'ebeveyn' => '', 'baslik' => 'Çerez Politikası', 'aciklama' => 'Bu sitede hangi çerezlerin hangi amaçla kullanıldığı, çerez kategorileri, açık rıza koşulları ve çerezleri tarayıcınızdan nasıl yöneteceğiniz hakkında bilgilendirme.', 'sablon' => 'page-templates/t-cerez-politikasi.php'],
        ['slug' => 'dr-ramazan-ersoy', 'ebeveyn' => '', 'baslik' => 'Uzm. Dr. Ramazan Ersoy Kimdir? — Alerji Uzmanı, İstanbul', 'aciklama' => 'Dr. Ramazan Ersoy\'un eğitim geçmişi, yan dal uzmanlığı, akademik görevleri, dernek üyelikleri, bilimsel yayınları ve kongre ödülleri — İstanbul Nişantaşı.', 'sablon' => 'page-templates/t-dr-ramazan-ersoy.php'],
        ['slug' => 'iletisim', 'ebeveyn' => '', 'baslik' => 'İletişim ve Ulaşım — Nişantaşı, İstanbul', 'aciklama' => 'Dr. Ramazan Ersoy muayenehanesi: Harbiye Mah. Teşvikiye Cad. 37/3, Şişli / İstanbul (Nişantaşı). Telefon 0212 709 93 96, çalışma saatleri ve ulaşım tarifi.', 'sablon' => 'page-templates/t-iletisim.php'],
        ['slug' => 'randevu', 'ebeveyn' => '', 'baslik' => 'Randevu Talebi — Alerji Uzmanı İstanbul', 'aciklama' => 'Dr. Ramazan Ersoy muayenehanesinden randevu talebi: form, telefon (0212 709 93 96) veya WhatsApp. Çalışma saatleri ve randevunun kesinleşme adımları — İstanbul.', 'sablon' => 'page-templates/t-randevu.php'],
        ['slug' => 'kvkk-aydinlatma', 'ebeveyn' => '', 'baslik' => 'KVKK Aydınlatma Metni', 'aciklama' => '6698 sayılı KVKK kapsamında aydınlatma metni: veri sorumlusu, işlenen veri kategorileri, işleme amaçları, hukuki sebepler, saklama süreleri ve ilgili kişi hakları.', 'sablon' => 'page-templates/t-kvkk-aydinlatma.php'],
        ['slug' => 'yasal-uyari', 'ebeveyn' => '', 'baslik' => 'Yasal Uyarı', 'aciklama' => 'Bu sitenin bilgilendirme amaçlı olduğuna, içeriklerin hekim muayenesinin yerine geçmediğine, telif haklarına ve tanıtım mevzuatına uyuma ilişkin yasal uyarı metni.', 'sablon' => 'page-templates/t-yasal-uyari.php'],
        ['slug' => 'yayinlar-ve-oduller', 'ebeveyn' => '', 'baslik' => 'Bilimsel Yayınlar ve Ödüller', 'aciklama' => 'Dr. Ramazan Ersoy\'un hakemli dergilerdeki 10 bilimsel yayını (2007-2025), XV. Ulusal Alerji ve Klinik İmmünoloji Kongresi bildiri ödülleri ve dernek üyelikleri.', 'sablon' => 'page-templates/t-yayinlar-ve-oduller.php'],
        ['slug' => 'alerji-testi-fiyatlari-2026', 'ebeveyn' => '', 'baslik' => 'Alerji Testi Fiyatları 2026 — İstanbul', 'aciklama' => 'Alerji testi fiyatları 2026: mevzuat gereği ücretler internette yayınlanamaz. Fiyatı etkileyen faktörler, SGK çerçevesi ve ücret bilgisini alma yolu — İstanbul.', 'sablon' => 'page-templates/t-alerji-testi-fiyatlari-2026.php'],
        ['slug' => 'alerji-mi-soguk-alginligi-mi', 'ebeveyn' => 'araclar', 'baslik' => 'Alerji mi, Soğuk Algınlığı mı?', 'aciklama' => 'Alerji mi, soğuk algınlığı mı? 6 soruluk kısa değerlendirme ile 60 saniyede fikir edinin. Tanı aracı değildir; belirti karşılaştırma tablosu — İstanbul Nişantaşı.', 'sablon' => 'page-templates/t-alerji-mi-soguk-alginligi-mi.php'],
        ['slug' => 'astim-kontrol-testi', 'ebeveyn' => 'araclar', 'baslik' => 'Astım Kontrol Testi (ACT): 5 Soruda Ölçün', 'aciklama' => 'Astım Kontrol Testi (ACT): son 4 haftayı sorgulayan 5 soruluk anket. Puanınızı hesaplayın, sonucu hekiminizle paylaşın. Tanı yerine geçmez — İstanbul Nişantaşı.', 'sablon' => 'page-templates/t-astim-kontrol-testi.php'],
        ['slug' => 'polen-takvimi', 'ebeveyn' => 'araclar', 'baslik' => 'İstanbul Polen Takvimi: Hangi Ayda Ne Var?', 'aciklama' => 'İstanbul polen takvimi: ağaç polenleri şubat–nisan, çim polenleri mayıs–temmuz, ot polenleri ağustos–ekim. Polen mevsiminde korunma ve hekime başvuru ölçütleri.', 'sablon' => 'page-templates/t-polen-takvimi.php'],
        ['slug' => 'video-kutuphanesi', 'ebeveyn' => 'araclar', 'baslik' => 'Alerji ve Astım Video Kütüphanesi', 'aciklama' => 'Dr. Ramazan Ersoy anlatıyor: alerji ve astım videolarının konuya göre kütüphanesi — alerjik rinit ve polen, astım, besin ve ilaç alerjileri, testler, immünoterapi.', 'sablon' => 'page-templates/t-video-kutuphanesi.php'],
        ['slug' => 'ikinci-gorus', 'ebeveyn' => 'hasta-merkezi', 'baslik' => 'İkinci Görüş: Test Sonucunuzu Yükleyin', 'aciklama' => 'Başka merkezde yaptırdığınız alerji deri testi, spesifik IgE, solunum fonksiyon testi veya epikrizinizi iletin; ön inceleme sonrası görüşme planlansın — İstanbul.', 'sablon' => 'page-templates/t-ikinci-gorus.php'],
        ['slug' => 'online-on-degerlendirme', 'ebeveyn' => 'hasta-merkezi', 'baslik' => 'Online Ön Değerlendirme Nasıl Çalışır?', 'aciklama' => 'Kliniğe gelmeden şikayetlerinizi ve tetkiklerinizi paylaşın: online ön değerlendirmede neler yapılabilir, neler yapılamaz? 3 adımlı akış — İstanbul Nişantaşı.', 'sablon' => 'page-templates/t-online-on-degerlendirme.php'],
        ['slug' => 'randevunuza-hazirlanin', 'ebeveyn' => 'hasta-merkezi', 'baslik' => 'Randevuya Hazırlık ve İlaç Kesme Kuralları', 'aciklama' => 'Alerji muayenesi öncesi: yanınızda getirmeniz gerekenler, deri testi öncesi ilaç kesme kuralları (antihistaminikler ~10 gün) ve randevu günü akışı — İstanbul.', 'sablon' => 'page-templates/t-randevunuza-hazirlanin.php'],
        ['slug' => 'araclar', 'ebeveyn' => '', 'baslik' => 'Araçlar', 'aciklama' => '', 'sablon' => 'page-templates/t-bolum.php'],
        ['slug' => 'hasta-merkezi', 'ebeveyn' => '', 'baslik' => 'Hasta Merkezi', 'aciklama' => '', 'sablon' => 'page-templates/t-bolum.php'],
    ];

    /* iki geçiş: önce ebeveynsizler (ebeveyn kimliği için) */
    $kimlik = [];
    foreach ([false, true] as $cocukTuru) {
        foreach ($tanimlar as $t) {
            $cocukMu = $t['ebeveyn'] !== '';
            if ($cocukMu !== $cocukTuru) continue;
            $mevcut = get_page_by_path(($t['ebeveyn'] ? $t['ebeveyn'] . '/' : '') . $t['slug'], OBJECT, 'page');
            if ($mevcut) { $kimlik[$t['slug']] = $mevcut->ID; continue; }
            $id = wp_insert_post([
                'post_type'   => 'page',
                'post_status' => 'publish',
                'post_title'  => $t['baslik'],
                'post_name'   => $t['slug'],
                'post_parent' => $t['ebeveyn'] ? ($kimlik[$t['ebeveyn']] ?? 0) : 0,
                'post_content'=> '',
            ]);
            if (!is_wp_error($id)) {
                $kimlik[$t['slug']] = $id;
                update_post_meta($id, '_wp_page_template', $t['sablon']);
                if ($t['aciklama']) update_post_meta($id, 'drre_desc', $t['aciklama']);
            }
        }
    }
    update_option('drre_sayfa_olustur_2026_08_17', 'kuruldu:' . count($kimlik), false);
    flush_rewrite_rules();
}, 99);
