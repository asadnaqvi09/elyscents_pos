<div id="product-modal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <div>
                <h3 id="modal-title" class="modal-title"><?= ($lang === 'ur') ? 'نئی پروڈکٹ شامل کریں' : 'Add New Product' ?></h3>
                <p class="modal-subtitle"><?= ($lang === 'ur') ? 'پروڈکٹ کیٹلاگ انٹری' : 'Product Catalog Entry' ?></p>
            </div>
            <button onclick="InventoryManager.closeModal()" class="close-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
            </button>
        </div>

        <form id="product-form" onsubmit="InventoryManager.handleSave(event)" class="product-form">
            <input type="hidden" name="id" id="modal-product-id">
            
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label"><?= ($lang === 'ur') ? 'پروڈکٹ کا نام (انگریزی)' : 'Product Name (EN) *' ?></label>
                    <input type="text" name="name_en" id="modal-name-en" class="input-field" required placeholder="e.g., Oud Al Layl">
                </div>

                <div class="form-group">
                    <label class="form-label"><?= ($lang === 'ur') ? 'پروڈکٹ کا نام (اردو)' : 'Product Name (UR)' ?></label>
                    <input type="text" name="name_ur" id="modal-name-ur" dir="rtl" class="input-field input-urdu" placeholder="عود اللیل">
                </div>

                <div class="form-group">
                    <label class="form-label"><?= ($lang === 'ur') ? 'ایس کے یو / کوڈ' : 'SKU / Code' ?></label>
                    <input type="text" name="sku" id="modal-sku" class="input-field" placeholder="e.g., OUD-101">
                </div>

                <div class="form-group">
                    <label class="form-label"><?= ($lang === 'ur') ? 'برانڈ' : 'Brand' ?></label>
                    <input type="text" name="brand" id="modal-brand" class="input-field" placeholder="e.g., Arabiyat">
                </div>

                <div class="form-group">
                    <label class="form-label"><?= ($lang === 'ur') ? 'کیٹیگری' : 'Category' ?></label>
                    <div class="select-wrapper">
                        <select name="category" id="modal-category" class="input-field select-field">
                            <option value="men"><?= ($lang === 'ur') ? 'مردانہ' : 'Men' ?></option>
                            <option value="women"><?= ($lang === 'ur') ? 'خواتین' : 'Women' ?></option>
                            <option value="unisex"><?= ($lang === 'ur') ? 'یونیسیکس' : 'Unisex' ?></option>
                            <option value="gifts"><?= ($lang === 'ur') ? 'تحائف' : 'Gifts' ?></option>
                            <option value="testers"><?= ($lang === 'ur') ? 'ٹیسٹرز' : 'Testers' ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"><?= ($lang === 'ur') ? 'سائز / مقدار' : 'Size / Volume' ?></label>
                    <input type="text" name="size" id="modal-size" class="input-field" placeholder="e.g., 100ml">
                </div>

                <div class="form-group">
                    <label class="form-label"><?= ($lang === 'ur') ? 'اسٹاک کی تعداد' : 'Stock Quantity *' ?></label>
                    <input type="number" name="stock" id="modal-stock" class="input-field" value="0" min="0" required>
                </div>

                <div class="form-group">
                    <label class="form-label" style="color: #ef4444;"><?= ($lang === 'ur') ? 'کم اسٹاک الرٹ' : 'Low Stock Alert' ?></label>
                    <input type="number" name="low_stock_threshold" id="modal-threshold" class="input-field" value="5" min="0">
                </div>

                <div class="form-group">
                    <label class="form-label" style="color: #10b981;"><?= ($lang === 'ur') ? 'خریداری کی قیمت' : 'Cost Price (Rs.) *' ?></label>
                    <input type="number" name="cost_price" id="modal-cost-price" class="input-field" value="0" min="0" required>
                </div>

                <div class="form-group">
                    <label class="form-label" style="color: #7c3aed;"><?= ($lang === 'ur') ? 'فروخت کی قیمت' : 'Sale Price (Rs.) *' ?></label>
                    <input type="number" name="sale_price" id="modal-sale-price" class="input-field" value="0" min="0" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" onclick="InventoryManager.closeModal()" class="btn-cancel"><?= ($lang === 'ur') ? 'منسوخ کریں' : 'Cancel' ?></button>
                <button type="submit" id="modal-submit-btn" class="btn-save">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <?= ($lang === 'ur') ? 'محفوظ کریں' : 'Save Product' ?>
                </button>
            </div>
        </form>
    </div>
</div>