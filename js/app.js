// Main initialization
// Elyscents POS Global UI Logic
function updateClock() {
    const clockEl = document.getElementById('live-clock');
    const dateEl = document.getElementById('live-date');
    if (!clockEl || !dateEl) return;

    const now = new Date();
    
    clockEl.innerText = now.toLocaleTimeString('en-GB', { 
        hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true 
    });

    dateEl.innerText = now.toLocaleDateString('en-GB', { 
        weekday: 'short', day: '2-digit', month: 'short', year: 'numeric' 
    });
}

// Initial Calls
document.addEventListener('DOMContentLoaded', () => {
    setInterval(updateClock, 1000);
    updateClock();
});