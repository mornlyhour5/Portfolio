<section class="section" id="projects">
  <div class="wrap">
    <h2><?= bi('Projects', 'ស្នាដៃ') ?></h2>
    <div class="projects">
      <?php foreach ($projects as $project): ?>
      <article class="project glass">
        <span class="kind"><?= tr($project['kind']) ?></span>
        <h3><?= e($project['title']) ?></h3>
        <p><?= tr($project['text']) ?></p>
        <ul class="chips">
          <?php foreach ($project['tags'] as $tag): ?>
          <li><?= e($tag) ?></li>
          <?php endforeach; ?>
        </ul>
        <?php if (!empty($project['github'])): ?>
        <a class="text-link" href="<?= e($project['github']) ?>" target="_blank" rel="noopener"><?= bi('View on GitHub', 'មើលនៅ GitHub') ?></a>
        <?php endif; ?>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
