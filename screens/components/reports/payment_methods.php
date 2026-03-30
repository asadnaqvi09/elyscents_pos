<div style="background: white; padding: 24px; border-radius: 24px; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
        <h3 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0; tracking: -0.025em;">Payment Methods</h3>
        <span style="font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em;" class="Urdu-font">ادائیگی کے طریقے</span>
    </div>

    <div id="payment-methods-container" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 32px;">
        
        <div style="display: flex; flex-direction: column; gap: 12px;">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div style="width: 8px; height: 8px; border-radius: 9999px; background-color: #10b981;"></div>
                    <span style="font-size: 14px; font-weight: 600; color: #334155;">Cash</span>
                </div>
                <span id="pay-cash-percent" style="font-size: 14px; font-weight: 900; color: #0f172a; font-variant-numeric: tabular-nums;">0%</span>
            </div>
            
            <div style="height: 8px; width: 100%; background-color: #f1f5f9; border-radius: 9999px; overflow: hidden;">
                <div id="pay-cash-bar" style="height: 100%; width: 0%; background-color: #10b981; border-radius: 9999px; transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);"></div>
            </div>
            
            <p id="pay-cash-amount" style="font-size: 10px; font-weight: 700; color: #94a3b8; margin: 0; text-transform: uppercase;">Rs. 0</p>
        </div>

        <div style="display: flex; flex-direction: column; gap: 12px;">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div style="width: 8px; height: 8px; border-radius: 9999px; background-color: #7c3aed;"></div>
                    <span style="font-size: 14px; font-weight: 600; color: #334155;">Card</span>
                </div>
                <span id="pay-card-percent" style="font-size: 14px; font-weight: 900; color: #0f172a; font-variant-numeric: tabular-nums;">0%</span>
            </div>
            
            <div style="height: 8px; width: 100%; background-color: #f1f5f9; border-radius: 9999px; overflow: hidden;">
                <div id="pay-card-bar" style="height: 100%; width: 0%; background-color: #7c3aed; border-radius: 9999px; transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);"></div>
            </div>
            
            <p id="pay-card-amount" style="font-size: 10px; font-weight: 700; color: #94a3b8; margin: 0; text-transform: uppercase;">Rs. 0</p>
        </div>

    </div>
</div>

<style>
    /* Mobile optimization */
    @media (max-width: 768px) {
        div[style*="grid-template-columns: repeat(2, 1fr)"] {
            grid-template-columns: 1fr !important;
            gap: 24px !important;
        }
    }
</style>