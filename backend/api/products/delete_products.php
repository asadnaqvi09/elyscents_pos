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
    echo json_encode(['success' => false, 'message' => 'Kis product ko delete karna hai? ID bhejein']);
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Product ko inventory se khatam kar diya gaya hai']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Product nahi mili']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Delete nahi ho saka: ' . $e->getMessage()]);
}