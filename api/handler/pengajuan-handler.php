<?php

require __DIR__ . "/../constants/constants.php";
if (!isset($_COOKIE[USER_ID_COOKIE_KEY])) {
    header('Location: /login.php', true);
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);
    exit;
}

require __DIR__ . "/../db/config.php";

$user_id = $_COOKIE[USER_ID_COOKIE_KEY];

$stmt = $pdo->prepare("UPDATE login SET status = 'Diajukan' WHERE id = $user_id");
$stmt->execute();

header('Location: /registration.php#status-berkas');