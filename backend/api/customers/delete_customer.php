<?php
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../config/environment.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Login zaroori hai']);
    exit;
}

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(['success' => false, 'message' => 'Customer ID bhejein']);
    exit;
}

try {
    // Transaction record check (Safety)
    $check = $pdo->prepare("SELECT id FROM transactions WHERE customer_id = ? LIMIT 1");
    $check->execute([$id]);
    
    if ($check->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Is customer ki purani sales mojood hain, delete nahi kiya ja sakta']);
        exit;
    }

    $stmt = $pdo->prepare("DELETE FROM customers WHERE id = ?");
    $stmt->execute([$id]);

    echo json_encode(['success' => true, 'message' => 'Customer ko database se hata diya gaya hai']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Delete fail: ' . $e->getMessage()]);
}