<?php
$lang = $_SESSION['language'] ?? 'en'; 
$isUrdu = ($lang === 'ur');
$direction = $isUrdu ? 'rtl' : 'ltr';
$textAlign = $isUrdu ? 'right' : 'left';
?>

<div style="height: 100%; overflow-y: auto; padding: 40px 20px; background-color: #f8fafc; font-family: 'Inter', sans-serif; direction: <?php echo $direction; ?>;">
    <div style="max-width: 900px; margin: 0 auto;">
        
        <div style="margin-bottom: 32px; display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h1 style="font-size: 28px; font-weight: 800; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 12px;">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    <?php echo $isUrdu ? 'مدد اور معاونت' : 'Help & Support'; ?>
                </h1>
                <p style="font-size: 15px; color: #64748b; margin-top: 6px;"><?php echo $isUrdu ? 'عام سوالات کے جوابات تلاش کریں' : 'Find answers to common questions'; ?></p>
            </div>
            <button onclick="loadScreen('more')" style="background: white; border: 1px solid #e2e8f0; color: #1e293b; padding: 10px 18px; border-radius: 12px; font-weight: 600; cursor: pointer; box-shadow: 0 1px 2px rgba(0,0,0,0.05);"><?php echo $isUrdu ? 'واپس' : '← Back'; ?></button>
        </div>

        <div style="position: relative; margin-bottom: 32px;">
            <svg style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #94a3b8;" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" id="helpSearch" onkeyup="filterHelp()" placeholder="<?php echo $isUrdu ? 'مضامین تلاش کریں...' : 'Search help articles...'; ?>" 
                style="width: 100%; padding: 16px 16px 16px 48px; border-radius: 16px; border: 1px solid #e2e8f0; font-size: 16px; background: white; outline: none; box-sizing: border-box; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 48px;">
            <div style="background: white; padding: 24px; border-radius: 20px; border: 1px solid #eef2f6; display: flex; align-items: center; gap: 16px; cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="background: #f5f3ff; color: #7c3aed; padding: 12px; border-radius: 14px;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                </div>
                <div>
                    <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: #1e293b;">User Guide</h3>
                    <p style="margin: 4px 0 0; font-size: 13px; color: #64748b;">Complete manual</p>
                </div>
            </div>
            <div style="background: white; padding: 24px; border-radius: 20px; border: 1px solid #eef2f6; display: flex; align-items: center; gap: 16px; cursor: pointer;">
                <div style="background: #eff6ff; color: #2563eb; padding: 12px; border-radius: 14px;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="12" height="10" rx="2" ry="2"/><path d="M22 7l-6 5 6 5V7z"/></svg>
                </div>
                <div>
                    <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: #1e293b;">Video Tutorials</h3>
                    <p style="margin: 4px 0 0; font-size: 13px; color: #64748b;">Step by step</p>
                </div>
            </div>
            <div style="background: white; padding: 24px; border-radius: 20px; border: 1px solid #eef2f6; display: flex; align-items: center; gap: 16px; cursor: pointer;">
                <div style="background: #ecfdf5; color: #059669; padding: 12px; border-radius: 14px;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                </div>
                <div>
                    <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: #1e293b;">Contact Support</h3>
                    <p style="margin: 4px 0 0; font-size: 13px; color: #64748b;">Get help</p>
                </div>
            </div>
        </div>

        <div id="faqList" style="display: flex; flex-direction: column; gap: 32px; padding-bottom: 100px;">
            
            <div class="faq-group">
                <h2 style="font-size: 18px; font-weight: 800; color: #1e293b; margin-bottom: 16px;"><?php echo $isUrdu ? 'شروعات' : 'Getting Started'; ?></h2>
                <div style="background: white; border-radius: 20px; border: 1px solid #e2e8f0; overflow: hidden;">
                    <?php echo renderFaqItem(
                        "How do I process a sale?", 
                        "1. Go to the POS/Sell screen\n2. Search and add products to cart\n3. Enter customer details (optional)\n4. Select payment method (Cash/Card/UPI)\n5. Click \"Complete Sale\"\n6. Print or share receipt",
                        $isUrdu
                    ); ?>
                    <?php echo renderFaqItem(
                        "How do I add a new customer?", 
                        "1. Go to Customers screen\n2. Click \"Add Customer\" button\n3. Enter name and phone (required)\n4. Add email, birthday, preferences (optional)\n5. Click \"Save Customer\"\n\nPhone format: 03XX-XXXXXXX",
                        $isUrdu
                    ); ?>
                </div>
            </div>

            <div class="faq-group">
                <h2 style="font-size: 18px; font-weight: 800; color: #1e293b; margin-bottom: 16px;">Inventory Management</h2>
                <div style="background: white; border-radius: 20px; border: 1px solid #e2e8f0; overflow: hidden;">
                    <?php echo renderFaqItem(
                        "How do I update stock levels?", 
                        "1. Open Inventory screen\n2. Find the product you want to update\n3. Click \"Edit\" button on the product card\n4. Update the stock quantity\n5. Click \"Save Product\"\n\nStock is automatically reduced when sales are completed.",
                        $isUrdu
                    ); ?>
                    <?php echo renderFaqItem(
                        "How do I delete a product?", 
                        "1. Find the product in Inventory screen\n2. Click the trash icon on the product card\n3. Confirm deletion in the popup dialog\n\nWarning: This action cannot be undone. Sales staff cannot delete products.",
                        $isUrdu
                    ); ?>
                </div>
            </div>

            <div class="faq-group">
                <h2 style="font-size: 18px; font-weight: 800; color: #1e293b; margin-bottom: 16px;">Customer Management</h2>
                <div style="background: white; border-radius: 20px; border: 1px solid #e2e8f0; overflow: hidden;">
                    <?php echo renderFaqItem(
                        "What are loyalty tiers?", 
                        "Elyscents has 3 loyalty tiers based on total purchases:\n\n• Bronze (🥉): Rs. 0 - 50,000\n• Silver (⭐): Rs. 50,001 - 100,000\n• Gold (👑): Rs. 100,001+\n\nHigher tiers receive better discounts and exclusive offers.",
                        $isUrdu
                    ); ?>
                    <?php echo renderFaqItem(
                        "How do loyalty points work?", 
                        "Customers earn 1 point for every Rs. 100 spent.\n\nPoints can be redeemed for:\n• Discounts on future purchases\n• Free samples\n• Special gift sets\n\n100 points = Rs. 100 discount",
                        $isUrdu
                    ); ?>
                </div>
            </div>

            <div class="faq-group">
                <h2 style="font-size: 18px; font-weight: 800; color: #1e293b; margin-bottom: 16px;">Offline Mode</h2>
                <div style="background: white; border-radius: 20px; border: 1px solid #e2e8f0; overflow: hidden;">
                    <?php echo renderFaqItem(
                        "How does offline mode work?", 
                        "Elyscents is designed to work offline during power outages:\n\n• All data is stored locally in your browser\n• You can continue processing sales\n• Changes sync automatically when online\n• Red \"Offline\" indicator shows at top\n\nYour data is safe and will not be lost.",
                        $isUrdu
                    ); ?>
                    <?php echo renderFaqItem(
                        "What happens to offline transactions?", 
                        "When offline:\n1. Transactions are saved locally\n2. Added to sync queue\n3. Yellow indicator shows pending items\n\nWhen back online:\n1. System automatically syncs\n2. All pending transactions upload\n3. Indicator turns green\n\nNo manual action needed!",
                        $isUrdu
                    ); ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
// Helper function to render FAQ items cleanly
function renderFaqItem($title, $content, $isUrdu) {
    return '
    <div class="faq-item" style="border-bottom: 1px solid #f1f5f9;">
        <button onclick="toggleFaq(this)" style="width: 100%; border: none; background: none; padding: 20px 24px; display: flex; justify-content: space-between; align-items: center; cursor: pointer; transition: background 0.2s;">
            <span style="font-weight: 600; color: #334155; font-size: 15px; text-align: left;">'.$title.'</span>
            <svg style="width: 18px; height: 18px; color: #94a3b8; transition: transform 0.3s;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </button>
        <div style="display: none; padding: 0 24px 24px 24px; color: #64748b; font-size: 14px; line-height: 1.6; white-space: pre-line; text-align: left;">
            '.$content.'
        </div>
    </div>';
}
?>