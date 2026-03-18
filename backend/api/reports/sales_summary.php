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
    $today = date('Y-m-d');

    // 1. Aaj ki total sales aur counts
    $stmt = $pdo->prepare("SELECT 
            COUNT(id) as total_txns, 
            SUM(subtotal) as total_subtotal, 
            SUM(tax) as total_tax, 
            SUM(total) as total_revenue 
            FROM transactions 
            WHERE DATE(created_at) = ?");
    $stmt->execute([$today]);
    $summary = $stmt->fetch();

    // 2. Low Stock Products (Jo threshold se kam hain)
    $stmt = $pdo->prepare("SELECT name_en, name_ur, stock FROM products WHERE stock < ?");
    $stmt->execute([LOW_STOCK_THRESHOLD]);
    $low_stock_items = $stmt->fetchAll();

    // 3. Top 5 Best Selling Products (JSON data se nikalne ke bajaye transactions se)
    // Note: Simple POS ke liye hum aaj ki transactions ki list bhi bhej dete hain
    $stmt = $pdo->prepare("SELECT t.id, t.total, t.created_at, c.name as customer_name 
            FROM transactions t 
            LEFT JOIN customers c ON t.customer_id = c.id 
            WHERE DATE(t.created_at) = ? 
            ORDER BY t.created_at DESC");
    $stmt->execute([today]);
    $recent_sales = $stmt->fetchAll();

    // 4. Inventory Valuation (Admin knowledge ke liye)
    $inventory = $pdo->query("SELECT 
            SUM(cost_price * stock) as total_cost_value, 
            SUM(sale_price * stock) as total_sale_value 
            FROM products")->fetch();

    echo json_encode([
        'success' => true,
        'summary' => [
            'total_transactions' => $summary['total_txns'] ?? 0,
            'total_revenue' => $summary['total_revenue'] ?? 0,
            'total_tax' => $summary['total_tax'] ?? 0,
            'net_sales' => $summary['total_subtotal'] ?? 0
        ],
        'inventory_stats' => [
            'cost_value' => $inventory['total_cost_value'] ?? 0,
            'sale_value' => $inventory['total_sale_value'] ?? 0,
            'potential_profit' => ($inventory['total_sale_value'] - $inventory['total_cost_value'])
        ],
        'low_stock' => $low_stock_items,
        'recent_sales' => $recent_sales
    ]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Report generate nahi ho saki: ' . $e->getMessage()]);
}