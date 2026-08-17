/* Etiket Dedektifi — arac-api.php (mod=etiket) istemcisi.
   Kişisel veri beklenmez; yine de hiçbir girdi saklanmaz. */
(function () {
  'use strict';
  var cipKutu = document.getElementById('edAlerjenler');
  var metin = document.getElementById('edMetin');
  var tara = document.getElementById('edTara');
  var bekle = document.getElementById('edBekle');
  var sonuc = document.getElementById('edSonuc');
  if (!cipKutu || !tara) return;

  cipKutu.addEventListener('click', function (e) {
    var b = e.target.closest('.ed-cip');
    if (!b) return;
    b.setAttribute('aria-pressed', b.getAttribute('aria-pressed') === 'true' ? 'false' : 'true');
  });

  function kacir(s) {
    var d = document.createElement('div');
    d.textContent = s;
    return d.innerHTML;
  }

  function satir(tur, baslik, aciklama) {
    var sinif = tur === 'kesin' ? 'kesin' : (tur === 'olasi' ? 'olasi' : 'temiz');
    var im = tur === 'kesin' ? '!' : (tur === 'olasi' ? '?' : '✓');
    return '<div class="ed-bulgu"><span class="ed-isaret ' + sinif + '" aria-hidden="true">' + im +
      '</span><div><b>' + kacir(baslik) + '</b><p>' + kacir(aciklama) + '</p></div></div>';
  }

  tara.addEventListener('click', function () {
    var secili = [].map.call(cipKutu.querySelectorAll('[aria-pressed="true"]'), function (b) {
      return b.getAttribute('data-a');
    });
    var m = (metin.value || '').trim();
    if (!secili.length) { sonuc.innerHTML = '<p class="sm muted">Önce en az bir alerjen seçin.</p>'; return; }
    if (m.length < 10) { sonuc.innerHTML = '<p class="sm muted">İçindekiler listesini yapıştırın (en az birkaç kelime).</p>'; return; }

    tara.disabled = true;
    bekle.classList.add('acik');

    fetch('/arac-api.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ mod: 'etiket', alerjenler: secili, metin: m })
    }).then(function (r) { return r.json(); }).then(function (j) {
      tara.disabled = false;
      bekle.classList.remove('acik');
      if (j.hata) {
        sonuc.innerHTML = '<p class="sm muted">' +
          (j.hata === 'limit' ? 'Saatlik kullanım sınırına ulaşıldı; biraz sonra tekrar deneyin.'
                              : 'Tarama şu an yapılamadı; lütfen tekrar deneyin.') + '</p>';
        return;
      }
      var h = '';
      if (j.temiz) {
        h += satir('temiz', 'Seçtiğiniz alerjenlerin bilinen adları bulunamadı',
          'Yine de "izler içerebilir" uyarısı bu araçla görülemez — ambalajın tamamını okuyun.');
      } else {
        (j.bulgular || []).forEach(function (b) {
          h += satir(b.tur, '"' + b.kaynak + '" → ' + b.alerjen.toUpperCase(), b.aciklama);
        });
        h += '<p class="xs muted" style="margin-top:.6rem">Şüpheli üründen uzak durun; kesin güvence için üreticiyle iletişime geçin.</p>';
      }
      sonuc.innerHTML = h;
    }).catch(function () {
      tara.disabled = false;
      bekle.classList.remove('acik');
      sonuc.innerHTML = '<p class="sm muted">Bağlantı sorunu — lütfen tekrar deneyin.</p>';
    });
  });
})();
