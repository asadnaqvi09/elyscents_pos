<div class="flex flex-col h-full bg-surface overflow-hidden">
    <!-- Header -->
    <div class="p-4 border-b border-border shrink-0">
        <div class="flex items-center justify-between">
            <div>
                <h2 style="font-size:17px; font-weight:900; color:#1e293b; letter-spacing:-0.3px;">Current Sale</h2>
                <p style="font-size:11px; color:#94a3b8; font-weight:500; margin-top:2px;" id="sale-number">#000000</p>
            </div>
            <button onclick="POSState.clearCart()" 
                    style="font-size:11px; font-weight:700; color:#94a3b8; padding:6px 12px; border-radius:8px; border:none; background:transparent; cursor:pointer; transition:all 0.15s;"
                    onmouseenter="this.style.color='#ef4444'; this.style.background='#fef2f2';"
                    onmouseleave="this.style.color='#94a3b8'; this.style.background='transparent';">
                Clear
            </button>
        </div>
    </div>

    <!-- Cart Items -->
    <div class="flex-1 overflow-y-auto" id="cart-container" style="scrollbar-width:thin; scrollbar-color:#e2e8f0 transparent;">
        <!-- Empty State -->
        <div id="cart-empty" style="display:flex; flex-direction:column; align-items:center; justify-content:center; height:100%; gap:10px; padding:24px;">
            <div style="color:#d1d5db;">
                <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
            </div>
            <p style="font-size:13px; font-weight:700; color:#d1d5db;">Cart is empty</p>
        </div>

        <!-- Cart Items List -->
        <div id="cart-items" class="hidden" style="padding:12px; display:none; flex-direction:column; gap:8px;"></div>
    </div>

    <!-- Cart Footer -->
    <div id="cart-footer" style="display:none; flex-direction:column; border-top:1px solid #e2e8f0; padding:14px; gap:8px;" class="shrink-0">
        <div style="display:flex; justify-content:space-between; font-size:12px; color:#64748b; font-weight:500;">
            <span>Subtotal</span>
            <span id="cart-subtotal">Rs. 0</span>
        </div>
        <div style="display:flex; justify-content:space-between; align-items:center; font-size:12px; color:#64748b; font-weight:500;">
            <span>Discount</span>
            <div style="display:flex; align-items:center; gap:6px;">
                <input type="number" id="discount-input" placeholder="0" min="0"
                    style="width:60px; text-align:right; font-size:12px; border:1px solid #e2e8f0; border-radius:8px; padding:4px 8px; outline:none; background:#f3f3f5;"
                    oninput="POSState.updateDiscount(this.value)"
                    onfocus="this.style.borderColor='#7c3aed'; this.style.background='#fff';"
                    onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f3f3f5';">
                <span style="font-size:11px; color:#94a3b8;">Rs</span>
            </div>
        </div>
        <div style="display:flex; justify-content:space-between; font-size:15px; font-weight:900; color:#1e293b; padding-top:8px; border-top:1px solid #e2e8f0;">
            <span>Total</span>
            <span id="cart-total" style="color:#7c3aed;">Rs. 0</span>
        </div>
    </div>
</div>

<script>
document.getElementById('sale-number').textContent = '#' + Math.floor(100000 + Math.random() * 900000);
</script>