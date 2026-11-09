<?php $title = 'Projects'; require __DIR__ . '/includes/header.php'; ?>

<section class="page">
  <h1 class="page-title">Projects</h1>
  <?php if ($projects): ?>
    <?php require __DIR__ . '/includes/project-cards.php'; ?>
  <?php else: ?>
    <div class="projects-empty" aria-label="Project space reserved">
      <span class="projects-empty-mark" aria-hidden="true">+</span>
      <p>New projects will be added here.</p>
    </div>
  <?php endif; ?>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
