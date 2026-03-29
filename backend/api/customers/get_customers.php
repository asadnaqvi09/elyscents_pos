<?php
/**
 * get_customers.php — PDO Version
 * Returns HTML cards for the Customer Grid
 */
header('Content-Type: application/json');
require_once '../../../config/database.php';

try {
    $search = trim($_GET['search'] ?? '');
    $sql = "SELECT * FROM customers WHERE 1=1";
    $params = [];

    if (!empty($search)) {
        $sql .= " AND (name LIKE ? OR phone LIKE ? OR email LIKE ? OR id LIKE ?)";
        $like = "%{$search}%";
        $params = array_merge($params, [$like, $like, $like, $like]);
    }
    $sql .= " ORDER BY created_at DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $html = '';
    if (empty($customers)) {
        $html = '<div style="grid-column:1/-1;text-align:center;padding:100px 0;color:#94a3b8;">
                    <p style="font-weight:700;">No customers found.</p>
                 </div>';
    } else {
        foreach ($customers as $c) {
            $initials = strtoupper(substr($c['name'], 0, 1));
            $tierColor = ($c['loyalty_tier'] == 'gold') ? '#f59e0b' : (($c['loyalty_tier'] == 'silver') ? '#94a3b8' : '#cd7f32');
            
            // Safe JSON for Edit Modal
            $jsCustomer = htmlspecialchars(json_encode($c), ENT_QUOTES);

            $html .= <<<HTML
<div class="customer-card" style="background:white; border-radius:20px; border:1px solid #f1f5f9; padding:20px; transition:all 0.2s; position:relative; overflow:hidden;">
    <div style="display:flex; align-items:center; gap:16px; margin-bottom:16px;">
        <div style="width:52px; height:52px; border-radius:16px; background:#f5f3ff; color:#7c3aed; display:flex; align-items:center; justify-content:center; font-weight:900; font-size:20px;">
            {$initials}
        </div>
        <div style="flex:1;">
            <h3 style="margin:0; font-size:16px; font-weight:800; color:#1e293b;">{$c['name']}</h3>
            <p style="margin:2px 0 0; font-size:13px; color:#64748b; font-weight:600;">{$c['phone']}</p>
        </div>
        <div style="background:{$tierColor}20; color:{$tierColor}; font-size:10px; font-weight:900; padding:4px 10px; border-radius:12px; text-transform:uppercase;">
            {$c['loyalty_tier']}
        </div>
    </div>

    <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px; background:#f8fafc; padding:15px; border-radius:16px; margin-bottom:16px;">
        <div>
            <p style="margin:0; font-size:10px; color:#94a3b8; font-weight:800; text-transform:uppercase;">Total Spent</p>
            <p style="margin:2px 0 0; font-size:15px; font-weight:900; color:#1e293b;">Rs. {$c['total_purchases']}</p>
        </div>
        <div style="text-align:right;">
            <p style="margin:0; font-size:10px; color:#94a3b8; font-weight:800; text-transform:uppercase;">Points</p>
            <p style="margin:2px 0 0; font-size:15px; font-weight:900; color:#7c3aed;">{$c['points']}</p>
        </div>
    </div>

    <div style="display:flex; gap:10px;">
        <button onclick='CustomerManager.openModal({$jsCustomer})' style="flex:1; padding:10px; border-radius:12px; border:1.5px solid #e2e8f0; background:white; color:#475569; font-size:12px; font-weight:800; cursor:pointer;">
            Edit Profile
        </button>
        <button onclick='CustomerManager.viewHistory("{$c['id']}")' style="padding:10px; border-radius:12px; border:1.5px solid #7c3aed; background:#f5f3ff; color:#7c3aed; cursor:pointer;">
             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </button>
    </div>
</div>
HTML;
        }
    }

    echo json_encode(['success' => true, 'html' => $html]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}