<?php

require __DIR__ . "/../constants/constants.php";
if (!isset($_COOKIE[USER_ID_COOKIE_KEY])) {
    header('Location: /login.php', true);
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);
    exit;
}

session_start();

require __DIR__ . "/../db/config.php";

$login_id = $_COOKIE[USER_ID_COOKIE_KEY];
$id = $_POST['biodata_ortu_id'];
$nama_lengkap = $_POST['nama_lengkap'];
$hubungan = $_POST['hubungan'];
$alamat = $_POST['alamat'];

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM biodata_ortu WHERE id = $id";
    $stat = $pdo->prepare($sql);
    $stat->execute();

    header('Location: /registration.php#biodata-ortu', true);
} else {
    if (!$id) {
        $sql = "INSERT INTO biodata_ortu (id_login, nama_lengkap, hubungan, alamat) VALUES ($login_id, '$nama_lengkap', '$hubungan', '$alamat')";
        $stat = $pdo->prepare($sql);
        $stat->execute();
    
        $id = $pdo->lastInsertId();
        
        header('Location: /registration.php#biodata-ortu', true);
    } else {
        $sql = "UPDATE biodata_ortu SET id_login = $login_id, nama_lengkap = '$nama_lengkap', hubungan = '$hubungan', alamat = '$alamat' WHERE id = $id";
        $stat = $pdo->prepare($sql);
        $stat->execute();
    
        header('Location: /registration.php#biodata-ortu', true);
    }
}