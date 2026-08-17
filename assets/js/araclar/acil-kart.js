/* Acil Plan Kartı — tamamen istemci tarafı; ağa hiçbir şey gitmez.
   Form alanları yazdıkça karta yansır; Yazdır düğmesi tarayıcının
   yazdırma penceresini açar (PDF kaydetme oradan). */
(function () {
  'use strict';
  var esle = [
    ['akAd', ['akcAd', 'akbAd']],
    ['akAlerjen', ['akcAlerjen', 'akbAlerjen']],
    ['akOto', ['akcOto', 'akbOto']],
    ['akKisi', ['akcKisi', 'akbKisi']]
  ];
  esle.forEach(function (cift) {
    var girdi = document.getElementById(cift[0]);
    if (!girdi) return;
    girdi.addEventListener('input', function () {
      var v = girdi.value.trim() || '—';
      cift[1].forEach(function (id) {
        var h = document.getElementById(id);
        if (h) h.textContent = v;
      });
    });
  });
  var yazdir = document.getElementById('akYazdir');
  if (yazdir) yazdir.addEventListener('click', function () { window.print(); });
})();
