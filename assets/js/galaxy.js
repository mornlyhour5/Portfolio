// Galaxy: sky canvas, nebula, stars, shooting stars, cursor and the animation loop.
(() => {
  const root = document.documentElement;
  const canvas = document.getElementById('sky');
  const ctx = canvas.getContext('2d');
  const motionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');

  // Galaxy palette per theme. Tints are r, g, b. Haze blobs are [x, y, radius, rgb, alpha],
  // with x and y as fractions of the screen and radius as a fraction of the screen diagonal.
  const BAND_ANGLE = -0.5;
  const PAL = {
    dark: {
      tints: ['240, 246, 255', '150, 200, 255', '120, 230, 255'],
      core: '235, 245, 255',
      nebula: 0.67,
      scrim: 0.72,
      alpha: 1,
      flare: 1,
      additive: true,
      bokeh: ['60, 130, 255', '90, 200, 255'],
      bokehAlpha: 0.45,
      shooter: '200, 225, 255',
      haze: [
        [0.7, 0.35, 0.5, '40, 110, 255', 0.11],
        [0.12, 0.92, 0.45, '30, 170, 255', 0.06],
        [0.92, 0.9, 0.4, '70, 130, 255', 0.04]
      ]
    },
    light: {
      // Violet and indigo stars with pastel haze. The colour comes from the CSS page background
      tints: ['109, 70, 214', '167, 110, 240', '40, 90, 200'],
      core: '109, 70, 214',
      nebula: 0,
      scrim: 0,
      alpha: 0.6,
      flare: 0.7,
      additive: false,
      bokeh: ['196, 181, 253', '125, 211, 252'],
      bokehAlpha: 0.22,
      shooter: '109, 70, 214',
      haze: [
        [0.7, 0.35, 0.5, '196, 181, 253', 0.2],
        [0.12, 0.92, 0.45, '125, 211, 252', 0.16],
        [0.92, 0.12, 0.4, '249, 168, 212', 0.14]
      ]
    }
  };

  const N = 1400;
  const stars = [];
  const flares = [];
  const bokehs = [];
  const shooters = [];
  const sprites = {};
  let W = 0, H = 0, dpr = 1;
  let theme = '';
  let raf = 0, last = 0, t = 0, nextShot = 2;
  let px = 0.5, py = 0.5, sx = 0.5, sy = 0.5;

  // Box-Muller normal sample, used to cluster stars along the galaxy band
  const gauss = () => {
    let u = 0, v = 0;
    while (u === 0) u = Math.random();
    while (v === 0) v = Math.random();
    return Math.sqrt(-2 * Math.log(u)) * Math.cos(2 * Math.PI * v);
  };

  // Radial sprite with color stops given as [position, alpha]
  function radial(size, rgb, stops) {
    const c = document.createElement('canvas');
    c.width = size;
    c.height = size;
    const g = c.getContext('2d');
    const r = size / 2;
    const grd = g.createRadialGradient(r, r, 0, r, r, r);
    for (const [p, a] of stops) grd.addColorStop(p, `rgba(${rgb}, ${a})`);
    g.fillStyle = grd;
    g.fillRect(0, 0, size, size);
    return c;
  }

  // Thin horizontal diffraction line: bright center, tapering to nothing at both ends
  function spikeSprite(rgb) {
    const w = 256, h = 16;
    const c = document.createElement('canvas');
    c.width = w;
    c.height = h;
    const g = c.getContext('2d');
    const grd = g.createLinearGradient(0, 0, w, 0);
    grd.addColorStop(0, `rgba(${rgb}, 0)`);
    grd.addColorStop(0.35, `rgba(${rgb}, 0.22)`);
    grd.addColorStop(0.5, `rgba(${rgb}, 1)`);
    grd.addColorStop(0.65, `rgba(${rgb}, 0.22)`);
    grd.addColorStop(1, `rgba(${rgb}, 0)`);
    for (let y = 0; y < h; y++) {
      const k = 1 - Math.abs(y + 0.5 - h / 2) / (h / 2);
      g.globalAlpha = k * k * k;
      g.fillStyle = grd;
      g.fillRect(0, y, w, 1);
    }
    return c;
  }

  function buildSet(th) {
    const p = PAL[th];
    return {
      stars: p.tints.map((c) => radial(64, c, [[0, 1], [0.12, 0.95], [0.3, 0.35], [0.6, 0.08], [1, 0]])),
      glow: radial(128, p.core, [[0, 1], [0.06, 0.9], [0.18, 0.42], [0.42, 0.12], [0.7, 0.03], [1, 0]]),
      spike: spikeSprite(p.core),
      bokeh: p.bokeh.map((c) => radial(160, c, [[0, 0.55], [0.6, 0.4], [0.85, 0.12], [1, 0]]))
    };
  }

  // Depth: most stars sit far away and are small and dim, a few are near and bright
  function seed() {
    stars.length = 0;
    for (let i = 0; i < N; i++) {
      const band = i < N * 0.42;
      const d = Math.pow(Math.random(), 2.2);
      const r = Math.random();
      stars.push({
        band,
        u: band ? Math.max(-0.9, Math.min(0.9, gauss() * 0.3)) : 0,
        v: band ? gauss() * 0.035 : 0,
        x: Math.random(),
        y: Math.random(),
        d,
        tint: r < 0.8 ? 0 : r < 0.95 ? 1 : 2,
        a: 0.2 + d * 0.75,
        tw: Math.random() < 0.5 ? 0.6 + Math.random() * 2 : 0,
        ph: Math.random() * Math.PI * 2,
        spd: 1 + d * 14
      });
    }
  }

  // Bright stars with long diffraction spikes that breathe and wobble
  function seedFlares() {
    flares.length = 0;
    for (let i = 0; i < 18; i++) {
      flares.push({
        x: Math.random(),
        y: Math.random(),
        size: 0.7 + Math.random() * 0.9,
        ph: Math.random() * Math.PI * 2,
        sp: 0.5 + Math.random() * 1.0,
        rot: (Math.random() - 0.5) * 0.12,
        d: 0.8 + Math.random() * 0.4
      });
    }
  }

  // Soft purple and pink orbs, out of focus, drifting slowly
  function seedBokeh() {
    bokehs.length = 0;
    for (let i = 0; i < 26; i++) {
      bokehs.push({
        x: Math.random(),
        y: Math.random(),
        r: 24 + Math.random() * 70,
        d: Math.random(),
        ph: Math.random() * Math.PI * 2,
        sp: 0.15 + Math.random() * 0.35,
        spd: 2 + Math.random() * 6,
        k: i % 2
      });
    }
  }

  // Shooting stars: a streak with a fading tail, launched every few seconds
  function spawnShooter() {
    const dir = Math.random() < 0.6 ? 1 : -1;
    const ang = (18 + Math.random() * 14) * Math.PI / 180;
    const speed = 700 + Math.random() * 500;
    const x = dir > 0 ? Math.random() * W * 0.55 : W * (0.45 + Math.random() * 0.55);
    shooters.push({
      x,
      y: Math.random() * H * 0.35,
      vx: dir * Math.cos(ang) * speed,
      vy: Math.sin(ang) * speed,
      life: 0,
      max: 0.8 + Math.random() * 0.6,
      len: 120 + Math.random() * 160
    });
  }

  function updateShooters(dt) {
    for (let i = shooters.length - 1; i >= 0; i--) {
      const s = shooters[i];
      s.x += s.vx * dt;
      s.y += s.vy * dt;
      s.life += dt;
      if (s.life > s.max) shooters.splice(i, 1);
    }
    nextShot -= dt;
    if (nextShot <= 0) {
      spawnShooter();
      if (Math.random() < 0.5) spawnShooter();
      nextShot = 1.2 + Math.random() * 2.3;
    }
  }

  // Nebula: fractal noise with domain warping, coloured through a dark blue to violet, pink and white ramp,
  // with teal streaks. Built once into a small canvas and stretched to the screen, so the clouds stay soft.
  const hash2 = (x, y, s) => {
    let h = Math.imul(x, 374761393) ^ Math.imul(y, 668265263) ^ Math.imul(s, 2147483647);
    h = Math.imul(h ^ (h >>> 13), 1274126177);
    h ^= h >>> 16;
    return (h >>> 0) / 4294967295;
  };
  const vnoise = (x, y, s) => {
    const xi = Math.floor(x), yi = Math.floor(y);
    const xf = x - xi, yf = y - yi;
    const u = xf * xf * (3 - 2 * xf), v = yf * yf * (3 - 2 * yf);
    const a = hash2(xi, yi, s), b = hash2(xi + 1, yi, s);
    const c = hash2(xi, yi + 1, s), d = hash2(xi + 1, yi + 1, s);
    return a + (b - a) * u + (c - a) * v + (a - b - c + d) * u * v;
  };
  const fbm = (x, y, s, oct) => {
    let sum = 0, amp = 0.5, freq = 1, norm = 0;
    for (let i = 0; i < oct; i++) {
      sum += amp * vnoise(x * freq, y * freq, s + i * 17);
      norm += amp;
      amp *= 0.5;
      freq *= 2.03;
    }
    return sum / norm;
  };
  const smooth = (a, b, x) => {
    const k = Math.min(1, Math.max(0, (x - a) / (b - a)));
    return k * k * (3 - 2 * k);
  };
  const RAMP = [
    [0.0, 8, 14, 48],
    [0.35, 26, 34, 110],
    [0.5, 92, 56, 214],
    [0.64, 186, 74, 214],
    [0.8, 255, 122, 214],
    [1.0, 244, 232, 255]
  ];
  function ramp(v) {
    for (let k = 1; k < RAMP.length; k++) {
      if (v <= RAMP[k][0]) {
        const p = RAMP[k - 1], q = RAMP[k];
        const f = (v - p[0]) / (q[0] - p[0]);
        return [p[1] + (q[1] - p[1]) * f, p[2] + (q[2] - p[2]) * f, p[3] + (q[3] - p[3]) * f];
      }
    }
    const last = RAMP[RAMP.length - 1];
    return [last[1], last[2], last[3]];
  }
  function buildNebula(NW = 480, NH = 300) {
    const c = document.createElement('canvas');
    c.width = NW;
    c.height = NH;
    const g = c.getContext('2d');
    const img = g.createImageData(NW, NH);
    const data = img.data;
    // A random offset gives each visit a slightly different cloud pattern
    const ox0 = Math.random() * 40, oy0 = Math.random() * 40;
    for (let j = 0; j < NH; j++) {
      for (let i = 0; i < NW; i++) {
        const x = ox0 + (i / NW) * 3.2;
        const y = oy0 + (j / NW) * 3.2;
        const qx = fbm(x, y, 3, 4);
        const qy = fbm(x + 5.2, y + 1.3, 7, 4);
        const dens = Math.min(1, Math.max(0, (fbm(x + 2.4 * qx, y + 2.4 * qy, 13, 6) - 0.4) * 2.8));
        const hue = fbm(x + 1.7 * qy + 4.1, y + 1.7 * qx + 2.7, 29, 3);
        const col = ramp(dens);
        const teal = smooth(0.6, 0.78, hue) * 0.7 * smooth(0.3, 0.7, dens);
        const k = (j * NW + i) * 4;
        data[k] = col[0] + (72 - col[0]) * teal;
        data[k + 1] = col[1] + (224 - col[1]) * teal;
        data[k + 2] = col[2] + (196 - col[2]) * teal;
        data[k + 3] = smooth(0.12, 0.75, dens) * 235;
      }
    }
    g.putImageData(img, 0, 0);
    return c;
  }
  // Three nebula layers at different scales, speeds and turns, so the clouds drift past each other
  const NEB_LAYERS = [
    { w: 480, h: 300, scale: 1.3, speed: 0.09, rot: 0.035, alpha: 1.0 },
    { w: 360, h: 225, scale: 1.55, speed: -0.05, rot: -0.03, alpha: 0.6 },
    { w: 320, h: 200, scale: 1.8, speed: 0.035, rot: 0.02, alpha: 0.42 }
  ];
  let nebulaLayers = null;
  function drawNebula(pal) {
    if (!nebulaLayers) nebulaLayers = NEB_LAYERS.map((L) => buildNebula(L.w, L.h));
    if (pal.nebula > 0) {
      NEB_LAYERS.forEach((L, i) => {
        const dw = W * L.scale, dh = H * L.scale;
        const breathe = 0.82 + 0.18 * Math.sin(t * 0.35 + i * 2.1);
        // Each layer wanders and turns slowly; the pointer shifts the layers by different amounts for depth
        const ox = Math.sin(t * L.speed + i * 1.7) * W * 0.05 - (sx - 0.5) * 24 * (i + 1) * 0.5;
        const oy = Math.cos(t * L.speed * 0.8 + i) * H * 0.04 - (sy - 0.5) * 16 * (i + 1) * 0.5;
        ctx.save();
        ctx.translate(W / 2 + ox, H / 2 + oy);
        ctx.rotate(Math.sin(t * L.speed * 0.6 + i) * L.rot);
        ctx.globalAlpha = pal.nebula * L.alpha * breathe;
        ctx.drawImage(nebulaLayers[i], -dw / 2, -dh / 2, dw, dh);
        ctx.restore();
      });
    }
    if (pal.scrim > 0) {
      // A darker shade behind the text on the left keeps the headline readable
      const sg = ctx.createLinearGradient(0, 0, W * 0.62, 0);
      sg.addColorStop(0, `rgba(4, 11, 28, ${pal.scrim})`);
      sg.addColorStop(1, 'rgba(4, 11, 28, 0)');
      ctx.globalAlpha = 1;
      ctx.fillStyle = sg;
      ctx.fillRect(0, 0, W, H);
    }
  }

  // Dust motes rising slowly, each one twinkling
  const dust = [];
  function seedDust() {
    dust.length = 0;
    for (let i = 0; i < 130; i++) {
      dust.push({
        x: Math.random(),
        y: Math.random(),
        r: 0.5 + Math.random() * 1.1,
        d: Math.random(),
        sp: 2 + Math.random() * 6,
        ph: Math.random() * Math.PI * 2,
        tw: 0.5 + Math.random() * 1.5
      });
    }
  }
  function advanceDust(dt) {
    for (const p of dust) {
      p.y -= (p.sp * (0.4 + p.d) * dt) / (H || 1);
      if (p.y < -0.02) {
        p.y += 1.04;
        p.x = Math.random();
      }
    }
  }
  function drawDust(pal, set) {
    for (const p of dust) {
      const x = p.x * W + (sx - 0.5) * 30 * (0.3 + p.d) + Math.sin(t * 0.4 + p.ph) * 6;
      const y = p.y * H + (sy - 0.5) * 20 * (0.3 + p.d);
      const a = (0.25 + 0.5 * p.d) * (0.6 + 0.4 * Math.sin(t * p.tw + p.ph)) * pal.alpha;
      const s = p.r * 2 + p.d * 2;
      ctx.globalAlpha = Math.min(1, a);
      ctx.drawImage(set.stars[0], x - s / 2, y - s / 2, s, s);
    }
  }

  // Pointer position, used to brighten the stars near the cursor
  let hovering = false, hoverX = 0, hoverY = 0;

  // Custom cursor: the ring follows the pointer, morphs while scrolling, and leaves a short star trail
  const cursor = document.querySelector('.cursor');
  const cursorOn = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
  let cx = 0, cy = 0;
  let ringSpin = 0;
  const cursorRing = cursor.querySelector('.cursor-ring');
  if (cursorOn) root.classList.add('custom-cursor');
  let scrollTimer = 0;
  const markScrolling = () => {
    cursor.classList.add('scrolling');
    clearTimeout(scrollTimer);
    scrollTimer = setTimeout(() => cursor.classList.remove('scrolling'), 280);
    schedule();
  };
  if (cursorOn) {
    window.addEventListener('wheel', markScrolling, { passive: true });
    window.addEventListener('scroll', markScrolling, { passive: true });
    document.addEventListener('pointerover', (e) => {
      const link = e.target.closest && e.target.closest('a, button');
      cursor.classList.toggle('is-link', !!link);
    });
  }
  function updateCursor(dt, animate) {
    if (!cursorOn) return;
    const k = animate ? Math.min(1, dt * 45) : 1;
    const px = cx, py = cy;
    cx += (hoverX - cx) * k;
    cy += (hoverY - cy) * k;
    cursor.style.transform = `translate3d(${cx}px, ${cy}px, 0)`;
    // The star spins in proportion to how far the pointer travelled this frame
    const dist = Math.min(40, Math.hypot(cx - px, cy - py));
    if (animate && dist > 0.05) {
      ringSpin = (ringSpin + dist * 2.2) % 360;
      cursorRing.style.setProperty('--spin', `${ringSpin}deg`);
    }
  }

  function resize() {
    dpr = Math.min(window.devicePixelRatio || 1, 2);
    W = canvas.clientWidth;
    H = canvas.clientHeight;
    canvas.width = Math.round(W * dpr);
    canvas.height = Math.round(H * dpr);
    schedule();
  }

  function advance(dt) {
    const diag = Math.hypot(W, H) || 1;
    for (const s of stars) {
      if (s.band) {
        s.u += (s.spd * dt) / diag;
        if (s.u > 0.9) s.u -= 1.8;
      } else {
        s.x -= (s.spd * dt) / (W || 1);
        if (s.x < 0) s.x += 1;
      }
    }
    for (const b of bokehs) {
      b.x -= (b.spd * dt) / (W || 1);
      if (b.x * W < -b.r) b.x += (W + 2 * b.r) / (W || 1);
    }
  }

  function drawBokeh(pal, set) {
    for (const b of bokehs) {
      const x = b.x * W + (sx - 0.5) * 30 * (0.3 + b.d);
      const y = b.y * H + Math.sin(t * b.sp + b.ph) * 14 + (sy - 0.5) * 22 * (0.3 + b.d);
      const pulse = 0.75 + 0.25 * Math.sin(t * b.sp * 1.7 + b.ph);
      ctx.globalAlpha = pal.bokehAlpha * pulse;
      ctx.drawImage(set.bokeh[b.k], x - b.r, y - b.r, b.r * 2, b.r * 2);
    }
  }

  function drawFlares(pal, set) {
    for (const f of flares) {
      const x = f.x * W + (sx - 0.5) * 40 * f.d;
      const y = f.y * H + (sy - 0.5) * 28 * f.d;
      const p = 0.5 + 0.5 * Math.sin(t * f.sp + f.ph);
      const flick = 0.9 + 0.1 * Math.sin(t * 6.1 + f.ph * 2.7);
      const L = (46 + 84 * f.size) * (0.72 + 0.28 * p);
      const thick = 1.6 + 1.0 * p;
      const gs = (16 + 24 * f.size) * (0.85 + 0.15 * p);
      ctx.globalAlpha = Math.min(1, pal.flare * (0.6 + 0.4 * p) * flick);
      ctx.drawImage(set.glow, x - gs / 2, y - gs / 2, gs, gs);
      ctx.save();
      ctx.translate(x, y);
      ctx.rotate(f.rot + Math.sin(t * 0.35 + f.ph) * 0.04);
      ctx.drawImage(set.spike, -L, -thick / 2, L * 2, thick);
      ctx.rotate(Math.PI / 2);
      ctx.drawImage(set.spike, -L, -thick / 2, L * 2, thick);
      ctx.restore();
    }
  }

  function drawShooters(pal, set) {
    for (const s of shooters) {
      const k = Math.min(1, s.life / s.max);
      const fade = Math.sin(Math.PI * k);
      const sp = Math.hypot(s.vx, s.vy);
      const ux = s.vx / sp;
      const uy = s.vy / sp;
      const tx = s.x - ux * s.len;
      const ty = s.y - uy * s.len;
      const g = ctx.createLinearGradient(s.x, s.y, tx, ty);
      g.addColorStop(0, `rgba(${pal.shooter}, ${0.95 * fade})`);
      g.addColorStop(1, `rgba(${pal.shooter}, 0)`);
      ctx.globalAlpha = 1;
      ctx.strokeStyle = g;
      ctx.lineWidth = 1.5;
      ctx.lineCap = 'round';
      ctx.beginPath();
      ctx.moveTo(s.x, s.y);
      ctx.lineTo(tx, ty);
      ctx.stroke();
      ctx.globalAlpha = fade;
      ctx.drawImage(set.glow, s.x - 9, s.y - 9, 18, 18);
    }
  }

  function draw() {
    const th = currentTheme();
    if (th !== theme) {
      theme = th;
      if (!sprites[th]) sprites[th] = buildSet(th);
    }
    const pal = PAL[th];
    const set = sprites[th];
    const diag = Math.hypot(W, H);
    const cosA = Math.cos(BAND_ANGLE);
    const sinA = Math.sin(BAND_ANGLE);
    const nx = -sinA;
    const ny = cosA;
    const bx = W * 0.7;
    const by = H * 0.35;

    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    ctx.globalCompositeOperation = 'source-over';
    ctx.globalAlpha = 1;
    ctx.clearRect(0, 0, W, H);
    drawNebula(pal);

    for (const [hx, hy, hr, rgb, a] of pal.haze) {
      const cx = W * hx;
      const cy = H * hy;
      const g = ctx.createRadialGradient(cx, cy, 0, cx, cy, diag * hr);
      g.addColorStop(0, `rgba(${rgb}, ${a * (0.85 + 0.15 * Math.sin(t * 0.5 + hx * 6))})`);
      g.addColorStop(1, `rgba(${rgb}, 0)`);
      ctx.fillStyle = g;
      ctx.fillRect(0, 0, W, H);
    }

    ctx.globalCompositeOperation = pal.additive ? 'lighter' : 'source-over';
    drawBokeh(pal, set);
    drawDust(pal, set);

    for (const s of stars) {
      let x, y;
      if (s.band) {
        const along = s.u * diag;
        const across = s.v * diag;
        x = bx + along * cosA + across * nx;
        y = by + along * sinA + across * ny;
      } else {
        x = s.x * W;
        y = s.y * H;
      }
      // Parallax: near stars follow the pointer more than far ones
      x += (sx - 0.5) * 40 * (0.2 + s.d);
      y += (sy - 0.5) * 28 * (0.2 + s.d);
      if (x < -20 || x > W + 20 || y < -20 || y > H + 20) continue;

      let a = s.a * pal.alpha;
      if (s.tw) a *= 0.5 + 0.5 * Math.sin(t * s.tw + s.ph);
      a = Math.max(0, Math.min(1, a));

      const size = 2 + s.d * 12;
      ctx.globalAlpha = a;
      ctx.drawImage(set.stars[s.tint], x - size / 2, y - size / 2, size, size);
    }

    drawFlares(pal, set);
    drawShooters(pal, set);
    ctx.globalAlpha = 1;
  }

  // Animates while motion is allowed, draws a single still frame otherwise
  function tick(now) {
    raf = 0;
    const dt = Math.min(0.05, Math.max(0, (now - last) / 1000));
    last = now;
    const animate = !motionQuery.matches;
    if (animate) {
      t += dt;
      advance(dt);
      updateShooters(dt);
      advanceDust(dt);
      sx += (px - sx) * 0.035;
      sy += (py - sy) * 0.035;
    } else {
      sx = 0.5;
      sy = 0.5;
    }
    updateCursor(dt, animate);
    draw();
    if (animate) raf = requestAnimationFrame(tick);
  }

  function schedule() {
    if (!raf) raf = requestAnimationFrame(tick);
  }

  document.addEventListener('themechange', schedule);
  motionQuery.addEventListener('change', schedule);
  window.addEventListener('resize', resize);
  window.addEventListener('pointermove', (e) => {
    if (!W || !H) return;
    px = e.clientX / W;
    py = e.clientY / H;
    hovering = true;
    hoverX = e.clientX;
    hoverY = e.clientY;
    cursor.classList.add('seen');
    schedule();
  }, { passive: true });
  window.addEventListener('pointerout', (e) => {
    if (!e.relatedTarget) {
      hovering = false;
      cursor.classList.remove('seen');
      schedule();
    }
  });

  resize();
  seed();
  seedFlares();
  seedBokeh();
  seedDust();
  last = performance.now();
  schedule();
})();
