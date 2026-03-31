<div class="product-grid-wrapper">
    <div class="grid-header">
        <div id="category-list" class="category-container">
            <?php 
            $cats = ['All', 'Men', 'Women', 'Unisex']; 
            foreach($cats as $index => $cat): 
                $displayCat = ($lang === 'ur') ? ($translations['sale']['categories'][$cat] ?? $cat) : $cat;
            ?>
                <button onclick="filterCategory(this, '<?= $cat ?>')" 
                    class="cat-btn <?= $index === 0 ? 'active' : '' ?>">
                    <?= $displayCat ?>
                </button>
            <?php endforeach; ?>
        </div>
        
        <div class="search-box">
            <span class="search-icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            </span>
            <input type="text" id="productSearch" 
                   placeholder="<?= $translations['sale']['search_prod'][$lang] ?>" 
                   class="search-input">
        </div>
    </div>

    <div class="products-scroll-area no-scrollbar">
        <div id="products-display" class="products-grid-layout">
            <?php foreach ($products as $p): ?>
            <?php 
                $displayName = ($isUrdu && !empty($p['name_ur'])) ? $p['name_ur'] : $p['name_en'];
            ?>
            <div onclick="POSState.addToCart({id: <?= $p['id'] ?>, name: '<?= addslashes($displayName) ?>', price: <?= $p['sale_price'] ?>, size: '<?= $p['size'] ?>'})" 
                 class="product-card"
                 data-category="<?= htmlspecialchars($p['category'] ?? 'All') ?>"
                 data-name-en="<?= strtolower(htmlspecialchars($p['name_en'])) ?>"
                 data-name-ur="<?= htmlspecialchars($p['name_ur'] ?? '') ?>">
                
                <div class="img-container">
                    <img src="assets/images/branding/perfume-icon.png" 
                         style="width:44px; height:44px; object-fit:contain;"
                         onerror="this.outerHTML='<span style=\'font-size:24px;\'>🧴</span>'">
                </div>

                <div class="product-info">
                    <h3><?= htmlspecialchars($displayName) ?></h3>
                    <p><?= htmlspecialchars($p['size']) ?></p>
                    
                    <div class="price-row">
                        <div>
                            <span class="price-tag">Rs. <?= number_format($p['sale_price']) ?></span>
                            <div class="stock-indicator">
                                <span class="stock-dot" style="background: <?= ($p['stock'] ?? 0) > 5 ? '#10b981' : '#ef4444' ?>;"></span>
                                <span style="font-size:9px; font-weight:700; color:#94a3b8;">
                                    <?= $p['stock'] ?? 0 ?> <?= ($lang === 'ur') ? 'اسٹاک میں' : 'In Stock' ?>
                                </span>
                            </div>
                        </div>
                        <div class="add-icon-btn">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
function filterCategory(btn, cat) {
    document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    document.querySelectorAll('.product-card').forEach(card => {
        const cardCat = card.dataset.category || 'All';
        card.style.display = (cat === 'All' || cardCat === cat) ? 'flex' : 'none';
    });
}

document.getElementById('productSearch').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('.product-card').forEach(card => {
        const nameEn = card.dataset.nameEn || '';
        const nameUr = card.dataset.nameUr || '';
        card.style.display = (nameEn.includes(q) || nameUr.includes(q)) ? 'flex' : 'none';
    });
});
</script>