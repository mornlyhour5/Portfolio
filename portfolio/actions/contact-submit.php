<?php
declare(strict_types=1);

// Receives the contact form, checks it, emails it to the owner, then sends the visitor back to the page.

require __DIR__ . '/../config.php';

function back(string $status): void
{
    header('Location: ../index.php?' . $status . '#contact', true, 303);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    back('error=1');
}

// Honeypot: people never see or fill this field, so a value here means a bot
if (trim((string) ($_POST['website'] ?? '')) !== '') {
    back('sent=1');
}

$name    = trim((string) ($_POST['name'] ?? ''));
$email   = trim((string) ($_POST['email'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

$valid = $name !== ''
    && $message !== ''
    && mb_strlen($name) <= 100
    && mb_strlen($message) <= 2000
    && filter_var($email, FILTER_VALIDATE_EMAIL) !== false
    && !preg_match('/[\r\n]/', $name . $email); // stops mail header injection

if (!$valid) {
    back('error=1');
}

$subject = mb_encode_mimeheader('Portfolio message from ' . $name, 'UTF-8');
$body    = "Name: {$name}\nEmail: {$email}\n\n{$message}\n";
$headers = implode("\r\n", [
    'From: Portfolio <' . $profile['email'] . '>',
    'Reply-To: ' . $email,
    'Content-Type: text/plain; charset=UTF-8',
]);

$sent = mail($profile['email'], $subject, $body, $headers);
back($sent ? 'sent=1' : 'error=1');
