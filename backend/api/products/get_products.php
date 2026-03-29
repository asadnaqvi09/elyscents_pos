<?php
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../config/environment.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

// ── Stats mode (counters + alerts) ───────────────────────
if (($_GET['format'] ?? '') === 'stats') {
    try {
        $all = $pdo->query("SELECT stock, low_stock_threshold FROM products")->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode([
            'success'  => true,
            'total'    => count($all),
            'lowStock' => count(array_filter($all, fn($p) => $p['stock'] > 0 && $p['stock'] <= $p['low_stock_threshold'])),
            'outStock' => count(array_filter($all, fn($p) => (int)$p['stock'] === 0)),
        ]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

// ── Main Fetch ────────────────────────────────────────────
try {
    $search   = trim($_GET['search']   ?? '');
    $category = trim($_GET['category'] ?? '');
    $sql      = "SELECT * FROM products WHERE 1=1";
    $params   = [];

    if (!empty($search)) {
        $sql   .= " AND (name_en LIKE ? OR name_ur LIKE ? OR sku LIKE ? OR brand LIKE ?)";
        $like   = "%{$search}%";
        $params = array_merge($params, [$like, $like, $like, $like]);
    }
    if (!empty($category) && $category !== 'All') {
        $sql     .= " AND category = ?";
        $params[] = $category;
    }
    $sql .= " ORDER BY id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ── Category labels ───────────────────────────────────
    $catLabels = [
        'men'     => 'Men / مردانہ',
        'women'   => 'Women / خواتین',
        'unisex'  => 'Unisex / عام',
        'gifts'   => 'Gifts / تحائف',
        'testers' => 'Testers / ٹیسٹرز',
        'All'     => 'All',
    ];

    // ── Empty state ───────────────────────────────────────
    if (empty($products)) {
        echo json_encode([
            'success' => true,
            'count'   => 0,
            'html'    => '<div style="grid-column:1/-1;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:80px 0;color:#94a3b8;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:16px;opacity:0.4;"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                            <p style="font-size:15px;font-weight:700;margin:0;">No products found</p>
                            <p style="font-size:13px;margin:6px 0 0;opacity:0.7;">Try a different search or add a new product</p>
                         </div>',
            'data'    => [],
        ]);
        exit;
    }

    // ── Build HTML cards ──────────────────────────────────
    $html = '';
    foreach ($products as $p) {
        $stock     = (int)$p['stock'];
        $threshold = (int)$p['low_stock_threshold'];
        $isOut     = $stock === 0;
        $isLow     = !$isOut && $stock <= $threshold;

        $badgeBg    = $isOut ? '#6b7280' : ($isLow ? '#f59e0b' : '#10b981');
        $badgeLabel = $isOut ? 'Out of Stock' : ($isLow ? 'Low Stock' : 'In Stock');
        $stockColor = $isOut ? '#ef4444' : ($isLow ? '#f59e0b' : '#10b981');

        $catLabel  = $catLabels[$p['category']] ?? ucfirst((string)$p['category']);
        $costPrice = (float)$p['cost_price'];
        $salePrice = (float)$p['sale_price'];
        $margin    = $salePrice - $costPrice;
        $marginPct = $costPrice > 0 ? round(($margin / $costPrice) * 100) : 0;

        // Image or placeholder
        $imgHtml = !empty($p['image'])
            ? '<img src="assets/images/products/' . htmlspecialchars($p['image']) . '" style="width:100%;height:100%;object-fit:cover;" onerror="this.style.display=\'none\';this.nextElementSibling.style.display=\'block\'"><span style="font-size:48px;display:none;">🌸</span>'
            : '<span style="font-size:48px;line-height:1;">🌸</span>';

        // Safe JSON for onclick
        $jsProduct = htmlspecialchars(json_encode([
            'id'                  => (int)$p['id'],
            'sku'                 => $p['sku'],
            'name_en'             => $p['name_en'],
            'name_ur'             => $p['name_ur'] ?? '',
            'brand'               => $p['brand'] ?? '',
            'category'            => $p['category'],
            'size'                => $p['size'] ?? '',
            'cost_price'          => $costPrice,
            'sale_price'          => $salePrice,
            'stock'               => $stock,
            'low_stock_threshold' => $threshold,
        ]), ENT_QUOTES);

        $maxDisplay  = max($stock, $threshold * 3, 1);
        $pct         = min(100, round(($stock / $maxDisplay) * 100));
        $nameEn      = htmlspecialchars($p['name_en']);
        $nameUr      = htmlspecialchars($p['name_ur'] ?? '');
        $brand       = htmlspecialchars($p['brand'] ?? '');
        $size        = htmlspecialchars($p['size'] ?? '');
        $sku         = htmlspecialchars($p['sku']);
        $nameForJs = htmlspecialchars(json_encode($nameEn), ENT_QUOTES);
        $pid         = (int)$p['id'];

        $html .= <<<HTML
<div class="product-card" style="background:white;border-radius:20px;overflow:hidden;border:1px solid #f1f5f9;box-shadow:0 2px 8px rgba(0,0,0,0.04);display:flex;flex-direction:column;transition:box-shadow 0.2s,transform 0.2s;"
     onmouseover="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.1)';this.style.transform='translateY(-2px)'"
     onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)';this.style.transform='translateY(0)'">
    
    <div style="width:100%;height:120px;background:linear-gradient(135deg,#ede9fe,#faf5ff);display:flex;align-items:center;justify-content:center;position:relative;flex-shrink:0;">
        {$imgHtml}
        <div style="position:absolute;top:10px;right:10px;background:{$badgeBg};color:white;font-size:10px;font-weight:800;padding:4px 10px;border-radius:20px;text-transform:uppercase;">{$badgeLabel}</div>
    </div>

    <div style="padding:16px;display:flex;flex-direction:column;flex:1;">
        
        <h3 style="margin:0 0 4px;font-size:15px;font-weight:800;color:#1e293b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
            {$nameEn}
        </h3>

        <div style="font-size:12px;color:#64748b;margin-bottom:6px;">
            {$brand} • {$size}
        </div>

        <div style="font-size:10px;color:#94a3b8;font-family:monospace;margin-bottom:10px;">
            {$sku}
        </div>

        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
            <div style="font-size:19px;font-weight:900;color:#7c3aed;">
                Rs. {$salePrice}
            </div>
            <div style="background:#22c55e;color:white;font-size:10px;font-weight:800;padding:4px 10px;border-radius:20px;">
                In Stock
            </div>
        </div>

        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
            <div style="font-size:12px;color:#64748b;">
                Stock: <span style="font-weight:800;color:#1e293b;">{$stock}</span>
            </div>
            <div style="font-size:11px;color:#94a3b8;">
                {$catLabel}
            </div>
        </div>

        <div style="display:flex;gap:8px;margin-top:auto;padding-top:12px;border-top:1px solid #f8fafc;">
            
            <button onclick='InventoryManager.openModal({$jsProduct})'
                style="flex:1;padding:9px;border-radius:12px;border:1.5px solid #e2e8f0;background:white;color:#475569;font-size:12px;font-weight:800;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:5px;transition:all 0.2s;"
                onmouseover="this.style.borderColor='#7c3aed';this.style.color='#7c3aed';this.style.background='#f5f3ff'"
                onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#475569';this.style.background='white'">
                
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4Z"/>
                </svg>
                Edit
            </button>

            <button onclick='InventoryManager.confirmDelete({$pid}, {$nameForJs})'
    style="padding:9px 14px;border-radius:12px;border:1.5px solid #fee2e2;background:#fef2f2;color:#ef4444;font-size:12px;font-weight:800;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all 0.2s;"
    onmouseover="this.style.background='#ef4444';this.style.color='white'"
    onmouseout="this.style.background='#fef2f2';this.style.color='#ef4444'">
    
    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 6h18"/>
        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
    </svg>
</button>

        </div>
    </div>
</div>
HTML;
    }

    echo json_encode([
        'success' => true,
        'count'   => count($products),
        'html'    => $html,
        'data'    => $products,
    ]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}