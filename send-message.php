<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\Exception as MailException;
use PHPMailer\PHPMailer\PHPMailer;

function respond(bool $ok, string $message, int $status): void
{
  http_response_code($status);
  if (str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json')) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok' => $ok, 'message' => $message]);
  } else {
    header('Location: contact.php?sent=' . ($ok ? 'yes' : 'no'), true, 303);
  }
  exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Allow: POST');
  respond(false, 'Method not allowed.', 405);
}

session_start();
$expectedToken = $_SESSION['contact_csrf'] ?? '';
$providedToken = $_POST['csrf_token'] ?? '';
if (!is_string($expectedToken) || !is_string($providedToken) || $expectedToken === '' || !hash_equals($expectedToken, $providedToken)) {
  respond(false, 'The form expired. Reload the page and try again.', 400);
}

if (!empty($_POST['website'])) {
  respond(false, 'Invalid form submission.', 400);
}

$lastSent = $_SESSION['contact_last_sent'] ?? 0;
if (is_int($lastSent) && time() - $lastSent < 30) {
  respond(false, 'Please wait a moment before sending another message.', 429);
}

$nameInput = $_POST['name'] ?? null;
$emailInput = $_POST['email'] ?? null;
$messageInput = $_POST['message'] ?? null;
if (!is_string($nameInput) || !is_string($emailInput) || !is_string($messageInput)) {
  respond(false, 'Please check the form and try again.', 422);
}

$name = trim($nameInput);
$senderEmail = trim($emailInput);
$message = trim($messageInput);
if (
  $name === '' || mb_strlen($name) > 100 ||
  !filter_var($senderEmail, FILTER_VALIDATE_EMAIL) || mb_strlen($senderEmail) > 254 ||
  $message === '' || mb_strlen($message) > 3000
) {
  respond(false, 'Please check the form and try again.', 422);
}

$mailConfig = null;
$configPath = getenv('PORTFOLIO_MAIL_CONFIG');
if ($configPath !== false && $configPath !== '') {
  if (!is_file($configPath) || !is_readable($configPath)) {
    error_log('Contact mail configuration file is missing or unreadable.');
    respond(false, 'Message sending is not configured yet. Please contact me by email instead.', 503);
  }
  $configJson = file_get_contents($configPath);
  if ($configJson === false) {
    error_log('Contact mail configuration file could not be read.');
    respond(false, 'Message sending is not configured yet. Please contact me by email instead.', 503);
  }
  $mailConfig = json_decode($configJson, true);
  if (!is_array($mailConfig)) {
    error_log('Contact mail configuration file is invalid JSON.');
    respond(false, 'Message sending is not configured yet. Please contact me by email instead.', 503);
  }
  $smtpUser = $mailConfig['smtp_user'] ?? null;
  $smtpKey = $mailConfig['smtp_key'] ?? null;
  $fromEmail = $mailConfig['from_email'] ?? null;
  $fromName = $mailConfig['from_name'] ?? 'Jai Ochoa Portfolio';
} else {
  $smtpUser = getenv('BREVO_SMTP_USER');
  $smtpKey = getenv('BREVO_SMTP_KEY');
  $fromEmail = getenv('BREVO_FROM_EMAIL');
  $fromName = getenv('BREVO_FROM_NAME') ?: 'Jai Ochoa Portfolio';
}
$autoload = __DIR__ . '/vendor/autoload.php';
if (
  !is_string($smtpUser) || $smtpUser === '' ||
  !is_string($smtpKey) || $smtpKey === '' ||
  !is_string($fromEmail) || !filter_var($fromEmail, FILTER_VALIDATE_EMAIL) ||
  !is_string($fromName) || $fromName === '' || mb_strlen($fromName) > 100 ||
  !is_file($autoload)
) {
  error_log('Contact mail is not configured: required Brevo SMTP settings or Composer dependencies are missing.');
  respond(false, 'Message sending is not configured yet. Please contact me by email instead.', 503);
}

$_SESSION['contact_last_sent'] = time();
session_write_close();

require $autoload;
$mail = new PHPMailer(true);
try {
  $mail->isSMTP();
  $mail->Host = 'smtp-relay.brevo.com';
  $mail->SMTPAuth = true;
  $mail->Username = $smtpUser;
  $mail->Password = $smtpKey;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;
  $mail->CharSet = PHPMailer::CHARSET_UTF8;
  $mail->setFrom($fromEmail, $fromName);
  $mail->addAddress('johnjairuhochoa@gmail.com');
  $mail->addReplyTo($senderEmail, $name);
  $mail->Subject = 'portfolio';
  $mail->isHTML(false);
  $mail->Body = "Name: {$name}\nEmail: {$senderEmail}\n\n{$message}";
  $mail->send();
} catch (MailException $exception) {
  error_log('Contact mail delivery failed: ' . $mail->ErrorInfo);
  respond(false, 'The message could not be sent right now. Please try again later.', 502);
}

respond(true, 'Message sent successfully. Thanks for getting in touch.', 200);
