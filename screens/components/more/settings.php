<div style="height: 100%; overflow-y: auto; padding: 32px 20px; background-color: #f8fafc; font-family: 'Inter', -apple-system, sans-serif;">
    <div style="max-width: 900px; margin: 0 auto;">
        
        <div style="margin-bottom: 32px; display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h1 style="font-size: 28px; font-weight: 800; color: #1e293b; margin: 0; letter-spacing: -0.5px;">Settings</h1>
                <p style="font-size: 14px; color: #64748b; margin-top: 4px;">Manage your store settings and preferences</p>
            </div>
            <button onclick="loadScreen('more')" style="background: #ffffff; border: 1px solid #e2e8f0; color: #1e293b; padding: 10px 18px; border-radius: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">← Back</button>
        </div>

        <div style="display: flex; flex-direction: column; gap: 24px; padding-bottom: 120px;">
            
            <section style="background: white; padding: 32px; border-radius: 24px; border: 1px solid #eef2f6; box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 28px;">
                    <div style="color: #9333ea; background: #faf5ff; padding: 8px; border-radius: 10px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <h2 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0;">Store Information</h2>
                </div>
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label style="font-size: 14px; font-weight: 600; color: #334155;">Store Name</label>
                    <input type="text" id="storeName" oninput="handleInputChange('storeName', this.value)" 
                        style="width: 100%; padding: 14px 18px; border-radius: 12px; border: 1px solid #f1f5f9; background: #f8fafc; font-size: 15px; box-sizing: border-box;" placeholder="Elyscents Perfume Shop">
                </div>
            </section>

            <section style="background: white; padding: 32px; border-radius: 24px; border: 1px solid #eef2f6; box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 28px;">
                    <div style="color: #9333ea; background: #faf5ff; padding: 8px; border-radius: 10px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <h2 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0;">Currency & Tax</h2>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                    <div>
                        <label style="font-size: 14px; font-weight: 600; color: #334155; display: block; margin-bottom: 8px;">Currency</label>
                        <select id="currency" onchange="handleInputChange('currency', this.value)" style="width: 100%; padding: 14px; border-radius: 12px; border: 1px solid #f1f5f9; background: #f8fafc; font-size: 15px;">
                            <option value="PKR">PKR - Pakistani Rupee (روپے)</option>
                            <option value="USD">USD - US Dollar ($)</option>
                        </select>
                    </div>
                    <div>
                        <label style="font-size: 14px; font-weight: 600; color: #334155; display: block; margin-bottom: 8px;">Tax Rate (%)</label>
                        <input type="number" id="taxRate" oninput="handleInputChange('taxRate', this.value)" style="width: 100%; padding: 14px; border-radius: 12px; border: 1px solid #f1f5f9; background: #f8fafc; font-size: 15px; box-sizing: border-box;" placeholder="17">
                        <p style="font-size: 12px; color: #94a3b8; margin-top: 6px;">Default: 17% (Pakistan GST)</p>
                    </div>
                </div>
            </section>

            <section style="background: white; padding: 32px; border-radius: 24px; border: 1px solid #eef2f6; box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 28px;">
                    <div style="color: #9333ea; background: #faf5ff; padding: 8px; border-radius: 10px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </div>
                    <h2 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0;">Language & Localization</h2>
                </div>
                <div>
                    <label style="font-size: 14px; font-weight: 600; color: #334155; display: block; margin-bottom: 8px;">Interface Language</label>
                    <select id="language" onchange="handleInputChange('language', this.value)" style="width: 100%; padding: 14px; border-radius: 12px; border: 1px solid #f1f5f9; background: #f8fafc; font-size: 15px;">
                        <option value="en">🇬🇧 English</option>
                        <option value="ur">🇵🇰 اردو (Urdu)</option>
                    </select>
                    <p style="font-size: 12px; color: #94a3b8; margin-top: 6px;">Changes will apply immediately</p>
                </div>
            </section>

            <section style="background: white; padding: 32px; border-radius: 24px; border: 1px solid #eef2f6; box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 28px;">
                    <div style="color: #9333ea; background: #faf5ff; padding: 8px; border-radius: 10px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                    </div>
                    <h2 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0;">Receipt Printer</h2>
                </div>
                <div>
                    <label style="font-size: 14px; font-weight: 600; color: #334155; display: block; margin-bottom: 8px;">Printer Device</label>
                    <select id="printer" style="width: 100%; padding: 14px; border-radius: 12px; border: 1px solid #f1f5f9; background: #f8fafc; font-size: 15px;">
                        <option value="default">Default Printer</option>
                        <option value="thermal">XP-80 Thermal Printer</option>
                    </select>
                </div>
            </section>

            <section style="background: white; padding: 32px; border-radius: 24px; border: 1px solid #eef2f6; box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 28px;">
                    <div style="color: #9333ea; background: #faf5ff; padding: 8px; border-radius: 10px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 4v6h-6"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                    </div>
                    <h2 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0;">Backup & Sync</h2>
                </div>
                <div>
                    <label style="font-size: 14px; font-weight: 600; color: #334155; display: block; margin-bottom: 8px;">Auto Backup Frequency</label>
                    <select id="backup" style="width: 100%; padding: 14px; border-radius: 12px; border: 1px solid #f1f5f9; background: #f8fafc; font-size: 15px;">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="manual">Manual Only</option>
                    </select>
                    <p style="font-size: 12px; color: #94a3b8; margin-top: 6px;">Automatic backup to local storage</p>
                </div>
            </section>

        </div>
    </div>

    <div style="position: fixed; bottom: 85px; left: 50%; transform: translateX(-50%); width: 95%; max-width: 860px; background: white; border: 1px solid #e2e8f0; padding: 16px 24px; border-radius: 20px; display: flex; justify-content: flex-end; gap: 12px; z-index: 90; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);">
    
    <button id="discardBtn" onclick="discardChanges()" disabled 
        style="padding: 10px 20px; border-radius: 12px; border: 1px solid #e2e8f0; background: #f8fafc; color: #64748b; font-weight: 700; cursor: not-allowed; opacity: 0.5; transition: all 0.2s; font-size: 14px;">
        Discard Changes
    </button>
    
    <button id="saveSettingsBtn" onclick="saveSettings()" disabled 
        style="padding: 10px 28px; border-radius: 12px; background: #9333ea; color: white; border: none; font-weight: 700; cursor: not-allowed; opacity: 0.5; box-shadow: 0 4px 12px rgba(147, 51, 234, 0.2); transition: all 0.2s; display: flex; align-items: center; gap: 8px; font-size: 14px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        Save Settings
    </button>
</div>
</div>

<script>
    if(typeof fetchSettings === 'function') fetchSettings();

    // Jab koi change ho toh buttons enable karne ke liye ye function call karein
    function enableButtons() {
        const dBtn = document.getElementById('discardBtn');
        const sBtn = document.getElementById('saveSettingsBtn');
        
        [dBtn, sBtn].forEach(btn => {
            btn.disabled = false;
            btn.style.opacity = '1';
            btn.style.cursor = 'pointer';
        });
        
        sBtn.style.transform = 'translateY(-1px)';
    }

    // Mock implementation for demo
    function handleInputChange(key, val) {
        console.log(key, val);
        enableButtons();
    }
</script>