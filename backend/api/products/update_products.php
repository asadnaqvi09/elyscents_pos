<?php
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../config/environment.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Login zaroori hai']);
    exit;
}

$id = $_POST['id'] ?? null;
if (!$id) {
    echo json_encode(['success' => false, 'message' => 'Product ID lazmi hai']);
    exit;
}

try {
    $sku = $_POST['sku'] ?? '';
    $name_en = $_POST['name_en'] ?? '';
    $name_ur = $_POST['name_ur'] ?? null;
    $category = $_POST['category'] ?? '';
    $size = $_POST['size'] ?? '';
    $cost_price = $_POST['cost_price'] ?? 0;
    $sale_price = $_POST['sale_price'] ?? 0;
    $stock = $_POST['stock'] ?? 0;

    $sql = "UPDATE products SET 
            sku = ?, name_en = ?, name_ur = ?, category = ?, 
            size = ?, cost_price = ?, sale_price = ?, stock = ? 
            WHERE id = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$sku, $name_en, $name_ur, $category, $size, $cost_price, $sale_price, $stock, $id]);

    echo json_encode(['success' => true, 'message' => 'Product ki maloomat update ho gayi hain']);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Update fail ho gaya: ' . $e->getMessage()]);
}