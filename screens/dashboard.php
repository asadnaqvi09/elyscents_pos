<?php
require_once __DIR__ . '/../config/database.php';
try {
    $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<link rel="stylesheet" href="css/sales/sales.css">
<link rel="stylesheet" href="css/sales/product_grid.css">
<link rel="stylesheet" href="css/sales/actions_buttons.css">
<link rel="stylesheet" href="css/sales/cart_system.css">

<div class="sales-layout">
    <section class="sales-section section-products">
        <?php include __DIR__ . '/components/sale/product_grid.php'; ?>
    </section>

    <section class="sales-section section-cart">
        <?php include __DIR__ . '/components/sale/cart_system.php'; ?>
    </section>

    <section class="sales-section section-actions">
        <?php include __DIR__ . '/components/sale/actions_buttons.php'; ?>
    </section>
</div>

<script src="js/cart.js"></script>