<?php
// process_marketing.php
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
    header('Location: marketing-drop.php');
    exit;
}

// Get POST data
$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
$platform = isset($_POST['platform']) ? trim($_POST['platform']) : '';
$post_link = isset($_POST['post_link']) ? trim($_POST['post_link']) : '';
$screenshot_url = isset($_POST['screenshot_url']) ? trim($_POST['screenshot_url']) : '';
$reward_coins = isset($_POST['reward_coins']) ? floatval($_POST['reward_coins']) : 0;
$csrf_token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

$user_id = $_SESSION['user_id'];
$today = date('Y-m-d');

// Validation
if (empty($post_link)) {
    $_SESSION['error'] = 'Please provide your post link';
    header('Location: marketing-drop.php');
    exit;
}

if (!filter_var($post_link, FILTER_VALIDATE_URL)) {
    $_SESSION['error'] = 'Please provide a valid URL';
    header('Location: marketing-drop.php');
    exit;
}

$valid_platforms = ['facebook', 'instagram', 'twitter'];
if (!in_array($platform, $valid_platforms)) {
    $_SESSION['error'] = 'Invalid platform selected';
    header('Location: marketing-drop.php');
    exit;
}

try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        throw new Exception('Database connection failed');
    }
    
    // Check if user already submitted today
    $stmt = $conn->prepare("SELECT id FROM marketing_submissions WHERE user_id = ? AND DATE(submitted_at) = ?");
    $stmt->bind_param("is", $user_id, $today);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        throw new Exception('You have already submitted today');
    }
    
    // Insert submission
    $status = 'pending';
    $submission_id = 'MRK-' . strtoupper(uniqid());
    
    $stmt = $conn->prepare("INSERT INTO marketing_submissions 
        (submission_id, user_id, post_id, platform, post_link, screenshot_url, reward_coins, status, submitted_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("siisssds", $submission_id, $user_id, $post_id, $platform, $post_link, $screenshot_url, $reward_coins, $status);
    $stmt->execute();
    
    $_SESSION['success'] = 'Your submission has been received. You will get coins after admin verification.';
    header('Location: marketing-drop.php');
    
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header('Location: marketing-drop.php');
} finally {
    $conn->close();
}
?>