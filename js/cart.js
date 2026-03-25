function renderTotals() {
    const { subtotal, total } = POSState.getTotals();
    
    const subtotalEl = document.getElementById('cart-subtotal');
    const totalEl = document.getElementById('cart-total');
    const checkoutDisplay = document.getElementById('checkout-total-display');

    if(subtotalEl) subtotalEl.innerText = `Rs. ${subtotal.toLocaleString()}`;
    if(totalEl) totalEl.innerText = `Rs. ${total.toLocaleString()}`;
    if(checkoutDisplay) checkoutDisplay.innerText = `Rs. ${total.toLocaleString()} Checkout`;
}

function renderCart() {
    const cartItemsList = document.getElementById('cart-items');
    const emptyState = document.getElementById('cart-empty');
    const cartFooter = document.getElementById('cart-footer');

    if (!cartItemsList) return;

    if (POSState.cart.length === 0) {
        cartItemsList.style.display = 'none';
        cartFooter.style.display = 'none';
        emptyState.style.display = 'flex';
        return;
    }

    emptyState.style.display = 'none';
    cartItemsList.style.display = 'flex';
    cartFooter.style.display = 'flex';

    cartItemsList.innerHTML = POSState.cart.map(item => `
        <div style="background:#fff; border:1px solid #e2e8f0; border-radius:16px; padding:12px; display:flex; align-items:center; gap:12px; margin-bottom:8px;">
            <div style="flex:1;">
                <h4 style="font-size:13px; font-weight:700; color:#1e293b;">${item.name}</h4>
                <p style="font-size:11px; color:#7c3aed; font-weight:800;">Rs. ${item.price.toLocaleString()}</p>
            </div>
            <div style="display:flex; align-items:center; gap:10px; background:#f3f3f5; padding:4px 10px; border-radius:10px;">
                <button onclick="POSState.updateQty(${item.id}, -1)" style="border:none; background:transparent; cursor:pointer; font-weight:900; color:#64748b;">-</button>
                <span style="font-size:12px; font-weight:800; min-width:15px; text-align:center;">${item.qty}</span>
                <button onclick="POSState.updateQty(${item.id}, 1)" style="border:none; background:transparent; cursor:pointer; font-weight:900; color:#7c3aed;">+</button>
            </div>
            <button onclick="POSState.removeItem(${item.id})" style="border:none; background:transparent; color:#94a3b8; cursor:pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18m-2 0v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6m3 0V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
            </button>
        </div>
    `).join('');
}