<?php
$q = $_SERVER['QUERY_STRING'] ?? '';
header('Location: index.php' . ($q !== '' ? '?' . $q : '') . '#contact', true, 302);
exit;
