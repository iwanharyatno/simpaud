<?php

$host = $_ENV['POSTGRES_HOST'];
$port = 5432;
$dbname = $_ENV['POSTGRES_DATABASE'];
$user = $_ENV['POSTGRES_USER'];
$pass = $_ENV['POSTGRES_PASSWORD'];

$pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$pass");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);