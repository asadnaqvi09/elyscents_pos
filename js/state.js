const POSState = {
    cart: [],
    taxRate: 0.05, 
    language: currentLang || 'en',

    addToCart(product) {
        const existingItem = this.cart.find(item => item.id === product.id);
        if (existingItem) {
            existingItem.qty += 1;
        } else {
            this.cart.push({
                id: product.id,
                name: this.language === 'ur' ? (product.name_ur || product.name) : (product.name_en || product.name),
                image: product.image ? `assets/images/products/${product.image}` : 'assets/images/products/placeholder.png', 
                price: parseFloat(product.sale_price || product.price),
                qty: 1 
            });
        }
        this.updateUI();
    },

    getTotals() {
        const subtotal = this.cart.reduce((acc, item) => acc + (item.price * item.qty), 0);
        const tax = subtotal * this.taxRate;
        const discount = parseFloat(document.getElementById('discount-input')?.value) || 0;
        const total = (subtotal + tax) - discount;
        return { subtotal, tax, discount, total };
    },

    setInventory(data) {
        this.inventory = data;
        const countEl = document.getElementById('total-product-count');
        if (countEl) countEl.innerText = data.length;
    },

    getFilteredProducts() {
        return this.inventory.filter(product => {
            const searchTerm = this.filters.search.toLowerCase();
            const matchesSearch = 
                product.name_en.toLowerCase().includes(searchTerm) ||
                (product.name_ur && product.name_ur.includes(searchTerm)) ||
                product.sku.toLowerCase().includes(searchTerm);

            const matchesCategory = 
                this.filters.category === 'All' || 
                product.category === this.filters.category;

            const stockNum = parseInt(product.stock);
            const threshold = parseInt(product.low_stock_threshold);
            
            let matchesStatus = true;
            if (this.filters.status === 'low') matchesStatus = (stockNum > 0 && stockNum <= threshold);
            if (this.filters.status === 'out') matchesStatus = (stockNum <= 0);

            return matchesSearch && matchesCategory && matchesStatus;
        });
    },

    updateQty(productId, newQty) {
        const item = this.cart.find(item => item.id === productId);
        if (item) {
            item.qty += newQty;
            if (item.qty <= 0) return this.removeItem(productId);
            this.updateUI();
        }
    },

    removeItem(productId) {
        this.cart = this.cart.filter(item => item.id !== productId);
        this.updateUI();
    },

    updateUI() {
        if (typeof renderCart === 'function') renderCart();
        if (typeof renderTotals === 'function') renderTotals();
        if (typeof InventoryManager !== 'undefined' && typeof InventoryManager.renderGrid === 'function') {
            InventoryManager.renderGrid();
        }
    }
};