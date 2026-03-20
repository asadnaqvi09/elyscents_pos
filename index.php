<?php
require_once 'config/database.php';
require_once 'config/environment.php';

// Auth Guard
if (!isset($_SESSION['user_id'])) {
    include 'screens/login.php';
    exit;
}

// Page Routing Logic
$page = $_GET['page'] ?? 'sale'; // Default ab 'sale' hai as per your requirement
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elyscents POS - Admin</title>
    
    <link rel="stylesheet" href="css/output.css">
</head>
<body class="bg-background text-text-primary h-screen flex flex-col overflow-hidden">

    <?php include 'screens/components/layout/top_bar.php'; ?>

    <main class="flex-1 overflow-hidden relative">
        <div class="h-full w-full p-4 overflow-y-auto">
            <div class="max-w-[1600px] mx-auto h-full">
                <?php 
                // Modular Page Switcher
                switch ($page) {
                    case 'sale':
                        include 'screens/sale.php';
                        break;
                    case 'inventory':
                        include 'screens/inventory.php';
                        break;
                    case 'customers':
                        include 'screens/customers.php';
                        break;
                    case 'reports':
                        include 'screens/reports.php';
                        break;
                    case 'more':
                        include 'screens/more.php';
                        break;
                    case 'settings':
                        include 'screens/settings.php';
                        break;
                    case 'logout':
                        session_destroy();
                        header('Location: index.php');
                        exit;
                    default:
                        include 'screens/sale.php';
                        break;
                }
                ?>
            </div>
        </div>
    </main>

    <?php include 'screens/components/layout/bottom_bar.php'; ?>

    <script src="js/app.js"></script>
    <script src="js/ui-helpers.js"></script>
</body>
</html>