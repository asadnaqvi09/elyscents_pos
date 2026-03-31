<div class="search-container">
    <span class="search-icon">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
    </span>
    
    <input type="text" 
           id="customer-search" 
           class="search-input"
           oninput="CustomerManager.handleSearch()" 
           placeholder="<?= ($lang === 'ur') ? 'نام، فون یا آئی ڈی سے تلاش کریں...' : 'Search by name, phone or ID...' ?>">
           
    <div class="search-shortcut" style="<?= ($lang === 'ur') ? 'display:none;' : '' ?>">
        CTRL + K
    </div>
</div>