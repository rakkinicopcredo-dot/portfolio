<?php
// get_messages.php - sends the messages (newest first) as JSON, without the email addresses
header('Content-Type: application/json');

$file = __DIR__ . '/data/messages.json';
$all  = file_exists($file) ? (json_decode(file_get_contents($file), true) ?: []) : [];

$public = array_map(fn($m) => [
    'name'    => $m['name'] ?? '',
    'message' => $m['message'] ?? '',
    'time'    => $m['time'] ?? ''
], $all);

echo json_encode(array_reverse($public));
