const POSState = {
    cart: [],
    
    // Grid se item add karne ke liye
    addToCart(product) {
        const existingItem = this.cart.find(item => item.id === product.id);
        if (existingItem) {
            existingItem.qty += 1;
        } else {
            this.cart.push({
                id: product.id,
                name: product.name,
                price: parseFloat(product.price),
                qty: 1 
            });
        }
        this.updateUI();
    },

    // Poora cart saaf karne ke liye
    clearCart() {
        if (this.cart.length === 0) return;
        if (confirm("Kya aap poora cart clear karna chahte hain?")) {
            this.cart = [];
            const discInput = document.getElementById('discount-input');
            if(discInput) discInput.value = 0;
            this.updateUI();
        }
    },

    // Aik item delete karne ke liye
    removeItem(productId) {
        this.cart = this.cart.filter(item => item.id !== productId);
        this.updateUI();
    },

    // + and - buttons ke liye
    updateQty(productId, newQty) {
        const item = this.cart.find(item => item.id === productId);
        if (item) {
            item.qty += newQty;
            if (item.qty <= 0) return this.removeItem(productId);
            this.updateUI();
        }
    },

    // Totals calculate karne ke liye
    getTotals() {
        const subtotal = this.cart.reduce((acc, item) => acc + (item.price * item.qty), 0);
        const discount = parseFloat(document.getElementById('discount-input')?.value) || 0;
        const total = subtotal - discount;
        return { subtotal, discount, total };
    },

    updateUI() {
        if (typeof renderCart === 'function') renderCart();
        if (typeof renderTotals === 'function') renderTotals();
    }
};;