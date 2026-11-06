<?php $title = 'Contact'; require __DIR__ . '/includes/header.php'; ?>

<section class="page">
  <h1 class="page-title">Contact me</h1>
  <p class="intro">Have a question, project idea, or just want to connect? Send me a message.</p>
  <div class="contact-layout">
    <section class="contact-details" aria-labelledby="contact-details-title">
      <h2 id="contact-details-title">Find me online</h2>
      <ul class="contact-list">
        <li><a href="mailto:<?= h($email) ?>"><span>Email</span><?= h($email) ?></a></li>
        <li><a href="<?= h($github) ?>" target="_blank" rel="noopener"><span>GitHub</span>github.com/zayhub13</a></li>
        <li><a href="<?= h($linkedin) ?>" target="_blank" rel="noopener"><span>LinkedIn</span>Connect with me</a></li>
        <li><a href="assets/resume.pdf" target="_blank" rel="noopener"><span>Resume</span>View resume</a></li>
      </ul>
      <p class="more"><button class="link" type="button" data-copy="<?= h($email) ?>">Copy email address</button></p>
    </section>
    <section class="contact-message" aria-labelledby="contact-message-title">
      <h2 id="contact-message-title">Get in touch</h2>
      <p>Write a message below and your email app will open with it ready to send.</p>
      <form class="contact-form" data-contact-form data-recipient="<?= h($email) ?>">
        <label for="contact-name">Your name</label>
        <input id="contact-name" name="name" type="text" autocomplete="name" maxlength="100" required>
        <label for="contact-email">Your email</label>
        <input id="contact-email" name="email" type="email" autocomplete="email" maxlength="254" required>
        <label for="contact-body">Message</label>
        <textarea id="contact-body" name="message" rows="6" maxlength="3000" required></textarea>
        <button class="contact-submit" type="submit">Write email <span aria-hidden="true">&rarr;</span></button>
        <p class="form-status" data-form-status aria-live="polite"></p>
      </form>
    </section>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
