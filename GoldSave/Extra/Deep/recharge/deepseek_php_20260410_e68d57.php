<?php
// process_recharge.php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'gold_kinen');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: mobile-recharge.php');
    exit;
}

// Get POST data
$mobile_number = isset($_POST['mobile_number']) ? trim($_POST['mobile_number']) : '';
$recharge_amount = isset($_POST['recharge_amount']) ? floatval($_POST['recharge_amount']) : 0;
$csrf_token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

$user_id = $_SESSION['user_id'];

// Validation
if (empty($mobile_number)) {
    $_SESSION['error'] = 'Please enter mobile number';
    header('Location: mobile-recharge.php');
    exit;
}

if (strlen($mobile_number) != 11) {
    $_SESSION['error'] = 'Please enter a valid 11-digit mobile number';
    header('Location: mobile-recharge.php');
    exit;
}

if ($recharge_amount <= 0) {
    $_SESSION['error'] = 'Invalid recharge amount';
    header('Location: mobile-recharge.php');
    exit;
}

if ($recharge_amount < 10) {
    $_SESSION['error'] = 'Minimum recharge amount is ৳ 10';
    header('Location: mobile-recharge.php');
    exit;
}

try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        throw new Exception('Database connection failed');
    }
    
    // Start transaction
    $conn->begin_transaction();
    
    // Check user coins
    $stmt = $conn->prepare("SELECT coins FROM users WHERE id = ? FOR UPDATE");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if (!$user) {
        throw new Exception('User not found');
    }
    
    // 1 Coin = 1 TK, so coins needed = recharge_amount
    $coins_needed = $recharge_amount;
    
    if ($coins_needed > $user['coins']) {
        throw new Exception('Insufficient coins');
    }
    
    // Update user coins
    $new_coins = $user['coins'] - $coins_needed;
    $stmt = $conn->prepare("UPDATE users SET coins = ? WHERE id = ?");
    $stmt->bind_param("di", $new_coins, $user_id);
    $stmt->execute();
    
    // Insert recharge record
    $status = 'completed';
    $recharge_id = 'RCH-' . strtoupper(uniqid());
    
    $stmt = $conn->prepare("INSERT INTO recharge_history 
        (recharge_id, user_id, mobile_number, amount, coins_used, status, created_at) 
        VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sisdis", $recharge_id, $user_id, $mobile_number, $recharge_amount, $coins_needed, $status);
    $stmt->execute();
    
    $conn->commit();
    
    $_SESSION['success'] = "Successfully recharged ৳ $recharge_amount to $mobile_number";
    header('Location: dashboard.php');
    
} catch (Exception $e) {
    $conn->rollback();
    $_SESSION['error'] = $e->getMessage();
    header('Location: mobile-recharge.php');
} finally {
    $conn->close();
}
?>