<?php $title = 'Contact'; require __DIR__ . '/includes/header.php'; ?>

<section class="page">
  <h1 class="page-title">Contact</h1>
  <p class="intro">Write to me about a project, a bug, or work you need built.</p>
  <ul class="contact-list">
    <li><a href="mailto:<?= h($email) ?>"><span>Email</span><?= h($email) ?></a></li>
    <li><a href="<?= h($github) ?>" target="_blank" rel="noopener"><span>GitHub</span>github.com/zayhub13</a></li>
    <li><a href="<?= h($linkedin) ?>" target="_blank" rel="noopener"><span>LinkedIn</span>Connect with me</a></li>
    <li><a href="assets/resume.pdf" target="_blank" rel="noopener"><span>Resume</span>View it in your browser</a></li>
  </ul>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
