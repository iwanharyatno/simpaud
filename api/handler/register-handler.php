<?php
session_start();

require "../../db/config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $sandi = $_POST['sandi'];

    $cekEmail = "SELECT email FROM login WHERE email = :email";
    $stat = $pdo->prepare($cekEmail);
    $stat->bindValue(':email', $email, PDO::PARAM_STR);
    $stat->execute();   
    
    $stat = $stat->fetch(PDO::FETCH_ASSOC);
    if ($stat) {
        $_SESSION['data'] = [
            'username' => $username,
            'email' => $email,
            'telepon' => $telepon
        ];
        $_SESSION['error'] = 'Email sudah digunakan';
        header('location: /register.php');
        exit;
    }

    $sql = "INSERT INTO login (username, email, telepon, sandi) VALUES ('$username', '$email', '$telepon', '$sandi')";

    if ($pdo->exec($sql)) {
        setcookie('user-email', $email);
        header('location: /registration.php', true);
    } else {
        echo "gagal!";
    }
}