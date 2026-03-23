// Load orders from database
function loadOrders() {
    fetch('api.php?action=get_all_orders')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.orders.length > 0) {
                displayOrders(data.orders);
                document.getElementById('ordersTableContainer').style.display = 'table';
                document.getElementById('noOrdersMessage').style.display = 'none';
            } else {
                document.getElementById('ordersTableContainer').style.display = 'none';
                document.getElementById('noOrdersMessage').style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error loading orders:', error);
            alert('Error loading orders');
        });
}

// Display orders in table
function displayOrders(orders) {
    const tbody = document.getElementById('ordersTableBody');
    tbody.innerHTML = '';
    
    orders.forEach(order => {
        const row = document.createElement('tr');
        const date = new Date(order.created_at).toLocaleDateString();
        
        let statusClass = 'status-pending';
        if (order.status === 'Completed') statusClass = 'status-completed';
        if (order.status === 'Shipped') statusClass = 'status-shipped';
        
        row.innerHTML = `
            <td class="order-id">#${order.id}</td>
            <td class="order-email">${order.user_email}</td>
            <td class="order-total">$${parseFloat(order.total_amount).toFixed(2)}</td>
            <td><span class="status-badge ${statusClass}">${order.status}</span></td>
            <td class="order-date">${date}</td>
            <td>
                <button class="btn-view-details" onclick="viewOrderDetails(${order.id})">View</button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

// View order details
function viewOrderDetails(orderId) {
    fetch(`api.php?action=get_order&order_id=${orderId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayOrderModal(data.order);
            } else {
                alert('Error loading order details');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading order details');
        });
}

// Display order details in modal
function displayOrderModal(order) {
    const modal = document.getElementById('orderModal');
    const content = document.getElementById('orderDetailsContent');
    
    let itemsHTML = '<div class="order-items-list"><h4>Items:</h4>';
    order.items.forEach(item => {
        itemsHTML += `
            <div class="order-item">
                <span>${item.product_name} x${item.quantity}</span>
                <span>$${parseFloat(item.subtotal).toFixed(2)}</span>
            </div>
        `;
    });
    itemsHTML += '</div>';
    
    const date = new Date(order.created_at).toLocaleString();
    
    content.innerHTML = `
        <div class="order-detail-row">
            <span class="order-detail-label">Order ID:</span>
            <span class="order-detail-value">#${order.id}</span>
        </div>
        <div class="order-detail-row">
            <span class="order-detail-label">Customer Email:</span>
            <span class="order-detail-value">${order.user_email}</span>
        </div>
        <div class="order-detail-row">
            <span class="order-detail-label">Status:</span>
            <span class="order-detail-value">${order.status}</span>
        </div>
        <div class="order-detail-row">
            <span class="order-detail-label">Date:</span>
            <span class="order-detail-value">${date}</span>
        </div>
        ${itemsHTML}
        <div class="order-detail-row">
            <span class="order-detail-label">Subtotal:</span>
            <span class="order-detail-value">$${parseFloat(order.subtotal || 0).toFixed(2)}</span>
        </div>
        <div class="order-detail-row">
            <span class="order-detail-label">Shipping:</span>
            <span class="order-detail-value">$${parseFloat(order.shipping || 0).toFixed(2)}</span>
        </div>
        <div class="order-detail-row">
            <span class="order-detail-label">Tax:</span>
            <span class="order-detail-value">$${parseFloat(order.tax || 0).toFixed(2)}</span>
        </div>
        <div class="order-detail-row total">
            <span class="order-detail-label">Total:</span>
            <span class="order-detail-value" style="color: #ff6b9d;">$${parseFloat(order.total_amount).toFixed(2)}</span>
        </div>
    `;
    
    modal.style.display = 'block';
}

// Close order modal
function closeOrderModal() {
    const modal = document.getElementById('orderModal');
    modal.style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('orderModal');
    if (event.target === modal) {
        closeOrderModal();
    }
};

// Load orders on page load
document.addEventListener('DOMContentLoaded', function() {
    loadOrders();
});
