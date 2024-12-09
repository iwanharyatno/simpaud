<?php

require __DIR__ . "/../constants/constants.php";
require __DIR__ . "/../db/config.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(403);
}

$user_id = $_COOKIE[USER_ID_COOKIE_KEY];

$stmt = $pdo->prepare("UPDATE login SET status = 'Diajukan' WHERE id = $user_id");
$stmt->execute();

header('Location: /registration.php#status-berkas');