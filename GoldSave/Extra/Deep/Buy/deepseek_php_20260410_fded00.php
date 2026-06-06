<?php
// process_buy.php
session_start();

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

// Get POST data
$amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
$gold_gram = isset($_POST['gold_gram']) ? floatval($_POST['gold_gram']) : 0;
$free_coins = isset($_POST['free_coins']) ? floatval($_POST['free_coins']) : 0;
$csrf_token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

$user_id = $_SESSION['user_id'];

// Validation
if ($amount <= 0) {
    $_SESSION['error'] = 'Invalid amount';
    header('Location: buy-gold.html');
    exit;
}

if ($amount < 100) {
    $_SESSION['error'] = 'Minimum purchase amount is ৳ 100';
    header('Location: buy-gold.html');
    exit;
}

$gold_price = 7850; // ৳ per gram

try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        throw new Exception('Database connection failed');
    }
    
    // Start transaction
    $conn->begin_transaction();
    
    // Check user balance
    $stmt = $conn->prepare("SELECT balance, gold, coins FROM users WHERE id = ? FOR UPDATE");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if (!$user) {
        throw new Exception('User not found');
    }
    
    if ($amount > $user['balance']) {
        throw new Exception('Insufficient balance');
    }
    
    // Calculate new values
    $new_balance = $user['balance'] - $amount;
    $new_gold = $user['gold'] + $gold_gram;
    $new_coins = $user['coins'] + $free_coins; // Only free coins added
    
    // Update user balance, gold, and coins
    $stmt = $conn->prepare("UPDATE users SET balance = ?, gold = ?, coins = ? WHERE id = ?");
    $stmt->bind_param("dddi", $new_balance, $new_gold, $new_coins, $user_id);
    $stmt->execute();
    
    // Insert transaction record
    $transaction_type = 'buy';
    $status = 'completed';
    $stmt = $conn->prepare("INSERT INTO transactions (user_id, type, amount, gold_gram, free_coins, status, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("isddds", $user_id, $transaction_type, $amount, $gold_gram, $free_coins, $status);
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