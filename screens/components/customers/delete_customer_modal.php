<div id="cust-delete-modal" class="modal-overlay" style="z-index:10000;">
    <div class="modal-card delete-card">
        <div class="delete-icon-box">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2M10 11v6M14 11v6"/></svg>
        </div>

        <h3 class="customer-header-title" style="font-size: 18px; text-align: center;">
            <?= ($lang === 'ur') ? 'کسٹمر حذف کریں؟' : 'Delete Customer?' ?>
        </h3>
        <p class="customer-header-subtitle" style="margin: 12px 0 24px; text-align: center; line-height: 1.5;">
            <?= ($lang === 'ur') ? 'کیا آپ واقعی اس کسٹمر کو حذف کرنا چاہتے ہیں؟' : 'Are you sure you want to delete ' ?> 
            <span id="delete-cust-name" style="color:#1e293b; font-weight:800;"></span>? 
            <?= ($lang === 'ur') ? 'تمام ٹرانزیکشن ہسٹری ختم ہو جائے گی اور اسے واپس نہیں لایا جا سکے گا۔' : 'This action will remove all transaction history and cannot be undone.' ?>
        </p>

        <div style="display:flex; flex-direction:column; gap:10px;">
            <button onclick="CustomerManager.handleDelete()" class="btn-delete-confirm" style="width:100%; padding:14px;">
                <?= ($lang === 'ur') ? 'جی ہاں، کسٹمر حذف کریں' : 'Yes, Delete Customer' ?>
            </button>
            <button onclick="CustomerManager.closeDeleteModal()" class="btn-cancel" style="width:100%; padding:14px;">
                <?= ($lang === 'ur') ? 'پروفائل برقرار رکھیں' : 'Keep Profile' ?>
            </button>
        </div>
    </div>
</div>