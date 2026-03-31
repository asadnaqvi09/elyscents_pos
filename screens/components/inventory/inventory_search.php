<div class="search-wrapper">
    <div class="search-icon-wrapper">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
        </svg>
    </div>

    <input type="text" 
           id="inventory-search"
           class="inv-search-input"
           placeholder="Search by name, SKU, or brand..."
           oninput="InventoryManager.handleSearch(this.value)"
           autocomplete="off">

    <div class="search-shortcuts">
        <kbd class="shortcut-key">Ctrl</kbd>
        <kbd class="shortcut-key">K</kbd>
    </div>
</div>

<script>
// Optional: Global shortcut listener for Ctrl+K
document.addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        document.getElementById('inventory-search').focus();
    }
});
</script>