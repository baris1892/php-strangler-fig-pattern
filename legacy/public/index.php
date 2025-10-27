<?php

header('Content-Type: application/json');

session_start();

// start legacy session if necessary
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = ['id' => 1, 'name' => 'Legacy User'];
}

$response = [
    'status' => '✅ User logged in (Legacy)',
    'session_id' => session_id(),
    'user' => $_SESSION['user']
];

echo json_encode($response, JSON_PRETTY_PRINT);
