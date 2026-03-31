<nav class="top-nav">
    <div class="brand-section">
        <div class="logo-box">E</div>
        <div class="brand-info">
            <h1><?php echo $translations['auth']['login_title'][$lang]; ?></h1>
            <p><?php echo ($lang === 'ur') ? 'واہ برانچ' : 'Wah Branch'; ?></p>
        </div>
        <div class="status-badge">
            <div class="status-dot"></div>
            <span style="font-size: 10px; font-weight: 800; color: #22c55e; text-transform: uppercase;">
                <?php echo ($lang === 'ur') ? 'آن لائن' : 'Online'; ?>
            </span>
        </div>
    </div>

    <div class="clock-section">
        <p id="live-clock" class="live-clock"></p>
        <p id="live-date" class="live-date"></p>
    </div>

    <div class="actions-section">
        <div class="stats-pill">
            <div style="display: flex; align-items: center; gap: 6px; color: #22c55e;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                <span style="font-size: 10px; font-weight: 700; text-transform: uppercase;">
                    <?php echo ($lang === 'ur') ? 'مطابقت پذیر' : 'Synced'; ?>
                </span>
            </div>
        </div>
        
        <button class="lang-btn" onclick="toggleLanguage()" style="cursor: pointer; padding: 5px 15px; font-weight: bold; border-radius: 6px; border: 1px solid var(--border);">
            <?php echo ($lang === 'en') ? 'اردو' : 'EN'; ?>
        </button>
        
        <div class="brand-section" style="padding-left: 8px;">
            <div style="width: 36px; height: 36px; background: rgba(147, 51, 234, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                👑
            </div>
            <span style="font-size: 12px; font-weight: 600;">
                <?php echo ($lang === 'ur') ? 'مالک' : 'Owner'; ?>
            </span>
        </div>
    </div>
</nav>

<script>
function toggleLanguage() {
    const newLang = '<?php echo $lang; ?>' === 'en' ? 'ur' : 'en';
    
    fetch('backend/api/settings/update_language.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ lang: newLang })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            window.location.reload();
        }
    })
    .catch(err => console.error('Error updating language:', err));
}
</script>