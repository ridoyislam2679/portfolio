<?php
// process_sell.php
session_start();
header('Content-Type: application/json');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'gold_kinen');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: buy-gold.html');
    exit;
}

$coins = isset($_POST['coins']) ? floatval($_POST['coins']) : 0;
$user_id = $_SESSION['user_id'];

if ($coins <= 0) {
    $_SESSION['error'] = 'Invalid coin amount';
    header('Location: buy-gold.html');
    exit;
}

$gold_price = 7850;
$gram_per_coin = 0.01274;
$gold_gram = $coins * $gram_per_coin;
$amount = $gold_gram * $gold_price;

try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        throw new Exception('Database connection failed');
    }
    
    $conn->begin_transaction();
    
    // Check user coins
    $stmt = $conn->prepare("SELECT coins, balance FROM users WHERE id = ? FOR UPDATE");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($coins > $user['coins']) {
        throw new Exception('Insufficient coins');
    }
    
    // Update user
    $new_coins = $user['coins'] - $coins;
    $new_balance = $user['balance'] + $amount;
    $new_gold = $user['gold'] - $gold_gram;
    
    $stmt = $conn->prepare("UPDATE users SET balance = ?, coins = ?, gold = ? WHERE id = ?");
    $stmt->bind_param("dddi", $new_balance, $new_coins, $new_gold, $user_id);
    $stmt->execute();
    
    // Insert transaction
    $transaction_type = 'sell';
    $stmt = $conn->prepare("INSERT INTO transactions (user_id, type, amount, gold_gram, coins, status, created_at) VALUES (?, ?, ?, ?, ?, 'completed', NOW())");
    $stmt->bind_param("isddd", $user_id, $transaction_type, $amount, $gold_gram, $coins);
    $stmt->execute();
    
    $conn->commit();
    
    $_SESSION['success'] = 'Gold sold successfully!';
    header('Location: dashboard.html');
    
} catch (Exception $e) {
    $conn->rollback();
    $_SESSION['error'] = $e->getMessage();
    header('Location: buy-gold.html');
} finally {
    $conn->close();
}
?>