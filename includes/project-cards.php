<div class="project-grid">
  <?php foreach ($projects as $i => $p): ?>
    <article class="project-card" id="<?= h($p['slug']) ?>">
      <?php if (!empty($p['image'])): ?>
        <button class="project-card-trigger" type="button" data-project-open="<?= h($p['slug']) ?>" aria-haspopup="dialog" aria-controls="project-dialog">
          <span class="project-label">Project <?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
          <span class="project-card-title" role="heading" aria-level="3"><?= h($p['name']) ?></span>
          <span class="project-card-summary"><?= h($p['description']) ?></span>
          <?php if (!empty($p['stack'])): ?><span class="project-stack"><span>Built with</span> <?= h($p['stack']) ?></span><?php endif; ?>
          <span class="project-details-cta">View project details <span aria-hidden="true">&rarr;</span></span>
        </button>
      <?php else: ?>
        <div class="project-card-content">
          <span class="project-label">Project <?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
          <h2 class="project-card-title"><?= h($p['name']) ?></h2>
          <p class="project-card-summary"><?= h($p['description']) ?></p>
          <?php if (!empty($p['stack'])): ?><p class="project-stack"><span>Built with</span> <?= h($p['stack']) ?></p><?php endif; ?>
          <div class="project-actions">
            <?php if (!empty($p['github_url'])): ?>
              <a class="project-github" href="<?= h($p['github_url']) ?>" target="_blank" rel="noopener"><?= social('github') ?><span>View repository</span></a>
            <?php endif; ?>
            <?php if (!empty($p['live_url'])): ?>
              <a class="link" href="<?= h($p['live_url']) ?>" target="_blank" rel="noopener">View live</a>
            <?php endif; ?>
            <?php if (!empty($p['file'])): ?>
              <a class="link" href="<?= h($p['file']) ?>" download>Download project</a>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>
    </article>
    <?php if (!empty($p['image'])): ?>
      <template data-project-details="<?= h($p['slug']) ?>">
        <div class="project-detail-layout has-image">
          <figure class="project-detail-image">
            <img src="<?= asset($p['image']) ?>" alt="Front page of <?= h($p['name']) ?>">
          </figure>
          <div class="project-detail-copy">
            <span class="project-detail-eyebrow">Project <?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
            <h2 id="project-dialog-title"><?= h($p['name']) ?></h2>
            <p><?= h($p['details'] ?? $p['description']) ?></p>
            <?php if (!empty($p['highlights'])): ?>
              <h3>Highlights</h3>
              <ul>
                <?php foreach ($p['highlights'] as $highlight): ?><li><?= h($highlight) ?></li><?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <?php if (!empty($p['stack'])): ?><p class="project-detail-stack"><strong>Built with</strong> <?= h($p['stack']) ?></p><?php endif; ?>
            <div class="project-detail-actions">
              <?php if (!empty($p['github_url'])): ?>
                <a class="project-github" href="<?= h($p['github_url']) ?>" target="_blank" rel="noopener"><?= social('github') ?><span>View repository</span></a>
              <?php endif; ?>
              <?php if (!empty($p['live_url'])): ?>
                <a class="link" href="<?= h($p['live_url']) ?>" target="_blank" rel="noopener">View live</a>
              <?php endif; ?>
              <?php if (!empty($p['file'])): ?>
                <a class="link" href="<?= h($p['file']) ?>" download>Download project</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </template>
    <?php endif; ?>
  <?php endforeach; ?>
</div>
<dialog class="project-dialog" id="project-dialog" data-project-dialog aria-labelledby="project-dialog-title">
  <button type="button" class="project-dialog-close" data-project-dialog-close aria-label="Close project details">&times;</button>
  <div class="project-dialog-content" data-project-dialog-content></div>
</dialog>
