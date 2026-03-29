<?php
require_once dirname(__DIR__, 3) . '/config/database.php';
$result    = $conn->query("SELECT stock, low_stock_threshold FROM products");
$allRows   = $result->fetch_all(MYSQLI_ASSOC);
$lowStock  = count(array_filter($allRows, fn($p) => $p['stock'] > 0 && $p['stock'] <= $p['low_stock_threshold']));
$outStock  = count(array_filter($allRows, fn($p) => $p['stock'] == 0));
?>

<div id="inventory-alerts" style="margin-bottom:<?= ($lowStock > 0 || $outStock > 0) ? '14px' : '0' ?>;">

    <?php if ($lowStock > 0): ?>
    <div id="alert-low-stock" style="display:flex; align-items:center; justify-content:space-between; padding:12px 18px; background:#fffbeb; border:1.5px solid #fde68a; border-radius:14px; margin-bottom:8px;">
        <div style="display:flex; align-items:center; gap:10px;">
            <div style="width:8px; height:8px; background:#f59e0b; border-radius:50%; animation:pulse 2s infinite;"></div>
            <span style="font-size:13px; font-weight:700; color:#92400e;">
                <span id="low-stock-count" style="font-weight:900;"><?= $lowStock ?></span>
                product<?= $lowStock > 1 ? 's' : '' ?> running low on stock
            </span>
        </div>
        <span style="font-size:11px; font-weight:700; color:#b45309; text-transform:uppercase; letter-spacing:0.5px;">Restock Soon</span>
    </div>
    <?php endif; ?>

    <?php if ($outStock > 0): ?>
    <div id="alert-out-stock" style="display:flex; align-items:center; justify-content:space-between; padding:12px 18px; background:#fef2f2; border:1.5px solid #fecaca; border-radius:14px;">
        <div style="display:flex; align-items:center; gap:10px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span style="font-size:13px; font-weight:700; color:#991b1b;">
                <span id="out-stock-count" style="font-weight:900;"><?= $outStock ?></span>
                product<?= $outStock > 1 ? 's' : '' ?> out of stock
            </span>
        </div>
        <span style="font-size:11px; font-weight:700; color:#b91c1c; text-transform:uppercase; letter-spacing:0.5px;">Urgent</span>
    </div>
    <?php endif; ?>

</div>

<style>
@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: 0.5; transform: scale(1.4); }
}
</style>
