// Page behaviour: copy email, smooth in-page scrolling and the experience road.
(() => {
  const motionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');

  // Email is shown as text so it can be copied even where mailto links do nothing
  const copyBtn = document.getElementById('copy-email');
  const addr = document.getElementById('email-address');
  const status = document.getElementById('copy-status');
  let statusTimer = 0;
  const say = (msg) => {
    status.textContent = msg;
    clearTimeout(statusTimer);
    statusTimer = setTimeout(() => { status.textContent = ''; }, 2600);
  };
  copyBtn?.addEventListener('click', async () => {
    const km = document.documentElement.lang === 'km';
    try {
      await navigator.clipboard.writeText(addr.textContent.trim());
      say(km ? 'បានចម្លងអាសយដ្ឋានអ៊ីមែលហើយ។' : 'Email address copied.');
    } catch (err) {
      const range = document.createRange();
      range.selectNodeContents(addr);
      const sel = window.getSelection();
      sel.removeAllRanges();
      sel.addRange(range);
      say(km ? 'បានជ្រើសអាសយដ្ឋានហើយ។ សូមចុច Ctrl+C ឬ Cmd+C ដើម្បីចម្លង។' : 'Address selected. Press Ctrl+C or Cmd+C to copy it.');
    }
  });

  // Smooth scroll for in-page links: an eased glide to the section, stopped by any user input
  let scrollRaf = 0;
  const cancelScroll = () => {
    if (scrollRaf) cancelAnimationFrame(scrollRaf);
    scrollRaf = 0;
  };
  const easeInOut = (k) => (k < 0.5 ? 4 * k * k * k : 1 - Math.pow(-2 * k + 2, 3) / 2);

  function glideTo(targetY) {
    cancelScroll();
    const startY = window.scrollY;
    const dist = targetY - startY;
    if (Math.abs(dist) < 2 || motionQuery.matches) {
      window.scrollTo(0, targetY);
      return;
    }
    const duration = Math.min(1100, Math.max(520, Math.abs(dist) * 0.45));
    const begin = performance.now();
    const step = (now) => {
      const k = Math.min(1, (now - begin) / duration);
      window.scrollTo(0, startY + dist * easeInOut(k));
      scrollRaf = k < 1 ? requestAnimationFrame(step) : 0;
    };
    scrollRaf = requestAnimationFrame(step);
  }

  document.addEventListener('click', (e) => {
    const link = e.target.closest('a[href^="#"]');
    if (!link) return;
    const id = link.getAttribute('href').slice(1);
    if (!id) return;
    if (id === 'top') {
      e.preventDefault();
      glideTo(0);
      return;
    }
    const target = document.getElementById(id);
    if (!target) return;
    e.preventDefault();
    const navOffset = 84; // clearance below the floating navigation pill
    const y = target.getBoundingClientRect().top + window.scrollY - navOffset;
    const maxY = document.documentElement.scrollHeight - window.innerHeight;
    glideTo(Math.max(0, Math.min(maxY, y)));
    // Keyboard activations also move focus to the section, for screen reader and keyboard users
    if (e.detail === 0) {
      target.setAttribute('tabindex', '-1');
      target.focus({ preventScroll: true });
    }
  });
  ['wheel', 'touchstart', 'pointerdown', 'keydown'].forEach((type) =>
    window.addEventListener(type, cancelScroll, { passive: true }));

  // Experience road: a winding road drawn to the size of its box. The centre sways from side to side,
  // the lit trail grows as you scroll, the star rides its tip, and each stop sits on the curve.
  const road = document.querySelector('.road');
  const track = road.querySelector('.road-track');
  const svg = road.querySelector('.road-svg');
  const [edgeLeft, edgeRight] = road.querySelectorAll('.road-edge');
  const dash = road.querySelector('.road-dash');
  const lit = road.querySelector('.road-lit');
  const roadStar = road.querySelector('.road-star');
  const stops = [...road.querySelectorAll('.node')];
  const PERIOD = 400; // pixels from one swing of the road to the next
  let width = 0;
  let height = 0;
  let sway = 0;
  let halfWidth = 0;
  let centre = [];

  // The road's centre x at a given height y: it swings left and right
  function centreX(y) {
    return width / 2 + sway * Math.sin((2 * Math.PI * y) / PERIOD - 0.4);
  }
  function pathOf(points) {
    return points.map((p, i) => `${i ? 'L' : 'M'}${p.x.toFixed(1)} ${p.y.toFixed(1)}`).join(' ');
  }
  // Draw the road again whenever the box changes size
  function build() {
    const box = track.getBoundingClientRect(); // exact size, including fractions of a pixel
    width = box.width;
    height = box.height;
    svg.setAttribute('viewBox', `0 0 ${width} ${height}`);
    sway = width * 0.3;
    halfWidth = width > 300 ? 38 : 9;
    const steps = Math.max(2, Math.round(height / 4));
    centre = Array.from({ length: steps + 1 }, (_, i) => {
      const y = (height * i) / steps;
      return { x: centreX(y), y };
    });
    edgeLeft.setAttribute('d', pathOf(centre.map((p) => ({ x: p.x - halfWidth, y: p.y }))));
    edgeRight.setAttribute('d', pathOf(centre.map((p) => ({ x: p.x + halfWidth, y: p.y }))));
    dash.setAttribute('d', pathOf(centre));
    updateRoad();
  }
  function updateRoad() {
    const r = road.getBoundingClientRect();
    const lineY = window.innerHeight * 0.6;
    const p = Math.min(1, Math.max(0, (lineY - r.top) / r.height));
    const tipY = height * p;
    const tipX = centreX(tipY);
    lit.setAttribute('d', pathOf([...centre.filter((pt) => pt.y <= tipY), { x: tipX, y: tipY }]));
    roadStar.style.left = `${tipX}px`;
    roadStar.style.top = `${tipY}px`;
    roadStar.hidden = p <= 0;
    for (const n of stops) {
      const nr = n.getBoundingClientRect();
      n.style.translate = `${centreX(nr.top + nr.height / 2 - r.top) - width / 2}px 0`;
      n.classList.toggle('on', nr.top + 9 < lineY);
    }
  }
  window.addEventListener('scroll', updateRoad, { passive: true });
  window.addEventListener('load', build);
  // Redraw whenever the road's box changes size: a window resize, a web font arriving, or a language
  // switch that changes the length of the text. The star and stops are placed in pixels, so they must
  // be recalculated with the same size as the drawn road, or they drift off the centre line.
  if ('ResizeObserver' in window) {
    new ResizeObserver(build).observe(road);
  } else {
    window.addEventListener('resize', build);
  }
  build();

  // Typing effect in the hero: the greeting types out, then the title. Reduced motion shows the text at once.
  // Switching language stops the typing and shows the full text in the new language.
  const typedGreeting = document.querySelector('.hero .greeting');
  const typedTitle = document.querySelector('.hero h1');
  if (typedGreeting && typedTitle && !motionQuery.matches) {
    let typingRun = 0;
    const pause = (ms) => new Promise((done) => setTimeout(done, ms));
    // Only the visible language's span types; the other language is hidden by CSS
    const visibleSpan = (el) => [...el.children].find((s) => getComputedStyle(s).display !== 'none');
    async function typeOut(el, speed, run) {
      const span = visibleSpan(el);
      if (!span) return;
      const full = span.textContent;
      const text = document.createTextNode('');
      const caret = document.createElement('span');
      caret.className = 'type-caret';
      caret.setAttribute('aria-hidden', 'true');
      span.textContent = '';
      span.append(text, caret);
      for (let i = 1; i <= full.length && run === typingRun; i++) {
        text.data = full.slice(0, i);
        await pause(speed);
      }
      text.data = full;
      caret.remove();
    }
    async function typeHero() {
      const run = ++typingRun;
      await typeOut(typedGreeting, 70, run);
      if (run !== typingRun) return;
      await pause(180);
      if (run !== typingRun) return;
      await typeOut(typedTitle, 36, run);
    }
    document.addEventListener('langchange', () => { typingRun++; });
    typeHero();
  }

})();
