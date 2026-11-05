document.addEventListener('DOMContentLoaded', () => {
  const root = document.documentElement;

  // Light / dark toggle, remembered between visits
  const theme = document.querySelector('.theme');
  const sync = () => theme && theme.setAttribute('aria-pressed', String(root.getAttribute('data-theme') === 'dark'));
  sync();
  if (theme) {
    theme.addEventListener('click', () => {
      const next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
      root.setAttribute('data-theme', next);
      try { localStorage.setItem('theme', next); } catch (e) {}
      sync();
    });
  }

  // Mobile menu
  const burger = document.querySelector('.burger');
  const menu = document.getElementById('menu');
  if (burger && menu) {
    burger.addEventListener('click', () => {
      const open = menu.classList.toggle('open');
      burger.setAttribute('aria-expanded', String(open));
    });
  }

  // Footer logo: drag to spin freely, tap or press Enter to turn 90 degrees
  const knob = document.querySelector('.knob');
  if (knob) {
    const svg = knob.querySelector('svg');
    let angle = 0, last = 0, travelled = 0, dragging = false;
    const apply = () => { svg.style.transform = 'rotate(' + angle + 'deg)'; };
    const at = (e) => {
      const r = knob.getBoundingClientRect();
      return Math.atan2(e.clientY - (r.top + r.height / 2), e.clientX - (r.left + r.width / 2)) * 180 / Math.PI;
    };
    knob.addEventListener('pointerdown', (e) => {
      dragging = true; travelled = 0; last = at(e);
      knob.setPointerCapture(e.pointerId);
      svg.style.transition = 'none';
    });
    knob.addEventListener('pointermove', (e) => {
      if (!dragging) return;
      const a = at(e);
      let d = a - last;
      if (d > 180) d -= 360;
      if (d < -180) d += 360;
      angle += d; travelled += Math.abs(d); last = a;
      apply();
    });
    const end = () => {
      if (!dragging) return;
      dragging = false;
      svg.style.transition = '';
      if (travelled < 4) { angle += 90; apply(); }
    };
    knob.addEventListener('pointerup', end);
    knob.addEventListener('pointercancel', end);
    knob.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ' || e.key === 'ArrowRight') { e.preventDefault(); angle += 90; apply(); }
      if (e.key === 'ArrowLeft') { e.preventDefault(); angle -= 90; apply(); }
    });
  }

  // Scroll reveal
  const targets = document.querySelectorAll('.band .rail, .index-list li, .project, .contact-list li, .more');
  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
      });
    }, { threshold: 0.12 });
    targets.forEach((el, i) => {
      el.classList.add('reveal');
      el.style.transitionDelay = (i % 4) * 70 + 'ms';
      io.observe(el);
    });
  }
});
