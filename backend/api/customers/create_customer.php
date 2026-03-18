<?php
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../config/environment.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Login zaroori hai']);
    exit;
}

$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? null;
$birthday = $_POST['birthday'] ?? null;
$preferences = $_POST['preferences'] ?? '';

if (empty($name) || empty($phone)) {
    echo json_encode(['success' => false, 'message' => 'Naam aur Phone number lazmi hain']);
    exit;
}

try {
    $sql = "INSERT INTO customers (name, phone, email, birthday, preferences) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $phone, $email, $birthday, $preferences]);

    echo json_encode(['success' => true, 'message' => 'Naya customer register ho gaya hai']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Registration fail: ' . $e->getMessage()]);
}