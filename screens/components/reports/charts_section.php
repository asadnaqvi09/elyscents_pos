<div style="display: grid; grid-template-columns: repeat(12, 1fr); gap: 24px; margin-bottom: 32px;">
    
    <div style="grid-column: span 8 / span 8; background: white; padding: 24px; border-radius: 24px; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.02); min-width: 0;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
            <h3 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0; tracking: -0.025em;">Sales by Hour</h3>
            <span style="font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em;" class="Urdu-font">گھنٹے کے حساب سے فروخت</span>
        </div>
        
        <div id="sales-hour-chart" style="min-height: 300px; width: 100%;"></div>
    </div>

    <div style="grid-column: span 4 / span 4; background: white; padding: 24px; border-radius: 24px; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.02); display: flex; flex-direction: column; min-width: 0;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
            <h3 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0; tracking: -0.025em;">Category</h3>
            <span style="font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em;" class="Urdu-font">زمرہ تقسیم</span>
        </div>

        <div id="category-pie-chart" style="flex: 1; display: flex; align-items: center; justify-content: center; min-height: 320px;"></div>
        
        <div id="category-legend" style="margin-top: 16px; display: flex; flex-direction: column; gap: 8px;"></div>
    </div>
</div>

<style>
    /* Responsive adjustment for tablets/mobile */
    @media (max-width: 1024px) {
        div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }
        div[style*="grid-column: span 8"], 
        div[style*="grid-column: span 4"] {
            grid-column: span 1 / span 1 !important;
        }
    }
</style>