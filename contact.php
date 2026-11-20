<?php
// contact.php - the OLD way: the server handles the form, then the browser loads the whole page again
session_start();
date_default_timezone_set('Asia/Manila');

$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

$flash = ['ok' => false, 'text' => '', 'old' => ['name' => $name, 'email' => $email, 'message' => $message]];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $flash['text'] = "Please use the contact form to send a message.";
} elseif ($name === '' || $email === '' || $message === '') {
    $flash['text'] = "Please fill in all the fields.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $flash['text'] = "Please enter a valid email address.";
} else {
    $dir  = __DIR__ . '/data';
    $file = $dir . '/messages.json';
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    $messages = file_exists($file) ? (json_decode(file_get_contents($file), true) ?: []) : [];  // read the list
    $messages[] = [                                                                              // add one message
        'name'    => $name,
        'email'   => $email,
        'message' => $message,
        'time'    => date('M j, h:i A')
    ];
    file_put_contents($file, json_encode($messages, JSON_PRETTY_PRINT), LOCK_EX);                // save

    $flash['ok']   = true;
    $flash['text'] = "Thank you, " . $name . "! Your message was saved.";
    $flash['old']  = ['name' => '', 'email' => '', 'message' => ''];   // clear the form
}

// Send the browser back to the portfolio's Contact section (full page reload, no resubmit on refresh)
$_SESSION['flash'] = $flash;
header('Location: portfolio.php#contact');
exit;
