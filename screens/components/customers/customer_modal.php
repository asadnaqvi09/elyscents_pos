<div id="customer-modal" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            <div>
                <h3 id="cust-modal-title" class="customer-header-title" style="font-size: 21px;">
                    <?= ($lang === 'ur') ? 'نیا کسٹمر شامل کریں' : 'Add New Customer' ?>
                </h3>
                <p class="label-caps" style="color: #94a3b8; margin-top: 4px;">
                    <?= ($lang === 'ur') ? 'کسٹمر پروفائل مینجمنٹ' : 'Customer Profile Management' ?>
                </p>
            </div>
            <button onclick="CustomerManager.closeModal()" class="btn-icon-close">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
            </button>
        </div>

        <form id="customer-form" onsubmit="CustomerManager.handleSave(event)" class="modal-body no-scrollbar">
            <input type="hidden" id="modal-customer-id" name="id">
            
            <div class="form-grid">
                <div class="input-group" style="grid-column: 1 / -1;">
                    <label class="label-caps"><?= ($lang === 'ur') ? 'پورا نام *' : 'Full Name *' ?></label>
                    <input type="text" id="modal-cust-name" name="name" required placeholder="<?= ($lang === 'ur') ? 'مثال: احمد خان' : 'e.g. Ahmed Khan' ?>" class="input-field">
                </div>

                <div class="input-group">
                    <label class="label-caps"><?= ($lang === 'ur') ? 'فون نمبر *' : 'Phone Number *' ?></label>
                    <input type="text" id="modal-cust-phone" name="phone" required placeholder="03XX-XXXXXXX" class="input-field">
                </div>

                <div class="input-group">
                    <label class="label-caps"><?= ($lang === 'ur') ? 'ای میل ایڈریس' : 'Email Address' ?></label>
                    <input type="email" id="modal-cust-email" name="email" placeholder="customer@example.com" class="input-field">
                </div>

                <div class="input-group">
                    <label class="label-caps"><?= ($lang === 'ur') ? 'تاریخ پیدائش' : 'Birthday' ?></label>
                    <input type="date" id="modal-cust-birthday" name="birthday" class="input-field">
                </div>

                <div class="input-group">
                    <label class="label-caps" style="color: #7c3aed;"><?= ($lang === 'ur') ? 'لائلٹی اسٹیٹس' : 'Loyalty Status' ?></label>
                    <div class="select-wrapper">
                        <select id="modal-cust-tier" name="loyalty_tier" class="select-custom">
                            <option value="bronze"><?= ($lang === 'ur') ? 'برونز ممبر' : 'Bronze Member' ?></option>
                            <option value="silver"><?= ($lang === 'ur') ? 'سلور VIP' : 'Silver VIP' ?></option>
                            <option value="gold"><?= ($lang === 'ur') ? 'گولڈ ایلیٹ' : 'Gold Elite' ?></option>
                        </select>
                    </div>
                </div>

                <div class="input-group" style="grid-column: 1 / -1;">
                    <label class="label-caps"><?= ($lang === 'ur') ? 'کسٹمر نوٹس' : 'Customer Notes' ?></label>
                    <textarea id="modal-cust-notes" name="notes" rows="3" placeholder="<?= ($lang === 'ur') ? 'پسندیدہ خوشبو، خریداری کی رفتار وغیرہ...' : 'Preferred scents, frequency, etc...' ?>" class="input-field" style="resize:none;"></textarea>
                </div>
            </div>

            <div style="margin-top:26px; display:flex; justify-content:flex-end; gap:12px;">
                <button type="button" onclick="CustomerManager.closeModal()" class="btn-cancel"><?= ($lang === 'ur') ? 'منسوخ کریں' : 'Cancel' ?></button>
                <button type="submit" id="cust-modal-submit-btn" class="btn-add-customer">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <?= ($lang === 'ur') ? 'کسٹمر محفوظ کریں' : 'Save Customer' ?>
                </button>
            </div>
        </form>
    </div>
</div>