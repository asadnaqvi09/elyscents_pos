/**
 * Reports Manager - Handles Analytics & Charts for Elyscents POS
 * Using ApexCharts for high-performance visualization
 */

const ReportsManager = {
    salesChart: null,
    categoryChart: null,

    // 1. Initialize Charts and Load Default Data
    init() {
        console.log("Reports Manager Initialized...");
        this.initSalesChart();
        this.initCategoryChart();
        this.fetchAnalytics('today'); // Default load
    },

    // 2. Bar Chart Setup (Sales by Hour)
    initSalesChart() {
        const options = {
            chart: {
                type: 'bar',
                height: 300,
                toolbar: { show: false },
                fontFamily: 'Inter, sans-serif'
            },
            series: [{ name: 'Sales (Rs.)', data: [] }],
            colors: ['#7C3AED'], // Purple theme
            plotOptions: {
                bar: { borderRadius: 6, columnWidth: '50%' }
            },
            dataLabels: { enabled: false },
            xaxis: { categories: [] },
            yaxis: { labels: { formatter: (val) => `Rs. ${val}` } },
            grid: { borderColor: '#f1f5f9' }
        };

        this.salesChart = new ApexCharts(document.querySelector("#sales-hour-chart"), options);
        this.salesChart.render();
    },

    // 3. Pie Chart Setup (Category Breakdown)
    initCategoryChart() {
        const options = {
            chart: { type: 'donut', height: 320, fontFamily: 'Inter, sans-serif' },
            series: [],
            labels: [],
            colors: ['#10B981', '#7C3AED', '#F59E0B', '#94a3b8'], // Men, Women, Unisex, All
            legend: { position: 'bottom' },
            dataLabels: { enabled: true, formatter: (val) => `${Math.round(val)}%` },
            plotOptions: {
                pie: { donut: { size: '70%' } }
            }
        };

        this.categoryChart = new ApexCharts(document.querySelector("#category-pie-chart"), options);
        this.categoryChart.render();
    },

    // 4. Fetch Data from API
    async fetchAnalytics(range) {
        // UI Feedback: Tab active state update
        this.updateTabUI(range);

        try {
            const response = await fetch(`api/reports/get_analytics.php?range=${range}`);
            const data = await response.json();

            if (data.success) {
                this.updateUI(data);
            } else {
                console.error("API Error:", data.message);
            }
        } catch (error) {
            console.error("Fetch Error:", error);
        }
    },

    // 5. Update HTML Elements & Charts
    updateUI(data) {
        // Update KPI Cards
        document.querySelector("#stat-total-sales").innerText = `Rs. ${data.summary.total_sales.toLocaleString()}`;
        document.querySelector("#stat-transactions").innerText = data.summary.transactions;
        document.querySelector("#stat-low-stock").innerText = data.summary.low_stock;
        document.querySelector("#stat-avg-sale").innerText = `Rs. ${Math.round(data.summary.avg_sale)}`;

        // Update Sales Bar Chart
        const hourLabels = data.hourly_sales.map(item => item.hour);
        const hourValues = data.hourly_sales.map(item => item.sales);
        this.salesChart.updateSeries([{ data: hourValues }]);
        this.salesChart.updateOptions({ xaxis: { categories: hourLabels } });

        // Update Category Pie Chart
        const catLabels = data.categories.map(item => item.name);
        const catValues = data.categories.map(item => item.value);
        this.categoryChart.updateSeries(catValues);
        this.categoryChart.updateOptions({ labels: catLabels });

        // Update Top Products List (Simple HTML injection)
        let topProductsHTML = '';
        data.top_products.forEach(p => {
            topProductsHTML += `
                <div class="flex items-center justify-between text-xs border-b border-slate-50 pb-2">
                    <span class="text-slate-700 font-medium">${p.product_name}</span>
                    <span class="font-bold text-slate-900">${p.sold} sold</span>
                </div>`;
        });
        document.querySelector("#top-products-list").innerHTML = topProductsHTML || 'No data';
    },

    updateTabUI(range) {
        document.querySelectorAll('.range-btn').forEach(btn => {
            btn.classList.remove('bg-purple-600', 'text-white', 'shadow-md');
            btn.classList.add('text-slate-600');
        });
        const activeBtn = document.querySelector(`#btn-${range}`);
        if (activeBtn) {
            activeBtn.classList.add('bg-purple-600', 'text-white', 'shadow-md');
            activeBtn.classList.remove('text-slate-600');
        }
    }
};

// Start when DOM is ready
document.addEventListener('DOMContentLoaded', () => ReportsManager.init());