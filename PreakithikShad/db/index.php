<?php

$host = 'localhost';
$dbname = 'eshopbussiness';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("<h3 style='color:red;'>Connection failed: " . $e->getMessage())."</h3>";
}

?>

<?php
/*

$host = 'localhost';
$dbname = 'mobiler1_eShop';
$username = 'mobiler1_shop';
$password = 'hridoyshop#1';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4", // এখানে charset যোগ করলাম
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4" // Extra safety
        ]
    );
} catch (PDOException $e) {
    die("<h3 style='color:red;'>Connection failed: " . $e->getMessage() . "</h3>");
}

*/

?>