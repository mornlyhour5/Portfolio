<?php
// Flags set by actions/contact-submit.php when it sends the visitor back here
$contactSent = isset($_GET['sent']);
$contactError = isset($_GET['error']);
?>
<section class="section" id="contact">
  <div class="wrap">
    <div class="card glass">
      <div class="contact-intro">
      <h2><?= bi('Get in touch', 'ទាក់ទងមកខ្ញុំ') ?></h2>
      <p class="lead"><?= bi("I'm early in my career, and I'm always glad to hear from people in the industry. If you have advice, a question or a new idea, please send me a message.", 'ខ្ញុំនៅដើមអាជីព ហើយខ្ញុំរីករាយជានិច្ចនៅពេលទទួលសារពីមនុស្សក្នុងវិស័យនេះ។ បើអ្នកមានដំបូន្មាន សំណួរ ឬគំនិតថ្មី សូមផ្ញើសារមកខ្ញុំ។') ?></p>

      </div>

      <div class="contact-main">
      <?php if ($contactSent): ?>
        <p class="notice ok" role="status"><?= bi('Thanks! Your message has been sent.', 'អរគុណ! សាររបស់អ្នកត្រូវបានផ្ញើរួចហើយ។') ?></p>
      <?php elseif ($contactError): ?>
        <p class="notice error" role="alert"><?= bi('That message could not be sent. Check the fields and try again.', 'មិនអាចផ្ញើសារនេះបានទេ។ សូមពិនិត្យព័ត៌មានក្នុងប្រអប់ ហើយព្យាយាមម្តងទៀត។') ?></p>
      <?php endif; ?>

      <form class="contact-form" action="actions/contact-submit.php" method="post">
        <div class="field-group">
          <div class="form-row">
            <label class="field">
              <span><?= bi('Name', 'ឈ្មោះ') ?></span>
              <input type="text" name="name" placeholder="Your name" data-ph-en="Your name" data-ph-km="ឈ្មោះរបស់អ្នក" maxlength="100" autocomplete="name" required>
            </label>
            <label class="field">
              <span><?= bi('Email', 'អ៊ីមែល') ?></span>
              <input type="email" name="email" placeholder="you@example.com" maxlength="150" autocomplete="email" required>
            </label>
          </div>

          <label class="field field-message">
            <span><?= bi('Message', 'សារ') ?></span>
            <textarea name="message" placeholder="What would you like to ask or share?" data-ph-en="What would you like to ask or share?" data-ph-km="តើអ្នកចង់សួរ ឬចែករំលែកអ្វី?" maxlength="2000" required></textarea>
          </label>
        </div>

        <!-- Hidden from people; bots tend to fill it in -->
        <input type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-9999px">

        <div class="form-foot">
          <p class="form-hint"><?= bi('Your email is only used to reply to you.', 'អ៊ីមែលរបស់អ្នកប្រើសម្រាប់តែឆ្លើយតបទៅអ្នកប៉ុណ្ណោះ។') ?></p>
          <button class="btn primary" type="submit"><?= bi('Send message', 'ផ្ញើសារ') ?> <span aria-hidden="true">→</span></button>
        </div>
      </form>
      </div>

      <div class="contact-side">

      <div class="divider"><span><?= bi('or reach me directly', 'ឬទាក់ទងដោយផ្ទាល់') ?></span></div>

      <div class="address">
        <span id="email-address"><?= e($profile['email']) ?></span>
        <button class="btn glass" id="copy-email" type="button"><?= bi('Copy email', 'ចម្លងអ៊ីមែល') ?></button>
      </div>
      <p class="status" id="copy-status" aria-live="polite"></p>

      <div class="actions">
        <a class="btn glass" href="mailto:<?= e($profile['email']) ?>?subject=Contact%20from%20Portfolio&amp;body=Hello%20Hour%2C"><?= bi('Open in email app', 'បើកក្នុងកម្មវិធីអ៊ីមែល') ?></a>
        <a class="btn glass" href="<?= e($profile['linkedin']) ?>" target="_blank" rel="noopener"><?= bi('LinkedIn profile', 'ប្រវត្តិរូប LinkedIn') ?></a>
      </div>
      </div>
    </div>
  </div>
</section>
