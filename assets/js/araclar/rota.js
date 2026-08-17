/* Belirti Yol Haritası — arac-api.php (mod=rota) istemcisi.
   Acil yanıtı gelirse kırmızı kart açılır ve giriş KİLİTLENİR
   (chatbot'taki davranışla aynı: kullanıcı 112'ye odaklansın). */
(function () {
  'use strict';
  var metin = document.getElementById('yrMetin');
  var gonder = document.getElementById('yrGonder');
  var bekle = document.getElementById('yrBekle');
  var acil = document.getElementById('yrAcil');
  var yanit = document.getElementById('yrYanit');
  var mesaj = document.getElementById('yrMesaj');
  var rota = document.getElementById('yrRota');
  if (!gonder) return;

  function kacir(s) {
    var d = document.createElement('div');
    d.textContent = s;
    return d.innerHTML;
  }

  gonder.addEventListener('click', function () {
    var m = (metin.value || '').trim();
    if (m.length < 8) {
      mesaj.textContent = 'Birkaç cümleyle şikayetinizi yazın — ne zamandır sürdüğü ve neyin artırdığı özellikle yardımcı olur.';
      rota.innerHTML = '';
      yanit.classList.add('acik');
      return;
    }
    gonder.disabled = true;
    bekle.classList.add('acik');

    fetch('/arac-api.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ mod: 'rota', metin: m })
    }).then(function (r) { return r.json(); }).then(function (j) {
      bekle.classList.remove('acik');
      if (j.acil) {
        /* KİLİT: acil kartı açık kalır, araç yeniden kullanılamaz */
        acil.classList.add('acik');
        yanit.classList.remove('acik');
        metin.disabled = true;
        gonder.disabled = true;
        acil.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
      }
      gonder.disabled = false;
      if (j.hata) {
        mesaj.textContent = j.hata === 'limit'
          ? 'Saatlik kullanım sınırına ulaşıldı; biraz sonra tekrar deneyin.'
          : 'Şu an yanıt üretilemedi; lütfen tekrar deneyin.';
        rota.innerHTML = '';
        yanit.classList.add('acik');
        return;
      }
      mesaj.textContent = j.mesaj || '';
      var h = '';
      (j.kartlar || []).forEach(function (k) {
        h += '<a href="' + kacir(k.url) + '"><b>' + kacir(k.baslik) + '</b>' + kacir(k.kisa) + '</a>';
      });
      rota.innerHTML = h;
      yanit.classList.add('acik');
    }).catch(function () {
      gonder.disabled = false;
      bekle.classList.remove('acik');
      mesaj.textContent = 'Bağlantı sorunu — lütfen tekrar deneyin.';
      rota.innerHTML = '';
      yanit.classList.add('acik');
    });
  });
})();
