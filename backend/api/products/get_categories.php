<?php
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../config/environment.php';

if (!isset($_SESSION['user_id'])) { 
    exit(json_encode(['success' => false, 'message' => 'Unauthorized'])); 
}

try {
    // ENUM values ya unique categories fetch karne ke liye
    $stmt = $pdo->query("SELECT DISTINCT category FROM products WHERE category IS NOT NULL");
    $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo json_encode([
        'success' => true, 
        'data' => $categories
    ]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}