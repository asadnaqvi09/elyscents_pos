<footer class="bottom-footer">
    <?php
    $nav_items = [
        ['id' => 'sale', 'label' => 'Sale', 'icon' => '🛍️'],
        ['id' => 'inventory', 'label' => 'Inventory', 'icon' => '📦'],
        ['id' => 'customers', 'label' => 'Customers', 'icon' => '👥'],
        ['id' => 'reports', 'label' => 'Reports', 'icon' => '📊'],
        ['id' => 'more', 'label' => 'More', 'icon' => '🔘']
    ];
    foreach ($nav_items as $item):
        $isActive = ($page === $item['id']);
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