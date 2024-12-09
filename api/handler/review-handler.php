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

$user_id = $_POST['user_id'];

$status_biodata = $_POST['status_biodata'];
$catatan_biodata = $_POST['catatan_biodata'];

$sql = "UPDATE biodata_murid SET status = :status, catatan = :catatan WHERE id_login = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':status', $status_biodata, PDO::PARAM_STR);
$stmt->bindValue(':catatan', $catatan_biodata, PDO::PARAM_STR);
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$stmt->execute();

$status_ortu_list = $_POST['status_ortu_list'];
$catatan_ortu_list = $_POST['catatan_ortu_list'];

$sql = "UPDATE biodata_ortu SET status = :status, catatan = :catatan WHERE id_login = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':status', $status_ortu_list, PDO::PARAM_STR);
$stmt->bindValue(':catatan', $catatan_ortu_list, PDO::PARAM_STR);
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$stmt->execute();

$status_berkas = $_POST['status_berkas'];
$catatan_berkas = $_POST['catatan_berkas'];

$sql = "UPDATE berkas_pendaftaran SET status = :status, catatan = :catatan WHERE id_login = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':status', $status_berkas, PDO::PARAM_STR);
$stmt->bindValue(':catatan', $catatan_berkas, PDO::PARAM_STR);
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$stmt->execute();

$status_user = 'Diajukan';

if ($status_biodata == 'Diterima' && $status_berkas == 'Diterima' && $status_ortu_list == 'Diterima') {
    $status_user = 'Diterima';
}
if ($status_biodata == 'Ditolak' || $status_berkas == 'Ditolak' || $status_ortu_list == 'Ditolak') {
    $status_user = 'Ditolak';
}
if ($status_biodata == 'Diproses' || $status_berkas == 'Diproses' || $status_ortu_list == 'Diproses') {
    $status_user = 'Diajukan';
}

$sql = "UPDATE login SET status = :status WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':status', $status_user, PDO::PARAM_STR);
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$stmt->execute();

$id = $_GET['id'];
header("Location: /admin/index.php");