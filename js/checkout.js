async function processSale() {
    if (POSState.cart.length === 0) return alert("Cart khali hai!");

    const { subtotal, total } = POSState.getTotals();
    const amountPaidStr = prompt(`Total: Rs. ${total.toLocaleString()}\nCustomer Paid:`, total);
    
    if (amountPaidStr === null) return;
    const amountPaid = parseFloat(amountPaidStr);
    
    if (isNaN(amountPaid) || amountPaid < total) {
        return alert("Raqam galat ya kam hai!");
    }

    const payload = {
        items: POSState.cart,
        subtotal: subtotal,
        total: total,
        payment_method: window.selectedPaymentMethod || 'Cash',
        amount_paid: amountPaid
    };

    try {
        const response = await fetch('backend/api/transactions/create_sale.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        const result = await response.json();
        
        if (result.success) {
            // 1. Fill Receipt Data
            prepareReceiptData(result, payload);
            
            // 2. Open Print Dialog
            window.print();

            // 3. Clear State and Auto-Refresh Dashboard
            POSState.cart = [];
            POSState.updateUI();
            
            // 1.5 seconds ka delay taake UI update ho jaye phir refresh
            setTimeout(() => {
                window.location.reload(); 
            }, 1500);

        } else {
            alert("Error: " + result.message);
        }
    } catch (e) {
        console.error(e);
        alert("Network Error! Check your connection.");
    }
}

function prepareReceiptData(result, payload) {
    document.getElementById('receipt-date').innerText = new Date().toLocaleString();
    document.getElementById('receipt-txn-id').innerText = "TXN: #" + (result.transaction_id || '0000');
    
    const itemsList = document.getElementById('receipt-items-list');
    itemsList.innerHTML = payload.items.map(item => `
        <div class="receipt-row">
            <span>${item.qty} x ${item.name}</span>
            <span>${(item.price * item.qty).toLocaleString()}</span>
        </div>
    `).join('');

    document.getElementById('receipt-subtotal').innerText = payload.subtotal.toLocaleString();
    document.getElementById('receipt-discount').innerText = (payload.subtotal - payload.total).toLocaleString();
    document.getElementById('receipt-total').innerText = payload.total.toLocaleString();
    document.getElementById('receipt-paid').innerText = payload.amount_paid.toLocaleString();
    
    // Change calculation if backend doesn't provide it
    const change = payload.amount_paid - payload.total;
    document.getElementById('receipt-change').innerText = change.toLocaleString();
}