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
  copyBtn.addEventListener('click', async () => {
    try {
      await navigator.clipboard.writeText(addr.textContent.trim());
      say('Email address copied.');
    } catch (err) {
      const range = document.createRange();
      range.selectNodeContents(addr);
      const sel = window.getSelection();
      sel.removeAllRanges();
      sel.addRange(range);
      say('Address selected. Press Ctrl+C or Cmd+C to copy it.');
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

  // Experience road: the fill grows as you scroll, and each stop lights up when the fill reaches it
  const road = document.querySelector('.road');
  const roadFill = road.querySelector('.road-fill');
  const roadStar = road.querySelector('.road-star');
  const stops = [...road.querySelectorAll('.node')];
  function updateRoad() {
    const r = road.getBoundingClientRect();
    const line = window.innerHeight * 0.6;
    const p = Math.min(1, Math.max(0, (line - r.top) / r.height));
    roadFill.style.height = `${p * 100}%`;
    roadStar.style.top = `${p * 100}%`;
    roadStar.hidden = p <= 0;
    for (const n of stops) {
      n.classList.toggle('on', n.getBoundingClientRect().top + 9 < line);
    }
  }
  window.addEventListener('scroll', updateRoad, { passive: true });
  window.addEventListener('resize', updateRoad);
  updateRoad();

})();
