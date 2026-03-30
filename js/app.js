// Navigation logic - window par attach karna zaroori hai
window.loadScreen = async function(screenPath) {
    const mainContent = document.getElementById('main-content');
    if (!mainContent) return;

    // Loading indicator
    mainContent.innerHTML = '<div style="display:flex; justify-content:center; align-items:center; height:100%; color:#64748b;">Loading...</div>';

    try {
        // Folder structure check: screens/${screenPath}.php
        const response = await fetch(`screens/${screenPath}.php`);
        
        if (!response.ok) {
            throw new Error(`Screen not found: screens/${screenPath}.php`);
        }

        const html = await response.text();
        mainContent.innerHTML = html;

        // Settings Specific logic
        if (screenPath.includes('settings')) {
            setTimeout(() => {
                if (typeof window.fetchSettings === 'function') {
                    window.fetchSettings();
                } else {
                    console.error("fetchSettings not found. Check settings_handler.js");
                }
            }, 100);
        }
    } catch (error) {
        console.error("Navigation Error:", error);
        mainContent.innerHTML = `<div style="padding:20px; color:red; text-align:center;">
            <h3>Error loading screen</h3>
            <p>${error.message}</p>
        </div>`;
    }
};

// Live Clock
window.updateClock = function() {
    const clockEl = document.getElementById('live-clock');
    const dateEl = document.getElementById('live-date');
    if (!clockEl) return;

    const now = new Date();
    clockEl.innerText = now.toLocaleTimeString('en-GB', { 
        hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true 
    });
    if(dateEl) {
        dateEl.innerText = now.toLocaleDateString('en-GB', { 
            weekday: 'short', day: '2-digit', month: 'short', year: 'numeric' 
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    setInterval(window.updateClock, 1000);
    window.updateClock();
});