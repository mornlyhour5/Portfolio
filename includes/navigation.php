<header class="bar">
  <div class="wrap">
    <nav class="pill glass" aria-label="Main">
      <a class="wordmark" href="#top"><?= e($profile['nickname']) ?><span>.</span></a>
      <div class="pill-end">
        <div class="pill-links">
          <?php foreach ($sections as $id => $label): ?>
          <a href="#<?= e($id) ?>"><?= tr($label) ?></a>
          <?php endforeach; ?>
        </div>
        <button class="toggle lang-toggle" id="lang-toggle" type="button" aria-label="Switch language to Khmer" title="Switch language to Khmer">KM</button>
        <button class="toggle" id="theme-toggle" type="button" aria-label="Switch to dark mode" title="Switch to dark mode"><svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg></button>
      </div>
    </nav>
  </div>
</header>

<nav class="tabbar glass" aria-label="Sections">
  <?php foreach ($sections as $id => $label): ?>
  <a href="#<?= e($id) ?>"><?= tr($label) ?></a>
  <?php endforeach; ?>
</nav>
