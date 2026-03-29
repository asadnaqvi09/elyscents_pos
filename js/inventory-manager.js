/**
 * inventory-manager.js
 * Synced with: get_products.php, create_product.php, update_products.php, delete_products.php
 * All endpoints use PDO + return { success, message, ... }
 */

const InventoryManager = {

    // ─── State ────────────────────────────────────────────────
    searchTimer:     null,
    deleteProductId: null,

    // ─── 1. Init ──────────────────────────────────────────────
    async init() {
        console.log('[InventoryManager] Active');
        await this.fetchProducts();
        this.setupKeyboardShortcuts();
    },

    // ─── 2. Fetch Products ────────────────────────────────────
    // get_products.php returns { success, count, html, data }
    async fetchProducts() {
        const grid   = document.getElementById('inventory-grid');
        const search = document.getElementById('inventory-search')?.value?.trim() || '';
        if (!grid) return;

        // Spinner
        grid.innerHTML = `
            <div style="grid-column:1/-1;padding:80px 0;text-align:center;">
                <div style="width:36px;height:36px;border:4px solid rgba(124,58,237,0.15);border-top-color:#7c3aed;border-radius:50%;display:inline-block;animation:im-spin 0.7s linear infinite;"></div>
            </div>
            <style>@keyframes im-spin{to{transform:rotate(360deg);}}</style>
        `;

        try {
            const params   = new URLSearchParams({ search });
            const response = await fetch(`backend/api/products/get_products.php?${params}`);
            const res      = await response.json();

            if (res.success) {
                grid.innerHTML = res.html;
                await this.updateCounters();
            } else {
                this._showGridError(res.message || 'Failed to load products.');
            }
        } catch (err) {
            console.error('[InventoryManager] fetchProducts:', err);
            this._showGridError('Connection error. Please check server.');
        }
    },

    _showGridError(msg) {
        const grid = document.getElementById('inventory-grid');
        if (!grid) return;
        grid.innerHTML = `
            <div style="grid-column:1/-1;text-align:center;padding:60px 0;">
                <p style="color:#ef4444;font-weight:800;font-size:15px;margin:0;">${msg}</p>
                <button onclick="InventoryManager.fetchProducts()" style="margin-top:16px;padding:10px 24px;border-radius:12px;border:none;background:#7c3aed;color:white;font-weight:800;font-size:13px;cursor:pointer;">
                    Retry
                </button>
            </div>
        `;
    },

    // ─── 3. Search (debounced) ────────────────────────────────
    handleSearch(_val) {
        clearTimeout(this.searchTimer);
        this.searchTimer = setTimeout(() => this.fetchProducts(), 300);
    },

    // ─── 4. Update Counters + Alerts ─────────────────────────
    // get_products.php?format=stats returns { success, total, lowStock, outStock }
    async updateCounters() {
        try {
            const res  = await fetch('backend/api/products/get_products.php?format=stats');
            const data = await res.json();
            if (!data.success) return;

            const countEl = document.getElementById('total-product-count');
            if (countEl) countEl.textContent = data.total;

            const lowEl  = document.getElementById('alert-low-stock');
            const lowNum = document.getElementById('low-stock-count');
            if (lowEl) {
                lowEl.style.display = data.lowStock > 0 ? 'flex' : 'none';
                if (lowNum) lowNum.textContent = data.lowStock;
            }

            const outEl  = document.getElementById('alert-out-stock');
            const outNum = document.getElementById('out-stock-count');
            if (outEl) {
                outEl.style.display = data.outStock > 0 ? 'flex' : 'none';
                if (outNum) outNum.textContent = data.outStock;
            }
        } catch (err) {
            console.warn('[InventoryManager] updateCounters:', err);
        }
    },

    // ─── 5. Open Modal ────────────────────────────────────────
    // product = null → Add mode | product = {...} → Edit mode
    openModal(product = null) {
        const modal = document.getElementById('product-modal');
        if (!modal) return;

        // Reset
        document.getElementById('product-form')?.reset();
        document.getElementById('modal-product-id').value = '';

        if (product) {
            // Edit mode
            document.getElementById('modal-title').textContent          = 'Edit Product Details';
            document.getElementById('modal-product-id').value           = product.id                  || '';
            document.getElementById('modal-name-en').value              = product.name_en             || '';
            document.getElementById('modal-name-ur').value              = product.name_ur             || '';
            document.getElementById('modal-brand').value                = product.brand               || '';
            document.getElementById('modal-size').value                 = product.size                || '';
            document.getElementById('modal-stock').value                = product.stock               ?? 0;
            document.getElementById('modal-cost-price').value           = product.cost_price          ?? 0;
            document.getElementById('modal-sale-price').value           = product.sale_price          ?? 0;
            document.getElementById('modal-threshold').value            = product.low_stock_threshold ?? 5;
            const cat = document.getElementById('modal-category');
            if (cat && product.category) cat.value = product.category;
        } else {
            // Add mode
            document.getElementById('modal-title').textContent = 'Add New Product';
        }

        modal.style.setProperty('display', 'flex', 'important');
        document.body.style.overflow = 'hidden';
        setTimeout(() => document.getElementById('modal-name-en')?.focus(), 100);
    },

    closeModal() {
        const modal = document.getElementById('product-modal');
        if (modal) modal.style.setProperty('display', 'none', 'important');
        document.body.style.overflow = 'auto';
    },

    // ─── 6. Save Product ─────────────────────────────────────
    // Add  → create_product.php  (POST, no id field)
    // Edit → update_products.php (POST, with id field)
    async handleSave(e) {
        e.preventDefault();

        const btn          = document.getElementById('modal-submit-btn');
        const originalHTML = btn.innerHTML;
        btn.disabled       = true;
        btn.innerHTML      = `<div style="width:15px;height:15px;border:3px solid rgba(255,255,255,0.3);border-top-color:white;border-radius:50%;animation:im-spin 0.6s linear infinite;display:inline-block;vertical-align:middle;margin-right:8px;"></div>Saving...`;

        const formData  = new FormData(e.target);
        const productId = document.getElementById('modal-product-id').value;

        // Route to correct endpoint
        const endpoint = productId
            ? 'backend/api/products/update_products.php'
            : 'backend/api/products/create_product.php';

        try {
            const response = await fetch(endpoint, { method: 'POST', body: formData });
            const res      = await response.json();

            if (res.success) {
                this.closeModal();
                await this.fetchProducts();
                this.showToast(res.message, 'success');
            } else {
                this.showToast(res.message || 'Something went wrong.', 'error');
            }
        } catch (err) {
            console.error('[InventoryManager] handleSave:', err);
            this.showToast('Network error. Please try again.', 'error');
        } finally {
            btn.disabled  = false;
            btn.innerHTML = originalHTML;
        }
    },

    // ─── 7. Delete Flow ───────────────────────────────────────
    // delete_products.php expects POST { id }
    confirmDelete(productId, productName) {
        this.deleteProductId = productId;
        const nameEl = document.getElementById('delete-product-name');
        if (nameEl) nameEl.textContent = productName;
        const modal = document.getElementById('delete-modal');
        if (modal) {
            modal.style.setProperty('display', 'flex', 'important');
            document.body.style.overflow = 'hidden';
        }
    },

    closeDeleteModal() {
        const modal = document.getElementById('delete-modal');
        if (modal) modal.style.setProperty('display', 'none', 'important');
        document.body.style.overflow = 'auto';
        this.deleteProductId = null;
    },

    async handleDelete() {
        if (!this.deleteProductId) return;

        const formData = new FormData();
        formData.append('id', this.deleteProductId);

        try {
            const response = await fetch('backend/api/products/delete_products.php', {
                method: 'POST',
                body:   formData,
            });
            const res = await response.json();

            if (res.success) {
                this.closeDeleteModal();
                await this.fetchProducts();
                this.showToast(res.message, 'success');
            } else {
                this.showToast(res.message || 'Delete failed.', 'error');
            }
        } catch (err) {
            console.error('[InventoryManager] handleDelete:', err);
            this.showToast('Network error. Please try again.', 'error');
        }
    },

    // ─── 9. Toast ─────────────────────────────────────────────
    showToast(message, type = 'success') {
        document.querySelectorAll('.im-toast').forEach(t => t.remove());

        const colors = {
            success: { bg: '#10b981', icon: '✓' },
            error:   { bg: '#ef4444', icon: '✕' },
        };
        const c = colors[type] || colors.success;

        const toast         = document.createElement('div');
        toast.className     = 'im-toast';
        toast.style.cssText = `
            position:fixed;bottom:32px;left:50%;transform:translateX(-50%) translateY(20px);
            background:${c.bg};color:white;padding:13px 24px;border-radius:14px;
            font-size:14px;font-weight:700;display:flex;align-items:center;gap:10px;
            box-shadow:0 8px 24px rgba(0,0,0,0.15);z-index:99999;
            opacity:0;transition:all 0.3s cubic-bezier(0.16,1,0.3,1);pointer-events:none;
        `;
        toast.innerHTML = `<span style="font-size:16px;">${c.icon}</span>${message}`;
        document.body.appendChild(toast);

        requestAnimationFrame(() => {
            toast.style.opacity   = '1';
            toast.style.transform = 'translateX(-50%) translateY(0)';
        });
        setTimeout(() => {
            toast.style.opacity   = '0';
            toast.style.transform = 'translateX(-50%) translateY(12px)';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    },

    // ─── 10. Keyboard Shortcuts ───────────────────────────────
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
    },
};

// ─── Bootstrap ────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('inventory-parent')) {
        InventoryManager.init();
    }
});
