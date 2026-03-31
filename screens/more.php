<link rel="stylesheet" href="css/more/more.css">

<div class="more-wrapper">
    <div class="more-container">
        <div class="more-header">
            <h1 class="more-title">More Options</h1>
            <p class="more-subtitle">Manage your store and preferences</p>
        </div>

        <div class="options-list">
            <button class="option-item" onclick="window.location.href='?page=settings'">
                <div class="option-content">
                    <div class="option-icon-box bg-purple">⚙️</div>
                    <div class="option-text">
                        <h3 class="option-label">Settings</h3>
                        <p class="option-desc">Shop & system config</p>
                    </div>
                </div>
                <span class="option-arrow">→</span>
            </button>

            <button class="option-item" onclick="window.location.href='?page=help'">
                <div class="option-content">
                    <div class="option-icon-box bg-blue">❓</div>
                    <div class="option-text">
                        <h3 class="option-label">Help & Support</h3>
                        <p class="option-desc">User guide & tutorials</p>
                    </div>
                </div>
                <span class="option-arrow">→</span>
            </button>

            <button class="option-item logout-btn" onclick="toggleLogoutModal(true)">
                <div class="option-content">
                    <div class="option-icon-box bg-white">🚪</div>
                    <div class="option-text">
                        <h3 class="option-label text-danger">Logout</h3>
                        <p class="option-desc text-danger-soft">Sign out of session</p>
                    </div>
                </div>
                <span class="option-arrow text-danger-soft">→</span>
            </button>
        </div>
    </div>
</div>

<div id="logoutModal" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-emoji">👋</div>
        <h2 class="modal-title">Wait, leaving already?</h2>
        <p class="modal-desc">Are you sure you want to log out of the POS system?</p>
        
        <div class="modal-actions">
            <button onclick="confirmLogout()" class="btn-confirm">Yes, Logout</button>
            <button onclick="toggleLogoutModal(false)" class="btn-cancel">No, Stay Logged In</button>
        </div>
    </div>
</div>

<script>
// Logout functions
window.toggleLogoutModal = function(show) {
    const modal = document.getElementById('logoutModal');
    if (modal) modal.style.display = show ? 'flex' : 'none';
}

window.confirmLogout = function() {
    sessionStorage.clear();
    localStorage.clear();
    // Path mapped to your structure
    window.location.href = 'backend/api/auth/logout.php';
}
</script>