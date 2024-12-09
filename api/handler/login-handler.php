<?php
session_start();

require __DIR__ . "/../constants/constants.php";
require __DIR__ . "/../db/config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $sandi = $_POST['sandi'];

    $cekEmail = "SELECT id, email FROM login WHERE email = :email AND sandi = :sandi";
    $stat = $pdo->prepare($cekEmail);
    $stat->bindValue(':email', $email, PDO::PARAM_STR);
    $stat->bindValue(':sandi', $sandi, PDO::PARAM_STR);
    $stat->execute();
    
    $stat = $stat->fetch(PDO::FETCH_ASSOC);
    if (!$stat) {
        $_SESSION['data'] = [
            'email' => $email,
        ];
        $_SESSION['error'] = 'Email atau sandi salah';
        header('location: /login.php');
        exit;
    } else {
        $user_id = $stat['id'];

        setcookie(USER_ID_COOKIE_KEY, $user_id, time() + 60*60*24*30, "/");

        $stat = $pdo->prepare(<<<END
        SELECT
            biodata_murid.id as biodata_murid_id,
            berkas_pendaftaran.id as berkas_pendaftaran_id
        FROM login
        LEFT JOIN biodata_murid ON biodata_murid.id_login = login.id
        LEFT JOIN berkas_pendaftaran ON berkas_pendaftaran.id_login = login.id
        WHERE login.id = $user_id;
        END);
        $stat->execute();

        $res = $stat->fetch(PDO::FETCH_ASSOC);
        setcookie(USER_BIODATA_ID_COOKIE_KEY, $res['biodata_murid_id'], time() + 60*60*24*30, '/');
        setcookie(USER_BERKAS_ID_COOKIE_KEY, $res['berkas_pendaftaran_id'], time() + 60*60*24*30, '/');

        header('Location: /registration.php', true);
    }
}