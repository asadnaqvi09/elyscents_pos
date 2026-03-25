<div class="flex flex-col h-full bg-surface overflow-hidden" style="padding:20px;">
    <h3 style="font-size:17px; font-weight:900; color:#1e293b; letter-spacing:-0.3px; margin-bottom:20px; flex-shrink:0;">Payment</h3>
    <div style="display:flex; flex-direction:column ; gap:10px; flex-shrink:0;">
        <!-- Cash -->
        <button onclick="setPayment('Cash', this)" 
                class="pay-btn active-pay"
                style="display:flex; flex-direction:column; align-items:center; justify-content:center; gap:8px; padding:20px 10px; border-radius:16px; border:2px solid #7c3aed; background:rgba(124,58,237,0.06); color:#7c3aed; cursor:pointer; transition:all 0.15s;">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
            <span style="font-size:13px; font-weight:700;">Cash</span>
        </button>

        <!-- Card -->
        <button onclick="setPayment('Card', this)" 
                class="pay-btn"
                style="display:flex; flex-direction:column; align-items:center; justify-content:center; gap:8px; padding:20px 10px; border-radius:16px; border:2px solid #e2e8f0; background:#fff; color:#94a3b8; cursor:pointer; transition:all 0.15s;">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
            <span style="font-size:13px; font-weight:700;">Card</span>
        </button>
    </div>
    <!-- Spacer -->
    <div class="flex-1"></div>
    <!-- Checkout Button; -->
    <button id="proceedCheckout" 
            onclick="processSale()"
            class="w-full active:scale-[0.98] transition-all"
            style="background:#7c3aed; color:#fff; padding:18px; border-radius:16px; font-size:16px; font-weight:900; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:10px; box-shadow:0 8px 20px rgba(124,58,237,0.25); flex-shrink:0;"
            onmouseenter="this.style.background='#5b21b6';"
            onmouseleave="this.style.background='#7c3aed';">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        <span id="checkout-total-display">Rs. 0 Checkout</span>
    </button>
</div>

<script>
window.selectedPaymentMethod = 'Cash';
function setPayment(method, btn) {
    window.selectedPaymentMethod = method;
    document.querySelectorAll('.pay-btn').forEach(b => {
        b.style.borderColor = '#e2e8f0';
        b.style.background = '#fff';
        b.style.color = '#94a3b8';
    });
    btn.style.borderColor = '#7c3aed';
    btn.style.background = 'rgba(124,58,237,0.06)';
    btn.style.color = '#7c3aed';
}
</script>