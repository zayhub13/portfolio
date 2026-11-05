<?php $title = 'About'; require __DIR__ . '/includes/header.php'; ?>

<section class="page">
  <h1 class="page-title">About</h1>
  <div class="about">
    <p class="big">I build web systems from the database up.</p>
    <p class="short">An ERD, a normalized MySQL schema, a PHP back end, and pages people can use without a manual. I pay the most attention to forms, requests and logins, because that is where a system's assumptions break. I am now moving into security, networking first.</p>

    <dl class="fields">
      <div><dt>Based in</dt><dd>Valenzuela City</dd></div>
      <div><dt>Working as</dt><dd>Freelance web developer and graphic designer since 2024: client sites, logos, jersey graphics, branding.</dd></div>
      <div><dt>Education</dt><dd>BS Information Technology, Pamantasan ng Lungsod ng Valenzuela, 2023 to present.</dd></div>
      <div><dt>Focus</dt><dd>Full-stack web with PHP and MySQL, Java OOP, database design, network design.</dd></div>
      <div><dt>Spoken</dt><dd>English and Filipino.</dd></div>
    </dl>

    <h2 class="skills-title">Skills</h2>
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
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
