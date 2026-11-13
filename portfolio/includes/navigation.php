<header class="bar">
  <div class="wrap">
    <nav class="pill glass" aria-label="Main">
      <a class="wordmark" href="#top"><?= e($profile['nickname']) ?><span>.</span></a>
      <div class="pill-end">
        <div class="pill-links">
          <?php foreach ($sections as $id => $label): ?>
          <a href="#<?= e($id) ?>"><?= e($label) ?></a>
          <?php endforeach; ?>
        </div>
        <button class="toggle" id="theme-toggle" type="button">Light mode</button>
      </div>
    </nav>
  </div>
</header>

<nav class="tabbar glass" aria-label="Sections">
  <?php foreach ($sections as $id => $label): ?>
  <a href="#<?= e($id) ?>"><?= e($label) ?></a>
  <?php endforeach; ?>
</nav>
