<?php
require_once __DIR__ . '/data.php';
$nav = ['index.php' => 'Home', 'projects.php' => 'Projects', 'skills.php' => 'Skills', 'about.php' => 'About', 'contact.php' => 'Contact'];
$current = basename($_SERVER['PHP_SELF']);
$title = isset($title) ? $title . ' | Jai Ochoa' : 'Jai Ochoa | Web developer';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= h($title) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600&family=Source+Serif+4:opsz,wght@8..60,400;8..60,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/main.js" defer></script>
</head>
<body>
<header class="nav">
  <a class="brand" href="index.php"><?= logo(38) ?><span>Jai Ochoa</span></a>
  <button class="burger" aria-expanded="false" aria-controls="menu">Menu</button>
  <nav>
    <ul class="menu" id="menu">
      <?php foreach ($nav as $file => $label): ?>
        <li><a href="<?= $file ?>"<?= $file === $current ? ' aria-current="page"' : '' ?>><?= $label ?></a></li>
      <?php endforeach; ?>
      <li><a class="resume-link" href="assets/resume.pdf" target="_blank" rel="noopener">Resume</a></li>
    </ul>
  </nav>
</header>
<main>
