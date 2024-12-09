<?php

session_start();

require __DIR__ . "/../db/config.php";
require __DIR__ . "/../constants/constants.php";

$login_id = $_COOKIE[USER_ID_COOKIE_KEY];
$nama_depan = $_POST['nama_depan'];
$nama_belakang = $_POST['nama_belakang'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];

if (!isset($_COOKIE[USER_BIODATA_ID_COOKIE_KEY])) {
    $sql = "INSERT INTO biodata_murid (id_login, nama_depan, nama_belakang, tanggal_lahir, jenis_kelamin, alamat) VALUES ($login_id, '$nama_depan', '$nama_belakang', '$tanggal_lahir', '$jenis_kelamin', '$alamat')";
    $stat = $pdo->prepare($sql);
    $stat->execute();

    $id = $pdo->lastInsertId();
    setcookie(USER_BIODATA_ID_COOKIE_KEY, $id, time() + 60*60*24*30, "/");

    header('Location: /registration.php#biodata-murid', true);
} else {
    $id = $_COOKIE[USER_BIODATA_ID_COOKIE_KEY];
    $sql = "UPDATE biodata_murid SET id_login = $login_id, nama_depan = '$nama_depan', nama_belakang = '$nama_belakang', tanggal_lahir = '$tanggal_lahir', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat' WHERE id = $id";
    $stat = $pdo->prepare($sql);
    $stat->execute();

    header('Location: /registration.php#biodata-murid', true);
}