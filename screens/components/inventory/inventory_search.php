<div style="position:relative; width:100%;">
    <div style="position:absolute; left:18px; top:50%; transform:translateY(-50%); color:#94a3b8; pointer-events:none;">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
    </div>
    <input type="text" 
           id="inventory-search"
           placeholder="Search by name, SKU, or brand..."
           onkeyup="InventoryManager.handleSearch(this.value)"
           autocomplete="off"
           style="width:100%; padding:15px 120px 15px 50px; border-radius:16px; background: #f3f3f5; font-size:14px; font-weight:600; color:#1e293b; outline:none; transition:all 0.2s; box-sizing:border-box;"
           onfocus="this.style.borderColor='#7c3aed'; this.style.boxShadow='0 0 0 4px rgba(124,58,237,0.08)'"
           onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">

    <div style="position:absolute; right:16px; top:50%; transform:translateY(-50%); display:flex; align-items:center; gap:4px; pointer-events:none;">
        <kbd style="padding:3px 7px; background:#f1f5f9; border:1px solid #e2e8f0; border-radius:6px; font-size:10px; font-weight:700; color:#94a3b8; font-family:monospace;">Ctrl</kbd>
        <kbd style="padding:3px 7px; background:#f1f5f9; border:1px solid #e2e8f0; border-radius:6px; font-size:10px; font-weight:700; color:#94a3b8; font-family:monospace;">K</kbd>
    </div>
</div>
