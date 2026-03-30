<div style="height: 100%; display: flex; flex-direction: column; align-items: center; padding: 40px; background-color: #ffffff; font-family: 'Inter', sans-serif;">
    
    <div style="width: 100%; max-width: 450px;">
        <div style="margin-bottom: 24px; text-align: left;">
            <h1 style="font-size: 28px; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -1px;">More Options</h1>
            <p style="font-size: 14px; color: #64748b; margin-top: 4px;">Manage your store and preferences</p>
        </div>

        <div style="display: flex; flex-direction: column; gap: 12px;">
            <button onclick="window.loadScreen('components/more/settings')" 
                style="display: flex; align-items: center; justify-content: space-between; padding: 16px 20px; background: white; border-radius: 20px; border: 1px solid #f1f5f9; cursor: pointer; transition: 0.2s ease; width: 100%;"
                onmouseover="this.style.backgroundColor='#f8fafc'; this.style.transform='translateX(4px)'"
                onmouseout="this.style.backgroundColor='white'; this.style.transform='translateX(0)'">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <div style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; background: #f5f3ff; border-radius: 12px; font-size: 18px;">⚙️</div>
                    <div>
                        <h3 style="font-size: 15px; font-weight: 700; color: #0f172a; margin: 0;">Settings</h3>
                        <p style="font-size: 12px; color: #94a3b8; margin: 0;">Shop & system config</p>
                    </div>
                </div>
                <span style="color: #cbd5e1;">→</span>
            </button>

            <button onclick="window.loadScreen('components/more/help')"
                style="display: flex; align-items: center; justify-content: space-between; padding: 16px 20px; background: white; border-radius: 20px; border: 1px solid #f1f5f9; cursor: pointer; transition: 0.2s ease; width: 100%;"
                onmouseover="this.style.backgroundColor='#f8fafc'; this.style.transform='translateX(4px)'"
                onmouseout="this.style.backgroundColor='white'; this.style.transform='translateX(0)'">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <div style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; background: #eff6ff; border-radius: 12px; font-size: 18px;">❓</div>
                    <div>
                        <h3 style="font-size: 15px; font-weight: 700; color: #0f172a; margin: 0;">Help & Support</h3>
                        <p style="font-size: 12px; color: #94a3b8; margin: 0;">User guide & tutorials</p>
                    </div>
                </div>
                <span style="color: #cbd5e1;">→</span>
            </button>

            <button onclick="toggleLogoutModal(true)" 
                style="display: flex; align-items: center; justify-content: space-between; padding: 16px 20px; background: #fff1f2; border-radius: 20px; border: 1px solid #ffe4e6; cursor: pointer; transition: 0.2s ease; width: 100%; margin-top: 8px;">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <div style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; background: #ffffff; border-radius: 12px; font-size: 18px;">🚪</div>
                    <div>
                        <h3 style="font-size: 15px; font-weight: 700; color: #be123c; margin: 0;">Logout</h3>
                        <p style="font-size: 12px; color: #fb7185; margin: 0;">Sign out of session</p>
                    </div>
                </div>
                <span style="color: #fb7185;">→</span>
            </button>
        </div>
    </div>
</div>

<div id="logoutModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px); z-index: 10000; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: white; width: 100%; max-width: 400px; border-radius: 28px; padding: 32px; text-align: center; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);">
        <div style="width: 64px; height: 64px; background: #fff1f2; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 24px;">👋</div>
        <h2 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">Wait, leaving already?</h2>
        <p style="font-size: 14px; color: #64748b; margin-bottom: 32px;">Are you sure you want to log out of the POS system?</p>
        
        <div style="display: flex; flex-direction: column; gap: 12px;">
            <button onclick="confirmLogout()" style="width: 100%; padding: 14px; background: #0f172a; color: white; border: none; border-radius: 16px; font-weight: 700; cursor: pointer;">Yes, Logout</button>
            <button onclick="toggleLogoutModal(false)" style="width: 100%; padding: 14px; background: transparent; color: #64748b; border: none; border-radius: 16px; font-weight: 600; cursor: pointer;">No, Stay Logged In</button>
        </div>
    </div>
</div>

<script>
// Prevent function redeclaration if script is reloaded
if (typeof navigateMore !== 'function') {
    window.navigateMore = function(path) {
        if (typeof loadScreen === 'function') {
            loadScreen(path);
        } else {
            console.error("loadScreen function not found in app.js");
        }
    }
}

if (typeof toggleLogoutModal !== 'function') {
    window.toggleLogoutModal = function(show) {
        const modal = document.getElementById('logoutModal');
        if (modal) modal.style.display = show ? 'flex' : 'none';
    }
}

if (typeof confirmLogout !== 'function') {
    window.confirmLogout = function() {
        window.location.href = 'backend/api/auth/logout.php';
    }
}

// Functions ko window object par assign karein taake AJAX loading ke baad bhi accessible hon
window.toggleFaq = function(btn) {
    const content = btn.nextElementSibling;
    const svg = btn.querySelector('svg');
    const isHidden = content.style.display === 'none' || content.style.display === '';
    
    // Sirf isi specific group ke items ko handle karein
    const parent = btn.closest('.faq-group'); 
    if(parent) {
        parent.querySelectorAll('.faq-item > div').forEach(el => {
            if(el !== content) el.style.display = 'none';
        });
        parent.querySelectorAll('.faq-item svg').forEach(el => {
            if(el !== svg) el.style.transform = 'rotate(0deg)';
        });
    }

    if (isHidden) {
        content.style.display = 'block';
        svg.style.transform = 'rotate(180deg)';
        btn.style.backgroundColor = '#fcfcfd';
    } else {
        content.style.display = 'none';
        svg.style.transform = 'rotate(0deg)';
        btn.style.backgroundColor = 'transparent';
    }
};

window.filterHelp = function() {
    const q = document.getElementById('helpSearch').value.toLowerCase();
    const groups = document.querySelectorAll('.faq-group');
    
    groups.forEach(group => {
        let hasVisibleItem = false;
        const items = group.querySelectorAll('.faq-item');
        
        items.forEach(item => {
            const text = item.innerText.toLowerCase();
            if(text.includes(q)) {
                item.style.display = 'block';
                hasVisibleItem = true;
            } else {
                item.style.display = 'none';
            }
        });
        group.style.display = hasVisibleItem ? 'block' : 'none';
    });
};
</script>