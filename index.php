<?php
require_once 'config/database.php';
require_once 'config/environment.php';
if (!isset($_SESSION['user_id'])) {
    include 'screens/login.php';
    exit;
}
$page = $_GET['page'] ?? 'sale'; 
?>
<!DOCTYPE html>
<html lang="en" class="h-full"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Elyscents POS</title>
    <link rel="stylesheet" href="css/output.css">
    <link rel="stylesheet" href="css/custom/print.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=Noto+Nastaliq+Urdu:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        ::-webkit-scrollbar-track { background: transparent; }
        /* Fix for Urdu line height in some browsers */
        .dir-rtl { direction: rtl; }
    </style>
</head>
<body class="bg-background h-full flex flex-col overflow-hidden text-text-primary font-sans antialiased">

    <?php include 'screens/components/layout/top_bar.php'; ?>

    <main class="flex-1 relative overflow-hidden min-h-0"> <?php 
        switch ($page) {
            case 'sale':      include 'screens/dashboard.php'; break;
            case 'inventory': include 'screens/inventory.php'; break;
            case 'customers': include 'screens/customers.php'; break;
            case 'reports':   include 'screens/reports.php'; break;
            default:          include 'screens/dashboard.php'; break;
        }
        ?>
    </main>
    <?php include 'screens/components/layout/bottom_bar.php'; ?>
    <?php include 'screens/components/inventory/product_modal.php'; ?>
    <?php include 'screens/components/inventory/delete_confirm_modal.php'; ?>
    <?php include 'screens/components/customers/customer_modal.php'; ?>
    <?php include 'screens/components/customers/delete_customer_modal.php'; ?>
    <script src="js/state.js"></script> <script src="js/app.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/checkout.js"></script>
    <script src="js/ui-helpers.js"></script>
    <?php if ($page === 'inventory'): ?>
        <script src="js/inventory-manager.js"></script>
    <?php endif; ?>
        <?php if ($page === 'customers'): ?>
        <script src="js/customer-manager.js"></script>
    <?php endif; ?>
</body>
</html>