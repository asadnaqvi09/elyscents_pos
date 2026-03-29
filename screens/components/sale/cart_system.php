<div class="flex flex-col overflow-hidden">
    <div class="p-4 border-b border-border shrink-0">
        <div class="flex items-center" style="justify-content: space-between">
            <div>
                <h2 style="font-size:17px; font-weight:900; color:#1e293b;">Current Sale</h2>
                <p style="font-size:11px; color:#94a3b8;" id="sale-number">#000000</p>
            </div>
            <button onclick="POSState.clearCart()" 
                    style="font-size:11px; font-weight:700; color:#94a3b8; padding:6px 12px; border-radius:8px; cursor:pointer;">
                Clear
            </button>
        </div>
    </div>
    <div class="flex-1 overflow-y-auto" id="cart-container">
        <div id="cart-empty" style="display:flex; flex-direction:column; align-items:center; justify-content:center; height:100%;">
            <p style="color:#d1d5db; font-size:13px; font-weight:700;">Cart is empty</p>
        </div>
        <div id="cart-items" style="display:none; flex-direction:column; padding:12px;"></div>
    </div>
    <div id="cart-footer" style="display:none; border-top:1px solid #e2e8f0; padding:14px; flex-direction:column; gap:8px;">
        <div class="flex justify-between text-xs text-gray-500">
            <span>Subtotal</span>
            <span id="cart-subtotal">Rs. 0</span>
        </div>
        <div class="flex justify-between font-black text-lg border-top pt-2">
            <span>Total</span>
            <span id="cart-total" class="text-primary">Rs. 0</span>
        </div>
    </div>
</div>