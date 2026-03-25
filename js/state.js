const POSState = {
    cart: [],
    taxRate: 0.17,

    addToCart(product) {
        const exists = this.cart.find(i => i.id === product.id);
        if (exists) {
            exists.qty++;
        } else {
            this.cart.push({ ...product, qty: 1 });
        }
        this.updateUI();
    },

    updateQty(id, delta) {
        const item = this.cart.find(i => i.id === id);
        if (item) {
            item.qty += delta;
            if (item.qty <= 0) this.cart = this.cart.filter(i => i.id !== id);
            this.updateUI();
        }
    },

    getTotals() {
        const subtotal = this.cart.reduce((s, i) => s + (i.price * i.qty), 0);
        const tax = subtotal * this.taxRate;
        return { subtotal, tax, total: subtotal + tax };
    },

    updateUI() {
        // These functions MUST exist in cart.js or here
        if (typeof renderCart === 'function') renderCart();
        if (typeof renderTotals === 'function') renderTotals();
    }
};