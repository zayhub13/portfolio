<?php $title = null; require __DIR__ . '/includes/header.php'; ?>

<section class="hero">
  <div class="hero-text">
    <h1>John Jairuh Ochoa</h1>
    <p class="sub">Web developer. PHP, MySQL, JavaScript, Java.</p>
    <p class="lede">I build web systems from the database up, and I pay close attention to the places where they break: bad input, wrong logins, assumptions I did not check.</p>
    <p class="cta">
      <a class="link" href="projects.php">See projects</a>
      <a class="link" href="assets/resume.pdf" target="_blank" rel="noopener">View resume</a>
    </p>
  </div>
  <div class="hero-art">
    <img src="assets/hero.png" alt="Black and white illustration of a person with dark shaggy hair and heavy-lidded eyes">
  </div>
</section>

<section class="band">
  <div class="rail">
    <h2>The argument</h2>
    <div class="prose">
      <p>A program works until someone does something its author did not expect. That someone might be a tired customer, a typo, or a person trying to get in. From inside the code, you cannot always tell which.</p>
      <p>When I build, I decide what a system assumes. When I read about attacks, I read what happens when those assumptions are false on purpose. Same material, opposite direction.</p>
    </div>
  </div>
</section>

<section class="page">
  <div class="rail">
    <h2>Projects</h2>
    <div>
      <ul class="index-list">
        <?php foreach ($projects as $p): ?>
          <li><a href="projects.php"><span><?= h($p['name']) ?></span><small><?= h($p['stack']) ?></small></a></li>
        <?php endforeach; ?>
      </ul>
      <p class="more"><a class="link" href="projects.php">Read the full stories</a></p>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
