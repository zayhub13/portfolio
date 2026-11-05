<?php $title = 'Projects'; require __DIR__ . '/includes/header.php'; ?>

<section class="page">
  <h1 class="page-title">Projects</h1>
  <p class="intro">Three, and the third is not finished. I would rather show three honestly than pad it to five.</p>

  <?php foreach ($projects as $p): ?>
    <article class="project">
      <h2><?= h($p['name']) ?></h2>
      <p class="stack"><?= h($p['stack']) ?></p>
      <dl class="fields">
        <?php
        $rows = [
          'The problem' => $p['problem'],
          'What did not work' => $p['tried'],
          'What I shipped' => $p['shipped'],
          $p['redo_label'] => $p['redo'],
        ];
        foreach ($rows as $label => $text):
          if ($text === '') continue; ?>
          <div><dt><?= h($label) ?></dt><dd><?= h($text) ?></dd></div>
        <?php endforeach; ?>
      </dl>
      <?php if ($p['note'] !== ''): ?><p class="note"><?= h($p['note']) ?></p><?php endif; ?>
    </article>
  <?php endforeach; ?>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
