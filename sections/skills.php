<section class="section" id="skills">
  <div class="wrap">
    <h2><?= bi('Skills', 'ជំនាញ') ?></h2>
    <div class="skill-grid">
      <?php foreach ($skills as $skill): ?>
      <article class="skill-card glass<?= $skill['wide'] ? ' wide' : '' ?>">
        <h3><?= tr($skill['name']) ?></h3>
        <ul class="skill-tags">
          <?php foreach ($skill['tags'] as $tag): ?>
          <li><?= e($tag) ?></li>
          <?php endforeach; ?>
        </ul>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
