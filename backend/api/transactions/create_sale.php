<?php
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../config/environment.php';
require_once '../../../config/constants.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Login zaroori hai']);
    exit;
}

// Data lena (Frontend se JSON format mein aayega)
$input = json_decode(file_get_contents('php://input'), true);

$customer_id = $input['customer_id'] ?? null;
$items = $input['items'] ?? []; // Array of products: [{id, qty, price}, ...]
$subtotal = $input['subtotal'] ?? 0;
$tax = $input['tax'] ?? 0;
$total = $input['total'] ?? 0;

if (empty($items)) {
    echo json_encode(['success' => false, 'message' => 'Cart khali hai']);
    exit;
}

try {
    // Transaction shuru karein (Atomic operation)
    $pdo->beginTransaction();

    // 1. Transaction record save karein
    $stmt = $pdo->prepare("INSERT INTO transactions (customer_id, items_json, subtotal, tax, total) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $customer_id,
        json_encode($items),
        $subtotal,
        $tax,
        $total
    ]);
    $transaction_id = $pdo->lastInsertId();

    // 2. Stock update karein aur har item check karein
    foreach ($items as $item) {
        $updateStock = $pdo->prepare("UPDATE products SET stock = stock - ? WHERE id = ? AND stock >= ?");
        $updateStock->execute([$item['qty'], $item['id'], $item['qty']]);
        
        if ($updateStock->rowCount() == 0) {
            throw new Exception("Product ID " . $item['id'] . " ka stock khatam hai ya kam hai");
        }
    }

    // 3. Customer Loyalty Points & Total Spent update karein (Agar customer select hai)
    if ($customer_id && LOYALTY_ENABLED) {
        $earned_points = floor($total / 100) * POINTS_PER_100;
        
        $updateCustomer = $pdo->prepare("UPDATE customers SET loyalty_points = loyalty_points + ?, total_spent = total_spent + ? WHERE id = ?");
        $updateCustomer->execute([$earned_points, $total, $customer_id]);
    }

    // Sab theek raha toh commit karein
    $pdo->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Sale mukammal ho gayi!',
        'transaction_id' => $transaction_id,
        'points_earned' => $earned_points ?? 0
    ]);

} catch (Exception $e) {
    // Agar koi bhi masla aaye toh sab rollback kar dein (kuch bhi save nahi hoga)
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Sale fail: ' . $e->getMessage()]);
}