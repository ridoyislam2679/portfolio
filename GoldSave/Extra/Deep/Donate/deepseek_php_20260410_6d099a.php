<?php
// process_donate.php
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
    header('Location: donate.php');
    exit;
}

// Get POST data
$campaign_id = isset($_POST['campaign_id']) ? intval($_POST['campaign_id']) : 0;
$donate_amount = isset($_POST['donate_amount']) ? floatval($_POST['donate_amount']) : 0;
$message = isset($_POST['message']) ? trim($_POST['message']) : '';
$csrf_token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

$user_id = $_SESSION['user_id'];

// Campaign names
$campaigns = [
    0 => 'রিনা বেগম - চিকিৎসা সহায়তা',
    1 => 'করিম পরিবার - বন্যার্ত সহায়তা',
    2 => 'আব্দুল গফুর - হুইলচেয়ার',
    3 => 'সাদিয়া আক্তার - শিক্ষা সহায়তা'
];

$campaign_name = isset($campaigns[$campaign_id]) ? $campaigns[$campaign_id] : 'Unknown Campaign';

// Validation
if ($donate_amount <= 0) {
    $_SESSION['error'] = 'Invalid donation amount';
    header('Location: donate.php');
    exit;
}

if ($donate_amount < 10) {
    $_SESSION['error'] = 'Minimum donation amount is ৳ 10';
    header('Location: donate.php');
    exit;
}

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
    
    if (!$user) {
        throw new Exception('User not found');
    }
    
    if ($donate_amount > $user['balance']) {
        throw new Exception('Insufficient balance');
    }
    
    // Update user balance
    $new_balance = $user['balance'] - $donate_amount;
    $stmt = $conn->prepare("UPDATE users SET balance = ? WHERE id = ?");
    $stmt->bind_param("di", $new_balance, $user_id);
    $stmt->execute();
    
    // Insert donation record
    $donation_id = 'DON-' . strtoupper(uniqid());
    $status = 'completed';
    
    $stmt = $conn->prepare("INSERT INTO donations 
        (donation_id, user_id, campaign_id, campaign_name, amount, message, status, created_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("siissss", $donation_id, $user_id, $campaign_id, $campaign_name, $donate_amount, $message, $status);
    $stmt->execute();
    
    $conn->commit();
    
    $_SESSION['success'] = "Successfully donated ৳ $donate_amount to $campaign_name";
    header('Location: dashboard.php');
    
} catch (Exception $e) {
    $conn->rollback();
    $_SESSION['error'] = $e->getMessage();
    header('Location: donate.php');
} finally {
    $conn->close();
}
?>