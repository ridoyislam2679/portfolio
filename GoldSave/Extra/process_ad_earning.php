<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

require 'db/index.php';

$user_id = $_SESSION['user_id'];
//$ad_id = isset($_POST['ad_id']) ? intval($_POST['ad_id']) : 0;
$reward = 1;

if ($ad_id <= 0 || $ad_id > 30) {
    echo json_encode(['success' => false, 'message' => 'Invalid ad ID']);
    exit;
}

$today = date('Y-m-d');

try {
    // Update user coins
    $stmt = $pdo->prepare("UPDATE users SET coin_balance = coin_balance + ? WHERE user_id = ?");
    $stmt->execute([$reward, $user_id]);
    
    $pdo->commit();
    
    echo json_encode(['success' => true, 'message' => 'Earning recorded', 'reward' => $reward]);
    
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?>