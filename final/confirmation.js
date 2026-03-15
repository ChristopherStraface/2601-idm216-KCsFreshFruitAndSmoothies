const saved = localStorage.getItem('kcs_last_order');

if (saved) {
    const order = JSON.parse(saved);

    document.getElementById('orderNumber').textContent     = order.orderNumber;
    document.getElementById('pickupTime').textContent        = order.pickupTime;
    document.getElementById('confirmSubtotal').textContent = '$' + order.subtotal;
    document.getElementById('confirmTax').textContent            = '$' + order.tax;
    document.getElementById('confirmTip').textContent            = '$' + order.tip;
    document.getElementById('confirmTotal').textContent        = '$' + order.total;

    document.getElementById('confirmationOrderItems').innerHTML = order.items.map(item => `
        <div class="order-item">
            <div class="order-item-header">
                <span>${item.qty}x ${item.name}</span>
                <span>$${item.price}</span>
            </div>
            <div class="order-item-details">${item.size}${item.details ? ', ' + item.details : ''}</div>
        </div>
    `).join('');
}

document.getElementById('returnHomeBtn').addEventListener('click', function() {
    window.location.href = 'index.php';
});

document.getElementById('pickedUpBtn').addEventListener('click', function() {
    localStorage.removeItem('kcs_last_order');
    window.location.href = 'index.php';
});
