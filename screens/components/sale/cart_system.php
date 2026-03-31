<div class="cart-wrapper">
    <div class="cart-header">
        <div>
            <h2><?= ($lang === 'ur') ? 'حالیہ فروخت' : 'Current Sale' ?></h2>
            <p id="sale-number">#000000</p>
        </div>
        <button class="clear-btn" onclick="POSState.clearCart()">
            <?= ($lang === 'ur') ? 'خالی کریں' : 'Clear' ?>
        </button>
    </div>

    <div class="cart-main-area no-scrollbar" id="cart-container">
        <div id="cart-empty" class="cart-empty-state">
            <p><?= ($lang === 'ur') ? 'کارٹ خالی ہے' : 'Cart is empty' ?></p>
        </div>

        <div id="cart-items" class="cart-items-list" style="display:none;"></div>
    </div>

    <div id="cart-footer" class="cart-footer" style="display:none;">
        <div class="summary-row">
            <span><?= ($lang === 'ur') ? 'ذیلی کل' : 'Subtotal' ?></span>
            <span id="cart-subtotal">Rs. 0</span>
        </div>
        
        <div class="total-row">
            <span><?= ($lang === 'ur') ? 'کل رقم' : 'Total' ?></span>
            <span id="cart-total" class="total-amount">Rs. 0</span>
        </div>
    </div>
</div>