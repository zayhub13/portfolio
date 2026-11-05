</main>
<footer class="footer">
  <div class="foot-brand">
    <div class="knob" role="button" tabindex="0" aria-label="Rotate the logo. Drag it, or press Enter to turn it.">
      <?= logo(96) ?>
    </div>
    <div>
      <p>John Jairuh Ochoa</p>
      <p>Web developer, Valenzuela City</p>
      <p class="hint">Drag the mark to spin it</p>
    </div>
  </div>
  <ul class="socials">
    <li><a href="<?= h($linkedin) ?>" target="_blank" rel="noopener"><?= social('linkedin') ?>LinkedIn</a></li>
    <li><a href="<?= h($github) ?>" target="_blank" rel="noopener"><?= social('github') ?>GitHub</a></li>
    <li><a href="mailto:<?= h($email) ?>"><?= social('gmail') ?>Gmail</a></li>
  </ul>
</footer>
</body>
</html>
