<div id="cust-delete-modal" style="display:none; position:fixed; inset:0; background:rgba(15, 23, 42, 0.6); backdrop-filter:blur(8px); z-index:10000; align-items:center; justify-content:center; padding:20px;">
    
    <div style="background:white; width:100%; max-width:400px; border-radius:24px; padding:32px; text-align:center; box-shadow:0 25px 50px -12px rgba(0,0,0,0.25); animation: modalPop 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
        
        <div style="width:64px; height:64px; background:#fef2f2; color:#ef4444; border-radius:20px; display:flex; align-items:center; justify-content:center; margin:0 auto 20px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2M10 11v6M14 11v6"/></svg>
        </div>

        <h3 style="margin:0; font-size:18px; font-weight:900; color:#1e293b;">Delete Customer?</h3>
        <p style="margin:12px 0 24px; font-size:14px; color:#64748b; line-height:1.5; font-weight:600;">
            Are you sure you want to delete <span id="delete-cust-name" style="color:#1e293b; font-weight:800;">this customer</span>? This action will remove all their transaction history and cannot be undone.
        </p>

        <div style="display:flex; flex-direction:column; gap:10px;">
            <button onclick="CustomerManager.handleDelete()" 
                    style="width:100%; padding:14px; border-radius:14px; border:none; background:#ef4444; color:white; font-size:14px; font-weight:800; cursor:pointer; transition:0.2s;">
                Yes, Delete Customer
            </button>
            <button onclick="CustomerManager.closeDeleteModal()" 
                    style="width:100%; padding:14px; border-radius:14px; border:1.5px solid #e2e8f0; background:white; color:#64748b; font-size:14px; font-weight:800; cursor:pointer;">
                Keep Profile
            </button>
        </div>
    </div>
</div>

<style>
@keyframes modalPop {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}
</style>