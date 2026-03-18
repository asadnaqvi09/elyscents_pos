<?php
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../config/environment.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Login zaroori hai']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$sku = $_POST['sku'] ?? '';
$name_en = $_POST['name_en'] ?? '';
$name_ur = $_POST['name_ur'] ?? null;
$category = $_POST['category'] ?? '';
$size = $_POST['size'] ?? '';
$cost_price = $_POST['cost_price'] ?? 0;
$sale_price = $_POST['sale_price'] ?? 0;
$stock = $_POST['stock'] ?? 0;

if (empty($sku) || empty($name_en) || empty($category) || empty($sale_price)) {
    echo json_encode(['success' => false, 'message' => 'Zaroori maloomat (SKU, Name, Category, Price) lazmi hain']);
    exit;
}

try {
    $checkSku = $pdo->prepare("SELECT id FROM products WHERE sku = ?");
    $checkSku->execute([$sku]);
    if ($checkSku->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Ye SKU pehle se maujood hai']);
        exit;
    }

    $image_name = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $target_dir = "../../../uploads/products/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = time() . '_' . $sku . '.' . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $image_name);
    }

    $sql = "INSERT INTO products (sku, name_en, name_ur, category, size, cost_price, sale_price, stock, image) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$sku, $name_en, $name_ur, $category, $size, $cost_price, $sale_price, $stock, $image_name]);

    echo json_encode([
        'success' => true, 
        'message' => 'Product kamyabi se shamil kar di gayi hai',
        'product_id' => $pdo->lastInsertId()
    ]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}