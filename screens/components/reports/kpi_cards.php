<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-bottom: 24px;">
    
    <div style="background: white; padding: 24px; border-radius: 20px; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
        <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 16px;">
            <div style="padding: 8px; background: #f5f3ff; border-radius: 8px;">
                <svg style="width: 24px; height: 24px; color: #7c3aed;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
            <div style="display: flex; align-items: center; gap: 4px; font-size: 10px; color: #16a34a; font-weight: 700; background: #f0fdf4; padding: 2px 8px; border-radius: 9999px;">
                <span>↗ 12%</span>
            </div>
        </div>
        <h3 style="font-size: 12px; font-weight: 600; color: #64748b; margin: 0 0 4px 0;">Total Sales</h3>
        <p id="stat-total-sales" style="font-size: 24px; font-weight: 900; color: #0f172a; margin: 0; font-variant-numeric: tabular-nums;">Rs. 0</p>
        <p style="font-size: 10px; color: #94a3b8; margin: 4px 0 0 0;" class="Urdu-font">گزشتہ روز کے مقابلے میں</p>
        
        <div style="margin-top: 16px; display: flex; gap: 4px; align-items: flex-end; height: 24px;">
            <div style="flex: 1; background: #7c3aed; border-top-left-radius: 2px; border-top-right-radius: 2px; opacity: 0.8; height: 8px;"></div>
            <div style="flex: 1; background: #7c3aed; border-top-left-radius: 2px; border-top-right-radius: 2px; opacity: 0.8; height: 4px;"></div>
            <div style="flex: 1; background: #7c3aed; border-top-left-radius: 2px; border-top-right-radius: 2px; opacity: 0.8; height: 12px;"></div>
            <div style="flex: 1; background: #7c3aed; border-top-left-radius: 2px; border-top-right-radius: 2px; opacity: 0.8; height: 16px;"></div>
            <div style="flex: 1; background: #7c3aed; border-top-left-radius: 2px; border-top-right-radius: 2px; opacity: 0.8; height: 20px;"></div>
            <div style="flex: 1; background: #7c3aed; border-top-left-radius: 2px; border-top-right-radius: 2px; opacity: 0.8; height: 12px;"></div>
            <div style="flex: 1; background: #7c3aed; border-top-left-radius: 2px; border-top-right-radius: 2px; opacity: 0.8; height: 16px;"></div>
        </div>
    </div>

    <div style="background: white; padding: 24px; border-radius: 20px; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
        <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 16px;">
            <div style="padding: 8px; background: #f0fdf4; border-radius: 8px;">
                <svg style="width: 24px; height: 24px; color: #16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div style="display: flex; align-items: center; gap: 4px; font-size: 10px; color: #16a34a; font-weight: 700; background: #f0fdf4; padding: 2px 8px; border-radius: 9999px;">
                <span>↗ 8%</span>
            </div>
        </div>
        <h3 style="font-size: 12px; font-weight: 600; color: #64748b; margin: 0 0 4px 0;">Transactions</h3>
        <p id="stat-transactions" style="font-size: 24px; font-weight: 900; color: #0f172a; margin: 0; font-variant-numeric: tabular-nums;">0</p>
        <p style="font-size: 10px; color: #94a3b8; margin: 4px 0 0 0;">Average: <span id="stat-avg-sale" style="font-weight: 700; color: #64748b;">Rs. 0</span></p>
    </div>

    <div style="background: white; padding: 24px; border-radius: 20px; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
        <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 16px;">
            <div style="padding: 8px; background: #fffbeb; border-radius: 8px;">
                <svg style="width: 24px; height: 24px; color: #d97706;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
        </div>
        <h3 style="font-size: 12px; font-weight: 600; color: #64748b; margin: 0 0 8px 0;">Top Products</h3>
        <div id="top-products-list" style="display: flex; flex-direction: column; gap: 8px;">
            </div>
    </div>

    <div style="background: white; padding: 24px; border-radius: 20px; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
        <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 16px;">
            <div style="padding: 8px; background: #fef2f2; border-radius: 8px;">
                <svg style="width: 24px; height: 24px; color: #dc2626;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
        </div>
        <h3 style="font-size: 12px; font-weight: 600; color: #64748b; margin: 0 0 4px 0;">Stock Alert</h3>
        <p id="stat-low-stock" style="font-size: 24px; font-weight: 900; color: #dc2626; margin: 0; font-variant-numeric: tabular-nums;">0</p>
        <p style="font-size: 10px; color: #94a3b8; margin: 4px 0 0 0;" class="Urdu-font">اشیاء کم ہیں</p>
        <button style="width: 100%; margin-top: 12px; padding: 6px 0; font-size: 11px; font-weight: 700; color: #475569; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer;">
            View Details
        </button>
    </div>
</div>