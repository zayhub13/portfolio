<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
$_SESSION['contact_csrf'] ??= bin2hex(random_bytes(32));

$sendStatus = $_GET['sent'] ?? '';
$sendMessages = [
  'yes' => ['Message sent successfully. Thanks for getting in touch.', 'success'],
  'no' => ['The message could not be sent right now. Please try again later.', 'error'],
  'wait' => ['Please wait a moment before sending another message.', 'error'],
  'invalid' => ['Please check the form and try again.', 'error'],
];
