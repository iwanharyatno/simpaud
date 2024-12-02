<?php
require "./db/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPAUD - Sistem Informasi PAUD</title>
    <link rel="stylesheet" href="/css/fonts.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <header>
        <nav>
            <h1 style="font-family: Poppins;">SIMPAUD</h1>
            <ul>
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">Informasi Layanan</a></li>
                <li><a href="#">Kontak</a></li>
            </ul>
        </nav>
    </header>

    <?php

    echo $_SERVER["REQUEST_URI"];

    ?>
</body>
</html>