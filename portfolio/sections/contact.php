<section class="section" id="contact">
  <div class="wrap">
    <div class="card glass">
      <h2>Get in touch</h2>
      <p>I'm open to software development roles, collaborations and projects where I can put my backend and application development skills to work.</p>

      <div class="address">
        <span id="email-address"><?= e($profile['email']) ?></span>
        <button class="btn glass" id="copy-email" type="button">Copy email</button>
      </div>
      <p class="status" id="copy-status" aria-live="polite"></p>

      <?php if (isset($_GET['sent'])): ?>
        <p class="status" role="status">Thanks! Your message has been sent.</p>
      <?php elseif (isset($_GET['error'])): ?>
        <p class="status" role="alert">Sorry, the message could not be sent. Please check the fields and try again.</p>
      <?php endif; ?>

      <form class="contact-form" action="actions/contact-submit.php" method="post">
        <input type="text" name="name" placeholder="Your name" maxlength="100" required>
        <input type="email" name="email" placeholder="Your email" maxlength="150" required>
        <textarea name="message" placeholder="Your message" maxlength="2000" required></textarea>
        <!-- Hidden from people; bots tend to fill it in -->
        <input type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-9999px">
        <button class="btn primary" type="submit">Send message</button>
      </form>

      <div class="actions">
        <a class="btn glass" href="mailto:<?= e($profile['email']) ?>?subject=Contact%20from%20Portfolio&amp;body=Hello%20Hour%2C">Open in email app</a>
        <a class="btn glass" href="<?= e($profile['linkedin']) ?>" target="_blank" rel="noopener">LinkedIn profile</a>
      </div>
    </div>
  </div>
</section>
