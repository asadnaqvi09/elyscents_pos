<div class="cart-wrapper">
    <div class="cart-header">
        <div>
            <h2>Current Sale</h2>
            <p id="sale-number">#000000</p>
        </div>
        <button class="clear-btn" onclick="POSState.clearCart()">
            Clear
        </button>
    </div>

    <div class="cart-main-area no-scrollbar" id="cart-container">
        <div id="cart-empty" class="cart-empty-state">
            <p>Cart is empty</p>
        </div>

        <div id="cart-items" class="cart-items-list" style="display:none;">
            </div>
    </div>

    <div id="cart-footer" class="cart-footer" style="display:none;">
        <div class="summary-row">
            <span>Subtotal</span>
            <span id="cart-subtotal">Rs. 0</span>
        </div>
        
        <div class="total-row">
            <span>Total</span>
            <span id="cart-total" class="total-amount">Rs. 0</span>
        </div>
    </div>
</div>