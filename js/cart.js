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
    cartItemsList.style.display = 'block';
    cartFooter.style.display = 'block';

    cartItemsList.innerHTML = POSState.cart.map(item => `
        <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-sm overflow-hidden">
            <div class="flex items-start gap-3">
                <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0">
                    <img src="${item.image}" class="w-8 h-8 object-contain">
                </div>
                
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-sm font-bold text-slate-800 leading-tight">${item.name}</h4>
                            <p class="text-[11px] text-slate-400 mt-1 font-semibold italic">Rs. ${item.price.toLocaleString()} × ${item.qty}</p>
                        </div>
                        <button onclick="POSState.removeItem(${item.id})" class="text-red-400 hover:text-red-600 transition-colors">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18m-2 0v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6m3 0V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        </button>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center bg-slate-50 rounded-lg p-1 gap-3">
                            <button onclick="POSState.updateQty(${item.id}, -1)" class="w-7 h-7 flex items-center justify-center bg-white border border-slate-200 rounded-md text-slate-600 font-bold hover:bg-slate-100 transition-all">-</button>
                            <span class="text-xs font-black text-slate-800 min-width-[15px] text-center">${item.qty}</span>
                            <button onclick="POSState.updateQty(${item.id}, 1)" class="w-7 h-7 flex items-center justify-center bg-white border border-slate-200 rounded-md text-slate-600 font-bold hover:bg-slate-100 transition-all">+</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 pt-3 border-t border-slate-50 flex justify-between items-center">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Item Total</span>
                <span class="text-sm font-black text-slate-800">Rs. ${(item.price * item.qty).toLocaleString()}</span>
            </div>
        </div>
    `).join('');
}