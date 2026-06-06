<?php
// process_collect.php
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
    header('Location: collect-gold.html');
    exit;
}

// Get POST data
$gold_gram = isset($_POST['gold_gram']) ? floatval($_POST['gold_gram']) : 0;
$fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
$mobile = isset($_POST['mobile']) ? trim($_POST['mobile']) : '';
$address = isset($_POST['address']) ? trim($_POST['address']) : '';
$delivery_method = isset($_POST['delivery_method']) ? trim($_POST['delivery_method']) : '';
$csrf_token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

$user_id = $_SESSION['user_id'];

// Validation
if ($gold_gram <= 0) {
    $_SESSION['error'] = 'Invalid gold amount';
    header('Location: collect-gold.html');
    exit;
}

if ($gold_gram < 1) {
    $_SESSION['error'] = 'Minimum collect amount is 1 Gram';
    header('Location: collect-gold.html');
    exit;
}

if (empty($fullname)) {
    $_SESSION['error'] = 'Please enter your full name';
    header('Location: collect-gold.html');
    exit;
}

if (empty($mobile)) {
    $_SESSION['error'] = 'Please enter your mobile number';
    header('Location: collect-gold.html');
    exit;
}

if (strlen($mobile) < 11) {
    $_SESSION['error'] = 'Please enter a valid mobile number';
    header('Location: collect-gold.html');
    exit;
}

if (empty($address)) {
    $_SESSION['error'] = 'Please enter your address';
    header('Location: collect-gold.html');
    exit;
}

$valid_methods = ['coin', 'biscuit', 'bar', 'jewelry', 'gram'];
if (!in_array($delivery_method, $valid_methods)) {
    $_SESSION['error'] = 'Invalid delivery method';
    header('Location: collect-gold.html');
    exit;
}

try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        throw new Exception('Database connection failed');
    }
    
    // Start transaction
    $conn->begin_transaction();
    
    // Check user gold balance
    $stmt = $conn->prepare("SELECT gold FROM users WHERE id = ? FOR UPDATE");
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
    
    // Update user gold
    $new_gold = $user['gold'] - $gold_gram;
    $stmt = $conn->prepare("UPDATE users SET gold = ? WHERE id = ?");
    $stmt->bind_param("di", $new_gold, $user_id);
    $stmt->execute();
    
    // Insert collect request
    $status = 'pending';
    $request_id = 'COL-' . strtoupper(uniqid());
    
    $stmt = $conn->prepare("INSERT INTO collect_requests 
        (request_id, user_id, gold_gram, fullname, mobile, address, delivery_method, status, created_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sidsssss", $request_id, $user_id, $gold_gram, $fullname, $mobile, $address, $delivery_method, $status);
    $stmt->execute();
    
    $conn->commit();
    
    $_SESSION['success'] = 'Gold collection request submitted successfully! Request ID: ' . $request_id;
    header('Location: dashboard.html');
    
} catch (Exception $e) {
    $conn->rollback();
    $_SESSION['error'] = $e->getMessage();
    header('Location: collect-gold.html');
} finally {
    $conn->close();
}
?>