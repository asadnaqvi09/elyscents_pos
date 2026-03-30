<?php
header('Content-Type: application/json');
require_once '../../../config/database.php'; // Path check karlein
require_once '../../../config/environment.php';

// Check if User is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Login zaroori hai']);
    exit;
}

try {
    $range = isset($_GET['range']) ? $_GET['range'] : 'today';

    // Date filtering logic based on your previous code style
    $date_condition = "DATE(transaction_date) = CURDATE()";
    if ($range === 'week') {
        $date_condition = "transaction_date >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
    } elseif ($range === 'month') {
        $date_condition = "transaction_date >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
    }

    // 1. KPI Summary (Using your table: customer_transactions)
    $stmt = $pdo->prepare("SELECT 
            COUNT(id) as total_txns, 
            SUM(total) as total_revenue 
            FROM customer_transactions 
            WHERE $date_condition");
    $stmt->execute();
    $summary = $stmt->fetch();

    // 2. Low Stock Alerts (Using your products table)
    $stmt = $pdo->prepare("SELECT name_en, stock FROM products WHERE stock <= low_stock_threshold");
    $stmt->execute();
    $low_stock_items = $stmt->fetchAll();

    // 3. Hourly Sales (New: Required for the Bar Chart)
    $stmt = $pdo->prepare("SELECT HOUR(transaction_date) as hr, SUM(total) as amt 
            FROM customer_transactions 
            WHERE $date_condition 
            GROUP BY HOUR(transaction_date) ORDER BY hr ASC");
    $stmt->execute();
    $hourly_sales = $stmt->fetchAll();

    // 4. Category Breakdown (New: Required for the Pie Chart)
    $stmt = $pdo->prepare("SELECT p.category, SUM(ti.quantity) as val
            FROM transaction_items ti
            JOIN products p ON ti.product_name = p.name_en
            JOIN customer_transactions ct ON ti.transaction_id = ct.id
            WHERE $date_condition
            GROUP BY p.category");
    $stmt->execute();
    $categories = $stmt->fetchAll();

    // 5. Top Products
    $stmt = $pdo->prepare("SELECT product_name, SUM(quantity) as sold 
            FROM transaction_items ti
            JOIN customer_transactions ct ON ti.transaction_id = ct.id
            WHERE $date_condition
            GROUP BY product_name ORDER BY sold DESC LIMIT 2");
    $stmt->execute();
    $top_products = $stmt->fetchAll();

    // Response structure tailored for the React logic
    echo json_encode([
        'success' => true,
        'summary' => [
            'total_sales' => (float)($summary['total_revenue'] ?? 0),
            'transactions' => (int)($summary['total_txns'] ?? 0),
            'low_stock' => count($low_stock_items),
            'avg_sale' => $summary['total_txns'] > 0 ? round($summary['total_revenue'] / $summary['total_txns'], 2) : 0
        ],
        'hourly_sales' => $hourly_sales,
        'categories' => $categories,
        'top_products' => $top_products,
        'low_stock_list' => $low_stock_items
    ]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}