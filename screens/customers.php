<link rel="stylesheet" href="css/customers/customers.css">
<link rel="stylesheet" href="css/customers/customer_header.css">
<link rel="stylesheet" href="css/customers/customer_modal.css">
<link rel="stylesheet" href="css/customers/customer_search.css">

<div id="customer-parent">
    
    <?php include 'screens/components/customers/customer_header.php'; ?>

    <div class="customer-search-wrapper">
        <?php include 'screens/components/customers/customer_search.php'; ?>
    </div>

    <div id="customer-scroll-area" class="no-scrollbar">
        <div id="customer-grid">
            </div>
    </div>

    <?php include 'screens/components/customers/customer_modal.php'; ?>
    <?php include 'screens/components/customers/delete_customer_modal.php'; ?>

</div>

<script src="js/customer-manager.js"></script>
<script>
    if (typeof CustomerManager !== 'undefined') {
        CustomerManager.init();
    }
</script>