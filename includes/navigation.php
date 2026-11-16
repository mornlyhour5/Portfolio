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
        <div class="settings">
          <button class="toggle settings-toggle" id="settings-toggle" type="button" aria-expanded="false" aria-controls="settings-panel" aria-label="Settings" title="Settings"><svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 21v-7M4 10V3M12 21v-9M12 8V3M20 21v-5M20 12V3M1 14h6M9 8h6M17 16h6"/></svg></button>
          <div class="settings-panel glass" id="settings-panel" hidden>
            <p class="settings-title"><?= bi('Settings', 'ការកំណត់') ?></p>
            <div class="setting-row">
              <label for="theme-select"><?= bi('Colour', 'ពណ៌') ?></label>
              <select class="setting-select" id="theme-select">
                <option value="system" data-en="Follow device" data-km="តាមឧបករណ៍">Follow device</option>
                <option value="light" data-en="Light" data-km="ភ្លឺ">Light</option>
                <option value="dark" data-en="Dark" data-km="ងងឹត">Dark</option>
              </select>
            </div>
            <div class="setting-row">
              <label for="star-select"><?= bi('Stars', 'ផ្កាយ') ?></label>
              <select class="setting-select" id="star-select">
                <option value="show" data-en="Show" data-km="បង្ហាញ">Show</option>
                <option value="hide" data-en="Hide" data-km="លាក់">Hide</option>
              </select>
            </div>
            <!-- <div class="setting-row">
              <label for="lang-select"><?= bi('Language', 'ភាសា') ?></label>
              <select class="setting-select" id="lang-select">
                <option value="en">English</option>
                <option value="km">ភាសាខ្មែរ</option>
              </select>
            </div> -->
          </div>
        </div>
      </div>
    </nav>
  </div>
</header>

<nav class="tabbar glass" aria-label="Sections">
  <?php foreach ($sections as $id => $label): ?>
  <a href="#<?= e($id) ?>"><?= tr($label) ?></a>
  <?php endforeach; ?>
</nav>
