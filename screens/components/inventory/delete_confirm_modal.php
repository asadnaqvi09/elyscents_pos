<?php
/**
 * delete_confirm_modal.php
 * Confirmation dialog before deleting a product
 * JS sets the product name and ID via InventoryManager.confirmDelete()
 */
?>
<div id="delete-modal" style="display:none; position:fixed; inset:0; z-index:10000; align-items:center; justify-content:center; background:rgba(15,23,42,0.5); backdrop-filter:blur(6px); padding:20px;">
    <div style="background:white; width:100%; max-width:420px; border-radius:24px; box-shadow:0 20px 60px -10px rgba(0,0,0,0.25); overflow:hidden; animation:modalSlideUp 0.25s cubic-bezier(0.16,1,0.3,1);">

        <!-- Icon + Title -->
        <div style="padding:32px 32px 24px; text-align:center;">
            <div style="width:56px; height:56px; background:#fef2f2; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
            </div>
            <h3 style="margin:0 0 8px; font-size:19px; font-weight:900; color:#1e293b;">Are you sure?</h3>
            <p style="margin:0; font-size:14px; font-weight:500; color:#64748b; line-height:1.6;">
                This will permanently delete
                <strong id="delete-product-name" style="color:#1e293b;"></strong>.
                This action cannot be undone.
            </p>
        </div>

        <!-- Actions -->
        <div style="padding:0 32px 28px; display:flex; gap:10px;">
            <button onclick="InventoryManager.closeDeleteModal()"
                style="flex:1; padding:13px; border-radius:12px; border:1.5px solid #e2e8f0; background:white; color:#64748b; font-size:13px; font-weight:800; cursor:pointer; transition:all 0.2s;"
                onmouseover="this.style.background='#f8fafc'"
                onmouseout="this.style.background='white'">
                Cancel
            </button>
            <button onclick="InventoryManager.handleDelete()"
                style="flex:1; padding:13px; border-radius:12px; border:none; background:#ef4444; color:white; font-size:13px; font-weight:900; cursor:pointer; box-shadow:0 4px 12px rgba(239,68,68,0.3); transition:all 0.2s;"
                onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 8px 16px rgba(239,68,68,0.4)'"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(239,68,68,0.3)'">
                Delete Product
            </button>
        </div>
    </div>
</div>