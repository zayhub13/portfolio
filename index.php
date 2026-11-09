<?php $title = null; require __DIR__ . '/includes/header.php'; ?>

<section class="hero" id="home">
  <div class="hero-art" tabindex="0" role="group" aria-label="Portrait illustration that reveals my photo on hover, focus, or click">
    <img class="art-a" src="<?= asset('assets/hero.png') ?>" alt="Black and white illustration of a person with dark shaggy hair and heavy-lidded eyes">
    <img class="art-b" src="<?= asset('assets/me.jpg') ?>" alt="John Jairuh Ochoa in a white, orange and purple polo, taking a mirror selfie">
    <span class="art-sheen" aria-hidden="true"></span>
  </div>
  <div class="hero-text">
    <h1>Hello, I'm Jai</h1>
    <p class="sub"><span data-roles='["Full Stack Developer","Cybersecurity Learner","Graphic Designer"]' class="role">Full Stack Developer &amp; Cybersecurity Learner</span></p>
    <p class="location">Valenzuela City, Philippines<span class="clock-wrap" hidden> &middot; <span data-clock></span> local time</span></p>
    <p class="lede">I build web projects and am currently learning cybersecurity and Linux fundamentals. I’m still developing my knowledge through study and hands-on practice.</p>
    <p class="cta">
      <a class="link" href="#projects">Explore projects</a>
      <a class="link" href="assets/resume.pdf" target="_blank" rel="noopener">View resume</a>
    </p>
  </div>
</section>

<section class="home-projects" id="projects" aria-labelledby="home-projects-title">
  <div class="page">
    <h2 class="page-title" id="home-projects-title">Projects</h2>
    <p class="intro">A selection of things I’ve built and the tools behind them.</p>
    <?php if ($projects): ?>
      <?php require __DIR__ . '/includes/project-cards.php'; ?>
    <?php else: ?>
      <div class="projects-empty" aria-label="Project space reserved">
        <span class="projects-empty-mark" aria-hidden="true">+</span>
        <p>New projects will be added here.</p>
      </div>
    <?php endif; ?>
    <p class="more"><a class="link" href="projects.php">See all project details</a></p>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
