<section class="section" id="projects">
  <div class="wrap">
    <h2>Projects</h2>
    <div class="projects">
      <?php foreach ($projects as $project): ?>
      <article class="project glass">
        <span class="kind"><?= e($project['kind']) ?></span>
        <h3><?= e($project['title']) ?></h3>
        <p><?= e($project['text']) ?></p>
        <ul class="chips">
          <?php foreach ($project['tags'] as $tag): ?>
          <li><?= e($tag) ?></li>
          <?php endforeach; ?>
        </ul>
        <a class="text-link" href="<?= e($profile['github']) ?>" target="_blank" rel="noopener">View on GitHub</a>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
