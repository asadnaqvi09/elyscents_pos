<?php
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../config/environment.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Login zaroori hai']);
    exit;
}

$id = $_POST['id'] ?? null;
$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? null;
$birthday = $_POST['birthday'] ?? null;
$preferences = $_POST['preferences'] ?? '';

if (!$id || empty($name) || empty($phone)) {
    echo json_encode(['success' => false, 'message' => 'ID, Naam aur Phone lazmi hain']);
    exit;
}

try {
    $sql = "UPDATE customers SET 
            name = ?, phone = ?, email = ?, 
            birthday = ?, preferences = ? 
            WHERE id = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $phone, $email, $birthday, $preferences, $id]);

    echo json_encode(['success' => true, 'message' => 'Customer ki maloomat update ho gayi hain']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Update fail: ' . $e->getMessage()]);
}