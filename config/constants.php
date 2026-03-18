<?php
$query = $pdo->query("SELECT `key`, `value` FROM settings");
$settings = $query->fetchAll(PDO::FETCH_KEY_PAIR);

define('STORE_NAME', $settings['store_name'] ?? 'Elyscents');
define('CURRENCY', $settings['currency'] ?? 'PKR');
define('TAX_RATE', (float)($settings['tax_rate'] ?? 0.17));
define('TAX_NAME', $settings['tax_name'] ?? 'GST');
define('LOYALTY_ENABLED', ($settings['loyalty_enabled'] ?? 'true') === 'true');
define('POINTS_PER_100', (int)($settings['points_per_100'] ?? 1));
define('LOW_STOCK_THRESHOLD', (int)($settings['low_stock_threshold'] ?? 5));

function getLoyaltyTier($points) {
    if ($points >= 1500) return ['label' => 'Gold', 'color' => 'gold'];
    if ($points >= 500) return ['label' => 'Silver', 'color' => 'silver'];
    return ['label' => 'Bronze', 'color' => 'bronze'];
}