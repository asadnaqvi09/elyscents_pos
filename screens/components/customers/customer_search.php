<div style="position:relative; width:100%">
    <span style="position:absolute; left:16px; top:50%; transform:translateY(-50%); color:#94a3b8;">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    </span>
    
    <input type="text" 
           id="customer-search" 
           oninput="CustomerManager.handleSearch()" 
           placeholder="Search by name, phone or ID... (Ctrl + K)" 
           style="width:100%; padding:14px 16px 14px 48px; border-radius:16px; border:1.5px solid #e2e8f0; background:white; font-size:14px; font-weight:600; color:#1e293b; outline:none; transition:all 0.2s; box-shadow:0 2px 4px rgba(0,0,0,0.02);">
           
    <div style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:#f1f5f9; padding:4px 8px; border-radius:8px; color:#94a3b8; font-size:10px; font-weight:800; border:1px solid #e2e8f0; pointer-events:none;">
        CTRL + K
    </div>
</div>