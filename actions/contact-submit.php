
<?php

require __DIR__ . '/../config.php';

// Redirect visitor back to contact section.
function back(string $status): void
{
    header('Location: ../index.php?' . $status . '#contact', true, 303);
    exit;
}

// Accept POST only.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    back('error=1');
}

// Honeypot spam protection.
if (trim((string)($_POST['website'] ?? '')) !== '') {
    back('sent=1');
}

// Get form values.
$name = trim((string)($_POST['name'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$message = trim((string)($_POST['message'] ?? ''));

// Count UTF-8 characters.
function textLength(string $value): int
{
    if (function_exists('mb_strlen')) {
        return mb_strlen($value, 'UTF-8');
    }

    preg_match_all('/./us', $value, $matches);
    return count($matches[0]);
}

// Validate input.
$valid =
    $name !== '' &&
    $email !== '' &&
    $message !== '' &&
    textLength($name) <= 100 &&
    textLength($message) <= 2000 &&
    filter_var($email, FILTER_VALIDATE_EMAIL) !== false &&
    !preg_match('/[\r\n]/', $name) &&
    !preg_match('/[\r\n]/', $email);

if (!$valid) {
    back('error=1');
}

// Email configuration.
$adminEmail = $contactRecipient ?? $profile['email'];
$senderEmail = $contactFromEmail ?? '';

if (
    !filter_var($adminEmail, FILTER_VALIDATE_EMAIL) ||
    !filter_var($senderEmail, FILTER_VALIDATE_EMAIL)
) {
    back('error=1');
}

// Email subject.
$subject = 'New Contact Message - Portfolio';

// Email body.
$body = "New message from your portfolio website.\n\n";
$body .= "Name: {$name}\n";
$body .= "Email: {$email}\n\n";
$body .= "Message:\n{$message}\n";

// Email headers.
$headers = [
    'From: Portfolio Website <' . $senderEmail . '>',
    'Reply-To: ' . $email,
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8'
];

// Send email.
try {
    $sent = mail(
        $adminEmail,
        $subject,
        $body,
        implode("\r\n", $headers)
    );
} catch (Throwable $e) {
    $sent = false;
}

// Redirect with result.
back($sent ? 'sent=1' : 'error=1');
