<div id="customer-parent" style="display:flex; flex-direction:column; height:100%; background:#f8fafc; overflow:hidden; font-family:'Inter', sans-serif;">
    <?php include 'screens/components/customers/customer_header.php'; ?>
    <div style="flex-shrink:0; padding:15px 40px; border-bottom:1px solid #f1f5f9;">
        <?php include 'screens/components/customers/customer_search.php'; ?>
    </div>
    <div id="customer-scroll-area" class="no-scrollbar" style="flex:1; overflow-y:auto; padding:28px 40px 100px;">
        <div id="customer-grid" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(320px, 1fr)); gap:24px;">
            </div>
    </div>
</div>
<script>
    // Agar hum page shift kar rahay hain, to ensure karein ke Manager init ho jaye
    if (typeof CustomerManager !== 'undefined') {
        CustomerManager.init();
    }
</script>