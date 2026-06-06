<?php
// process_buy.php
session_start();
header('Content-Type: application/json');

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'gold_kinen');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: buy-gold.html');
    exit;
}

$amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
$csrf_token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';
$user_id = $_SESSION['user_id'];

// Validation
if ($amount <= 0) {
    $_SESSION['error'] = 'Invalid amount';
    header('Location: buy-gold.html');
    exit;
}

if ($amount < 100) {
    $_SESSION['error'] = 'Minimum purchase amount is ₦ 100';
    header('Location: buy-gold.html');
    exit;
}

$gold_price = 7850; // ₦ per gram
$gold_gram = $amount / $gold_price;
$coins = $gold_gram; // 1 gram = 1 coin

try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        throw new Exception('Database connection failed');
    }
    
    // Start transaction
    $conn->begin_transaction();
    
    // Check user balance
    $stmt = $conn->prepare("SELECT balance FROM users WHERE id = ? FOR UPDATE");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($amount > $user['balance']) {
        throw new Exception('Insufficient balance');
    }
    
    // Update user balance
    $new_balance = $user['balance'] - $amount;
    $stmt = $conn->prepare("UPDATE users SET balance = ? WHERE id = ?");
    $stmt->bind_param("di", $new_balance, $user_id);
    $stmt->execute();
    
    // Update user gold and coins
    $stmt = $conn->prepare("UPDATE users SET gold = gold + ?, coins = coins + ? WHERE id = ?");
    $stmt->bind_param("ddi", $gold_gram, $coins, $user_id);
    $stmt->execute();
    
    // Insert transaction record
    $transaction_type = 'buy';
    $stmt = $conn->prepare("INSERT INTO transactions (user_id, type, amount, gold_gram, coins, status, created_at) VALUES (?, ?, ?, ?, ?, 'completed', NOW())");
    $stmt->bind_param("isddd", $user_id, $transaction_type, $amount, $gold_gram, $coins);
    $stmt->execute();
    
    $conn->commit();
    
    $_SESSION['success'] = 'Gold purchased successfully!';
    header('Location: dashboard.html');
    
} catch (Exception $e) {
    $conn->rollback();
    $_SESSION['error'] = $e->getMessage();
    header('Location: buy-gold.html');
} finally {
    $conn->close();
}
?>