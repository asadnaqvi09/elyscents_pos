<?php
/**
 * update_customer.php — PDO Version
 * POST { id, name, phone, email, birthday, notes, loyalty_tier }
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
    echo json_encode(['success' => false, 'message' => 'Customer ID missing.']);
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

    // ── Update Logic ──────────────────────────────────────
    $stmt = $pdo->prepare("
        UPDATE customers SET
            name         = ?,
            phone        = ?,
            email        = ?,
            birthday     = ?,
            notes        = ?,
            loyalty_tier = ?
        WHERE id = ?
    ");

    $stmt->execute([$name, $phone, $email, $birthday, $notes, $tier, $id]);

    echo json_encode(['success' => true, 'message' => 'Customer profile updated.']);

} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        echo json_encode(['success' => false, 'message' => 'This phone number is already used by another customer.']);
    } else {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}