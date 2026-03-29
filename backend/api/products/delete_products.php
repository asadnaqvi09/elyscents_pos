<?php
/**
 * delete_products.php — PDO Version
 * POST { id } → deletes product
 */
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../config/environment.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

// Accept both POST body and GET param (for flexibility)
$id = $_POST['id'] ?? $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(['success' => false, 'message' => 'Product ID missing.']);
    exit;
}

try {
    // Check exists first
    $check = $pdo->prepare("SELECT id FROM products WHERE id = ?");
    $check->execute([(int)$id]);
    if (!$check->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Product not found.']);
        exit;
    }

    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([(int)$id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Product deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Delete failed.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}