<div class="kpi-grid">
    
    <div class="kpi-card">
        <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 16px;">
            <div class="kpi-icon-box" style="background: #f5f3ff;">
                <svg style="width: 24px; height: 24px; color: #7c3aed;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
            </div>
            <div class="trend-badge" style="color: #16a34a; background: #f0fdf4;">
                <span>↗ 12%</span>
            </div>
        </div>
        <h3 class="kpi-label">Total Sales</h3>
        <p id="stat-total-sales" class="kpi-value">Rs. 0</p>
        <p class="reports-subtitle Urdu-font" style="font-size: 10px; color: #94a3b8;">گزشتہ روز کے مقابلے میں</p>
        
        <div class="kpi-mini-chart">
            <div class="mini-bar" style="height: 30%;"></div>
            <div class="mini-bar" style="height: 15%;"></div>
            <div class="mini-bar" style="height: 50%;"></div>
            <div class="mini-bar" style="height: 70%;"></div>
            <div class="mini-bar" style="height: 85%;"></div>
            <div class="mini-bar" style="height: 45%;"></div>
            <div class="mini-bar" style="height: 60%;"></div>
        </div>
    </div>

    <div class="kpi-card">
        <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 16px;">
            <div class="kpi-icon-box" style="background: #f0fdf4;">
                <svg style="width: 24px; height: 24px; color: #16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <div class="trend-badge" style="color: #16a34a; background: #f0fdf4;">
                <span>↗ 8%</span>
            </div>
        </div>
        <h3 class="kpi-label">Transactions</h3>
        <p id="stat-transactions" class="kpi-value">0</p>
        <p style="font-size: 10px; color: #94a3b8; margin-top: 4px;">Avg Order: <span id="stat-avg-sale" style="font-weight: 700; color: #64748b;">Rs. 0</span></p>
    </div>

    <div class="kpi-card">
        <div style="display: flex; align-items: flex-start; margin-bottom: 16px;">
            <div class="kpi-icon-box" style="background: #fffbeb;">
                <svg style="width: 24px; height: 24px; color: #d97706;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        </div>
        <h3 class="kpi-label">Top Products</h3>
        <div id="top-products-list" style="display: flex; flex-direction: column; gap: 8px;">
            </div>
    </div>

    <div class="kpi-card">
        <div style="display: flex; align-items: flex-start; margin-bottom: 16px;">
            <div class="kpi-icon-box" style="background: #fef2f2;">
                <svg style="width: 24px; height: 24px; color: #dc2626;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>
        <h3 class="kpi-label">Stock Alert</h3>
        <p id="stat-low-stock" class="kpi-value" style="color: #dc2626;">0</p>
        <p class="reports-subtitle Urdu-font" style="font-size: 10px; color: #94a3b8;">اشیاء اسٹاک میں کم ہیں</p>
        <button onclick="Navigation.changeTab('inventory')" style="width: 100%; margin-top: 12px; padding: 8px 0; font-size: 11px; font-weight: 800; color: #475569; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
            Restock Now
        </button>
    </div>
</div>