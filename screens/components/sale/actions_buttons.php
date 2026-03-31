<div class="actions-wrapper">
    <h3><?= ($lang === 'ur') ? 'ادائیگی' : 'Payment' ?></h3>
    
    <div class="payment-methods-grid">
        <button onclick="setPayment('Cash', this)" class="pay-btn active-pay">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
            <span><?= ($lang === 'ur') ? 'نقد' : 'Cash' ?></span>
        </button>

        <button onclick="setPayment('Card', this)" class="pay-btn">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
            <span><?= ($lang === 'ur') ? 'کارڈ' : 'Card' ?></span>
        </button>
    </div>

    <div class="spacer"></div>

    <button id="proceedCheckout" onclick="processSale()" class="checkout-btn">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
        <span id="checkout-total-display">Rs. 0 <?= ($lang === 'ur') ? 'چیک آؤٹ' : 'Checkout' ?></span>
    </button>
</div>

<script>
window.selectedPaymentMethod = 'Cash';
const checkoutLabel = '<?= ($lang === "ur") ? "چیک آؤٹ" : "Checkout" ?>';

function setPayment(method, btn) {
    window.selectedPaymentMethod = method;
    document.querySelectorAll('.pay-btn').forEach(b => b.classList.remove('active-pay'));
    btn.classList.add('active-pay');
}
</script>