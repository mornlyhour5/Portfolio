<section class="section" id="experience">
  <div class="wrap">
    <h2><?= bi('Experience', 'បទពិសោធន៍') ?></h2>

    <!-- The intro, road and contact card share this layout: a grid on wide screens, a single column on phones -->
    <div class="exp-layout">
      <?php require __DIR__ . '/about.php'; ?>

      <div class="road">
        <div class="road-track" aria-hidden="true">
          <svg class="road-svg" focusable="false">
            <path class="road-edge" d=""/>
            <path class="road-edge" d=""/>
            <path class="road-dash" d=""/>
            <path class="road-lit" d=""/>
          </svg>
          <span class="road-star" hidden></span>
        </div>
        <ol class="steps">
          <?php foreach ($steps as $step): ?>
          <li class="step">
            <span class="node" aria-hidden="true"></span>
            <div class="step-card glass">
              <span class="stage"><?= tr($step['stage']) ?></span>
              <h3><?= tr($step['title']) ?></h3>
              <p><?= tr($step['text']) ?></p>
            </div>
          </li>
          <?php endforeach; ?>
        </ol>
      </div>

    </div>
  </div>
</section>
