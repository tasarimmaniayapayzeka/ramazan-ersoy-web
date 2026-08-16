<?php
/**
 * İçerik tipleri ve alan modeli
 *
 * URL YAPISI statik siteyle AYNI tutuldu — taşıma sırasında adreslerin
 * değişmemesi SEO açısından en kritik nokta:
 *   /hastaliklar/astim   ·  /testler/deri-prick-testi
 *   /tedaviler/...        ·  /alerji-rehberi/...
 *
 * ALANLAR NEDEN ACF DEĞİL: eklenti sayısını sıfırda tutuyoruz (her eklenti
 * yeni saldırı yüzeyi ve güncelleme yükü). Alan kümesi küçük ve sabit;
 * WordPress'in kendi meta kutuları yetiyor.
 */
if (!defined('ABSPATH')) exit;

/* ============================================================
   1) İÇERİK TİPLERİ
   ============================================================ */
function drre_icerik_tipleri() {
    $ortak = [
        'public'       => true,
        'show_in_rest' => true,          /* blok editörü */
        'has_archive'  => true,
        'menu_position'=> 20,
        'supports'     => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields'],
    ];

    /* DİKKAT: array_merge kullanılıyor, + DEĞİL. PHP'nin + birleşimi
       SOLDAKİ diziyi korur; ilk sürümde $ortak'taki 'rewrite' anahtarı
       buradaki slug ayarlarını sessizce eziyordu ve adresler /hastalik/
       (tekil) kuruldu — statik sitenin /hastaliklar/... yapısıyla
       uyuşmayınca 301 haritası ikinci bir yönlendirmeye düşüyordu. */
    register_post_type('hastalik', array_merge($ortak, [
        'labels' => drre_etiket('Hastalık', 'Hastalıklar'),
        'rewrite' => ['slug' => 'hastaliklar', 'with_front' => false],
        'menu_icon' => 'dashicons-heart',
    ]));

    register_post_type('test', array_merge($ortak, [
        'labels' => drre_etiket('Test', 'Testler'),
        'rewrite' => ['slug' => 'testler', 'with_front' => false],
        'menu_icon' => 'dashicons-clipboard',
    ]));

    register_post_type('tedavi', array_merge($ortak, [
        'labels' => drre_etiket('Tedavi', 'Tedaviler'),
        'rewrite' => ['slug' => 'tedaviler', 'with_front' => false],
        'menu_icon' => 'dashicons-shield',
    ]));

    register_post_type('rehber', array_merge($ortak, [
        'labels' => drre_etiket('Rehber Yazısı', 'Alerji Rehberi'),
        'rewrite' => ['slug' => 'alerji-rehberi', 'with_front' => false],
        'menu_icon' => 'dashicons-media-document',
    ]));
}
add_action('init', 'drre_icerik_tipleri');

function drre_etiket($tekil, $cogul) {
    return [
        'name' => $cogul, 'singular_name' => $tekil,
        'add_new_item' => "Yeni $tekil ekle", 'edit_item' => "$tekil düzenle",
        'all_items' => "Tüm $cogul", 'menu_name' => $cogul,
        'search_items' => "$cogul içinde ara", 'not_found' => "$cogul bulunamadı",
    ];
}

/* ============================================================
   2) ALANLAR
   ============================================================ */
function drre_alanlar() {
    $tipler = ['hastalik', 'test', 'tedavi', 'rehber'];
    $alanlar = [
        'drre_desc'    => 'string',   /* meta description — 150-160 karakter */
        'drre_sss'     => 'string',   /* SSS: tek kaynak (bkz. sema.php) */
        'drre_ozet'    => 'string',   /* öne çıkan cevap — snippet hedefli */
        'drre_inceleme'=> 'string',   /* tıbbi inceleme tarihi (YYYY-MM-DD) */
    ];
    foreach ($tipler as $t) {
        foreach ($alanlar as $ad => $tur) {
            register_post_meta($t, $ad, [
                'type' => $tur, 'single' => true, 'show_in_rest' => true,
                'auth_callback' => function () { return current_user_can('edit_posts'); },
            ]);
        }
    }
}
add_action('init', 'drre_alanlar');

/* ---------- Düzenleme ekranındaki kutular ---------- */
function drre_kutular() {
    foreach (['hastalik', 'test', 'tedavi', 'rehber'] as $t) {
        add_meta_box('drre-seo', 'SEO ve şema', 'drre_kutu_ciz', $t, 'normal', 'high');
    }
}
add_action('add_meta_boxes', 'drre_kutular');

function drre_kutu_ciz($yazi) {
    wp_nonce_field('drre_kaydet', 'drre_nonce');
    $desc = get_post_meta($yazi->ID, 'drre_desc', true);
    $ozet = get_post_meta($yazi->ID, 'drre_ozet', true);
    $sss  = get_post_meta($yazi->ID, 'drre_sss', true);
    $inc  = get_post_meta($yazi->ID, 'drre_inceleme', true);
    ?>
    <p>
      <label for="drre_desc"><strong>Meta açıklama</strong> — arama sonucunda görünen metin.
      <span id="drre_sayac"></span></label><br>
      <textarea id="drre_desc" name="drre_desc" rows="2" style="width:100%"
        maxlength="200" placeholder="150-160 karakter. Sayfanın ne anlattığını ve kime hitap ettiğini söyleyin."><?php echo esc_textarea($desc); ?></textarea>
    </p>

    <p>
      <label for="drre_ozet"><strong>Öne çıkan cevap</strong> — sayfanın ilk paragrafında geçen 40-55 kelimelik özet.</label><br>
      <em style="color:#666;font-size:12px">Google'ın "öne çıkan snippet" olarak seçebilmesi için soruyu doğrudan cevaplayın.</em><br>
      <textarea id="drre_ozet" name="drre_ozet" rows="3" style="width:100%"><?php echo esc_textarea($ozet); ?></textarea>
    </p>

    <p>
      <label for="drre_sss"><strong>Sık sorulan sorular</strong></label><br>
      <em style="color:#666;font-size:12px">
        Her soru bir satır, hemen altındaki satır cevabı. Sorular arasında BİR BOŞ SATIR bırakın.<br>
        Bu alan TEK KAYNAKTIR: hem sayfadaki açılır SSS bloğu hem Google'a gönderilen
        FAQPage şeması buradan üretilir — ikisi asla birbirinden sapamaz.
      </em><br>
      <textarea id="drre_sss" name="drre_sss" rows="10" style="width:100%;font-family:monospace"
        placeholder="Astım geçer mi?&#10;Astım kontrol altına alınabilen bir hastalıktır; kontrol sağlandığında...&#10;&#10;Astım ilaçları bağımlılık yapar mı?&#10;Hayır. İnhaler tedaviler bağımlılık yapmaz..."><?php echo esc_textarea($sss); ?></textarea>
    </p>

    <p>
      <label for="drre_inceleme"><strong>Tıbbi inceleme tarihi</strong></label>
      <input type="date" id="drre_inceleme" name="drre_inceleme" value="<?php echo esc_attr($inc); ?>">
      <em style="color:#666;font-size:12px">Mevzuat gereği içeriğin hekim tarafından gözden geçirildiği tarih.</em>
    </p>

    <script>
    (function(){
      var t=document.getElementById('drre_desc'), s=document.getElementById('drre_sayac');
      if(!t||!s)return;
      var g=function(){ var n=t.value.length;
        s.textContent=' ('+n+' karakter'+(n>160?' — UZUN, Google kesebilir':(n&&n<120?' — kısa':''))+')';
        s.style.color = n>160 ? '#b91c1c' : '#666'; };
      t.addEventListener('input',g); g();
    })();
    </script>
    <?php
}

function drre_kutu_kaydet($id) {
    if (!isset($_POST['drre_nonce']) || !wp_verify_nonce($_POST['drre_nonce'], 'drre_kaydet')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $id)) return;

    foreach (['drre_desc', 'drre_ozet', 'drre_sss', 'drre_inceleme'] as $a) {
        if (isset($_POST[$a])) {
            update_post_meta($id, $a, sanitize_textarea_field(wp_unslash($_POST[$a])));
        }
    }
}
add_action('save_post', 'drre_kutu_kaydet');
