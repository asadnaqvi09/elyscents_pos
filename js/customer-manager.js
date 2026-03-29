/**
 * CustomerManager.js
 * Handles CRUD for Customers using the same logic as InventoryManager
 */
const CustomerManager = {
    // ─── State ────────────────────────────────────────────────
    searchTimer:      null,
    deleteCustomerId: null,

    // ─── 1. Init ──────────────────────────────────────────────
    async init() {
        console.log('[CustomerManager] Active');
        await this.fetchCustomers();
        this.setupKeyboardShortcuts();
    },

    // ─── 2. Fetch Customers ───────────────────────────────────
    async fetchCustomers() {
        const grid   = document.getElementById('customer-grid');
        const search = document.getElementById('customer-search')?.value?.trim() || '';
        if (!grid) return;

        // Loading Spinner
        grid.innerHTML = `
            <div style="grid-column:1/-1;padding:80px 0;text-align:center;">
                <div style="width:36px;height:36px;border:4px solid rgba(124,58,237,0.15);border-top-color:#7c3aed;border-radius:50%;display:inline-block;animation:cm-spin 0.7s linear infinite;"></div>
            </div>
            <style>@keyframes cm-spin{to{transform:rotate(360deg);}}</style>
        `;

        try {
            const params   = new URLSearchParams({ search });
            const response = await fetch(`backend/api/customers/get_customers.php?${params}`);
            const res      = await response.json();

            if (res.success) {
                grid.innerHTML = res.html;
            } else {
                this._showGridError(res.message || 'Failed to load customers.');
            }
        } catch (err) {
            console.error('[CustomerManager] fetchCustomers:', err);
            this._showGridError('Connection error. Check server.');
        }
    },

    _showGridError(msg) {
        const grid = document.getElementById('customer-grid');
        if (!grid) return;
        grid.innerHTML = `
            <div style="grid-column:1/-1;text-align:center;padding:60px 0;">
                <p style="color:#ef4444;font-weight:800;font-size:15px;margin:0;">${msg}</p>
                <button onclick="CustomerManager.fetchCustomers()" style="margin-top:16px;padding:10px 24px;border-radius:12px;border:none;background:#7c3aed;color:white;font-weight:800;font-size:13px;cursor:pointer;">
                    Retry
                </button>
            </div>
        `;
    },

    // ─── 3. Search (debounced) ────────────────────────────────
    handleSearch() {
        clearTimeout(this.searchTimer);
        this.searchTimer = setTimeout(() => this.fetchCustomers(), 300);
    },

    // ─── 4. Open Modal ────────────────────────────────────────
    openModal(customer = null) {
        const modal = document.getElementById('customer-modal');
        if (!modal) return;

        // Reset Form
        document.getElementById('customer-form')?.reset();
        document.getElementById('modal-customer-id').value = '';

        if (customer) {
            // Edit mode
            document.getElementById('cust-modal-title').textContent = 'Edit Customer Profile';
            document.getElementById('modal-customer-id').value    = customer.id;
            document.getElementById('modal-cust-name').value      = customer.name;
            document.getElementById('modal-cust-phone').value     = customer.phone;
            document.getElementById('modal-cust-email').value     = customer.email || '';
            document.getElementById('modal-cust-birthday').value  = customer.birthday || '';
            document.getElementById('modal-cust-notes').value     = customer.notes || '';
            document.getElementById('modal-cust-tier').value      = customer.loyalty_tier || 'bronze';
        } else {
            // Add mode
            document.getElementById('cust-modal-title').textContent = 'Register New Customer';
        }

        modal.style.setProperty('display', 'flex', 'important');
        document.body.style.overflow = 'hidden';
    },

    closeModal() {
        const modal = document.getElementById('customer-modal');
        if (modal) modal.style.setProperty('display', 'none', 'important');
        document.body.style.overflow = 'auto';
    },

    // ─── 5. Save Customer ─────────────────────────────────────
    async handleSave(e) {
        e.preventDefault();

        const btn = document.getElementById('cust-modal-submit-btn');
        const originalHTML = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = `Saving...`;

        const formData   = new FormData(e.target);
        const customerId = document.getElementById('modal-customer-id').value;

        // Route to correct endpoint based on ID presence
        const endpoint = customerId 
            ? 'backend/api/customers/update_customer.php' 
            : 'backend/api/customers/create_customer.php';

        try {
            const response = await fetch(endpoint, { method: 'POST', body: formData });
            const res      = await response.json();

            if (res.success) {
                this.closeModal();
                await this.fetchCustomers();
                this.showToast(res.message, 'success');
            } else {
                this.showToast(res.message || 'Error saving data.', 'error');
            }
        } catch (err) {
            console.error('[CustomerManager] handleSave:', err);
            this.showToast('Network error.', 'error');
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalHTML;
        }
    },

    // ─── 6. Delete Flow ───────────────────────────────────────
    confirmDelete(id, name) {
        this.deleteCustomerId = id;
        const nameEl = document.getElementById('delete-cust-name');
        if (nameEl) nameEl.textContent = name;
        
        const modal = document.getElementById('cust-delete-modal');
        if (modal) {
            modal.style.setProperty('display', 'flex', 'important');
            document.body.style.overflow = 'hidden';
        }
    },

    closeDeleteModal() {
        const modal = document.getElementById('cust-delete-modal');
        if (modal) modal.style.setProperty('display', 'none', 'important');
        document.body.style.overflow = 'auto';
        this.deleteCustomerId = null;
    },

    async handleDelete() {
        if (!this.deleteCustomerId) return;

        const formData = new FormData();
        formData.append('id', this.deleteCustomerId);

        try {
            const response = await fetch('backend/api/customers/delete_customer.php', {
                method: 'POST',
                body: formData
            });
            const res = await response.json();

            if (res.success) {
                this.closeDeleteModal();
                await this.fetchCustomers();
                this.showToast(res.message, 'success');
            } else {
                this.showToast(res.message || 'Delete failed.', 'error');
            }
        } catch (err) {
            this.showToast('Network error.', 'error');
        }
    },

    // ─── 7. UI Helpers ────────────────────────────────────────
    showToast(message, type = 'success') {
        // Same toast logic as InventoryManager
        const toast = document.createElement('div');
        toast.className = 'im-toast';
        const bg = type === 'success' ? '#10b981' : '#ef4444';
        toast.style.cssText = `position:fixed;bottom:32px;left:50%;transform:translateX(-50%);background:${bg};color:white;padding:12px 24px;border-radius:12px;z-index:99999;font-weight:700;`;
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    },

    viewHistory(id) {
        // Future: Redirect to customer history page
        window.location.href = `?page=reports&customer_id=${id}`;
    },

    setupKeyboardShortcuts() {
        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeModal();
                this.closeDeleteModal();
            }
        });
    }
};

// Bootstrap
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('customer-grid')) {
        CustomerManager.init();
    }
});