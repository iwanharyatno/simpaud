<?php

session_start();

require __DIR__ . "/../db/config.php";
require __DIR__ . "/../constants/constants.php";

$login_id = $_COOKIE[USER_ID_COOKIE_KEY];
$path_berkas = $_POST['path_berkas'];

if (!isset($_COOKIE[USER_BERKAS_ID_COOKIE_KEY])) {
    $sql = "INSERT INTO berkas_pendaftaran (id_login, path_berkas) VALUES ($login_id, '$path_berkas')";
    $stat = $pdo->prepare($sql);
    $stat->execute();

    $id = $pdo->lastInsertId();
    setcookie(USER_BERKAS_ID_COOKIE_KEY, $id, time() + 60*60*24*30, "/");

    header('Location: /registration.php#berkas-pendaftaran', true);
} else {
    $id = $_COOKIE[USER_BERKAS_ID_COOKIE_KEY];
    $sql = "UPDATE berkas_pendaftaran SET id_login = $login_id, path_berkas = '$path_berkas' WHERE id = $id";
    $stat = $pdo->prepare($sql);
    $stat->execute();

    header('Location: /registration.php#berkas-pendaftaran', true);
}