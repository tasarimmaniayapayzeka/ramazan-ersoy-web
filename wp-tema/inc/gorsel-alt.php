<?php
/**
 * Görsel alt metinleri — slug → alt eşlemesi.
 * Kaynak: 23 görselin tek tek gözle denetlendiği inceleme turu (16 Ağu 2026).
 * Alt metinler görme engelli kullanıcı için BETİMLEYİCİDİR; anahtar kelime
 * doldurması değildir ve öyle kalmalıdır.
 */
if (!defined('ABSPATH')) exit;

function drre_gorsel_alt($slug) {
    $m = [
        'gebelikte-alerji-ve-astim' => 'Pencere onunde koyu teal koltuk, uzerine serilmis krem orgu battaniye; yan sehpada buhari tuten bardak, okaliptus dalli vazo ve kitap.',
        'klima-ve-ic-ortam-alerjenleri' => 'Ferah bir salonda ahsap zeminde duran silindir hava temizleyici; arkada duvara monteli beyaz klima, tul perde ve teal yastikli krem kanepe.',
        'yetiskinlikte-baslayan-astim' => 'Genis pencere kenarinda ahsap calisma masasi; uzerinde kapali krem defter, su bardagi ve pirinc masa lambasi, arkada bulanik Istanbul silueti ve minareler.',
        'hero' => 'Ferah muayenehanede ahsap masa uzerinde kapali krem defter ve stetoskop, yaninda teal kadife koltuk.',
        'alerjik-rinit' => 'Bahar dalindaki beyaz ciceklerin onunde havada suzulen altin sarisi polen taneleri, teal bulanik arka plan.',
        'astim' => 'Ahsap masadaki keten bez uzerinde markasiz beyaz olcum cihazi ve metalik inhaler, pencere isiginda.',
        'urtiker' => 'Yumusak gun isiginda kivrimlanan dogal keten kumasin yakin cekim dokusu, gunes golgeleri uzeriden geciyor.',
        'alerji-asisi-immunoterapi' => 'Altin renkli tepside etiketsiz cam flakon ve ince igneli sirinca, koyu petrol yesili duvar onunde.',
        'alerji-asisi-sss' => 'Acik ahsap masada damlalikli kehribar cam sise ve yaninda bir bardak su.',
        'ev-tozu-akari-yatak-odasi' => 'Aydinlik yatak odasinda krem nevresimli ahsap karyola; halisiz ahsap zemin ve tul perde.',
        'evcil-hayvan-alerjisi' => 'Pencere isiginda petrol yesili kadife koltukta kivrilip uyuyan tekir kedi, arkada pirinc lamba.',
        'besin-alerjisi' => 'Seramik tabakta findik ve kabuklu yer fistigi; yaninda keten ortude iki cig karides ve ceviz.',
        'ilac-alerjisi' => 'Krem tabakta bos yuzeyli blister icinde beyaz tabletler, uc beyaz kapsul ve bir bardak su.',
        'ari-alerjisi' => 'Krem renkli bir cicegin uzerinde duran bal arisinin yakin cekimi; arkada bulanik yesil saplar.',
        'herediter-anjiyoodem' => 'Aydinlik laboratuvar masasinda metal sehpada duran, etiketsiz ve bos uc cam flakon.',
        'mastositoz' => 'Koyu teal zeminde dağılmış, ışıkla parlayan altın rengi minik parçacıklardan oluşan soyut görsel.',
        'anafilaksi' => 'Krem rengi taşıma kutusu içinde duran, iki ucu altın kaplama, markasız kalem biçimli enjektör.',
        'deri-prick-testi' => 'Avuç içi yukarı uzanan ön kolda sıra hâlinde berrak test damlaları; yanında beyaz lanset duruyor.',
        'spesifik-ige-kan-testi' => 'Ahşap standa dizili, mavi kırmızı mor ve yeşil kapaklı dört kan tüpü; arkada bulanık laboratuvar.',
        'solunum-fonksiyon-testi' => 'Muayene odasında masada duran taşınabilir spirometre cihazı ve beyaz ağızlığı; cihazın ekranı kapalı.',
        'yama-testi' => 'Bir kişinin çıplak sırtında iki sıra hâlinde yapıştırılmış yirmi iki adet bej yama testi flasteri.',
        'provokasyon-testleri' => 'Boş gözlem odası: krem renkli uzanmalı koltuk, yanında sehpa ve duvarda ayaklı monitörler.',
        'testler-index' => 'Krem zeminde tepeden çekilmiş test malzemeleri: damlalıklı şişe, lanset, üç tüp, ağızlık, yamalar ve altın tepsi.',
    ];
    return $m[$slug] ?? '';
}
