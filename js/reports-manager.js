/**
 * Reports Manager - Handles Analytics & Charts for Elyscents POS
 */
const ReportsManager = {
    salesChart: null,
    categoryChart: null,

    init() {
        console.log("Reports Manager Initialized...");
        this.initSalesChart();
        this.initCategoryChart();
        this.fetchAnalytics('today'); 
    },

    // 1. Sales by Hour (Bar Chart)
    initSalesChart() {
        const options = {
            chart: {
                type: 'bar',
                height: 300,
                toolbar: { show: false },
                fontFamily: 'Inter, sans-serif',
                animations: { enabled: true, easing: 'easeinout', speed: 800 }
            },
            series: [{ name: 'Sales', data: [] }],
            colors: ['#7C3AED'],
            plotOptions: {
                bar: { borderRadius: 6, columnWidth: '45%', distributed: false }
            },
            dataLabels: { enabled: false },
            xaxis: { 
                categories: [],
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: { 
                labels: { 
                    formatter: (val) => `Rs. ${val >= 1000 ? (val/1000).toFixed(1) + 'k' : val}` 
                } 
            },
            grid: { borderColor: '#f1f5f9', strokeDashArray: 4 }
        };

        this.salesChart = new ApexCharts(document.querySelector("#sales-hour-chart"), options);
        this.salesChart.render();
    },

    // 2. Category Breakdown (Donut)
    initCategoryChart() {
        const options = {
            chart: { type: 'donut', height: 320, fontFamily: 'Inter, sans-serif' },
            series: [],
            labels: [],
            colors: ['#10B981', '#7C3AED', '#F59E0B', '#94a3b8'], 
            legend: { position: 'bottom', fontSize: '12px', fontWeight: 600 },
            stroke: { width: 0 },
            dataLabels: { enabled: true, dropShadow: { enabled: false } },
            plotOptions: {
                pie: { 
                    donut: { 
                        size: '75%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total Sales',
                                formatter: (w) => 'Rs.' + w.globals.seriesTotals.reduce((a, b) => a + b, 0).toLocaleString()
                            }
                        }
                    } 
                }
            }
        };

        this.categoryChart = new ApexCharts(document.querySelector("#category-pie-chart"), options);
        this.categoryChart.render();
    },

    async fetchAnalytics(range) {
        this.updateTabUI(range);

        try {
            const response = await fetch(`api/reports/get_analytics.php?range=${range}`);
            const data = await response.json();

            if (data.success) {
                this.updateUI(data);
            }
        } catch (error) {
            console.error("Fetch Error:", error);
        }
    },

    updateUI(data) {
        // Update KPIs with safe navigation
        const summary = data.summary || { total_sales: 0, transactions: 0, low_stock: 0, avg_sale: 0 };
        
        document.querySelector("#stat-total-sales").innerText = `Rs. ${summary.total_sales.toLocaleString()}`;
        document.querySelector("#stat-transactions").innerText = summary.transactions;
        document.querySelector("#stat-low-stock").innerText = summary.low_stock;
        document.querySelector("#stat-avg-sale").innerText = `Rs. ${Math.round(summary.avg_sale).toLocaleString()}`;

        // Update Charts
        this.salesChart.updateSeries([{ 
            data: data.hourly_sales.map(item => item.sales) 
        }]);
        this.salesChart.updateOptions({ 
            xaxis: { categories: data.hourly_sales.map(item => item.hour) } 
        });

        this.categoryChart.updateSeries(data.categories.map(item => item.value));
        this.categoryChart.updateOptions({ labels: data.categories.map(item => item.name) });

        // Update Payment Progress Bars (New logic for animations)
        this.updatePaymentMethods(data.payment_methods);

        // Update Top Products (Clean Template)
        this.renderTopProducts(data.top_products);
    },

    updatePaymentMethods(methods) {
        if (!methods) return;
        
        methods.forEach(m => {
            const type = m.method.toLowerCase(); // 'cash' or 'card'
            const percent = m.percentage + '%';
            
            const bar = document.querySelector(`#pay-${type}-bar`);
            const pctLabel = document.querySelector(`#pay-${type}-percent`);
            const amtLabel = document.querySelector(`#pay-${type}-amount`);

            if (bar) bar.style.width = percent;
            if (pctLabel) pctLabel.innerText = percent;
            if (amtLabel) amtLabel.innerText = `Rs. ${m.amount.toLocaleString()}`;
        });
    },

    renderTopProducts(products) {
        const container = document.querySelector("#top-products-list");
        if (!container) return;

        container.innerHTML = products.length > 0 
            ? products.map(p => `
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 6px 0; border-bottom: 1px solid #f8fafc;">
                    <span style="font-size: 13px; font-weight: 600; color: #334155;">${p.product_name}</span>
                    <span style="font-size: 12px; font-weight: 800; color: #7c3aed; background: #f5f3ff; padding: 2px 8px; border-radius: 6px;">${p.sold}</span>
                </div>
            `).join('')
            : '<p style="font-size:12px; color:#94a3b8; text-align:center;">No recent sales</p>';
    },

    updateTabUI(range) {
        document.querySelectorAll('.range-btn').forEach(btn => btn.classList.remove('active'));
        const activeBtn = document.querySelector(`#btn-${range}`);
        if (activeBtn) activeBtn.classList.add('active');
    }
};

// Start initialization
document.addEventListener('DOMContentLoaded', () => ReportsManager.init());