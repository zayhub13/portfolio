<?php
function h($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

// Y2K mark: a four-point star cutting through an orbit ring
function logo($s = 40) {
  return '<svg width="' . $s . '" height="' . $s . '" viewBox="0 0 48 48" role="img" aria-label="Mark: a four-point star crossing an orbit ring"><ellipse cx="24" cy="24" rx="21" ry="8" transform="rotate(-28 24 24)" fill="none" stroke="currentColor" stroke-width="2.5"/><path d="M24 3C25.5 16 32 22.5 45 24 32 25.5 25.5 32 24 45 22.5 32 16 25.5 3 24 16 22.5 22.5 16 24 3Z" fill="currentColor" style="stroke:var(--logo-bg,#fff);stroke-width:3;paint-order:stroke"/></svg>';
}

function icon($name, $variant = 'original') {
  return 'https://cdn.jsdelivr.net/gh/devicons/devicon@v2.16.0/icons/' . $name . '/' . $name . '-' . $variant . '.svg';
}

$email = 'johnjairuhochoa@gmail.com';
$github = 'https://github.com/zayhub13';
$linkedin = 'https://www.linkedin.com/'; // replace with your own profile URL

$skills = [
  'Languages' => [['HTML', 'html5'], ['CSS', 'css3'], ['JavaScript', 'javascript'], ['PHP', 'php'], ['Java', 'java'], ['Python', 'python']],
  'Databases' => [['MySQL', 'mysql'], ['MongoDB', 'mongodb']],
  'Tools' => [['VS Code', 'vscode'], ['Git', 'git'], ['GitHub', 'github'], ['XAMPP', 'xampp'], ['Figma', 'figma'], ['Canva', 'canva'], ['Android Studio', 'androidstudio']],
];
$also = ['Cisco Packet Tracer', 'MySQL Workbench', 'MongoDB Compass', 'LibreOffice'];

// Empty strings are skipped on render, so nothing gets invented.
$projects = [
  [
    'name' => 'Julie Repol Beauty Salon',
    'stack' => 'PHP, MySQL, plain CSS',
    'problem' => 'A salon needed online reservations, and its staff needed one admin view of every booking.',
    'tried' => 'The admin dashboard kept returning an HTTP 500. The fault was the order I had put the authentication steps in, not the logic inside them.',
    'shipped' => 'A reservation flow for customers and an admin dashboard for staff. Queries use prepared statements, and anything printed back to a page goes through htmlspecialchars().',
    'redo_label' => 'What I would change',
    'redo' => 'Write the access check before any page exists, and test with a wrong login before a right one.',
    'note' => 'The source was lost in a deletion and I have no backup.',
  ],
  [
    'name' => 'Enterprise network in Packet Tracer',
    'stack' => 'Cisco Packet Tracer',
    'problem' => 'Eight subnets and eighty PCs have to reach each other and a web server without anyone typing eighty addresses by hand.',
    'tried' => '', // add: what you tried that failed
    'shipped' => 'A topology with 8 subnets, 80 DHCP-assigned PCs, DNS, and a web server at www.ochoa.com. OSPF, RIPv2 and EIGRP run side by side with route redistribution between them.',
    'redo_label' => 'What I would change',
    'redo' => '', // add: one thing you would do differently
    'note' => 'The file was lost in the same deletion.',
  ],
  [
    'name' => 'Cellphone repair job order system',
    'stack' => 'Group thesis, four of us. In design, not built.',
    'problem' => 'Jake Cellphone Repair Shop in Karuhatan needs customers to submit repair requests and follow progress, and staff to manage job orders.',
    'tried' => '',
    'shipped' => 'Not shipped. So far: requirements, an ERD, use cases for the owner, staff and customers, and wireframes.',
    'redo_label' => 'What I am watching',
    'redo' => "Customers look up a repair with a reference number. If those numbers count up one at a time, anyone can read anyone else's repair status. How they get generated is a security question I want answered before anyone writes the page.",
    'note' => '',
  ],
];
