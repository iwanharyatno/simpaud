<?php
session_start();

require __DIR__ . "/../db/config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $sandi = $_POST['sandi'];

    $cekEmail = "SELECT email FROM login WHERE email = :email AND sandi = :sandi";
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
        setcookie('user-email', $email);
        header('Location: /registration.php', true);
    }
}