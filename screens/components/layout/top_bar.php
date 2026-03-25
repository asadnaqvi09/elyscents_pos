<nav class="h-16 bg-surface border-b border-border shadow-sm px-6 grid grid-cols-3 items-center">
    <div class="flex items-center gap-4">
        <div class="w-11 h-11 bg-primary rounded-lg flex items-center justify-center text-white text-xl font-black shadow-md shadow-primary/20">
            E
        </div>
        <div class="flex flex-col leading-tight">
            <h1 class="text-sm font-bold text-text-primary">Elyscents</h1>
            <p class="text-[11px] text-text-secondary">Wah Branch</p>
        </div>
        <div class="ml-3 flex items-center gap-2 bg-success/10 px-3 py-1 rounded-full border border-success/20">
            <div class="w-2 h-2 bg-success rounded-full animate-pulse"></div>
            <span class="text-[10px] font-bold text-success uppercase tracking-wide">Online</span>
        </div>
    </div>

    <div class="flex flex-col items-center justify-center">
        <p id="live-clock" class="text-xl font-bold text-text-primary font-tabular tracking-tight"></p>
        <p id="live-date" class="text-[11px] text-text-secondary font-medium mt-0.5"></p>
    </div>

    <div class="flex items-center justify-end gap-3">
        <div class="flex items-center gap-2 bg-background/60 px-3 py-1.5 rounded-xl border border-border">
            <div class="flex items-center gap-1.5 text-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="3">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span class="text-[10px] font-bold uppercase">Synced</span>
            </div>
            <div class="w-px h-4 bg-border"></div>
            <div class="flex items-center gap-1 text-text-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="7" width="16" height="10" rx="2"></rect>
                    <line x1="22" y1="11" x2="22" y2="13"></line>
                </svg>
                <span class="text-[10px] font-bold text-text-primary font-tabular">100%</span>
            </div>
        </div>
        <button class="px-3 py-1.5 text-[11px] font-semibold text-text-primary border border-border rounded-lg hover:bg-gray-50 transition">
            اردو
        </button>
        <div class="flex items-center gap-2 pl-2">
            <div class="w-9 h-9 bg-primary-light/30 rounded-full flex items-center justify-center border border-primary/10">
                👑
            </div>
            <span class="text-xs font-semibold text-text-primary">Owner</span>
        </div>
    </div>
</nav>