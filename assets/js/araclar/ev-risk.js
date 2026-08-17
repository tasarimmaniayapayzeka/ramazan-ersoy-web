/* Ev Ortamı Risk Haritası — tamamen deterministik, istemci tarafı.
   Puanlama ve öneri metinleri sitenin akar/klima rehberleriyle aynı
   kanıt çizgisinde. Hiçbir veri ağa çıkmaz. */
(function () {
  'use strict';
  var SORULAR = [
    { s: 'Yatak, yastık ve yorganınızda akar geçirmez (bariyer) kılıf var mı?',
      c: ['Var', 'Bir kısmında', 'Yok'], p: [0, 1, 3],
      oneri: ['Akar geçirmez kılıf, kanıt düzeyi en tutarlı tek önlemdir',
        'Yatağın tamamını saran, fermuarlı kılıf edinin; yalnız üst yüzeyi örten ürünler aynı işi görmez.'] },
    { s: 'Nevresim takımını hangi sıklıkla ve kaç derecede yıkıyorsunuz?',
      c: ['Haftada bir, 60°C', 'Haftada bir, daha düşük ısı', 'Daha seyrek'], p: [0, 2, 3],
      oneri: ['Haftada bir, 60 derece', 'Düşük ısı kumaşı temizler ama akarı çoğu zaman canlı bırakır; haftalık 60°C döngüsüne geçin.'] },
    { s: 'Yatak odanızın nemi hakkında fikriniz var mı?',
      c: ['Ölçüyorum, %40-50 arası', 'Ölçmüyorum', 'Nemli olduğunu biliyorum'], p: [0, 2, 3],
      oneri: ['Nemi ölçün: hedef %40-50', 'Basit bir higrometre alın; %50 üstü akarı besler, %40 altı mukozayı kurutabilir.'] },
    { s: 'Yatak odanızda halı var mı?',
      c: ['Yok / silinebilir zemin', 'Küçük, yıkanabilir kilim', 'Duvardan duvara halı'], p: [0, 1, 3],
      oneri: ['Zemini sadeleştirin', 'Duvardan duvara halı akar deposudur; kaldıramıyorsanız HEPA süpürgeyle haftalık temizlik yapın.'] },
    { s: 'Yatakta/odada peluş oyuncak veya dekoratif yastık bolluğu var mı?',
      c: ['Yok', 'Birkaç tane', 'Çok'], p: [0, 1, 2],
      oneri: ['Peluş ve dekoratif yastıkları azaltın', 'Kalanları yıkanabilir türden seçin; yıkanamayanları ara ara derin dondurucuda bekletin.'] },
    { s: 'Evde tüylü evcil hayvan var mı, yatak odasına giriyor mu?',
      c: ['Yok', 'Var, yatak odasına girmiyor', 'Var, yatak odasında uyuyor'], p: [0, 1, 3],
      oneri: ['Yatak odasını hayvansız bölge yapın', 'Alerjen tüyde değil; tükürük ve deri döküntüsünde. En etkili sınır, uyuduğunuz odadır.'] },
    { s: 'Klimanızın filtresi en son ne zaman temizlendi/değişti?',
      c: ['Bu sezon', 'Geçen yıl', 'Hatırlamıyorum / hiç'], p: [0, 2, 3],
      oneri: ['Klima filtresini sezon başında temizletin', 'Bakımsız klima, serinletirken küf sporu ve toz dağıtan bir kaynağa dönüşür.'] },
    { s: 'Banyoda/duvarlarda küf ya da rutubet lekesi var mı?',
      c: ['Yok', 'Ara sıra oluyor', 'Kalıcı leke var'], p: [0, 2, 3],
      oneri: ['Önce kaynağı kurutun', 'Kalıcı rutubette hiçbir temizlik kalıcı olmaz; sızıntıyı giderin, banyoyu havalandırın.'] },
    { s: 'Evin içinde sigara içiliyor mu?',
      c: ['Hayır', 'Balkonda/pencerede', 'Evet, içeride'], p: [0, 1, 3],
      oneri: ['Ev içi sigara dumanını sıfırlayın', 'Duman alerjen değil ama en güçlü tahriş edicidir; hassas hava yolunu her gün yeniden alevlendirir.'] },
    { s: 'Çamaşırlar nerede kuruyor?',
      c: ['Dışarıda / kurutma makinesi', 'Balkonda', 'Oda içinde'], p: [0, 1, 2],
      oneri: ['Çamaşırı yaşam alanında kurutmayın', 'Oda içinde kuruyan çamaşır, nemi ve küf riskini doğrudan yükseltir.'] }
  ];

  var kutu = document.getElementById('evSorular');
  var hesapla = document.getElementById('evHesapla');
  if (!kutu || !hesapla) return;

  var secimler = new Array(SORULAR.length).fill(-1);
  SORULAR.forEach(function (soru, i) {
    var kart = document.createElement('div');
    kart.className = 'ev-soru';
    var baslik = document.createElement('p');
    baslik.textContent = (i + 1) + '. ' + soru.s;
    kart.appendChild(baslik);
    var grup = document.createElement('div');
    grup.className = 'ev-secenek';
    grup.setAttribute('role', 'group');
    soru.c.forEach(function (secenek, j) {
      var b = document.createElement('button');
      b.type = 'button';
      b.textContent = secenek;
      b.setAttribute('aria-pressed', 'false');
      b.addEventListener('click', function () {
        secimler[i] = j;
        [].forEach.call(grup.children, function (x) { x.setAttribute('aria-pressed', 'false'); });
        b.setAttribute('aria-pressed', 'true');
      });
      grup.appendChild(b);
    });
    kart.appendChild(grup);
    kutu.appendChild(kart);
  });

  hesapla.addEventListener('click', function () {
    var eksik = secimler.indexOf(-1);
    if (eksik !== -1) {
      kutu.children[eksik].scrollIntoView({ behavior: 'smooth', block: 'center' });
      kutu.children[eksik].style.borderColor = 'var(--amber)';
      return;
    }
    var toplam = 0, enCok = 0;
    var adaylar = [];
    SORULAR.forEach(function (soru, i) {
      var puan = soru.p[secimler[i]];
      toplam += puan;
      enCok += Math.max.apply(null, soru.p);
      if (puan > 0) adaylar.push({ puan: puan, oneri: soru.oneri });
    });
    adaylar.sort(function (a, b) { return b.puan - a.puan; });

    var oran = toplam / enCok;
    var baslik = document.getElementById('evBaslik');
    var cubuk = document.getElementById('evCubuk');
    if (oran < 0.2) {
      baslik.textContent = 'Eviniz oldukça iyi durumda';
      cubuk.style.background = 'var(--coral)';
    } else if (oran < 0.5) {
      baslik.textContent = 'İyileştirilebilir birkaç nokta var';
      cubuk.style.background = 'var(--amber)';
    } else {
      baslik.textContent = 'Ev ortamınız alerjen yükünü besliyor olabilir';
      cubuk.style.background = 'var(--red)';
    }
    cubuk.style.width = Math.max(6, Math.round(oran * 100)) + '%';

    var listeKutu = document.getElementById('evOneriler');
    listeKutu.innerHTML = '';
    if (!adaylar.length) {
      listeKutu.innerHTML = '<p class="sm muted">Sorulara verdiğiniz yanıtlarda öncelikli bir eksik görünmüyor — mevcut düzeninizi koruyun.</p>';
    } else {
      adaylar.slice(0, 5).forEach(function (a, i) {
        var d = document.createElement('div');
        d.className = 'ev-oneri';
        var no = document.createElement('span');
        no.className = 'no';
        no.textContent = i + 1;
        var ic = document.createElement('div');
        var b = document.createElement('b');
        b.textContent = a.oneri[0];
        var p = document.createElement('p');
        p.textContent = a.oneri[1];
        ic.appendChild(b); ic.appendChild(p);
        d.appendChild(no); d.appendChild(ic);
        listeKutu.appendChild(d);
      });
    }
    var sonuc = document.getElementById('evSonuc');
    sonuc.classList.add('acik');
    sonuc.scrollIntoView({ behavior: 'smooth', block: 'start' });
  });

  var yazdir = document.getElementById('evYazdir');
  if (yazdir) yazdir.addEventListener('click', function () { window.print(); });
})();
