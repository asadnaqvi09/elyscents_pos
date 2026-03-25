<div class="flex flex-col h-full bg-surface overflow-hidden">
    <!-- Top: Category Tabs + Search -->
    <div class="p-4 border-b border-border shrink-0 space-y-3">
        <div id="category-list" class="flex gap-1" style="background:#f1f1f4; padding:4px; border-radius:12px;">
            <?php 
            $cats = ['All', 'Men', 'Women', 'Unisex']; 
            foreach($cats as $index => $cat): 
            ?>
                <button onclick="filterCategory('<?= $cat ?>')" 
                    class="cat-btn flex-1 font-bold transition-all"
                    style="font-size:13px; border-radius:9px; border:none; cursor:pointer; padding:7px 4px;
                    <?= $index === 0 
                        ? 'background:#fff; color:#7c3aed; box-shadow:0 1px 4px rgba(0,0,0,0.08);' 
                        : 'background:transparent; color:#64748b;' ?>">
                    <?= $cat ?>
                </button>
            <?php endforeach; ?>
        </div>
        <div style="position:relative;">
            <span style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#94a3b8; line-height:0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            </span>
            <input type="text" id="productSearch" placeholder="Search products..." 
                class="w-full outline-none transition-all font-medium"
                style="padding:10px 16px 10px 36px; background:#f3f3f5; border-radius:10px; border:1px solid #e2e8f0; font-size:13px; color:#1e293b;"
                onfocus="this.style.borderColor='#7c3aed'; this.style.background='#fff';"
                onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f3f3f5';">
        </div>
    </div>
    <!-- Product Grid -->
    <div class="flex-1 overflow-y-auto p-3" style="scrollbar-width:thin; scrollbar-color:#e2e8f0 transparent;">
        <div id="products-display" style="display:grid; grid-template-columns:repeat(2, 1fr); gap:10px;">
            <?php foreach ($products as $p): ?>
            <div onclick="POSState.addToCart({id: <?= $p['id'] ?>, name: '<?= addslashes($p['name_en']) ?>', price: <?= $p['sale_price'] ?>, size: '<?= $p['size'] ?>'})" 
                 class="product-card transition-all"
                 data-category="<?= htmlspecialchars($p['category'] ?? 'All') ?>"
                 data-name="<?= strtolower(htmlspecialchars($p['name_en'])) ?>"
                 style="background:#fff; border:1.5px solid #e2e8f0; border-radius:20px; padding:12px; cursor:pointer; display:flex; flex-direction:column; position:relative; overflow:hidden; transition:all 0.15s;"
                 onmouseenter="this.style.boxShadow='0 6px 20px rgba(124,58,237,0.10)'; this.style.borderColor='rgba(124,58,237,0.3)'; this.querySelector('.hover-overlay').style.opacity='1';"
                 onmouseleave="this.style.boxShadow='none'; this.style.borderColor='#e2e8f0'; this.querySelector('.hover-overlay').style.opacity='0';"
                 onmousedown="this.style.transform='scale(0.97)'"
                 onmouseup="this.style.transform='scale(1)'">
                <!-- Hover Overlay -->
                <div class="hover-overlay" style="position:absolute; inset:0; background:rgba(124,58,237,0.03); opacity:0; transition:opacity 0.2s; display:flex; align-items:center; justify-content:center; z-index:10; border-radius:20px; pointer-events:none;">
                    <div style="background:#7c3aed; color:#fff; width:30px; height:30px; border-radius:50%; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 12px rgba(124,58,237,0.4);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    </div>
                </div>
                <!-- Product Image -->
                <div style="aspect-ratio:1/1; background:rgba(221,214,254,0.18); border-radius:14px; display:flex; align-items:center; justify-content:center; margin-bottom:10px; overflow:hidden;">
                    <img src="assets/images/branding/perfume-icon.png" 
                         style="width:44px; height:44px; object-fit:contain; opacity:0.75; transition:transform 0.2s;"
                         onerror="this.style.fontSize='28px'; this.outerHTML='<span style=\'font-size:28px;\'>🧴</span>'">
                </div>
                <!-- Info -->
                <div style="flex:1; display:flex; flex-direction:column;">
                    <h3 style="font-size:12px; font-weight:700; color:#1e293b; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; line-height:1.3;"><?= htmlspecialchars($p['name_en']) ?></h3>
                    <p style="font-size:10px; color:#94a3b8; font-weight:500; margin-top:2px; margin-bottom:8px;"><?= htmlspecialchars($p['size']) ?></p>
                    
                    <div style="margin-top:auto; display:flex; justify-content:space-between; align-items:flex-end;">
                        <div>
                            <span style="font-size:13px; font-weight:900; color:#7c3aed; display:block; line-height:1.2;">Rs. <?= number_format($p['sale_price']) ?></span>
                            <div style="display:flex; align-items:center; gap:4px; margin-top:4px;">
                                <span style="width:6px; height:6px; border-radius:50%; background:<?= ($p['stock'] ?? 0) > 5 ? '#10b981' : '#ef4444' ?>; display:inline-block; flex-shrink:0;"></span>
                                <span style="font-size:9px; font-weight:700; color:#94a3b8;"><?= $p['stock'] ?? 0 ?> In Stock</span>
                            </div>
                        </div>
                        <div style="width:26px; height:26px; background:#f3f3f5; border-radius:7px; display:flex; align-items:center; justify-content:center; color:#94a3b8; flex-shrink:0;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
function filterCategory(cat) {
    document.querySelectorAll('.cat-btn').forEach(btn => {
        const isActive = btn.textContent.trim() === cat;
        btn.style.background = isActive ? '#fff' : 'transparent';
        btn.style.color = isActive ? '#7c3aed' : '#64748b';
        btn.style.boxShadow = isActive ? '0 1px 4px rgba(0,0,0,0.08)' : 'none';
    });
    document.querySelectorAll('.product-card').forEach(card => {
        const cardCat = card.dataset.category || 'All';
        const show = (cat === 'All' || cardCat === cat);
        card.style.display = show ? 'flex' : 'none';
        if (show) card.style.flexDirection = 'column';
    });
}
document.getElementById('productSearch').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('.product-card').forEach(card => {
        const show = (card.dataset.name || '').includes(q);
        card.style.display = show ? 'flex' : 'none';
        if (show) card.style.flexDirection = 'column';
    });
});
</script>