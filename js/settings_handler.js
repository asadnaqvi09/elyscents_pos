// State management
let originalSettings = {};
let currentSettings = {};

// 1. Fetch settings from backend
window.fetchSettings = async function() {
    try {
        const response = await fetch('backend/api/settings/get_settings.php');
        const result = await response.json();

        if (result.status === 'success' || result.status === 'empty') {
            originalSettings = { ...result.data };
            currentSettings = { ...result.data };
            
            applySettingsToUI(result.data);
            updateSaveButtonState(false);
        }
    } catch (error) {
        console.error("Settings load karne mein masla:", error);
    }
}

// 2. Fill UI inputs
function applySettingsToUI(data) {
    if(!data) return;
    const fields = ['storeName', 'currency', 'taxRate', 'language', 'receiptPrinter', 'backupFrequency'];
    
    fields.forEach(field => {
        const el = document.getElementById(field);
        if (el) el.value = data[field] || '';
    });
}

// 3. Detect input changes
window.handleInputChange = function(field, value) {
    currentSettings[field] = value;
    
    // Compare objects to check for changes
    const hasChanges = JSON.stringify(originalSettings) !== JSON.stringify(currentSettings);
    updateSaveButtonState(hasChanges);
}

// 4. Save Settings (Fixed Headers)
window.saveSettings = async function() {
    const saveBtn = document.getElementById('saveSettingsBtn');
    if(!saveBtn) return;

    saveBtn.disabled = true;
    saveBtn.innerText = "Saving...";

    try {
        const response = await fetch('backend/api/settings/update_settings.php', {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/json' // FIXED: Colon was inside string before
            },
            body: JSON.stringify(currentSettings)
        });

        const result = await response.json();

        if (result.status === 'success') {
            originalSettings = { ...currentSettings };
            updateSaveButtonState(false);
            alert("Settings saved successfully!");
            
            if (originalSettings.language !== currentSettings.language) {
                location.reload(); 
            }
        } else {
            alert(result.message || "Error saving settings");
        }
    } catch (error) {
        console.error("Save Error:", error);
        alert("Server error occurred");
    } finally {
        saveBtn.disabled = false;
        saveBtn.innerHTML = "Save Settings";
    }
}

// 5. Discard changes
window.discardChanges = function() {
    currentSettings = { ...originalSettings };
    applySettingsToUI(originalSettings);
    updateSaveButtonState(false);
}

function updateSaveButtonState(enabled) {
    const saveBtn = document.getElementById('saveSettingsBtn');
    const discardBtn = document.getElementById('discardBtn');
    
    if (saveBtn && discardBtn) {
        saveBtn.disabled = !enabled;
        discardBtn.disabled = !enabled;
        saveBtn.style.opacity = enabled ? "1" : "0.5";
        saveBtn.style.cursor = enabled ? "pointer" : "not-allowed";
        discardBtn.style.opacity = enabled ? "1" : "0.5";
        discardBtn.style.cursor = enabled ? "pointer" : "not-allowed";
    }
}