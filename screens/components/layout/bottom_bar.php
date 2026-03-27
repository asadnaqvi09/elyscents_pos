<footer class="h-16 bg-surface border-t border-border fixed bottom-0 w-full flex items-center justify-around px-2 shadow-[0_-4px_12px_rgba(0,0,0,0.03)] z-50">
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
        <a href="?page=<?= $item['id'] ?>" 
           class="flex flex-col items-center justify-center gap-1 w-20 transition-all duration-200 <?= $isActive ? 'text-primary' : 'text-text-secondary hover:text-text-primary' ?>">
            <span class="text-xl <?= $isActive ? 'scale-110 drop-shadow-sm' : 'grayscale opacity-70' ?>"><?= $item['icon'] ?></span>
            <span class="text-[10px] font-bold uppercase tracking-tighter"><?= $item['label'] ?></span>
            <?php if ($isActive): ?>
                <div class="w-1 h-1 bg-primary rounded-full mt-0.5"></div>
            <?php endif; ?>
        </a>
    <?php endforeach; ?>
</footer>