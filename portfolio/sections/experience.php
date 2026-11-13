<section class="section" id="experience">
  <div class="wrap">
    <h2>Experience</h2>
    <?php require __DIR__ . '/about.php'; ?>

    <div class="road">
      <span class="road-fill" aria-hidden="true"></span>
      <span class="road-star" aria-hidden="true" hidden></span>
      <ol class="steps">
        <?php foreach ($steps as $step): ?>
        <li class="step">
          <span class="node" aria-hidden="true"></span>
          <div class="step-card glass">
            <span class="stage"><?= e($step['stage']) ?></span>
            <h3><?= e($step['title']) ?></h3>
            <p><?= e($step['text']) ?></p>
          </div>
        </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </div>
</section>
