<?php
// save_message.php - the AJAX way: it answers with JSON, not a whole page
header('Content-Type: application/json');
date_default_timezone_set('Asia/Manila');

function reply(bool $ok, string $text): void {
    echo json_encode(['ok' => $ok, 'reply' => $text]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    reply(false, 'Please use the contact form to send a message.');
}

$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $message === '') {
    reply(false, 'Please fill in all the fields.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    reply(false, 'Please enter a valid email address.');
}

$dir  = __DIR__ . '/data';
$file = $dir . '/messages.json';
if (!is_dir($dir)) {
    mkdir($dir, 0775, true);
}

$messages = file_exists($file) ? (json_decode(file_get_contents($file), true) ?: []) : [];
$messages[] = [
    'name'    => $name,
    'email'   => $email,
    'message' => $message,
    'time'    => date('M j, h:i A')
];

if (file_put_contents($file, json_encode($messages, JSON_PRETTY_PRINT), LOCK_EX) === false) {
    reply(false, 'Sorry, your message could not be saved.');
}

reply(true, 'Thank you, ' . $name . '! Your message was saved.');
