<footer class="bottom-footer">
    <?php
    $nav_items = [
        ['id' => 'sale',      'label' => $translations['nav']['sale'][$lang],      'icon' => '🛍️'],
        ['id' => 'inventory', 'label' => $translations['nav']['inventory'][$lang], 'icon' => '📦'],
        ['id' => 'customers', 'label' => $translations['nav']['customers'][$lang], 'icon' => '👥'],
        ['id' => 'reports',   'label' => $translations['nav']['reports'][$lang],   'icon' => '📊'],
        ['id' => 'more',      'label' => $translations['nav']['more'][$lang],      'icon' => '🔘']
    ];

    foreach ($nav_items as $item):
        $isActive = ($page === $item['id'] || ($page === 'dashboard' && $item['id'] === 'sale'));
    ?>
        <a href="?page=<?= $item['id'] ?>" class="nav-link <?= $isActive ? 'active' : '' ?>">
            <span class="nav-icon <?= !$isActive ? 'grayscale' : '' ?>"><?= $item['icon'] ?></span>
            <span class="nav-label"><?= $item['label'] ?></span>
            <?php if ($isActive): ?>
                <div class="active-indicator"></div>
            <?php endif; ?>
        </a>
    <?php endforeach; ?>
</footer>