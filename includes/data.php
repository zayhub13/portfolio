<?php
function h($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

// Mark: a crosshair with four long spikes over two rings. Follows the text colour.
function logo($s = 40) {
  $spikes = '';
  foreach ([0, 90, 180, 270] as $a) {
    $spikes .= '<g transform="rotate(' . $a . ' 24 24)"><path d="M22.4 12.5H25.6L24 .5Z"/><path d="M22.9 17.4H25.1L24 21.6Z"/></g>';
  }
  return '<svg width="' . $s . '" height="' . $s . '" viewBox="0 0 48 48" fill="currentColor" role="img" aria-label="Mark: a crosshair with four long spikes over two rings"><circle cx="24" cy="24" r="13.5" fill="none" stroke="currentColor" stroke-width="3"/><circle cx="24" cy="24" r="7.5" fill="none" stroke="currentColor" stroke-width="2.2"/>' . $spikes . '</svg>';
}

// Cache-busting: the browser re-downloads a file whenever it changes
function asset($path) {
  $f = __DIR__ . '/../' . $path;
  return $path . (is_file($f) ? '?v=' . filemtime($f) : '');
}

function icon($name, $variant = 'original') {
  return 'https://cdn.jsdelivr.net/gh/devicons/devicon@v2.16.0/icons/' . $name . '/' . $name . '-' . $variant . '.svg';
}

// Inline social icons so they follow the theme colour
function social($name) {
  $paths = [
    'linkedin' => 'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 1 1 0-4.125 2.062 2.062 0 0 1 0 4.125zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0z',
    'github' => 'M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12',
    'gmail' => 'M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.273H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-2.023 2.309-3.178 3.927-1.964L5.455 4.64 12 9.548l6.545-4.91 1.528-1.145C21.69 2.28 24 3.434 24 5.457z',
  ];
  return '<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="' . $paths[$name] . '"/></svg>';
}

$email = 'johnjairuhochoa@gmail.com';
$gmailCompose = 'https://mail.google.com/mail/?view=cm&fs=1&to=' . rawurlencode($email) . '&su=portfolio';
$github = 'https://github.com/zayhub13';
$linkedin = 'https://www.linkedin.com/in/john-jairuh-ochoa-a94262293/';

$skills = [
  'Languages' => [['HTML', 'html5'], ['CSS', 'css3'], ['JavaScript', 'javascript'], ['PHP', 'php'], ['Java', 'java'], ['Python', 'python']],
  'Databases' => [['MySQL', 'mysql'], ['MongoDB', 'mongodb']],
  'Tools' => [['VS Code', 'vscode'], ['Git', 'git'], ['GitHub', 'github'], ['Figma', 'figma'], ['Canva', 'canva']],
  'AI tools' => [['ChatGPT', null], ['GitHub Copilot', null], ['Google Gemini', null], ['Claude', null]],
  'Networking' => [['Cisco Packet Tracer', null], ['OSPF, RIPv2, EIGRP', null], ['DHCP and DNS', null]],
];

$certifications = [
  ['title' => 'Descriptive and Inferential Statistics with Python', 'date' => 'April 14, 2026', 'file' => 'python-statistics.png'],
  ['title' => 'Python Libraries for Data Analysis', 'date' => 'April 8, 2026', 'file' => 'python-libraries-data-analysis.png'],
  ['title' => 'Mastering SQL Functions and Clauses with Taylor Swift', 'date' => 'February 26, 2026', 'file' => 'sql-functions-clauses.png'],
  ['title' => 'Learning SQL Joins with Taylor Swift', 'date' => 'February 16, 2026', 'file' => 'sql-joins.png'],
  ['title' => 'Intro to SQL with Taylor Swift', 'date' => 'January 29, 2026', 'file' => 'intro-to-sql.png'],
];

$projects = [
  [
    'slug' => 'pierc-exe',
    'name' => 'PIERC.EXE',
    'description' => 'A piercing business inquiry website where visitors can submit service requests by email. It does not process payments.',
    'stack' => 'React, JavaScript, Tailwind CSS, Vercel Serverless Functions, Resend',
    'github_url' => 'https://github.com/zayhub13/pierc.exe',
    'live_url' => 'https://piercexe.vercel.app/',
  ],
  [
    'slug' => 'mdas-calculator',
    'name' => 'MDAS Calculator',
    'description' => 'A Java console calculator for multiplication, division, addition, and subtraction, with a check to prevent division by zero.',
    'stack' => 'Java',
    'github_url' => 'https://github.com/Miitsunoo/MDASCalculatorCC3',
  ],
  [
    'slug' => 'bunker-management-system',
    'name' => 'Bunker Management System',
    'description' => 'A Java console-based management system with occupant sign-in, keycard access checks, occupant profiles, work duties, and room reservations.',
    'stack' => 'Java',
    'github_url' => 'https://github.com/Miitsunoo/-M4-M1WithPaymentFramework',
  ],
];
