<?php
$host = getenv('MYSQL_HOST') ?: 'db';
$dbname = getenv('MYSQL_DATABASE') ?: 'resume_db';
$user = getenv('MYSQL_USER') ?: 'resume_user';
$pass = getenv('MYSQL_PASSWORD') ?: 'resume_pass';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection error : " . $e->getMessage());
}
?>