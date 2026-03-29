const POSState = {
    // --- Sale/Cart State ---
    cart: [],
    taxRate: 0.05, 

    // --- Inventory State (New) ---
    inventory: [],
    categories: [],
    filters: {
        search: '',
        category: 'All',
        status: 'all' // 'all', 'low', 'out'
    },

    // --- Existing Cart Functions ---
    addToCart(product) {
        const existingItem = this.cart.find(item => item.id === product.id);
        if (existingItem) {
            existingItem.qty += 1;
        } else {
            this.cart.push({
                id: product.id,
                name: product.name_en || product.name, // Support for our new naming
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

    // --- Inventory State Functions (New) ---
    setInventory(data) {
        this.inventory = data;
        const countEl = document.getElementById('total-product-count');
        if (countEl) countEl.innerText = data.length;
    },

    getFilteredProducts() {
        return this.inventory.filter(product => {
            const matchesSearch = 
                product.name_en.toLowerCase().includes(this.filters.search.toLowerCase()) ||
                (product.name_ur && product.name_ur.includes(this.filters.search)) ||
                product.sku.toLowerCase().includes(this.filters.search.toLowerCase()) ||
                (product.brand && product.brand.toLowerCase().includes(this.filters.search.toLowerCase()));

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

    // --- Global UI Sync ---
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
        // Agar inventory screen par hain to grid bhi refresh ho sakti hai
        if (typeof InventoryManager !== 'undefined' && typeof InventoryManager.renderGrid === 'function') {
            InventoryManager.renderGrid();
        }
    }
};