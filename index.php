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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elyscents POS</title>
    <link rel="stylesheet" href="css/output.css">
    <link rel="stylesheet" href="css/custom/print.css">
    <style>
        /* Scrollbar */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        ::-webkit-scrollbar-track { background: transparent; }
    </style>
</head>
<body class="bg-background h-screen flex flex-col overflow-hidden text-text-primary font-sans">
    <?php include 'screens/components/layout/top_bar.php'; ?>
    <main class="flex-1 overflow-hidden">
        <?php 
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
    <script src="js/app.js"></script>
    <script src="js/state.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/checkout.js"></script>
    <script src="js/ui-helpers.js"></script>
</body>
</html>