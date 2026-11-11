<?php
require_once __DIR__ . '/data.php';
$nav = ['home' => 'Home', 'projects' => 'Projects', 'about' => 'About', 'contact' => 'Contact'];
$title = isset($title) ? $title . ' | Jai Ochoa' : 'Jai Ochoa | Full Stack Developer';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= h($title) ?></title>
  <meta name="description" content="I'm Jai Ochoa, a full stack developer and IT student sharing my web projects, skills, and learning journey.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://johnjairuh-portfolio.vercel.app/">
  <meta property="og:image" content="https://johnjairuh-portfolio.vercel.app/assets/hero.png">
  <meta property="og:image:secure_url" content="https://johnjairuh-portfolio.vercel.app/assets/hero.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="736">
  <meta property="og:image:height" content="736">
  <meta property="og:image:alt" content="Anime-style illustration portrait from Jai Ochoa's portfolio">
  <meta name="twitter:image" content="https://johnjairuh-portfolio.vercel.app/assets/hero.png">
  <link rel="icon" type="image/svg+xml" href="<?= asset('assets/favicon.svg') ?>">
  <script>window.va = window.va || function () { (window.vaq = window.vaq || []).push(arguments); };</script>
  <script defer src="/_vercel/insights/script.js"></script>
  <script>document.documentElement.classList.add('js');try{var t=localStorage.getItem('theme');if(t)document.documentElement.setAttribute('data-theme',t);}catch(e){}</script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600&family=Source+Serif+4:opsz,wght@8..60,400;8..60,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
  <script src="<?= asset('js/main.js') ?>" defer></script>
</head>
<body>
<header class="nav">
  <a class="brand" href="index.php#home"><?= logo(38) ?><span>Jai Ochoa</span></a>
  <nav class="nav-links" aria-label="Main navigation">
    <?php $navIndex = 0; foreach ($nav as $id => $label): ?>
      <a href="index.php#<?= $id ?>" style="--nav-index:<?= $navIndex++ ?>"><?= $label ?></a>
    <?php endforeach; ?>
  </nav>
  <button class="theme" type="button" aria-label="Switch between light and dark mode" aria-pressed="false">
    <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="2"/><path d="M12 3a9 9 0 0 1 0 18z" fill="currentColor"/></svg>
  </button>
</header>
<main>
