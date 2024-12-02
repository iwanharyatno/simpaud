<?php

$host = 'localhost';
$port = 5432;
$dbname = 'simpaud';
$user = 'postgres';
$pass = 'admin';

$pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$pass");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);