<link rel="stylesheet" href="css/inventory/inventory.css">
<link rel="stylesheet" href="css/inventory/inventory_header.css">
<link rel="stylesheet" href="css/inventory/inventory_search.css">
<link rel="stylesheet" href="css/inventory/inventory_alert.css">
<link rel="stylesheet" href="css/inventory/product_modal.css">
<link rel="stylesheet" href="css/inventory/delete_confirm_modal.css">

<div id="inventory-parent">
    <?php include 'screens/components/inventory/inventory_header.php'; ?>
    <div class="inventory-search-container">
        <?php include 'screens/components/inventory/inventory_search.php'; ?>
    </div>
    <div id="inventory-scroll-area">
        <div id="inventory-grid">
            </div>
    </div>
    <?php
        include 'screens/components/inventory/product_modal.php';
        include 'screens/components/inventory/delete_confirm_modal.php';
    ?>;
</div>

<script src="js/inventory-manager.js"></script> 