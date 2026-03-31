<div id="delete-modal" class="delete-modal-overlay">
    <div class="delete-modal-content">
        <div class="delete-modal-body">
            <div class="delete-icon-wrapper">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                </svg>
            </div>
            <h3 class="delete-title"><?= ($lang === 'ur') ? 'کیا آپ کو یقین ہے؟' : 'Are you sure?' ?></h3>
            <p class="delete-text">
                <?= ($lang === 'ur') ? 'یہ مستقل طور پر حذف کر دے گا ' : 'This will permanently delete ' ?>
                <strong id="delete-product-name" class="delete-product-highlight"></strong>.
                <?= ($lang === 'ur') ? 'اس عمل کو واپس نہیں لیا جا سکتا۔' : 'This action cannot be undone.' ?>
            </p>
        </div>

        <div class="delete-modal-footer">
            <button onclick="InventoryManager.closeDeleteModal()" class="btn-cancel" style="flex:1;">
                <?= ($lang === 'ur') ? 'منسوخ کریں' : 'Cancel' ?>
            </button>
            <button onclick="InventoryManager.handleDelete()" class="btn-delete-confirm">
                <?= ($lang === 'ur') ? 'پروڈکٹ حذف کریں' : 'Delete Product' ?>
            </button>
        </div>
    </div>
</div>