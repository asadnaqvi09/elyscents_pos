<div style="height: 100%; display: flex; flex-direction: column; padding: 24px; overflow-y: auto; background-color: #f8fafc; font-family: 'Inter', sans-serif;">
    
    <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 32px;">
        <div>
            <h1 style="font-size: 24px; font-weight: 900; color: #0f172a; margin: 0; letter-spacing: -0.5px;">Reports & Analytics</h1>
            <p style="font-size: 14px; color: #64748b; font-weight: 600; margin: 4px 0 0 0;" class="Urdu-font">فروخت کی کارکردگی کا جائزہ</p>
        </div>

        <div style="display: flex; background: #ffffff; padding: 4px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
            <button id="btn-today" onclick="ReportsManager.fetchAnalytics('today')" 
                style="padding: 8px 24px; border-radius: 8px; border: none; font-size: 14px; font-weight: 700; cursor: pointer; transition: 0.3s; background: transparent; color: #64748b;" class="range-btn">
                Today
            </button>
            <button id="btn-week" onclick="ReportsManager.fetchAnalytics('week')" 
                style="padding: 8px 24px; border-radius: 8px; border: none; font-size: 14px; font-weight: 700; cursor: pointer; transition: 0.3s; background: transparent; color: #64748b;" class="range-btn">
                Week
            </button>
            <button id="btn-month" onclick="ReportsManager.fetchAnalytics('month')" 
                style="padding: 8px 24px; border-radius: 8px; border: none; font-size: 14px; font-weight: 700; cursor: pointer; transition: 0.3s; background: transparent; color: #64748b;" class="range-btn">
                Month
            </button>
        </div>
    </div>

    <div style="margin-bottom: 24px;">
        <?php include 'components/reports/kpi_cards.php'; ?>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; margin-bottom: 32px;">
        <?php include 'components/reports/charts_section.php'; ?>
    </div>

    <div style="background: white; border-radius: 24px; border: 1px solid #f1f5f9; padding: 24px;">
        <?php include 'components/reports/payment_methods.php'; ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="js/reports-manager.js"></script>

<style>
    /* Custom Scrollbar hide but functional */
    ::-webkit-scrollbar { width: 0px; background: transparent; }
    .range-btn:hover { background-color: #f1f5f9; }
</style>