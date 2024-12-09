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

$login_id = $_COOKIE[USER_ID_COOKIE_KEY];
$sql = "SELECT role FROM login WHERE id = $login_id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$res_usr = $stmt->fetch(PDO::FETCH_ASSOC);

if ($res_usr['role'] != 'Admin') {
    header('Location: /registration.php', true);
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM pengumuman WHERE id = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    header('Location: /admin/index.php#buat-pengumuman', true);
} else if (isset($_POST['id'])) {
    $judul = $_POST['judul'];
    $teks = $_POST['teks'];

    $id = $_POST['id'];
    $sql = "UPDATE pengumuman SET judul = '$judul', teks = '$teks' WHERE id = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    header('Location: /admin/index.php#buat-pengumuman', true);
}  else {
    $judul = $_POST['judul'];
    $teks = $_POST['teks'];

    $sql = "INSERT INTO pengumuman (judul, teks) VALUES ('$judul', '$teks')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    header('Location: /admin/index.php#buat-pengumuman', true);
}