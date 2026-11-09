</main>
<footer class="footer">
  <div class="foot-brand">
    <div class="foot-mark" role="img" aria-label="Rotatable logo">
      <?= logo(96) ?>
    </div>
    <div>
      <p>John Jairuh Ochoa</p>
      <p>Full Stack Developer</p>
    </div>
  </div>
  <ul class="socials">
    <li><a href="<?= h($linkedin) ?>" target="_blank" rel="noopener"><?= social('linkedin') ?>LinkedIn</a></li>
    <li><a href="<?= h($github) ?>" target="_blank" rel="noopener"><?= social('github') ?>GitHub</a></li>
    <li><a href="<?= h($gmailCompose) ?>" target="_blank" rel="noopener"><?= social('gmail') ?>Gmail</a></li>
  </ul>
</footer>
<nav class="rail-nav" aria-label="Sections">
  <?php foreach ($nav as $id => $label): ?><a href="index.php#<?= $id ?>" data-label="<?= h($label) ?>" aria-label="<?= h($label) ?>"></a><?php endforeach; ?>
</nav>
<button class="to-top" type="button" aria-label="Back to top">
  <svg viewBox="0 0 44 44" aria-hidden="true"><circle class="ring-bg" cx="22" cy="22" r="20"/><circle class="ring" cx="22" cy="22" r="20"/><path class="arrow" d="M22 29V15M15.5 21.5 22 15l6.5 6.5"/></svg>
</button>
</body>
</html>
