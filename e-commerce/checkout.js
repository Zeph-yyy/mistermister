// Get cart from localStorage
function getCart() {
    const cart = localStorage.getItem('pandora_cart');
    return cart ? JSON.parse(cart) : {};
}

// Calculate totals
function calculateTotals() {
    const cart = getCart();
    let subtotal = 0;
    
    Object.values(cart).forEach(item => {
        subtotal += item.price * item.quantity;
    });
    
    const shipping = subtotal >= 50 ? 0 : 5.99;
    const tax = subtotal * 0.08;
    const total = subtotal + shipping + tax;
    
    return {
        subtotal: subtotal.toFixed(2),
        shipping: shipping.toFixed(2),
        tax: tax.toFixed(2),
        total: total.toFixed(2)
    };
}

// Display order summary
function displayOrderSummary() {
    const cart = getCart();
    const totals = calculateTotals();
    const checkoutItems = document.getElementById('checkoutItems');
    
    checkoutItems.innerHTML = '';
    
    if (Object.keys(cart).length === 0) {
        checkoutItems.innerHTML = '<p style="color: #999; text-align: center; padding: 20px;">Your cart is empty</p>';
        return;
    }
    
    Object.entries(cart).forEach(([productId, item]) => {
        const itemTotal = (item.price * item.quantity).toFixed(2);
        const itemHTML = `
            <div class="checkout-item">
                <span class="checkout-item-title">${item.name}</span>
                <span class="checkout-item-qty">x${item.quantity}</span>
                <span class="checkout-item-price">$${itemTotal}</span>
            </div>
        `;
        checkoutItems.innerHTML += itemHTML;
    });
    
    document.getElementById('summarySubtotal').textContent = `$${totals.subtotal}`;
    document.getElementById('summaryShipping').textContent = `$${totals.shipping}`;
    document.getElementById('summaryTax').textContent = `$${totals.tax}`;
    document.getElementById('summaryTotal').textContent = `$${totals.total}`;
}

// Submit order
function submitOrder(event) {
    event.preventDefault();
    
    const cart = getCart();
    if (Object.keys(cart).length === 0) {
        alert('Your cart is empty!');
        return;
    }
    
    const button = document.querySelector('.btn-place-order');
    button.disabled = true;
    button.textContent = 'Processing...';
    
    const formData = {
        email: document.getElementById('email').value,
        name: document.getElementById('name').value,
        phone: document.getElementById('phone').value,
        address: document.getElementById('address').value,
        cart: cart,
        totals: calculateTotals()
    };
    
    fetch('api.php?action=save_order', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Clear cart
            localStorage.removeItem('pandora_cart');
            
            alert(`✓ Order Placed Successfully!\n\nOrder ID: ${data.order_id}\n\nThank you for shopping with Pandora's Produce!`);
            
            // Redirect to home page
            window.location.href = 'index.php';
        } else {
            alert('Error placing order: ' + data.error);
            button.disabled = false;
            button.textContent = 'Place Order';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error placing order: ' + error);
        button.disabled = false;
        button.textContent = 'Place Order';
    });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    displayOrderSummary();
});
