document.addEventListener('DOMContentLoaded', () => {
  const root = document.documentElement;
  const calm = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const canHover = window.matchMedia('(hover: hover)').matches;
  const toTop = document.querySelector('.to-top');

  // Light / dark toggle, remembered between visits
  const theme = document.querySelector('.theme');
  const sync = () => theme && theme.setAttribute('aria-pressed', String(root.getAttribute('data-theme') === 'dark'));
  sync();
  if (theme) theme.addEventListener('click', () => {
    const next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
    root.setAttribute('data-theme', next);
    try { localStorage.setItem('theme', next); } catch (e) {}
    sync();
  });

  // Home image: the illustration breaks into pixels and re-forms as my photo
  const art = document.querySelector('.hero-art');
  if (art) {
    const imgA = art.querySelector('.art-a'), imgB = art.querySelector('.art-b');
    const cv = document.createElement('canvas');
    art.appendChild(cv);
    const ctx = cv.getContext('2d');
    const off = document.createElement('canvas'), octx = off.getContext('2d');
    let p = 0, from = 0, to = 0, t0 = 0, raf = 0, live = false, held = false;
    const ease = (x) => x < .5 ? 4 * x * x * x : 1 - Math.pow(-2 * x + 2, 3) / 2;
    const size = () => {
      const d = Math.min(window.devicePixelRatio || 1, 2);
      const w = Math.max(1, Math.round(art.clientWidth * d));
      if (cv.width !== w) { cv.width = w; cv.height = w; }
    };
    const draw = () => {
      const W = cv.width;
      const block = 1 + (W / 15) * Math.pow(Math.abs(Math.sin(Math.PI * Math.min(1, Math.max(0, p)))), 1.25);
      ctx.clearRect(0, 0, W, W);
      if (block < 1.6) {
        ctx.imageSmoothingEnabled = true;
        ctx.globalAlpha = 1; ctx.drawImage(imgA, 0, 0, W, W);
        ctx.globalAlpha = ease(p); ctx.drawImage(imgB, 0, 0, W, W);
      } else {
        const n = Math.max(2, Math.round(W / block));
        off.width = n; off.height = n;
        ctx.imageSmoothingEnabled = false;
        const paint = (img, a) => {
          if (a <= 0) return;
          octx.imageSmoothingEnabled = true; octx.clearRect(0, 0, n, n); octx.drawImage(img, 0, 0, n, n);
          ctx.globalAlpha = a; ctx.drawImage(off, 0, 0, n, n, 0, 0, W, W);
        };
        paint(imgA, 1); paint(imgB, ease(p));
      }
      ctx.globalAlpha = 1;
    };
    const step = (now) => {
      const k = Math.min(1, Math.max(0, (now - t0) / 1300));
      p = from + (to - from) * ease(k);
      draw();
      raf = k < 1 ? requestAnimationFrame(step) : 0;
    };
    const go = (v) => {
      if (!live || v === to) return;
      to = v; from = p;
      if (calm) { p = v; draw(); return; }
      cancelAnimationFrame(raf); t0 = performance.now(); raf = requestAnimationFrame(step);
    };
    Promise.all([imgA, imgB].map((i) => (i.decode ? i.decode().catch(() => {}) : Promise.resolve()))).then(() => {
      if (!imgA.naturalWidth || !imgB.naturalWidth) return;
      size(); live = true; draw(); art.classList.add('live');
      if (window.ResizeObserver) new ResizeObserver(() => { size(); draw(); }).observe(art);
    });
    const setHold = () => go(held || art.matches(':focus-visible') ? 1 : 0);
    art.addEventListener('pointerenter', (e) => { if (e.pointerType === 'mouse') go(1); });
    art.addEventListener('pointerleave', (e) => {
      if (e.pointerType === 'mouse') go(held ? 1 : 0);
      art.style.removeProperty('--rx'); art.style.removeProperty('--ry');
    });
    art.addEventListener('focus', () => go(1));
    art.addEventListener('blur', setHold);
    art.addEventListener('click', () => { if (canHover) return; held = !held; art.classList.toggle('show', held); go(held ? 1 : 0); });
    art.addEventListener('keydown', (e) => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); held = !held; art.classList.toggle('show', held); go(held ? 1 : 0); } });
    if (canHover && !calm) {
      art.addEventListener('pointermove', (e) => {
        if (e.pointerType !== 'mouse') return;
        const r = art.getBoundingClientRect();
        const x = (e.clientX - r.left) / r.width, y = (e.clientY - r.top) / r.height;
        art.style.setProperty('--rx', ((x - .5) * 10).toFixed(1) + 'deg');
        art.style.setProperty('--ry', (-(y - .5) * 10).toFixed(1) + 'deg');
        art.style.setProperty('--gx', (x * 100).toFixed(0) + '%');
      });
    }
  }

  // Footer logo: it turns as your cursor moves around it. No clicking.
  const mark = document.querySelector('.foot-mark');
  if (mark) {
    const svg = mark.querySelector('svg');
    let angle = 0, last = null, vel = 0, raf = 0;
    const draw = () => { svg.style.transform = 'rotate(' + angle.toFixed(1) + 'deg)'; };
    const at = (e) => {
      const r = mark.getBoundingClientRect();
      const dx = e.clientX - (r.left + r.width / 2), dy = e.clientY - (r.top + r.height / 2);
      return Math.hypot(dx, dy) < 6 ? null : Math.atan2(dy, dx) * 180 / Math.PI;
    };
    const coast = () => { angle += vel; vel *= .95; draw(); raf = Math.abs(vel) > .05 ? requestAnimationFrame(coast) : 0; };
    mark.addEventListener('pointerenter', (e) => { cancelAnimationFrame(raf); vel = 0; last = at(e); });
    mark.addEventListener('pointermove', (e) => {
      const a = at(e);
      if (a === null || last === null) { last = a; return; }
      let d = a - last;
      if (d > 180) d -= 360;
      if (d < -180) d += 360;
      angle += d; vel = d; last = a; draw();
    });
    mark.addEventListener('pointerleave', () => { last = null; if (!calm && Math.abs(vel) > .3) { cancelAnimationFrame(raf); raf = requestAnimationFrame(coast); } });
  }

  const contactForm = document.querySelector('[data-contact-form]');
  if (contactForm) {
    contactForm.addEventListener('submit', (event) => {
      event.preventDefault();
      const fields = new FormData(contactForm);
      const recipient = contactForm.dataset.recipient;
      const subject = 'Portfolio message from ' + fields.get('name');
      const body = 'From: ' + fields.get('name') + ' (' + fields.get('email') + ')\n\n' + fields.get('message');
      const status = contactForm.querySelector('[data-form-status]');
      status.textContent = 'Opening your email app with this message. Please send it there to complete delivery.';
      window.location.href = 'mailto:' + recipient +
        '?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(body);
    });
  }

  // Keep the navigation compact while scrolling and update its progress line.
  const nav = document.querySelector('.nav');
  const bar = () => {
    const h = root.scrollHeight - root.clientHeight;
    const scrollY = window.scrollY || root.scrollTop;
    root.style.setProperty('--p', h > 0 ? (scrollY / h).toFixed(3) : 0);
    if (nav) nav.classList.toggle('scrolled', scrollY > 24);
    if (toTop) toTop.classList.toggle('show', scrollY > 500);
  };
  bar();
  window.addEventListener('scroll', bar, { passive: true });
  window.addEventListener('resize', bar);

  const carousel = document.querySelector('[data-cert-carousel]');
  if (carousel) {
    const cards = [...carousel.querySelectorAll('.cert-card')];
    const dots = [...carousel.querySelectorAll('[data-cert-dot]')];
    const count = carousel.querySelector('[data-cert-count]');
    const cap = carousel.querySelector('[data-cert-caption]');
    const view = carousel.querySelector('.cert-viewport');
    const n = cards.length;
    let active = 0, dragged = false;
    const place = (announce) => {
      cards.forEach((c, i) => {
        let o = i - active;
        if (o > n / 2) o -= n;
        if (o < -n / 2) o += n;
        const on = o === 0;
        c.style.setProperty('--o', o);
        c.style.setProperty('--ao', Math.abs(o));
        c.classList.toggle('is-active', on);
        c.classList.toggle('far', Math.abs(o) > 2);
        c.setAttribute('aria-hidden', on ? 'false' : 'true');
        c.querySelector('a').tabIndex = on ? 0 : -1;
      });
      dots.forEach((d, i) => { if (i === active) d.setAttribute('aria-current', 'true'); else d.removeAttribute('aria-current'); });
      count.textContent = (active + 1) + ' / ' + n;
      if (announce) {
        cap.querySelector('strong').textContent = cards[active].dataset.title;
        cap.querySelector('small').textContent = 'CodeSignal \u00b7 ' + cards[active].dataset.date;
        cap.classList.remove('swap'); void cap.offsetWidth; cap.classList.add('swap');
      }
    };
    const show = (next) => { active = (next + n) % n; place(true); };
    place(false);
    carousel.querySelector('[data-cert-prev]').addEventListener('click', () => show(active - 1));
    carousel.querySelector('[data-cert-next]').addEventListener('click', () => show(active + 1));
    dots.forEach((d) => d.addEventListener('click', () => show(Number(d.dataset.certDot))));
    cards.forEach((c, i) => c.addEventListener('click', (e) => { if (i !== active) { e.preventDefault(); show(i); } }));
    carousel.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowLeft') { e.preventDefault(); show(active - 1); }
      if (e.key === 'ArrowRight') { e.preventDefault(); show(active + 1); }
    });
    // swipe or drag to flip
    let sx = null;
    view.addEventListener('pointerdown', (e) => { sx = e.clientX; dragged = false; });
    view.addEventListener('pointerup', (e) => {
      if (sx === null) return;
      const dx = e.clientX - sx; sx = null;
      if (Math.abs(dx) > 45) { dragged = true; show(active + (dx < 0 ? 1 : -1)); }
    });
    view.addEventListener('pointercancel', () => { sx = null; });
    view.addEventListener('click', (e) => { if (dragged) { e.preventDefault(); e.stopPropagation(); dragged = false; } }, true);
    // tilt and light on the front certificate
    if (canHover && !calm) {
      view.addEventListener('pointermove', (e) => {
        if (e.pointerType !== 'mouse') return;
        const f = cards[active], r = f.getBoundingClientRect();
        const x = (e.clientX - r.left) / r.width, y = (e.clientY - r.top) / r.height;
        if (x < 0 || x > 1 || y < 0 || y > 1) { f.style.removeProperty('--tx'); f.style.removeProperty('--ty'); return; }
        f.style.setProperty('--tx', ((x - .5) * 12).toFixed(1) + 'deg');
        f.style.setProperty('--ty', (-(y - .5) * 12).toFixed(1) + 'deg');
        f.style.setProperty('--gx', (x * 100).toFixed(0) + '%');
      });
      view.addEventListener('pointerleave', () => cards.forEach((f) => { f.style.removeProperty('--tx'); f.style.removeProperty('--ty'); }));
    }
  }

  // Hero line: types out my roles
  const role = document.querySelector('[data-roles]');
  if (role && !calm) {
    const words = JSON.parse(role.dataset.roles);
    let w = 0, c = 0, del = false;
    role.textContent = '';
    const tick = () => {
      const word = words[w];
      c += del ? -1 : 1;
      role.textContent = word.slice(0, c);
      let wait = del ? 40 : 85;
      if (!del && c === word.length) { del = true; wait = 1700; }
      else if (del && c === 0) { del = false; w = (w + 1) % words.length; wait = 350; }
      setTimeout(tick, wait);
    };
    setTimeout(tick, 700);
  }

  // Live local time in Valenzuela
  const clock = document.querySelector('[data-clock]');
  if (clock) {
    const f = new Intl.DateTimeFormat('en-US', { hour: 'numeric', minute: '2-digit', timeZone: 'Asia/Manila' });
    const t = () => { clock.textContent = f.format(new Date()); };
    t(); setInterval(t, 15000);
    clock.closest('.clock-wrap').hidden = false;
  }

  // Back to top
  if (toTop) toTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: calm ? 'auto' : 'smooth' }));

  // Targeting reticle: four brackets follow the pointer and lock onto links and buttons
  if (canHover && !calm) {
    const r = document.createElement('div');
    r.className = 'reticle';
    r.innerHTML = '<i></i><i></i><i></i><i></i>';
    document.body.appendChild(r);
    let px = -100, py = -100, x = -100, y = -100, w = 24, h = 24, target = null;
    const sel = 'a, button, input, textarea, select, .hero-art, [tabindex]:not([tabindex="-1"])';
    window.addEventListener('pointermove', (e) => {
      if (e.pointerType === 'touch') return;
      px = e.clientX; py = e.clientY;
      r.classList.add('on');
      const t = e.target.closest ? e.target.closest(sel) : null;
      const ok = t && t.getBoundingClientRect().width < window.innerWidth * .9 ? t : null;
      if (ok !== target) { target = ok; r.classList.remove('lock'); if (ok) { void r.offsetWidth; r.classList.add('lock'); } }
    });
    document.addEventListener('mouseleave', () => r.classList.remove('on'));
    const loop = () => {
      let tx = px - 12, ty = py - 12, tw = 24, th = 24;
      if (target) { const b = target.getBoundingClientRect(); tx = b.left - 6; ty = b.top - 6; tw = b.width + 12; th = b.height + 12; }
      x += (tx - x) * .28; y += (ty - y) * .28; w += (tw - w) * .28; h += (th - h) * .28;
      r.style.transform = 'translate(' + x.toFixed(1) + 'px,' + y.toFixed(1) + 'px)';
      r.style.width = w.toFixed(1) + 'px'; r.style.height = h.toFixed(1) + 'px';
      requestAnimationFrame(loop);
    };
    loop();
  }

  // Soft light that follows the pointer across project cards
  document.querySelectorAll('.project-card').forEach((card) => card.addEventListener('pointermove', (e) => {
    const r = card.getBoundingClientRect();
    card.style.setProperty('--mx', (e.clientX - r.left) + 'px');
    card.style.setProperty('--my', (e.clientY - r.top) + 'px');
  }));

  // Copy email, with a small toast
  const toast = document.createElement('div');
  toast.className = 'toast'; toast.setAttribute('role', 'status');
  document.body.appendChild(toast);
  let tt;
  const say = (m) => { toast.textContent = m; toast.classList.add('show'); clearTimeout(tt); tt = setTimeout(() => toast.classList.remove('show'), 2000); };
  document.querySelectorAll('[data-copy]').forEach((b) => b.addEventListener('click', async () => {
    const v = b.dataset.copy;
    try { await navigator.clipboard.writeText(v); }
    catch (err) { const t = document.createElement('textarea'); t.value = v; document.body.appendChild(t); t.select(); try { document.execCommand('copy'); } catch (e2) {} t.remove(); }
    say('Email copied');
  }));

  // Fade between pages
  document.addEventListener('click', (e) => {
    const a = e.target.closest('a');
    if (!a || calm || e.defaultPrevented || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey || e.button) return;
    const u = new URL(a.href, location.href);
    if (u.origin !== location.origin || a.target === '_blank' || a.hasAttribute('download') || (u.pathname === location.pathname && u.hash) || !/\.php$|\/$/.test(u.pathname)) return;
    e.preventDefault();
    document.body.classList.add('leaving');
    setTimeout(() => { location.href = a.href; }, 220);
  });
  window.addEventListener('pageshow', (e) => { if (e.persisted) document.body.classList.remove('leaving'); });

  // Scroll reveal
  const targets = document.querySelectorAll('.index-list li, .project-card, .contact-list li, .more');
  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
    }, { threshold: 0.12 });
    targets.forEach((el, i) => { el.classList.add('reveal'); el.style.transitionDelay = (i % 4) * 70 + 'ms'; io.observe(el); });
  }
});
