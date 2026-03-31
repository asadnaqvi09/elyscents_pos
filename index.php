<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once 'config/database.php';
require_once 'config/environment.php';

// Ensure translations and lang are available even if environment.php missed them
$translations = $translations ?? include 'config/translations.php';
$lang = $_SESSION['language'] ?? 'en';

if (!isset($_SESSION['user_id'])) {
    include 'screens/login.php';
    exit;
}

$page = $_GET['page'] ?? 'sale'; 
$isUrdu = ($lang === 'ur');
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isUrdu ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Elyscents POS</title>
    
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/custom/print.css">
    
    <?php if($isUrdu): ?> 
        <link rel="stylesheet" href="css/custom/rtl.css"> 
    <?php endif; ?>

    <link rel="stylesheet" href="css/layout/top_bar.css">
    <link rel="stylesheet" href="css/layout/bottom_bar.css">
    <link rel="stylesheet" href="css/more/more.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=Noto+Nastaliq+Urdu:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="app-wrapper <?php echo $isUrdu ? 'urdu-font' : ''; ?>">

    <?php include 'screens/components/layout/top_bar.php'; ?>

    <main id="main-content">
        <?php 
        switch ($page) {
            case 'sale':      include 'screens/dashboard.php'; break;
            case 'inventory': include 'screens/inventory.php'; break;
            case 'customers': include 'screens/customers.php'; break;
            case 'reports':   include 'screens/reports.php'; break;
            case 'more':      include 'screens/more.php'; break;
            case 'settings':  include 'screens/components/more/settings.php'; break;
            case 'help':      include 'screens/components/more/help.php'; break;
            default:          include 'screens/dashboard.php'; break;
        }
        ?>
    </main>

    <?php include 'screens/components/layout/bottom_bar.php'; ?>

    <script>
        const currentLang = '<?php echo $lang; ?>';
        const trans = <?php echo json_encode($translations); ?>;
    </script>
    <script src="js/state.js"></script>
    <script src="js/app.js"></script> 
    <script src="js/checkout.js"></script>
</body>
</html>