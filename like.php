<?php
// like.php - GET: tell the like count for a project, POST: add 1 to the count (answers with JSON)
header('Content-Type: application/json');

$id = (int) ($_POST['id'] ?? $_GET['id'] ?? 0);
if ($id < 1) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'reply' => 'Missing project id.']);
    exit;
}

$dir  = __DIR__ . '/data';
$file = $dir . '/likes.json';
if (!is_dir($dir)) {
    mkdir($dir, 0775, true);
}

// Open (or create) the file and lock it so two quick clicks cannot overwrite each other
$fh = fopen($file, 'c+');
flock($fh, LOCK_EX);

$likes = json_decode(stream_get_contents($fh), true);
if (!is_array($likes)) {
    $likes = [];
}
if (!isset($likes[$id])) {
    $likes[$id] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $likes[$id]++;
    ftruncate($fh, 0);
    rewind($fh);
    fwrite($fh, json_encode($likes, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT));
}

flock($fh, LOCK_UN);
fclose($fh);

echo json_encode(['ok' => true, 'id' => $id, 'likes' => $likes[$id]]);
