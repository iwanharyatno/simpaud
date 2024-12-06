<?php

$host = getenv('POSTGRES_HOST') ? getenv('POSTGRES_HOST') : 'localhost';
$port = 5432;
$dbname = getenv('POSTGRES_DATABASE') ? getenv('POSTGRES_DATABASE') : 'simpaud';
$user = getenv('POSTGRES_USER') ? getenv('POSTGRES_USER') : 'postgres';
$pass = getenv('POSTGRES_PASSWORD') ? getenv('POSTGRES_PASSWORD') : 'admin';

$pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$pass");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);