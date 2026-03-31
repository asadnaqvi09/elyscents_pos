<?php
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../config/environment.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

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

    $catLabels = [
        'men'     => 'Men / مردانہ',
        'women'   => 'Women / خواتین',
        'unisex'  => 'Unisex / عام',
        'gifts'   => 'Gifts / تحائف',
        'testers' => 'Testers / ٹیسٹرز',
    ];

    if (empty($products)) {
        echo json_encode([
            'success' => true,
            'count'   => 0,
            'html'    => '<div style="grid-column:1/-1;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:100px 0;color:#94a3b8;">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom:20px;opacity:0.3;"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                            <p style="font-size:16px;font-weight:800;margin:0;color:#1e293b;">No products found</p>
                            <p style="font-size:13px;margin:8px 0 0;">Try adjusting your search or filters</p>
                         </div>'
        ]);
        exit;
    }

    $html = '';
    foreach ($products as $p) {
        $stock     = (int)$p['stock'];
        $threshold = (int)$p['low_stock_threshold'];
        $isOut     = $stock === 0;
        $isLow     = !$isOut && $stock <= $threshold;

        $badgeBg    = $isOut ? '#64748b' : ($isLow ? '#f59e0b' : '#10b981');
        $badgeLabel = $isOut ? 'Out of Stock' : ($isLow ? 'Low Stock' : 'In Stock');
        $stockColor = $isOut ? '#ef4444' : ($isLow ? '#f59e0b' : '#10b981');

        $catLabel  = $catLabels[$p['category']] ?? ucfirst((string)$p['category']);
        $salePrice = number_format((float)$p['sale_price']);
        
        $imgUrl = !empty($p['image']) ? "assets/images/products/" . $p['image'] : "";
        $imgHtml = $imgUrl 
            ? "<img src='{$imgUrl}' style='width:100%;height:100%;object-fit:cover;' onerror='this.style.display=\"none\";this.nextElementSibling.style.display=\"block\"'>"
            : "";
        $placeholderHtml = "<span style='font-size:40px;" . ($imgUrl ? "display:none;" : "") . "'>🧴</span>";

        $jsData = htmlspecialchars(json_encode([
            'id' => (int)$p['id'],
            'sku' => $p['sku'],
            'name_en' => $p['name_en'],
            'name_ur' => $p['name_ur'] ?? '',
            'brand' => $p['brand'] ?? '',
            'category' => $p['category'],
            'size' => $p['size'] ?? '',
            'cost_price' => (float)$p['cost_price'],
            'sale_price' => (float)$p['sale_price'],
            'stock' => $stock,
            'low_stock_threshold' => $threshold,
        ]), ENT_QUOTES);

        $nameEn = htmlspecialchars($p['name_en']);
        $nameForJs = htmlspecialchars(json_encode($nameEn), ENT_QUOTES);
        $maxView = max($stock, $threshold * 2, 1);
        $pct = min(100, round(($stock / $maxView) * 100));

        $html .= <<<HTML
        <div class="product-card" style="background:#fff; border-radius:20px; overflow:hidden; border:1px solid #f1f5f9; box-shadow:0 2px 10px rgba(0,0,0,0.03); display:flex; flex-direction:column; transition:all 0.3s ease; height:100%;"
             onmouseover="this.style.boxShadow='0 12px 30px rgba(0,0,0,0.08)'; this.style.transform='translateY(-4px)'"
             onmouseout="this.style.boxShadow='0 2px 10px rgba(0,0,0,0.03)'; this.style.transform='translateY(0)'">
            
            <div style="width:100%; height:140px; background:#f8fafc; display:flex; align-items:center; justify-content:center; position:relative; overflow:hidden;">
                {$imgHtml}{$placeholderHtml}
                <div style="position:absolute; top:12px; right:12px; background:{$badgeBg}; color:#fff; font-size:9px; font-weight:900; padding:5px 12px; border-radius:30px; text-transform:uppercase; letter-spacing:0.5px;">
                    {$badgeLabel}
                </div>
            </div>

            <div style="padding:18px; display:flex; flex-direction:column; flex:1;">
                <div style="margin-bottom:12px;">
                    <div style="display:flex; justify-content:space-between; align-items:start; gap:8px;">
                        <h3 style="margin:0; font-size:15px; font-weight:800; color:#1e293b; line-height:1.3;">{$nameEn}</h3>
                        <span style="font-size:10px; font-weight:700; color:#94a3b8; background:#f8fafc; padding:2px 6px; border-radius:6px; border:1px solid #f1f5f9;">{$p['size']}</span>
                    </div>
                    <p style="margin:4px 0 0; font-size:11px; font-weight:600; color:#64748b;">{$p['brand']} • <span style="font-family:monospace; color:#94a3b8;">{$p['sku']}</span></p>
                </div>

                <div style="margin-top:auto;">
                    <div style="display:flex; align-items:baseline; gap:4px; margin-bottom:14px;">
                        <span style="font-size:12px; font-weight:800; color:#7c3aed;">Rs.</span>
                        <span style="font-size:22px; font-weight:900; color:#1e293b; letter-spacing:-0.5px;">{$salePrice}</span>
                    </div>

                    <div style="margin-bottom:16px;">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:6px;">
                            <span style="font-size:11px; font-weight:700; color:#64748b;">Stock Status</span>
                            <span style="font-size:11px; font-weight:900; color:{$stockColor};">{$stock} Units</span>
                        </div>
                        <div style="width:100%; height:6px; background:#f1f5f9; border-radius:10px; overflow:hidden;">
                            <div style="width:{$pct}%; height:100%; background:{$stockColor}; border-radius:10px; transition:width 0.5s ease;"></div>
                        </div>
                    </div>

                    <div style="display:flex; gap:8px; padding-top:14px; border-top:1px solid #f8fafc;">
                        <button onclick='InventoryManager.openModal({$jsData})'
                                style="flex:1; height:38px; border-radius:12px; border:1.5px solid #e2e8f0; background:#fff; color:#475569; font-size:12px; font-weight:800; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:6px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4Z"/></svg>
                            Edit
                        </button>
                        <button onclick='InventoryManager.confirmDelete({$p['id']}, {$nameForJs})'
                                style="width:38px; height:38px; border-radius:12px; border:none; background:#fee2e2; color:#ef4444; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:0.2s;"
                                onmouseover="this.style.background='#ef4444'; this.style.color='#fff';"
                                onmouseout="this.style.background='#fee2e2'; this.style.color='#ef4444';">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
HTML;
    }

    echo json_encode([
        'success' => true,
        'count'   => count($products),
        'html'    => $html
    ]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}