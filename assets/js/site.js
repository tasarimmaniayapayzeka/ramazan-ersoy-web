/* Dr. Ramazan Ersoy — demo etkileşimleri
   Not: WordPress'e geçişte form gönderimi ve WhatsApp numarası
   panelden yönetilecek. Demoda gönderim simüle edilir. */
(function () {
  'use strict';

  var WA_NUMBER = '905000000000'; // DEMO — gerçek numara müşteriden alınacak
  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- Header: scroll gölgesi ---------- */
  var header = document.querySelector('.site-header');
  if (header) {
    var onScroll = function () {
      header.classList.toggle('is-scrolled', window.scrollY > 8);
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  /* ---------- Mobil menü ---------- */
  var toggle = document.querySelector('.nav-toggle');
  var nav = document.querySelector('.nav');
  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      var open = nav.getAttribute('data-open') === 'true';
      nav.setAttribute('data-open', String(!open));
      toggle.setAttribute('aria-expanded', String(!open));
      document.body.style.overflow = !open ? 'hidden' : '';
    });
  }

  /* ---------- Açılır menüler (tıkla + klavye) ---------- */
  document.querySelectorAll('.has-drop').forEach(function (item) {
    var btn = item.querySelector('button');
    if (!btn) return;
    var close = function () {
      item.setAttribute('data-open', 'false');
      btn.setAttribute('aria-expanded', 'false');
    };
    btn.addEventListener('click', function (e) {
      e.stopPropagation();
      var open = item.getAttribute('data-open') === 'true';
      document.querySelectorAll('.has-drop[data-open="true"]').forEach(function (o) {
        o.setAttribute('data-open', 'false');
        var b = o.querySelector('button');
        if (b) b.setAttribute('aria-expanded', 'false');
      });
      item.setAttribute('data-open', String(!open));
      btn.setAttribute('aria-expanded', String(!open));
    });
    item.addEventListener('mouseleave', function () {
      if (window.innerWidth > 960) close();
    });
    item.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') { close(); btn.focus(); }
    });
  });
  document.addEventListener('click', function () {
    document.querySelectorAll('.has-drop[data-open="true"]').forEach(function (o) {
      o.setAttribute('data-open', 'false');
      var b = o.querySelector('button');
      if (b) b.setAttribute('aria-expanded', 'false');
    });
  });

  /* ---------- Scroll reveal ---------- */
  var reveals = document.querySelectorAll('.reveal');
  if (reveals.length) {
    if (reduced || !('IntersectionObserver' in window)) {
      reveals.forEach(function (el) { el.classList.add('is-in'); });
    } else {
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-in');
            io.unobserve(entry.target);
          }
        });
      }, { threshold: 0.12, rootMargin: '0px 0px -40px' });
      reveals.forEach(function (el) { io.observe(el); });
    }
  }

  /* ---------- Sayaç animasyonu ---------- */
  var counters = document.querySelectorAll('[data-count]');
  if (counters.length && !reduced && 'IntersectionObserver' in window) {
    var cio = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var el = entry.target;
        cio.unobserve(el);
        var target = parseFloat(el.getAttribute('data-count'));
        var prefix = el.getAttribute('data-prefix') || '';
        var suffix = el.getAttribute('data-suffix') || '';
        var dur = 900, t0 = null;
        var tick = function (ts) {
          if (!t0) t0 = ts;
          var p = Math.min((ts - t0) / dur, 1);
          var eased = 1 - Math.pow(1 - p, 3);
          el.textContent = prefix + Math.round(target * eased).toLocaleString('tr-TR') + suffix;
          if (p < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
      });
    }, { threshold: 0.4 });
    counters.forEach(function (el) { cio.observe(el); });
  }

  /* ---------- Süzülen polen (dekoratif) ---------- */
  var pollen = document.querySelector('.pollen');
  if (pollen && !reduced) {
    for (var i = 0; i < 14; i++) {
      var dot = document.createElement('i');
      var size = 4 + Math.random() * 9;
      dot.style.width = dot.style.height = size.toFixed(1) + 'px';
      dot.style.left = (Math.random() * 100).toFixed(1) + '%';
      dot.style.animationDuration = (12 + Math.random() * 14).toFixed(1) + 's';
      dot.style.animationDelay = (-Math.random() * 20).toFixed(1) + 's';
      pollen.appendChild(dot);
    }
  }

  /* ---------- Polen takvimi: içinde bulunulan ayı vurgula ----------
     Ay vurgusu tarih fonksiyonuyla otomatik — "Mart'ta donmuş site"
     sendromunu engeller (araştırma riski #5). */
  var cal = document.querySelector('.pollen-cal');
  if (cal) {
    var m = new Date().getMonth();
    var cols = cal.querySelectorAll('.pc-col');
    if (cols[m]) cols[m].classList.add('is-now');
    var nowLabel = document.querySelector('[data-now-month]');
    if (nowLabel) {
      var names = ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran',
                   'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];
      nowLabel.textContent = names[m];
    }
  }

  /* ---------- Sayfaya duyarlı WhatsApp mesajı ---------- */
  document.querySelectorAll('[data-wa]').forEach(function (link) {
    var msg = link.getAttribute('data-wa') ||
      'Merhaba, Dr. Ramazan Ersoy için randevu almak istiyorum.';
    var src = link.getAttribute('data-wa-src') || 'genel';
    link.setAttribute('href', 'https://wa.me/' + WA_NUMBER + '?text=' + encodeURIComponent(msg));
    link.setAttribute('rel', 'noopener');
    link.setAttribute('target', '_blank');
    link.addEventListener('click', function () {
      // WP'de Takip Merkezi'ne bağlanacak (utm_source=whatsapp&src=...)
      if (window.console) console.info('[takip] whatsapp:' + src);
    });
  });

  /* ---------- Randevu formu (demo doğrulaması) ---------- */
  var form = document.querySelector('[data-appointment-form]');
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var ok = true;
      form.querySelectorAll('[required]').forEach(function (input) {
        var field = input.closest('.field') || input.closest('.consent');
        var valid = input.type === 'checkbox' ? input.checked : input.value.trim() !== '';
        if (input.type === 'tel' && valid) {
          valid = input.value.replace(/\D/g, '').length >= 10;
        }
        if (field) field.classList.toggle('is-error', !valid);
        if (!valid && ok) { input.focus(); ok = false; }
      });
      if (!ok) return;
      form.hidden = true;
      var done = document.querySelector('[data-appointment-done]');
      if (done) {
        done.classList.add('is-visible');
        done.setAttribute('tabindex', '-1');
        done.focus();
      }
    });
    form.querySelectorAll('input,select').forEach(function (input) {
      input.addEventListener('input', function () {
        var f = input.closest('.field') || input.closest('.consent');
        if (f) f.classList.remove('is-error');
      });
    });
  }

  /* ---------- Video lightbox (tıkla-oynat, lite-embed) ---------- */
  document.querySelectorAll('[data-video]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var id = btn.getAttribute('data-video');
      var box = document.createElement('div');
      box.setAttribute('role', 'dialog');
      box.setAttribute('aria-modal', 'true');
      box.setAttribute('aria-label', 'Tanıtım videosu');
      box.style.cssText = 'position:fixed;inset:0;z-index:200;background:rgba(20,30,29,.92);' +
        'display:flex;align-items:center;justify-content:center;padding:5vw';
      box.innerHTML = '<div style="width:min(900px,100%);aspect-ratio:16/9;position:relative">' +
        '<iframe style="width:100%;height:100%;border:0;border-radius:14px" ' +
        'src="https://www.youtube-nocookie.com/embed/' + id + '?autoplay=1&rel=0" ' +
        'title="Dr. Ramazan Ersoy tanıtım videosu" allow="autoplay; encrypted-media" allowfullscreen></iframe>' +
        '</div><button aria-label="Kapat" style="position:absolute;top:18px;right:22px;background:none;' +
        'border:none;color:#fff;font-size:34px;cursor:pointer;line-height:1">&times;</button>';
      var close = function () { box.remove(); document.body.style.overflow = ''; btn.focus(); };
      box.addEventListener('click', function (e) { if (e.target === box) close(); });
      box.querySelector('button').addEventListener('click', close);
      document.addEventListener('keydown', function esc(e) {
        if (e.key === 'Escape') { close(); document.removeEventListener('keydown', esc); }
      });
      document.body.appendChild(box);
      document.body.style.overflow = 'hidden';
      box.querySelector('button').focus();
    });
  });
})();
