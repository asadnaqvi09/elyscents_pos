const InventoryManager = {
    searchTimer: null,
    deleteProductId: null,

    async init() {
        await this.fetchProducts();
        this.setupKeyboardShortcuts();
    },

    async fetchProducts() {
        const grid = document.getElementById('inventory-grid');
        const search = document.getElementById('inventory-search')?.value?.trim() || '';
        if (!grid) return;

        grid.innerHTML = `
            <div class="grid-loader">
                <div class="spinner"></div>
            </div>
        `;

        try {
            const params = new URLSearchParams({ search });
            const response = await fetch(`backend/api/products/get_products.php?${params}`);
            const res = await response.json();

            if (res.success) {
                grid.innerHTML = res.html;
                await this.updateCounters();
            } else {
                this._showGridError(res.message || 'Failed to load products.');
            }
        } catch (err) {
            this._showGridError('Connection error. Please check server.');
        }
    },

    _showGridError(msg) {
        const grid = document.getElementById('inventory-grid');
        if (!grid) return;
        grid.innerHTML = `
            <div class="grid-error">
                <p>${msg}</p>
                <button onclick="InventoryManager.fetchProducts()" class="btn-retry">Retry</button>
            </div>
        `;
    },

    handleSearch() {
        clearTimeout(this.searchTimer);
        this.searchTimer = setTimeout(() => this.fetchProducts(), 300);
    },

    async updateCounters() {
        try {
            const res = await fetch('backend/api/products/get_products.php?format=stats');
            const data = await res.json();
            if (!data.success) return;

            const countEl = document.getElementById('total-product-count');
            if (countEl) countEl.textContent = data.total;

            this._toggleAlert('alert-low-stock', 'low-stock-count', data.lowStock);
            this._toggleAlert('alert-out-stock', 'out-stock-count', data.outStock);
        } catch (err) {
            console.warn(err);
        }
    },

    _toggleAlert(elId, countId, value) {
        const el = document.getElementById(elId);
        const count = document.getElementById(countId);
        if (el) {
            el.style.display = value > 0 ? 'flex' : 'none';
            if (count) count.textContent = value;
        }
    },

    openModal(product = null) {
        const modal = document.getElementById('product-modal');
        const form = document.getElementById('product-form');
        if (!modal || !form) return;

        form.reset();
        document.getElementById('modal-product-id').value = '';

        if (product) {
            document.getElementById('modal-title').textContent = 'Edit Product Details';
            document.getElementById('modal-product-id').value = product.id || '';
            document.getElementById('modal-name-en').value = product.name_en || '';
            document.getElementById('modal-name-ur').value = product.name_ur || '';
            document.getElementById('modal-brand').value = product.brand || '';
            document.getElementById('modal-size').value = product.size || '';
            document.getElementById('modal-stock').value = product.stock ?? 0;
            document.getElementById('modal-cost-price').value = product.cost_price ?? 0;
            document.getElementById('modal-sale-price').value = product.sale_price ?? 0;
            document.getElementById('modal-threshold').value = product.low_stock_threshold ?? 5;
            
            const cat = document.getElementById('modal-category');
            if (cat && product.category) cat.value = product.category;
        } else {
            document.getElementById('modal-title').textContent = 'Add New Product';
        }

        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        setTimeout(() => document.getElementById('modal-name-en')?.focus(), 100);
    },

    closeModal() {
        const modal = document.getElementById('product-modal');
        if (modal) modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    },

    async handleSave(e) {
        e.preventDefault();
        const btn = document.getElementById('modal-submit-btn');
        const originalHTML = btn.innerHTML;
        
        btn.disabled = true;
        btn.innerHTML = `<div class="btn-spinner"></div> Saving...`;

        const formData = new FormData(e.target);
        const productId = document.getElementById('modal-product-id').value;
        const endpoint = productId ? 'backend/api/products/update_products.php' : 'backend/api/products/create_product.php';

        try {
            const response = await fetch(endpoint, { method: 'POST', body: formData });
            const res = await response.json();

            if (res.success) {
                this.closeModal();
                await this.fetchProducts();
                this.showToast(res.message, 'success');
            } else {
                this.showToast(res.message || 'Something went wrong.', 'error');
            }
        } catch (err) {
            this.showToast('Network error.', 'error');
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalHTML;
        }
    },

    confirmDelete(productId, productName) {
        this.deleteProductId = productId;
        const nameEl = document.getElementById('delete-product-name');
        if (nameEl) nameEl.textContent = productName;
        
        const modal = document.getElementById('delete-modal');
        if (modal) {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    },

    closeDeleteModal() {
        const modal = document.getElementById('delete-modal');
        if (modal) modal.style.display = 'none';
        document.body.style.overflow = 'auto';
        this.deleteProductId = null;
    },

    async handleDelete() {
        if (!this.deleteProductId) return;

        const formData = new FormData();
        formData.append('id', this.deleteProductId);

        try {
            const response = await fetch('backend/api/products/delete_products.php', { method: 'POST', body: formData });
            const res = await response.json();

            if (res.success) {
                this.closeDeleteModal();
                await this.fetchProducts();
                this.showToast(res.message, 'success');
            } else {
                this.showToast(res.message || 'Delete failed.', 'error');
            }
        } catch (err) {
            this.showToast('Network error.', 'error');
        }
    },

    showToast(message, type = 'success') {
        document.querySelectorAll('.im-toast').forEach(t => t.remove());
        const isSuccess = type === 'success';
        
        const toast = document.createElement('div');
        toast.className = `im-toast toast-${type}`;
        toast.innerHTML = `<span>${isSuccess ? '✓' : '✕'}</span>${message}`;
        document.body.appendChild(toast);

        requestAnimationFrame(() => toast.classList.add('toast-show'));
        
        setTimeout(() => {
            toast.classList.remove('toast-show');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    },

    setupKeyboardShortcuts() {
        window.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                document.getElementById('inventory-search')?.focus();
            }
            if (e.key === 'Escape') {
                this.closeModal();
                this.closeDeleteModal();
            }
        });
    }
};

document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('inventory-parent')) InventoryManager.init();
});