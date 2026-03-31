<link rel="stylesheet" href="css/more/help.css">

<?php
$lang = $_SESSION['language'] ?? 'en'; 
$isUrdu = ($lang === 'ur');
$direction = $isUrdu ? 'rtl' : 'ltr';
?>

<div class="help-wrapper" style="direction: <?php echo $direction; ?>;">
    <div class="help-container">
        
        <!-- Header -->
        <div class="help-header">
            <div>
                <h1 class="help-title">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                    <?php echo $isUrdu ? 'مدد اور معاونت' : 'Help & Support'; ?>
                </h1>
                <p class="help-subtitle">
                    <?php echo $isUrdu ? 'عام سوالات کے جوابات تلاش کریں' : 'Find answers to common questions'; ?>
                </p>
            </div>

            <button onclick="loadScreen('more')" class="btn-back">
                <?php echo $isUrdu ? 'واپس' : '← Back'; ?>
            </button>
        </div>

        <!-- Search -->
        <div class="search-box">
            <svg class="search-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input type="text" id="helpSearch" onkeyup="filterHelp()" 
                placeholder="<?php echo $isUrdu ? 'مضامین تلاش کریں...' : 'Search help articles...'; ?>" 
                class="search-input">
        </div>

        <!-- Cards -->
        <div class="card-grid">
            <div class="card">
                <div class="icon-box icon-purple">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="card-title">User Guide</h3>
                    <p class="card-subtitle">Complete manual</p>
                </div>
            </div>

            <div class="card">
                <div class="icon-box icon-blue">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="7" width="12" height="10" rx="2"/>
                        <path d="M22 7l-6 5 6 5V7z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="card-title">Video Tutorials</h3>
                    <p class="card-subtitle">Step by step</p>
                </div>
            </div>

            <div class="card">
                <div class="icon-box icon-green">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="card-title">Contact Support</h3>
                    <p class="card-subtitle">Get help</p>
                </div>
            </div>
        </div>

        <!-- FAQ -->
        <div class="faq-list">

            <div class="faq-group">
                <h2 class="faq-group-title"><?php echo $isUrdu ? 'شروعات' : 'Getting Started'; ?></h2>
                <div class="faq-box">
                    <?php echo renderFaqItem(
                        "How do I process a sale?", 
                        "1. Go to the POS/Sell screen\n2. Search and add products to cart\n3. Enter customer details (optional)\n4. Select payment method (Cash/Card/UPI)\n5. Click \"Complete Sale\"\n6. Print or share receipt"
                    ); ?>

                    <?php echo renderFaqItem(
                        "How do I add a new customer?", 
                        "1. Go to Customers screen\n2. Click \"Add Customer\" button\n3. Enter name and phone (required)\n4. Add email, birthday, preferences (optional)\n5. Click \"Save Customer\"\n\nPhone format: 03XX-XXXXXXX"
                    ); ?>
                </div>
            </div>

            <div class="faq-group">
                <h2 class="faq-group-title">Inventory Management</h2>
                <div class="faq-box">
                    <?php echo renderFaqItem(
                        "How do I update stock levels?", 
                        "1. Open Inventory screen\n2. Find the product\n3. Click Edit\n4. Update stock\n5. Save"
                    ); ?>

                    <?php echo renderFaqItem(
                        "How do I delete a product?", 
                        "1. Click delete icon\n2. Confirm popup\n\nWarning: cannot be undone."
                    ); ?>
                </div>
            </div>

            <div class="faq-group">
                <h2 class="faq-group-title">Customer Management</h2>
                <div class="faq-box">
                    <?php echo renderFaqItem(
                        "What are loyalty tiers?", 
                        "• Bronze: 0 - 50,000\n• Silver: 50k - 100k\n• Gold: 100k+"
                    ); ?>

                    <?php echo renderFaqItem(
                        "How do loyalty points work?", 
                        "1 point per Rs.100\n100 points = Rs.100 discount"
                    ); ?>
                </div>
            </div>

            <div class="faq-group">
                <h2 class="faq-group-title">Offline Mode</h2>
                <div class="faq-box">
                    <?php echo renderFaqItem(
                        "How does offline mode work?", 
                        "• Works offline\n• Saves locally\n• Syncs when online"
                    ); ?>

                    <?php echo renderFaqItem(
                        "What happens to offline transactions?", 
                        "Saved locally → synced automatically later"
                    ); ?>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function toggleFaq(btn) {
    const item = btn.parentElement;

    // close others (accordion behavior)
    document.querySelectorAll('.faq-item').forEach(el => {
        if(el !== item) el.classList.remove('active');
    });

    item.classList.toggle('active');
}

// optional search
function filterHelp() {
    const input = document.getElementById("helpSearch").value.toLowerCase();
    document.querySelectorAll(".faq-item").forEach(item => {
        item.style.display = item.innerText.toLowerCase().includes(input) ? "" : "none";
    });
}
</script>

<?php
function renderFaqItem($title, $content) {
    return '
    <div class="faq-item">
        <button onclick="toggleFaq(this)" class="faq-btn">
            <span class="faq-title">'.$title.'</span>
            <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        <div class="faq-content">'.$content.'</div>
    </div>';
}
?>