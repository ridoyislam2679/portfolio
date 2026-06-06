<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

require 'db/index.php';

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT coin_balance FROM user WHERE user_id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($user) {
    echo json_encode(['success' => true, 'coins' => $user['coin_balance']);
} else {
    echo json_encode(['success' => false, 'message' => 'User not found']);
}
?>