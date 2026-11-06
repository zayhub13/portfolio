<?php $title = 'About'; require __DIR__ . '/includes/header.php'; ?>

<section class="page">
  <h1 class="page-title">About</h1>
  <div class="about">
    <p class="big">Hi, I'm Jai — a full stack developer and Information Technology student who is learning cybersecurity.</p>
    <p class="short">I enjoy building useful web projects and learning how technology works. I'm currently studying cybersecurity and Linux fundamentals. These are areas I'm still learning, and I'm developing my skills through study and hands-on practice.</p>

    <dl class="fields">
      <div><dt>Based in</dt><dd>Valenzuela City, Philippines</dd></div>
      <div><dt>Work</dt><dd>Freelance web development and graphic design since 2024, including client websites, logos, jersey graphics, and branding.</dd></div>
      <div><dt>Education</dt><dd>BS Information Technology, Pamantasan ng Lungsod ng Valenzuela, 2024 - Present.</dd></div>
      <div><dt>Currently learning</dt><dd>Cybersecurity and Linux fundamentals. I'm a learner in these areas and continue to build my knowledge through practice.</dd></div>
      <div><dt>Interests</dt><dd>Full stack web development, databases, computer networking, and cybersecurity fundamentals.</dd></div>
      <div><dt>Languages</dt><dd>English and Filipino.</dd></div>
    </dl>

    <h2 class="skills-title">Tools and skills</h2>
    <?php $n = 0; foreach ($skills as $group => $items): ?>
      <div class="skill-group">
        <h3><?= h($group) ?></h3>
        <ul class="chips">
          <?php foreach ($items as $s): ?>
            <li class="chip" style="--i:<?= $n++ ?>">
              <?php if ($s[1]): ?><img src="<?= icon($s[1]) ?>" alt="" width="24" height="24" onerror="this.style.display='none'"><?php endif; ?>
              <?= h($s[0]) ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endforeach; ?>

  </div>

  <?php if ($certifications): ?>
    <div class="cert-wrap">
      <h2 class="skills-title">Certifications</h2>
      <section class="cert-carousel" data-cert-carousel aria-label="Certifications" tabindex="0">
        <div class="cert-viewport">
          <ul class="cert-track">
            <?php foreach ($certifications as $i => $cert): ?>
              <li class="cert-card" data-title="<?= h($cert['title']) ?>" data-date="<?= h($cert['date']) ?>">
                <a href="assets/certificates/<?= h($cert['file']) ?>" target="_blank" rel="noopener" aria-label="Open full size: <?= h($cert['title']) ?>">
                  <img src="assets/certificates/<?= h($cert['file']) ?>" alt="CodeSignal certificate: <?= h($cert['title']) ?>" loading="lazy" draggable="false">
                  <span class="cert-sheen" aria-hidden="true"></span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
          <button type="button" class="cert-arrow cert-prev" data-cert-prev aria-label="Previous certificate">&larr;</button>
          <button type="button" class="cert-arrow cert-next" data-cert-next aria-label="Next certificate">&rarr;</button>
        </div>
        <div class="cert-caption" data-cert-caption aria-live="polite">
          <strong><?= h($certifications[0]['title']) ?></strong>
          <small>CodeSignal &middot; <?= h($certifications[0]['date']) ?></small>
        </div>
        <div class="cert-meta">
          <div class="cert-dots" aria-label="Choose a certificate">
            <?php foreach ($certifications as $i => $cert): ?>
              <button type="button" data-cert-dot="<?= $i ?>" aria-label="Show certificate <?= $i + 1 ?>"<?= $i === 0 ? ' aria-current="true"' : '' ?>></button>
            <?php endforeach; ?>
          </div>
          <span class="cert-count" data-cert-count aria-live="polite">1 / <?= count($certifications) ?></span>
        </div>
      </section>
    </div>
  <?php endif; ?>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
