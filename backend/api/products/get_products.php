<?php
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../config/environment.php';

// Check karein ke user login hai ya nahi
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Login zaroori hai']);
    exit;
}

try {
    // Search aur Category filter ke liye variables
    $search = $_GET['search'] ?? '';
    $category = $_GET['category'] ?? '';

    $sql = "SELECT * FROM products WHERE 1=1";
    $params = [];

    if (!empty($search)) {
        $sql .= " AND (name_en LIKE ? OR name_ur LIKE ? OR sku LIKE ?)";
        $searchTerm = "%$search%";
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $params[] = $searchTerm;
    }

    if (!empty($category) && $category !== 'All') {
        $sql .= " AND category = ?";
        $params[] = $category;
    }

    $sql .= " ORDER BY created_at DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll();

    // Response mein products bhej dein
    echo json_encode([
        'success' => true,
        'count' => count($products),
        'data' => $products
    ]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Data lane mein masla: ' . $e->getMessage()]);
}