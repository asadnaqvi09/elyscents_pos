function renderTotals() {
    const { subtotal, tax, total } = POSState.getTotals();
    
    // PHP components mein IDs 'subtotal-val', 'tax-val', etc use ho rahi hain
    const subtotalEl = document.getElementById('subtotal-val');
    const taxEl = document.getElementById('tax-val');
    const itemTotalEl = document.getElementById('item-total-display');
    const checkoutTotalEl = document.getElementById('checkout-total-display');

    if(subtotalEl) subtotalEl.innerText = `Rs. ${subtotal.toLocaleString()}`;
    if(taxEl) taxEl.innerText = `Rs. ${tax.toLocaleString()}`;
    if(itemTotalEl) itemTotalEl.innerText = `Rs. ${total.toLocaleString()}`;
    if(checkoutTotalEl) checkoutTotalEl.innerText = `Rs. ${total.toLocaleString()} Checkout`;
}

function renderCart() {
    // Apne cart_system.php wali ID yahan use karein
    const cartContainer = document.getElementById('cart-items-container');
    if (!cartContainer) return;
    
    if (POSState.cart.length === 0) {
        cartContainer.innerHTML = `
            <div class="h-full flex flex-col items-center justify-center text-center space-y-4 opacity-30">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                </div>
                <p class="text-sm font-black text-gray-500 uppercase tracking-widest">Cart is empty</p>
            </div>`;
        return;
    }

    cartContainer.innerHTML = POSState.cart.map(item => `
        <div class="bg-white border border-gray-100 rounded-2xl p-4 flex gap-4 shadow-sm">
            <div class="flex-1">
                <h4 class="text-[13px] font-bold text-gray-800">${item.name}</h4>
                <p class="text-[12px] font-black text-primary mt-1">Rs. ${item.price.toLocaleString()}</p>
            </div>
            <div class="flex items-center gap-3 bg-gray-50 px-3 py-1 rounded-xl border border-gray-100">
                <button onclick="updateQty(${item.id}, -1)" class="text-primary font-bold hover:scale-125 transition-transform">-</button>
                <span class="font-bold text-[13px] min-w-[20px] text-center">${item.qty}</span>
                <button onclick="updateQty(${item.id}, 1)" class="text-primary font-bold hover:scale-125 transition-transform">+</button>
            </div>
        </div>
    `).join('');
}