<link rel="stylesheet" href="css/reports/reports.css">
<link rel="stylesheet" href="css/reports/kpi_cards.css">
<link rel="stylesheet" href="css/reports/charts_section.css">
<link rel="stylesheet" href="css/reports/payment_methods.css">


<div class="reports-parent no-scrollbar">
    
    <div class="reports-header">
        <div>
            <h1 class="reports-title">Reports & Analytics</h1>
            <p class="reports-subtitle Urdu-font">فروخت کی کارکردگی کا جائزہ</p>
        </div>

        <div class="range-picker">
            <button id="btn-today" class="range-btn active" onclick="ReportsManager.fetchAnalytics('today')">
                Today
            </button>
            <button id="btn-week" class="range-btn" onclick="ReportsManager.fetchAnalytics('week')">
                Week
            </button>
            <button id="btn-month" class="range-btn" onclick="ReportsManager.fetchAnalytics('month')">
                Month
            </button>
        </div>
    </div>

    <div style="margin-bottom: 24px;">
        <?php include 'components/reports/kpi_cards.php'; ?>
    </div>

    <div class="reports-grid-section">
        <?php include 'components/reports/charts_section.php'; ?>
    </div>

    <div class="reports-white-card">
        <?php include 'components/reports/payment_methods.php'; ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="js/reports-manager.js"></script>