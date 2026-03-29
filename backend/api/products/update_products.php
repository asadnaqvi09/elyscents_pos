<?php
/**
 * update_products.php — PDO Version
 * POST { id, ...fields } → updates existing product
 */
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../config/environment.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$id = $_POST['id'] ?? null;
if (!$id) {
    echo json_encode(['success' => false, 'message' => 'Product ID missing.']);
    exit;
}

try {
    // ── Inputs ────────────────────────────────────────────
    $name_en    = trim($_POST['name_en']              ?? '');
    $name_ur    = trim($_POST['name_ur']              ?? '');
    $brand      = trim($_POST['brand']                ?? '');
    $category   = trim($_POST['category']             ?? 'unisex');
    $size       = trim($_POST['size']                 ?? '');
    $cost_price = (float)($_POST['cost_price']        ?? 0);
    $sale_price = (float)($_POST['sale_price']        ?? 0);
    $stock      = (int)($_POST['stock']               ?? 0);
    $threshold  = (int)($_POST['low_stock_threshold'] ?? 5);

    // ── Validation ────────────────────────────────────────
    if (empty($name_en)) {
        echo json_encode(['success' => false, 'message' => 'Product name (English) is required.']);
        exit;
    }
    if ($sale_price <= 0) {
        echo json_encode(['success' => false, 'message' => 'Sale price must be greater than 0.']);
        exit;
    }
    if ($cost_price <= 0) {
        echo json_encode(['success' => false, 'message' => 'Cost price must be greater than 0.']);
        exit;
    }

    $allowed = ['men', 'women', 'unisex', 'gifts', 'testers'];
    if (!in_array($category, $allowed)) $category = 'unisex';

    // ── Check exists ──────────────────────────────────────
    $check = $pdo->prepare("SELECT id FROM products WHERE id = ?");
    $check->execute([(int)$id]);
    if (!$check->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Product not found.']);
        exit;
    }

    // ── Update ────────────────────────────────────────────
    $stmt = $pdo->prepare("
        UPDATE products SET
            name_en             = ?,
            name_ur             = ?,
            brand               = ?,
            category            = ?,
            size                = ?,
            cost_price          = ?,
            sale_price          = ?,
            stock               = ?,
            low_stock_threshold = ?
        WHERE id = ?
    ");
    $stmt->execute([$name_en, $name_ur, $brand, $category, $size, $cost_price, $sale_price, $stock, $threshold, (int)$id]);

    echo json_encode(['success' => true, 'message' => 'Product updated successfully.']);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
