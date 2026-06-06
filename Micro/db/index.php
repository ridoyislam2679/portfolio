<?php
// maintenance.php
$isMaintenance = false; // true করলে আবার চbondho hobay

if ($isMaintenance) {
    echo "<h2 style='color:red;text-align:center;'>Website is under maintenance. Please try again later.</h2>";
    exit();
}

$host = 'localhost';
$dbname = 'refonexc_micro';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET time_zone = '+06:00'");
} catch (PDOException $e) {
    die("<h3 style='color:red;'>Connection failed: " . $e->getMessage())."</h3>";
}

function generateReferralCode() {
	global $pdo;
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    do {
        $code = '';
        for ($i = 0; $i < 8; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE referral_code = ?");
        $stmt->execute([$code]);
        $exists = $stmt->fetchColumn(); 

    } while ($exists); 

    return $code;
}
?>