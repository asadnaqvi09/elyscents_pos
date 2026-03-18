<?php
require_once 'config/database.php';
require_once 'config/environment.php';
if (!isset($_SESSION['user_id'])) {
    include 'screens/login.php';
    exit;
}
$page = $_GET['page'] ?? 'dashboard';
switch ($page) {
    case 'pos':
        include 'screens/pos.php';
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
    case 'settings':
        include 'screens/settings.php';
        break;
    case 'logout':
        session_destroy();
        header('Location: index.php');
        break;
    default:
        include 'screens/dashboard.php';
        break;
}