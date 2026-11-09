<section class="section" id="contact" aria-labelledby="contact-title">
  <div class="page">
    <h2 class="page-title" id="contact-title">Contact me</h2>
  <p class="intro">Have a question, project idea, or just want to connect? Send me a message.</p>
  <div class="contact-layout">
    <section class="contact-details" aria-labelledby="contact-details-title">
      <h2 id="contact-details-title">Find me online</h2>
      <ul class="contact-list">
        <li><a href="<?= h($gmailCompose) ?>" target="_blank" rel="noopener"><span>Email</span><?= h($email) ?></a></li>
        <li><a href="<?= h($github) ?>" target="_blank" rel="noopener"><span>GitHub</span>github.com/zayhub13</a></li>
        <li><a href="<?= h($linkedin) ?>" target="_blank" rel="noopener"><span>LinkedIn</span>Connect with me</a></li>
        <li><a href="assets/resume.pdf" target="_blank" rel="noopener"><span>Resume</span>View resume</a></li>
      </ul>
      <p class="more"><button class="link" type="button" data-copy="<?= h($email) ?>">Copy email address</button></p>
    </section>
    <section class="contact-message" aria-labelledby="contact-message-title">
      <h2 id="contact-message-title">Get in touch</h2>
      <p>Send me a message directly from this form. I’ll reply to the email address you provide.</p>
      <?php if (isset($sendMessages[$sendStatus])): ?>
        <p class="form-status form-status--<?= h($sendMessages[$sendStatus][1]) ?>" role="status"><?= h($sendMessages[$sendStatus][0]) ?></p>
      <?php endif; ?>
      <form class="contact-form" data-contact-form action="send-message.php" method="post">
        <input type="hidden" name="csrf_token" value="<?= h($_SESSION['contact_csrf']) ?>">
        <div class="contact-trap" aria-hidden="true">
          <label for="contact-website">Leave this field empty</label>
          <input id="contact-website" name="website" type="text" tabindex="-1" autocomplete="off">
        </div>
        <label for="contact-name">Your name</label>
        <input id="contact-name" name="name" type="text" autocomplete="name" maxlength="100" required>
        <label for="contact-email">Your email</label>
        <input id="contact-email" name="email" type="email" autocomplete="email" maxlength="254" required>
        <label for="contact-body">Message</label>
        <textarea id="contact-body" name="message" rows="6" maxlength="3000" required></textarea>
        <button class="contact-submit" type="submit">Send message <span aria-hidden="true">&rarr;</span></button>
        <p class="form-status" data-form-status aria-live="polite"></p>
      </form>
    </section>
  </div>
  </div>
</section>
