<?php $title = 'Projects'; require __DIR__ . '/includes/header.php'; ?>

<section class="page">
  <h1 class="page-title">Projects</h1>
  <?php if ($projects): ?>
    <div class="project-grid">
      <?php foreach ($projects as $i => $p): ?>
        <article class="project-card" id="<?= h($p['slug']) ?>">
          <span class="project-label">Project <?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
          <h2><?= h($p['name']) ?></h2>
          <p><?= h($p['description']) ?></p>
          <?php if (!empty($p['stack'])): ?><p class="project-stack"><span>Built with</span> <?= h($p['stack']) ?></p><?php endif; ?>
          <div class="project-actions">
            <?php if (!empty($p['github_url'])): ?>
              <a class="project-github" href="<?= h($p['github_url']) ?>" target="_blank" rel="noopener"><?= social('github') ?><span>View repository</span></a>
            <?php endif; ?>
            <?php if (!empty($p['live_url'])): ?>
              <a class="link" href="<?= h($p['live_url']) ?>" target="_blank" rel="noopener">View live site</a>
            <?php endif; ?>
            <?php if (!empty($p['file'])): ?>
              <a class="link" href="<?= h($p['file']) ?>" download>Download project</a>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="projects-empty" aria-label="Project space reserved">
      <span class="projects-empty-mark" aria-hidden="true">+</span>
      <p>New projects will be added here.</p>
    </div>
  <?php endif; ?>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
