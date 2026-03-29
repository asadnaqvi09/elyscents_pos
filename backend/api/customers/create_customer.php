<?php
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../config/environment.php';

// Auth Check
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

try {
    // ── Inputs ────────────────────────────────────────────
    $name     = trim($_POST['name']     ?? '');
    $phone    = trim($_POST['phone']    ?? '');
    $email    = trim($_POST['email']    ?? '');
    $birthday = !empty($_POST['birthday']) ? $_POST['birthday'] : null;
    $notes    = trim($_POST['notes']    ?? '');
    $tier     = trim($_POST['loyalty_tier'] ?? 'bronze');

    // ── Validation ────────────────────────────────────────
    if (empty($name) || empty($phone)) {
        echo json_encode(['success' => false, 'message' => 'Name and Phone are required.']);
        exit;
    }

    // ── Auto-generate Custom Customer ID ──────────────────
    // Format: CUST-1234
    do {
        $customer_id = 'CUST-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $check = $pdo->prepare("SELECT id FROM customers WHERE id = ?");
        $check->execute([$customer_id]);
    } while ($check->fetch());

    // ── Insert Logic ──────────────────────────────────────
    $stmt = $pdo->prepare("
        INSERT INTO customers 
            (id, name, phone, email, birthday, notes, loyalty_tier)
        VALUES 
            (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $customer_id, 
        $name, 
        $phone, 
        $email, 
        $birthday, 
        $notes, 
        $tier
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Customer registered successfully.',
        'customer_id' => $customer_id
    ]);

} catch (PDOException $e) {
    // Unique Phone constraint error handle karna
    if ($e->getCode() == 23000) {
        echo json_encode(['success' => false, 'message' => 'This phone number is already registered.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database Error: ' . $e->getMessage()]);
    }
}