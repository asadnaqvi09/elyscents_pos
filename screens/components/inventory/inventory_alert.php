<?php
require_once dirname(__DIR__, 3) . '/config/database.php';
$result    = $conn->query("SELECT stock, low_stock_threshold FROM products");
$allRows   = $result->fetch_all(MYSQLI_ASSOC);
$lowStock  = count(array_filter($allRows, fn($p) => $p['stock'] > 0 && $p['stock'] <= $p['low_stock_threshold']));
$outStock  = count(array_filter($allRows, fn($p) => $p['stock'] == 0));
$hasAlerts = ($lowStock > 0 || $outStock > 0);
?>

<div id="inventory-alerts" class="alert-container" style="margin-bottom: <?= $hasAlerts ? '14px' : '0' ?>;">

    <?php if ($lowStock > 0): ?>
    <div id="alert-low-stock" class="alert-base alert-low">
        <div class="alert-content-left">
            <div class="pulse-dot"></div>
            <span class="alert-text">
                <span id="low-stock-count" class="alert-count"><?= $lowStock ?></span>
                product<?= $lowStock > 1 ? 's' : '' ?> running low on stock
            </span>
        </div>
        <span class="alert-badge">Restock Soon</span>
    </div>
    <?php endif; ?>

    <?php if ($outStock > 0): ?>
    <div id="alert-out-stock" class="alert-base alert-out">
        <div class="alert-content-left">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <span class="alert-text">
                <span id="out-stock-count" class="alert-count"><?= $outStock ?></span>
                product<?= $outStock > 1 ? 's' : '' ?> out of stock
            </span>
        </div>
        <span class="alert-badge">Urgent</span>
    </div>
    <?php endif; ?>

</div>