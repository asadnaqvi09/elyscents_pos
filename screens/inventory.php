<?php
/**
 * inventory.php
 * Parent screen — assembles all inventory child components
 * Included by index.php inside <main>
 */
?>
<div id="inventory-parent" style="display:flex; flex-direction:column; height:100%; background:#f8fafc; overflow:hidden; font-family:'Inter', sans-serif;">

    <!-- 1. Header: Title + Add/Export buttons -->
    <?php include 'screens/components/inventory/inventory_header.php'; ?>

    <!-- 2. Controls: Alerts + Search -->
    <div style="flex-shrink:0; padding:15px 40px; border-bottom:1px solid #f1f5f9;">
        <?php include 'screens/components/inventory/inventory_search.php'; ?>
    </div>

    <!-- 3. Scrollable Product Grid -->
    <div id="inventory-scroll-area" style="flex:1; overflow-y:auto; padding:28px 40px 100px;">
        <div id="inventory-grid" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(300px, 1fr)); gap:24px;">
            <!-- Populated by InventoryManager.fetchProducts() via AJAX -->
        </div>
    </div>

</div>