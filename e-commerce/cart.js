// Cart management functions
const CART_KEY = 'pandora_cart';

// Get cart from localStorage
function getCart() {
    const cart = localStorage.getItem(CART_KEY);
    return cart ? JSON.parse(cart) : {};
}

// Save cart to localStorage
function saveCart(cart) {
    localStorage.setItem(CART_KEY, JSON.stringify(cart));
}

// Add item to cart
function addToCartStorage(productId, productName, price, quantity, emoji, bgColor) {
    let cart = getCart();
    
    if (cart[productId]) {
        cart[productId].quantity += quantity;
    } else {
        cart[productId] = {
            name: productName,
            price: parseFloat(price),
            quantity: quantity,
            emoji: emoji,
            bgColor: bgColor
        };
    }
    
    saveCart(cart);
}

// Remove item from cart
function removeFromCart(productId) {
    let cart = getCart();
    delete cart[productId];
    saveCart(cart);
    renderCart();
}

// Update item quantity
function updateQuantity(productId, quantity) {
    let cart = getCart();
    if (cart[productId]) {
        cart[productId].quantity = parseInt(quantity);
        if (cart[productId].quantity <= 0) {
            delete cart[productId];
        }
        saveCart(cart);
        renderCart();
    }
}

// Calculate totals
function calculateTotals() {
    const cart = getCart();
    let subtotal = 0;
    
    Object.values(cart).forEach(item => {
        subtotal += item.price * item.quantity;
    });
    
    // Free shipping on orders over $50
    const shipping = subtotal >= 50 ? 0 : 5.99;
    const tax = subtotal * 0.08; // 8% tax
    const total = subtotal + shipping + tax;
    
    return {
        subtotal: subtotal.toFixed(2),
        shipping: shipping.toFixed(2),
        tax: tax.toFixed(2),
        total: total.toFixed(2)
    };
}

// Render cart items
function renderCart() {
    const cart = getCart();
    const cartTableBody = document.getElementById('cartTableBody');
    const emptyCartMessage = document.getElementById('emptyCartMessage');
    const cartTable = document.querySelector('.cart-table');
    
    // Clear table
    cartTableBody.innerHTML = '';
    
    // Check if cart is empty
    if (Object.keys(cart).length === 0) {
        if (cartTable) cartTable.style.display = 'none';
        emptyCartMessage.style.display = 'block';
        updateSummary();
        return;
    }
    
    if (cartTable) cartTable.style.display = 'table';
    emptyCartMessage.style.display = 'none';
    
    // Render each item
    Object.entries(cart).forEach(([productId, item]) => {
        const itemTotal = (item.price * item.quantity).toFixed(2);
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <div class="cart-item-name">
                    <span class="cart-item-emoji" style="background-color: ${item.bgColor}; padding: 8px; border-radius: 4px; display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px;">${item.emoji}</span>
                    <span>${item.name}</span>
                </div>
            </td>
            <td>
                <span class="cart-item-price">$${item.price.toFixed(2)}</span>
            </td>
            <td>
                <div class="quantity-control">
                    <button onclick="decreaseQuantity('${productId}')">-</button>
                    <input type="number" value="${item.quantity}" onchange="updateQuantity('${productId}', this.value)" min="1">
                    <button onclick="increaseQuantity('${productId}')">+</button>
                </div>
            </td>
            <td>
                <span class="cart-item-total">$${itemTotal}</span>
            </td>
            <td>
                <button class="btn-remove" onclick="removeFromCart('${productId}')">Remove</button>
            </td>
        `;
        cartTableBody.appendChild(row);
    });
    
    updateSummary();
}

// Increase quantity
function increaseQuantity(productId) {
    const cart = getCart();
    if (cart[productId]) {
        cart[productId].quantity += 1;
        saveCart(cart);
        renderCart();
    }
}

// Decrease quantity
function decreaseQuantity(productId) {
    const cart = getCart();
    if (cart[productId]) {
        cart[productId].quantity -= 1;
        if (cart[productId].quantity <= 0) {
            delete cart[productId];
        }
        saveCart(cart);
        renderCart();
    }
}

// Update order summary
function updateSummary() {
    const totals = calculateTotals();
    document.getElementById('subtotal').textContent = `$${totals.subtotal}`;
    document.getElementById('shipping').textContent = `$${totals.shipping}`;
    document.getElementById('tax').textContent = `$${totals.tax}`;
    document.getElementById('total').textContent = `$${totals.total}`;
}

// Apply promo code
// function applyPromoCode() {
//     const promoCode = document.getElementById('promoCode').value.toUpperCase();
    
//     const promoCodes = {
//         'SAVE10': 0.10,    // 10% off
//         'SAVE20': 0.20,    // 20% off
//         'FRESH': 0.15,     // 15% off
//         'ORGANIC': 0.25    // 25% off
//     };
    
//     if (promoCodes[promoCode]) {
//         const discount = promoCodes[promoCode];
//         alert(`✓ Promo code applied! ${Math.round(discount * 100)}% discount activated.`);
//         // In a real app, you would apply the discount to the calculation
//     } else {
//         alert('✗ Invalid promo code.');
//     }
// }

// Proceed to checkout
function proceedToCheckout() {
    const cart = getCart();
    if (Object.keys(cart).length === 0) {
        alert('Your cart is empty!');
        return;
    }
    
    window.location.href = 'checkout.php';
}

// Initialize cart on page load
document.addEventListener('DOMContentLoaded', function() {
    renderCart();
});
