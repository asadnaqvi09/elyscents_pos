<div id="customer-modal" style="display:none; position:fixed; inset:0; z-index:9999; align-items:center; justify-content:center; background:rgba(15,23,42,0.45); backdrop-filter:blur(6px); padding:20px;">

    <div style="background:white; width:100%; max-width:660px; border-radius:24px; box-shadow:0 20px 60px -10px rgba(0,0,0,0.2); overflow:hidden; display:flex; flex-direction:column; animation:modalSlideUp 0.3s cubic-bezier(0.16,1,0.3,1);">
        
        <div style="padding:26px 32px 20px; display:flex; justify-content:space-between; align-items:flex-start;">
            <div>
                <h3 id="cust-modal-title" style="margin:0; font-size:21px; font-weight:900; color:#1e293b; letter-spacing:-0.4px;">Add New Customer</h3>
                <p style="margin:4px 0 0; font-size:10px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:1px;">Customer Profile Management</p>
            </div>
            <button onclick="CustomerManager.closeModal()"
                style="width:34px; height:34px; border-radius:50%; border:1.5px solid #e2e8f0; background:white; color:#94a3b8; cursor:pointer; display:flex; align-items:center; justify-content:center; flex-shrink:0; transition:all 0.2s;"
                onmouseover="this.style.color='#ef4444'; this.style.borderColor='#fca5a5'; this.style.transform='rotate(90deg)'"
                onmouseout="this.style.color='#94a3b8'; this.style.borderColor='#e2e8f0'; this.style.transform='rotate(0)'">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
            </button>
        </div>

        <form id="customer-form" onsubmit="CustomerManager.handleSave(event)" style="padding:0 32px 30px; overflow-y:auto; max-height:75vh;" class="no-scrollbar">
            
            <input type="hidden" id="modal-customer-id" name="id">
            
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px 20px;">
                
                <div style="grid-column: 1 / -1; display:flex; flex-direction:column; gap:6px;">
                    <label style="font-size:11px; font-weight:800; color:#64748b; text-transform:uppercase; letter-spacing:0.4px;">Full Name *</label>
                    <input type="text" id="modal-cust-name" name="name" required placeholder="e.g. Ahmed Khan" 
                           style="padding:13px 15px; border-radius:12px; border:1.5px solid #e2e8f0; background:#f8fafc; font-size:14px; font-weight:600; color:#1e293b; outline:none; transition:all 0.2s;"
                           onfocus="this.style.borderColor='#7c3aed'; this.style.boxShadow='0 0 0 3px rgba(124,58,237,0.1)'; this.style.background='white'"
                           onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.background='#f8fafc'">
                </div>

                <div style="display:flex; flex-direction:column; gap:6px;">
                    <label style="font-size:11px; font-weight:800; color:#64748b; text-transform:uppercase; letter-spacing:0.4px;">Phone Number *</label>
                    <input type="text" id="modal-cust-phone" name="phone" required placeholder="03XX-XXXXXXX" 
                           style="padding:13px 15px; border-radius:12px; border:1.5px solid #e2e8f0; background:#f8fafc; font-size:14px; font-weight:600; color:#1e293b; outline:none; transition:all 0.2s;"
                           onfocus="this.style.borderColor='#7c3aed'; this.style.boxShadow='0 0 0 3px rgba(124,58,237,0.1)'; this.style.background='white'"
                           onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.background='#f8fafc'">
                </div>

                <div style="display:flex; flex-direction:column; gap:6px;">
                    <label style="font-size:11px; font-weight:800; color:#64748b; text-transform:uppercase; letter-spacing:0.4px;">Email Address</label>
                    <input type="email" id="modal-cust-email" name="email" placeholder="customer@example.com" 
                           style="padding:13px 15px; border-radius:12px; border:1.5px solid #e2e8f0; background:#f8fafc; font-size:14px; font-weight:600; color:#1e293b; outline:none; transition:all 0.2s;"
                           onfocus="this.style.borderColor='#7c3aed'; this.style.boxShadow='0 0 0 3px rgba(124,58,237,0.1)'; this.style.background='white'"
                           onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.background='#f8fafc'">
                </div>

                <div style="display:flex; flex-direction:column; gap:6px;">
                    <label style="font-size:11px; font-weight:800; color:#64748b; text-transform:uppercase; letter-spacing:0.4px;">Birthday</label>
                    <input type="date" id="modal-cust-birthday" name="birthday" 
                           style="padding:12px 15px; border-radius:12px; border:1.5px solid #e2e8f0; background:#f8fafc; font-size:14px; font-weight:600; color:#1e293b; outline:none; transition:all 0.2s;">
                </div>

                <div style="display:flex; flex-direction:column; gap:6px;">
                    <label style="font-size:11px; font-weight:800; color:#7c3aed; text-transform:uppercase; letter-spacing:0.4px;">Loyalty Status</label>
                    <div style="position:relative;">
                        <select id="modal-cust-tier" name="loyalty_tier" 
                                style="width:100%; padding:13px 40px 13px 15px; border-radius:12px; border:1.5px solid #ede9fe; background:#f5f3ff; font-size:14px; font-weight:700; color:#7c3aed; outline:none; appearance:none; cursor:pointer;">
                            <option value="bronze">Bronze Member</option>
                            <option value="silver">Silver VIP</option>
                            <option value="gold">Gold Elite</option>
                        </select>
                        <div style="position:absolute; right:13px; top:50%; transform:translateY(-50%); pointer-events:none; color:#7c3aed;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                </div>

                <div style="grid-column: 1 / -1; display:flex; flex-direction:column; gap:6px;">
                    <label style="font-size:11px; font-weight:800; color:#64748b; text-transform:uppercase; letter-spacing:0.4px;">Customer Notes / Preferences</label>
                    <textarea id="modal-cust-notes" name="notes" rows="3" placeholder="Preferred scents, frequency, etc..."
                              style="padding:13px 15px; border-radius:12px; border:1.5px solid #e2e8f0; background:#f8fafc; font-size:14px; font-weight:600; color:#1e293b; outline:none; resize:none; transition:all 0.2s;"
                              onfocus="this.style.borderColor='#7c3aed'; this.style.background='white'"
                              onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'"></textarea>
                </div>

            </div>

            <div style="margin-top:26px; display:flex; justify-content:flex-end; align-items:center; gap:12px;">
                <button type="button" onclick="CustomerManager.closeModal()"
                    style="padding:12px 26px; border-radius:12px; border:1.5px solid #e2e8f0; background:white; color:#64748b; font-size:13px; font-weight:800; cursor:pointer; transition:all 0.2s;"
                    onmouseover="this.style.background='#f8fafc'"
                    onmouseout="this.style.background='white'">
                    Cancel
                </button>
                <button type="submit" id="cust-modal-submit-btn"
                    style="padding:12px 32px; border-radius:12px; border:none; background:#7c3aed; color:white; font-size:13px; font-weight:900; cursor:pointer; box-shadow:0 6px 16px rgba(124,58,237,0.35); transition:all 0.2s; display:flex; align-items:center; gap:8px;"
                    onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 10px 20px rgba(124,58,237,0.45)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 6px 16px rgba(124,58,237,0.35)'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Customer
                </button>
            </div>
        </form>
    </div>
</div>

<style>
@keyframes modalSlideUp {
    from { opacity:0; transform:translateY(28px) scale(0.96); }
    to   { opacity:1; transform:translateY(0) scale(1); }
}
/* Custom Scrollbar for the form */
#customer-form::-webkit-scrollbar { width: 4px; }
#customer-form::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
</style>