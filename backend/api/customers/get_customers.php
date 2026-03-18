<?php
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../config/environment.php';
require_once '../../../config/constants.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Login zaroori hai']);
    exit;
}

try {
    $search = $_GET['search'] ?? '';
    $sql = "SELECT * FROM customers WHERE 1=1";
    $params = [];

    if (!empty($search)) {
        $sql .= " AND (name LIKE ? OR phone LIKE ?)";
        $searchTerm = "%$search%";
        $params[] = $searchTerm;
        $params[] = $searchTerm;
    }

    $sql .= " ORDER BY total_spent DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $customers = $stmt->fetchAll();

    foreach ($customers as &$customer) {
        $tier = getLoyaltyTier($customer['loyalty_points']);
        $customer['tier_label'] = $tier['label'];
        $customer['tier_color'] = $tier['color'];
    }

    echo json_encode(['success' => true, 'data' => $customers]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Customer data error: ' . $e->getMessage()]);
}