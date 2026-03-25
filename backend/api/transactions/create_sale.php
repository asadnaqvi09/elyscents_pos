<?php
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../config/environment.php';

// Auth Guard: Sirf logged-in admin hi sale kar sakta hai
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

// Frontend se JSON data lena
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'message' => 'Invalid data received']);
    exit;
}

$customer_id    = $input['customer_id'] ?? null;
$items          = $input['items'] ?? []; // Array: [{id, qty, price}, ...]
$subtotal       = $input['subtotal'] ?? 0;
$tax            = $input['tax'] ?? 0;
$total          = $input['total'] ?? 0;
$payment_method = $input['payment_method'] ?? 'Cash';
$amount_paid    = $input['amount_paid'] ?? $total;
$change_amount  = $amount_paid - $total;

if (empty($items)) {
    echo json_encode(['success' => false, 'message' => 'Cart is empty']);
    exit;
}

try {
    $pdo->beginTransaction();

    // 1. Transaction Table mein Main Record Insert karna
    $sql = "INSERT INTO transactions 
            (customer_id, user_id, subtotal, tax, total, payment_method, amount_paid, change_amount, items_json) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $customer_id,
        $_SESSION['user_id'], // Admin Asad ki ID
        $subtotal,
        $tax,
        $total,
        $payment_method,
        $amount_paid,
        $change_amount,
        json_encode($items) // Backup ke liye pura cart JSON mein
    ]);
    
    $transaction_id = $pdo->lastInsertId();

    // 2. Har item ka Stock update karna aur Sale Items record karna
    foreach ($items as $item) {
        // Stock check karna
        $stk = $pdo->prepare("SELECT stock, name FROM products WHERE id = ? FOR UPDATE");
        $stk->execute([$item['id']]);
        $product = $stk->fetch();

        if (!$product || $product['stock'] < $item['qty']) {
            throw new Exception("Stock short for: " . ($product['name'] ?? 'ID '.$item['id']));
        }

        // Stock ghatana
        $updateStock = $pdo->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
        $updateStock->execute([$item['qty'], $item['id']]);
    }

    $pdo->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Sale successful!',
        'transaction_id' => $transaction_id,
        'change' => $change_amount
    ]);

} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}