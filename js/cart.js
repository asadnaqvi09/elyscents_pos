function renderTotals() {
    const { subtotal, tax, total } = POSState.getTotals();
    
    const subtotalEl = document.getElementById('cart-subtotal');
    const taxEl = document.getElementById('cart-tax');
    const totalEl = document.getElementById('cart-total');
    const checkoutDisplay = document.getElementById('checkout-total-display');

    if(subtotalEl) subtotalEl.innerText = `Rs. ${subtotal.toLocaleString()}`;
    if(taxEl) taxEl.innerText = `Rs. ${tax.toLocaleString()}`;
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
    cartItemsList.style.flexDirection = 'column';
    cartItemsList.style.gap = '10px';
    cartFooter.style.display = 'flex';

    cartItemsList.innerHTML = POSState.cart.map(item => `
        <div style="background:#fff; border:1px solid #e2e8f0; border-radius:16px; padding:12px; box-shadow:0 1px 3px rgba(0,0,0,0.02); overflow:hidden;">
            <div style="display:flex; align-items:start; gap:12px;">
                <div style="width:44px; height:44px; border-radius:10px; background:#f8fafc; border:1px solid #f1f5f9; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <img src="assets/images/branding/perfume-icon.png" style="width:28px; height:28px; object-fit:contain;" onerror="this.outerHTML='🧴'">
                </div>
                
                <div style="flex:1;">
                    <div style="display:flex; justify-content:space-between; align-items:start;">
                        <div>
                            <h4 style="font-size:13px; font-weight:700; color:#1e293b; margin:0; line-height:1.2;">${item.name}</h4>
                            <p style="font-size:11px; color:#94a3b8; margin:4px 0 0 0; font-weight:600;">Rs. ${item.price.toLocaleString()} × ${item.qty}</p>
                        </div>
                        <button onclick="POSState.removeItem(${item.id})" style="color:#fca5a5; background:none; border:none; cursor:pointer; padding:4px;">
                             <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18m-2 0v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6m3 0V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        </button>
                    </div>

                    <div style="display:flex; align-items:center; justify-content:space-between; margin-top:12px;">
                        <div style="display:flex; align-items:center; background:#f8fafc; border-radius:8px; padding:3px; gap:10px; border:1px solid #f1f5f9;">
                            <button onclick="POSState.updateQty(${item.id}, -1)" style="width:24px; height:24px; display:flex; align-items:center; justify-content:center; background:#fff; border:1px solid #e2e8f0; border-radius:6px; font-weight:bold; color:#64748b; cursor:pointer;">-</button>
                            <span style="font-size:12px; font-weight:900; color:#1e293b; min-width:15px; text-align:center;">${item.qty}</span>
                            <button onclick="POSState.updateQty(${item.id}, 1)" style="width:24px; height:24px; display:flex; align-items:center; justify-content:center; background:#fff; border:1px solid #e2e8f0; border-radius:6px; font-weight:bold; color:#64748b; cursor:pointer;">+</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div style="margin-top:12px; pt-3; border-top:1px solid #f8fafc; display:flex; justify-content:space-between; align-items:center; padding-top:8px;">
                <span style="font-size:10px; font-weight:700; color:#cbd5e1; text-transform:uppercase; letter-spacing:0.5px;">Item Total</span>
                <span style="font-size:13px; font-weight:900; color:#1e293b;">Rs. ${(item.price * item.qty).toLocaleString()}</span>
            </div>
        </div>
    `).join('');

    renderTotals();
}