<link rel="stylesheet" href="css/more/settings.css">

<div class="settings-wrapper">
    <div class="settings-container">
        
        <div class="settings-header">
            <div>
                <h1 class="settings-title">Settings</h1>
                <p class="settings-subtitle">Manage your store settings and preferences</p>
            </div>
            <button onclick="loadScreen('more')" class="btn-back">← Back</button>
        </div>

        <div class="settings-sections">
            
            <section class="card">
                <div class="card-header">
                    <div class="icon-box">
                        <!-- SVG -->
                    </div>
                    <h2 class="card-title">Store Information</h2>
                </div>
                <div>
                    <label class="label">Store Name</label>
                    <input type="text" id="storeName" oninput="handleInputChange('storeName', this.value)" 
                        class="input" placeholder="Elyscents Perfume Shop">
                </div>
            </section>

            <section class="card">
                <div class="card-header">
                    <div class="icon-box"></div>
                    <h2 class="card-title">Currency & Tax</h2>
                </div>

                <div class="grid-2">
                    <div>
                        <label class="label">Currency</label>
                        <select id="currency" onchange="handleInputChange('currency', this.value)" class="select">
                            <option value="PKR">PKR - Pakistani Rupee (روپے)</option>
                            <option value="USD">USD - US Dollar ($)</option>
                        </select>
                    </div>

                    <div>
                        <label class="label">Tax Rate (%)</label>
                        <input type="number" id="taxRate" oninput="handleInputChange('taxRate', this.value)" 
                            class="input" placeholder="17">
                        <p class="helper-text">Default: 17% (Pakistan GST)</p>
                    </div>
                </div>
            </section>

            <section class="card">
                <div class="card-header">
                    <div class="icon-box"></div>
                    <h2 class="card-title">Language & Localization</h2>
                </div>

                <div>
                    <label class="label">Interface Language</label>
                    <select id="language" onchange="handleInputChange('language', this.value)" class="select">
                        <option value="en">🇬🇧 English</option>
                        <option value="ur">🇵🇰 اردو (Urdu)</option>
                    </select>
                    <p class="helper-text">Changes will apply immediately</p>
                </div>
            </section>

            <section class="card">
                <div class="card-header">
                    <div class="icon-box"></div>
                    <h2 class="card-title">Receipt Printer</h2>
                </div>

                <div>
                    <label class="label">Printer Device</label>
                    <select id="printer" class="select">
                        <option value="default">Default Printer</option>
                        <option value="thermal">XP-80 Thermal Printer</option>
                    </select>
                </div>
            </section>

            <section class="card">
                <div class="card-header">
                    <div class="icon-box"></div>
                    <h2 class="card-title">Backup & Sync</h2>
                </div>

                <div>
                    <label class="label">Auto Backup Frequency</label>
                    <select id="backup" class="select">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="manual">Manual Only</option>
                    </select>
                    <p class="helper-text">Automatic backup to local storage</p>
                </div>
            </section>

        </div>
    </div>

    <div class="footer-bar">
        <button id="discardBtn" onclick="discardChanges()" disabled class="btn btn-discard">
            Discard Changes
        </button>
        
        <button id="saveSettingsBtn" onclick="saveSettings()" disabled class="btn btn-save">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                <polyline points="17 21 17 13 7 13 7 21"/>
                <polyline points="7 3 7 8 15 8"/>
            </svg>
            Save Settings
        </button>
    </div>
</div>

<script>
    if(typeof fetchSettings === 'function') fetchSettings();

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

    function handleInputChange(key, val) {
        console.log(key, val);
        enableButtons();
    }
</script>
<script src="js/settings_handler.js"></script>