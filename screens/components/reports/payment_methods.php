<div class="chart-card">
    <div class="chart-header">
        <h3 class="chart-title">Payment Methods</h3>
        <span class="chart-subtitle-urdu Urdu-font">ادائیگی کے طریقے</span>
    </div>

    <div id="payment-methods-container" class="payment-grid">
        
        <div class="payment-item">
            <div class="payment-label-row">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div class="payment-dot" style="background-color: #10b981;"></div>
                    <span style="font-size: 14px; font-weight: 600; color: #334155;">Cash</span>
                </div>
                <span id="pay-cash-percent" class="kpi-value" style="font-size: 14px;">0%</span>
            </div>
            
            <div class="payment-progress-bg">
                <div id="pay-cash-bar" class="payment-progress-fill" style="background-color: #10b981;"></div>
            </div>
            
            <p id="pay-cash-amount" class="label-caps" style="font-size: 10px; color: #94a3b8; margin: 0;">Rs. 0</p>
        </div>

        <div class="payment-item">
            <div class="payment-label-row">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div class="payment-dot" style="background-color: #7c3aed;"></div>
                    <span style="font-size: 14px; font-weight: 600; color: #334155;">Card</span>
                </div>
                <span id="pay-card-percent" class="kpi-value" style="font-size: 14px;">0%</span>
            </div>
            
            <div class="payment-progress-bg">
                <div id="pay-card-bar" class="payment-progress-fill" style="background-color: #7c3aed;"></div>
            </div>
            
            <p id="pay-card-amount" class="label-caps" style="font-size: 10px; color: #94a3b8; margin: 0;">Rs. 0</p>
        </div>

    </div>
</div>