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

  /* ---------- Uzun sayfalar: okuma çubuğu + scrollspy ---------- */
  var article = document.querySelector('.article-layout');
  if (article && header) {
    var bar = document.createElement('div');
    bar.className = 'read-progress';
    bar.setAttribute('aria-hidden', 'true');
    header.appendChild(bar);
    var onRead = function () {
      var h = document.documentElement;
      var max = h.scrollHeight - h.clientHeight;
      bar.style.transform = 'scaleX(' + (max > 0 ? window.scrollY / max : 0) + ')';
    };
    onRead();
    window.addEventListener('scroll', onRead, { passive: true });

    /* Scrollspy: görünür alanın üst çeyreğini geçen SON başlık aktiftir.
       (IntersectionObserver dar bandı, sıçramalı kaydırmada geçişleri
       kaçırıyordu — konum bazlı hesap her karede doğru sonuç verir.) */
    var tocLinks = document.querySelectorAll('.toc a[href^="#"]');
    if (tocLinks.length) {
      var mapTL = {};
      tocLinks.forEach(function (a) { mapTL[a.getAttribute('href').slice(1)] = a; });
      var spyTargets = Object.keys(mapTL)
        .map(function (id) { return document.getElementById(id); })
        .filter(Boolean);
      var current = null;
      var spyUpdate = function () {
        var line = window.innerHeight * 0.28;
        var best = null;
        spyTargets.forEach(function (t) {
          if (t.getBoundingClientRect().top <= line) best = t;
        });
        var next = best ? mapTL[best.id] : null;
        if (next === current) return;
        if (current) { current.classList.remove('is-active'); current.removeAttribute('aria-current'); }
        current = next;
        if (current) { current.classList.add('is-active'); current.setAttribute('aria-current', 'location'); }
      };
      window.addEventListener('scroll', spyUpdate, { passive: true });
      spyUpdate();
    }
  }

  /* ---------- Yazdırmadan önce tüm akordiyonları aç ---------- */
  window.addEventListener('beforeprint', function () {
    document.querySelectorAll('details:not([open])').forEach(function (d) {
      d.setAttribute('open', '');
      d.setAttribute('data-print-opened', '');
    });
  });
  window.addEventListener('afterprint', function () {
    document.querySelectorAll('details[data-print-opened]').forEach(function (d) {
      d.removeAttribute('open');
      d.removeAttribute('data-print-opened');
    });
  });

  /* ---------- Randevu formu: ?sikayet= ön-seçimi ----------
     Hastalık sayfalarındaki CTA'lar ?sikayet=rinit|astim|cilt|besin|ilac|asi taşır. */
  var sikayetSelect = document.getElementById('sikayet');
  if (sikayetSelect) {
    var esle = {
      rinit: 'Burun akıntısı / tıkanıklık',
      astim: 'Öksürük / nefes darlığı',
      cilt: 'Ciltte kaşıntı / kurdeşen',
      besin: 'Besin alerjisi şüphesi',
      ilac: 'İlaç alerjisi şüphesi',
      asi: 'Alerji aşısı hakkında bilgi'
    };
    var istenen = esle[new URLSearchParams(location.search).get('sikayet')];
    if (istenen) {
      [].slice.call(sikayetSelect.options).some(function (o) {
        if (o.text === istenen) { sikayetSelect.value = o.value || o.text; return true; }
        return false;
      });
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
    link.addEventListener('click', function (e) {
      // Demo aşaması: gerçek hat müşteriden gelince WA_NUMBER güncellenecek
      if (WA_NUMBER === '905000000000') {
        e.preventDefault();
        alert('Demo sürümü: WhatsApp hattı, site yayına alındığında aktifleşecektir.\nŞimdilik 0212 709 93 96 numarasını arayabilirsiniz.');
        return;
      }
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
  var PLACEHOLDER_IDS = ['dQw4w9WgXcQ', ''];
  document.querySelectorAll('[data-video]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var id = btn.getAttribute('data-video');
      if (PLACEHOLDER_IDS.indexOf(id) !== -1) {
        // Gerçek video ID'leri müşteriden gelene kadar zarif bekleme kartı
        var box = document.createElement('div');
        box.setAttribute('role', 'dialog');
        box.setAttribute('aria-modal', 'true');
        box.style.cssText = 'position:fixed;inset:0;z-index:200;background:rgba(20,30,29,.9);' +
          'display:flex;align-items:center;justify-content:center;padding:5vw';
        box.innerHTML = '<div style="background:var(--cream);border-radius:18px;padding:2.5rem;max-width:440px;text-align:center">' +
          '<svg viewBox="0 0 48 48" width="46" height="46" fill="none" stroke="var(--mint-ink)" stroke-width="2.5" stroke-linecap="round" style="margin:0 auto 1rem"><rect x="6" y="10" width="36" height="26" rx="4"/><path d="M20 18l10 5-10 5z" fill="var(--coral)" stroke="none"/><path d="M16 42h16"/></svg>' +
          '<h3 style="margin:0 0 .5rem">Video hazırlanıyor</h3>' +
          '<p style="margin:0 0 1.25rem;font-size:.9375rem;color:var(--body)">Dr. Ersoy’un bu konudaki videosu, video kütüphanesi düzenlemesi tamamlandığında burada yayınlanacak.</p>' +
          '<button class="btn btn--ghost btn--sm">Kapat</button></div>';
        var closeCard = function () { box.remove(); btn.focus(); };
        box.addEventListener('click', function (e) { if (e.target === box) closeCard(); });
        box.querySelector('button').addEventListener('click', closeCard);
        document.body.appendChild(box);
        box.querySelector('button').focus();
        return;
      }
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
