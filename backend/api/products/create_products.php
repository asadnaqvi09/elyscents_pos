<?php
/**
 * create_product.php — PDO Version
 * POST → inserts new product with auto-generated SKU
 */
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../config/environment.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

try {
    // ── Inputs ────────────────────────────────────────────
    $name_en    = trim($_POST['name_en']             ?? '');
    $name_ur    = trim($_POST['name_ur']             ?? '');
    $brand      = trim($_POST['brand']               ?? '');
    $category   = trim($_POST['category']            ?? 'unisex');
    $size       = trim($_POST['size']                ?? '');
    $cost_price = (float)($_POST['cost_price']       ?? 0);
    $sale_price = (float)($_POST['sale_price']       ?? 0);
    $stock      = (int)($_POST['stock']              ?? 0);
    $threshold  = (int)($_POST['low_stock_threshold']?? 5);

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

    // ── Auto-generate unique SKU ──────────────────────────
    do {
        $sku   = 'SKU-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $check = $pdo->prepare("SELECT id FROM products WHERE sku = ?");
        $check->execute([$sku]);
    } while ($check->fetch());

    // ── Image upload (optional) ───────────────────────────
    $image_name = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $target_dir = '../../../assets/images/products/';
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $ext        = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array($ext, $allowed_ext)) {
            $image_name = time() . '_' . $sku . '.' . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $image_name);
        }
    }

    // ── Insert ────────────────────────────────────────────
    $stmt = $pdo->prepare("
        INSERT INTO products 
            (sku, name_en, name_ur, brand, category, size, cost_price, sale_price, stock, low_stock_threshold, image)
        VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$sku, $name_en, $name_ur, $brand, $category, $size, $cost_price, $sale_price, $stock, $threshold, $image_name]);

    echo json_encode([
        'success' => true,
        'message' => 'Product added successfully.',
        'id'      => $pdo->lastInsertId(),
        'sku'     => $sku,
    ]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}