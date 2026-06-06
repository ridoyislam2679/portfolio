<?php
// process_sell.php
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
    header('Location: sell-gold.html');
    exit;
}

// Get POST data
$gold_gram = isset($_POST['gold_gram']) ? floatval($_POST['gold_gram']) : 0;
$money_amount = isset($_POST['money_amount']) ? floatval($_POST['money_amount']) : 0;
$csrf_token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

$user_id = $_SESSION['user_id'];

// Validation
if ($gold_gram <= 0) {
    $_SESSION['error'] = 'Invalid gold amount';
    header('Location: sell-gold.html');
    exit;
}

if ($gold_gram < 0.1) {
    $_SESSION['error'] = 'Minimum sell amount is 0.1 Gram';
    header('Location: sell-gold.html');
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
    
    // Check user gold balance
    $stmt = $conn->prepare("SELECT balance, gold FROM users WHERE id = ? FOR UPDATE");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if (!$user) {
        throw new Exception('User not found');
    }
    
    if ($gold_gram > $user['gold']) {
        throw new Exception('Insufficient gold balance');
    }
    
    // Calculate new values
    $new_balance = $user['balance'] + $money_amount;
    $new_gold = $user['gold'] - $gold_gram;
    
    // Update user balance and gold
    $stmt = $conn->prepare("UPDATE users SET balance = ?, gold = ? WHERE id = ?");
    $stmt->bind_param("ddi", $new_balance, $new_gold, $user_id);
    $stmt->execute();
    
    // Insert transaction record
    $transaction_type = 'sell';
    $status = 'completed';
    $stmt = $conn->prepare("INSERT INTO transactions (user_id, type, gold_gram, amount, status, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("isdd s", $user_id, $transaction_type, $gold_gram, $money_amount, $status);
    $stmt->execute();
    
    $conn->commit();
    
    $_SESSION['success'] = 'Gold sold successfully!';
    header('Location: dashboard.html');
    
} catch (Exception $e) {
    $conn->rollback();
    $_SESSION['error'] = $e->getMessage();
    header('Location: sell-gold.html');
} finally {
    $conn->close();
}
?>