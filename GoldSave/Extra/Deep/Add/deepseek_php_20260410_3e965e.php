<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'gold_kinen');

$user_id = $_SESSION['user_id'];
$ad_id = isset($_POST['ad_id']) ? intval($_POST['ad_id']) : 0;
$reward = 1; // 1 coin per ad

if ($ad_id <= 0 || $ad_id > 30) {
    echo json_encode(['success' => false, 'message' => 'Invalid ad ID']);
    exit;
}

$today = date('Y-m-d');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check if already watched today
$stmt = $conn->prepare("SELECT id FROM ad_watch_history WHERE user_id = ? AND ad_id = ? AND DATE(watched_at) = ?");
$stmt->bind_param("iis", $user_id, $ad_id, $today);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Already watched today']);
    $conn->close();
    exit;
}

// Check daily limit
$stmt = $conn->prepare("SELECT COUNT(*) as count FROM ad_watch_history WHERE user_id = ? AND DATE(watched_at) = ?");
$stmt->bind_param("is", $user_id, $today);
$stmt->execute();
$countResult = $stmt->get_result()->fetch_assoc();

if ($countResult['count'] >= 30) {
    echo json_encode(['success' => false, 'message' => 'Daily limit reached']);
    $conn->close();
    exit;
}

// Start transaction
$conn->begin_transaction();

try {
    // Insert watch history
    $stmt = $conn->prepare("INSERT INTO ad_watch_history (user_id, ad_id, reward_coins, watched_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iii", $user_id, $ad_id, $reward);
    $stmt->execute();
    
    // Update user coins
    $stmt = $conn->prepare("UPDATE users SET coins = coins + ? WHERE id = ?");
    $stmt->bind_param("ii", $reward, $user_id);
    $stmt->execute();
    
    $conn->commit();
    
    echo json_encode(['success' => true, 'message' => 'Earning recorded', 'reward' => $reward]);
    
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'Database error']);
}

$conn->close();
?>