
<footer class="foot">
  <div class="wrap">
    <p><?= bi('© ' . date('Y') . ' ' . $profile['name'] . '. All rights reserved.', '© ' . date('Y') . ' ' . $profile['name'] . '។ រក្សាសិទ្ធិគ្រប់យ៉ាង។') ?></p>
    <p class="foot-version"><?= bi('Version ' . $site['version'], 'កំណែ ' . $site['version']) ?></p>
    <nav aria-label="Social">
      <?php foreach ($socials as $label => $url): ?>
      <a href="<?= e($url) ?>" target="_blank" rel="noopener"><?= e($label) ?></a>
      <?php endforeach; ?>
    </nav>
  </div>
</footer>

<div class="cursor" aria-hidden="true">
  <span class="cursor-ring"></span>
  <span class="cursor-dot"></span>
</div>
</div>

<script src="<?= e(asset('assets/js/lang.js')) ?>"></script>
<script src="<?= e(asset('assets/js/theme.js')) ?>"></script>
<script src="<?= e(asset('assets/js/galaxy.js')) ?>"></script>
<script src="<?= e(asset('assets/js/main.js')) ?>"></script>
<script src="<?= e(asset('assets/js/settings.js')) ?>"></script>
</body>
</html>
