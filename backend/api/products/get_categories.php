<?php
header('Content-Type: application/json');
require_once '../../../config/database.php';

try {
    // ENUM values nikalne ke bajaye, hum wo categories nikalenge jo products mein use ho rahi hain
    $stmt = $pdo->query("SELECT DISTINCT category FROM products ORDER BY category ASC");
    $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // 'All' ko hamesha pehle rakhne ke liye
    if (!in_array('All', $categories)) {
        array_unshift($categories, 'All');
    }

    echo json_encode($categories);
} catch (Exception $e) {
    echo json_encode(['All', 'Men', 'Women', 'Unisex']); // Fallback agar DB fail ho jaye
}