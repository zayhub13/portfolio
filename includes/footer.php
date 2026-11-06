</main>
<footer class="footer">
  <div class="foot-brand">
    <div class="foot-mark" role="img" aria-label="Logo. Move your cursor around it to turn it.">
      <?= logo(96) ?>
    </div>
    <div>
      <p>John Jairuh Ochoa</p>
      <p>Full Stack Developer</p>
      <p class="hint">Move your cursor around the logo to turn it</p>
    </div>
  </div>
  <ul class="socials">
    <li><a href="<?= h($linkedin) ?>" target="_blank" rel="noopener"><?= social('linkedin') ?>LinkedIn</a></li>
    <li><a href="<?= h($github) ?>" target="_blank" rel="noopener"><?= social('github') ?>GitHub</a></li>
    <li><a href="<?= h($gmailCompose) ?>" target="_blank" rel="noopener"><?= social('gmail') ?>Gmail</a></li>
  </ul>
</footer>
<button class="to-top" type="button" aria-label="Back to top">
  <svg viewBox="0 0 44 44" aria-hidden="true"><circle class="ring-bg" cx="22" cy="22" r="20"/><circle class="ring" cx="22" cy="22" r="20"/><path class="arrow" d="M22 29V15M15.5 21.5 22 15l6.5 6.5"/></svg>
</button>
</body>
</html>
