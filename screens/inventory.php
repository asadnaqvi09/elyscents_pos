<?php
require_once __DIR__ . '/../config/database.php';
try {
    $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<div class="h-full w-full p-4 flex gap-4 overflow-hidden">
    <section style="width:40%; background:#fff; border-radius:24px; border:1px solid #e2e8f0; box-shadow:0 1px 4px rgba(0,0,0,0.04); overflow:hidden; display:flex; flex-direction:column;">
        <?php include __DIR__ . '/components/sale/product_grid.php'; ?>
    </section>
    <section style="width:30%; background:#fff; border-radius:24px; border:1px solid #e2e8f0; box-shadow:0 1px 4px rgba(0,0,0,0.04); overflow:hidden; display:flex; flex-direction:column;">
        <?php include __DIR__ . '/components/sale/cart_system.php'; ?>
    </section>
    <section style="width:30%; background:#fff; border-radius:24px; border:1px solid #e2e8f0; box-shadow:0 1px 4px rgba(0,0,0,0.04); overflow:hidden; display:flex; flex-direction:column;">
        <?php include __DIR__ . '/components/sale/actions_buttons.php'; ?>
    </section>
</div>