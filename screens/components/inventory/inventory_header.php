<div style="flex-shrink:0; padding:18px 40px; background:white; border-bottom:1px solid #f1f5f9; display:flex; justify-content:space-between; align-items:center;">
    <div>
        <h1 style="margin:0; font-size:20px; font-weight:900; color:#1e293b; letter-spacing:-0.6px;">
            Inventory Management
        </h1>
        <p style="margin:2px 0 0; font-size:10px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px;">
            <span id="total-product-count" style="color:#7c3aed; font-size:14px;">0</span> Products Total
        </p>
    </div>
    <div>
        <button onclick="InventoryManager.openModal()"
            style="padding:11px 24px; border-radius:14px; border:none; background:#7c3aed; color:white; font-weight:900; font-size:13px; cursor:pointer; display:flex; align-items:center; gap:7px;"
            onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 12px 20px -4px rgba(124,58,237,0.45)'"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 16px -4px rgba(124,58,237,0.35)'">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Add Product
        </button>
    </div>
</div>