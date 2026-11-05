<?php $title = 'Skills'; require __DIR__ . '/includes/header.php'; ?>

<section class="page">
  <h1 class="page-title">Skills and tools</h1>
  <p class="intro">What I write in, and what I write it with.</p>

  <?php $n = 0; foreach ($skills as $group => $items): ?>
    <div class="skill-group">
      <h2><?= h($group) ?></h2>
      <ul class="tiles">
        <?php foreach ($items as $s): ?>
          <li class="tile" style="--i:<?= $n++ ?>">
            <img src="<?= icon($s[1]) ?>" alt="" width="48" height="48" onerror="this.style.display='none'">
            <span><?= h($s[0]) ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endforeach; ?>

  <p class="also">Also: <?= h(implode(', ', $also)) ?>.</p>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
