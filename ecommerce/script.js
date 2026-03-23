// Cart Management
let cart = JSON.parse(localStorage.getItem('cart')) || [];
let products = [];
let currentBuyNowProduct = null;

// DOM Elements
const productsGrid = document.getElementById('productsGrid');
const cartBtn = document.getElementById('cartBtn');
const cartSidebar = document.getElementById('cartSidebar');
const cartOverlay = document.getElementById('cartOverlay');
const closeCartBtn = document.getElementById('closeCartBtn');
const cartItems = document.getElementById('cartItems');
const cartTotal = document.getElementById('cartTotal');
const cartCount = document.getElementById('cartCount');
const checkoutBtn = document.getElementById('checkoutBtn');
const productModal = document.getElementById('productModal');
const checkoutModal = document.getElementById('checkoutModal');
const successModal = document.getElementById('successModal');
const closeProductModal = document.getElementById('closeProductModal');
const closeCheckoutModal = document.getElementById('closeCheckoutModal');
const closeSuccessBtn = document.getElementById('closeSuccessBtn');
const productForm = document.getElementById('productForm');
const checkoutForm = document.getElementById('checkoutForm');

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    loadProducts();
    updateCartUI();
    setupEventListeners();
});

// Load products from PHP backend
async function loadProducts() {
    try {
        const response = await fetch('get_products.php');
        products = await response.json();
        displayProducts();
    } catch (error) {
        console.error('Error loading products:', error);
        productsGrid.innerHTML = '<p style="grid-column: 1/-1; text-align: center;">Failed to load products</p>';
    }
}

// Display products on the page
function displayProducts() {
    productsGrid.innerHTML = '';
    products.forEach(product => {
        const productCard = document.createElement('div');
        productCard.className = 'product-card';
        // use image_data (data URI) if present, otherwise fallback to placeholder
        const imgSrc = product.image_data || 'https://via.placeholder.com/200?text=No+Image';
        productCard.innerHTML = `
            <img src="${imgSrc}" alt="${product.name}" class="product-image">
            <h3 class="product-name">${product.name}</h3>
            <div class="product-price">$${parseFloat(product.price).toFixed(2)}</div>
            <div class="product-buttons">
                <button class="add-to-cart-btn" onclick="addToCart(${product.id}, '${product.name}', ${product.price})">Add to Cart</button>
                <button class="buy-now-btn" onclick="openBuyNowModal(${product.id}, '${product.name}', ${product.price})">Buy Now</button>
            </div>
        `;
        productsGrid.appendChild(productCard);
    });
}

// Add product to cart
function addToCart(productId, productName, productPrice) {
    const existingItem = cart.find(item => item.id === productId);
    
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: productId,
            name: productName,
            price: productPrice,
            quantity: 1
        });
    }
    
    saveCart();
    updateCartUI();
    
    // Show feedback
    showNotification(`${productName} added to cart!`);
}

// Remove product from cart
function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    saveCart();
    updateCartUI();
}

// Update product quantity in cart
function updateQuantity(productId, change) {
    const item = cart.find(item => item.id === productId);
    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
            removeFromCart(productId);
        } else {
            saveCart();
            updateCartUI();
        }
    }
}

// Save cart to localStorage
function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Update cart UI
function updateCartUI() {
    // Update cart count
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartCount.textContent = totalItems;
    
    // Update cart items display
    if (cart.length === 0) {
        cartItems.innerHTML = '<div class="empty-cart"><p>Your cart is empty</p></div>';
        checkoutBtn.disabled = true;
        checkoutBtn.style.opacity = '0.5';
        checkoutBtn.style.cursor = 'not-allowed';
    } else {
        checkoutBtn.disabled = false;
        checkoutBtn.style.opacity = '1';
        checkoutBtn.style.cursor = 'pointer';
        
        cartItems.innerHTML = cart.map(item => `
            <div class="cart-item">
                <div class="cart-item-info">
                    <h4>${item.name}</h4>
                    <p>$${parseFloat(item.price).toFixed(2)}</p>
                </div>
                <div class="cart-item-actions">
                    <div class="quantity-control">
                        <button onclick="updateQuantity(${item.id}, -1)">−</button>
                        <span>${item.quantity}</span>
                        <button onclick="updateQuantity(${item.id}, 1)">+</button>
                    </div>
                    <button class="remove-item-btn" onclick="removeFromCart(${item.id})">✕</button>
                </div>
            </div>
        `).join('');
    }
    
    // Update cart total
    const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    cartTotal.textContent = '$' + total.toFixed(2);
}

// Open/close cart sidebar
function toggleCart() {
    cartSidebar.classList.toggle('active');
    cartOverlay.classList.toggle('active');
}

// Open Buy Now modal
function openBuyNowModal(productId, productName, productPrice) {
    currentBuyNowProduct = { id: productId, name: productName, price: productPrice, quantity: 1 };
    updateOrderSummary(productName, productPrice, 1, 'orderSummary');
    productModal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

// Open Checkout modal
function openCheckoutModal() {
    updateCheckoutOrderSummary();
    checkoutModal.classList.add('active');
    cartSidebar.classList.remove('active');
    cartOverlay.classList.remove('active');
    document.body.style.overflow = 'hidden';
}

// Update order summary in modals
function updateOrderSummary(productName, productPrice, quantity, summaryId) {
    const total = productPrice * quantity;
    const orderSummary = document.getElementById(summaryId);
    orderSummary.innerHTML = `
        <h4>Order Summary</h4>
        <div class="order-summary-item">
            <span>${productName} x${quantity}</span>
            <span>$${(productPrice * quantity).toFixed(2)}</span>
        </div>
        <div class="order-summary-total">
            <span>Total:</span>
            <span>$${total.toFixed(2)}</span>
        </div>
    `;
}

// Update checkout order summary
function updateCheckoutOrderSummary() {
    const checkoutOrderSummary = document.getElementById('checkoutOrderSummary');
    if (cart.length === 0) {
        checkoutOrderSummary.innerHTML = '<p>Your cart is empty</p>';
        return;
    }
    
    const itemsHTML = cart.map(item => `
        <div class="order-summary-item">
            <span>${item.name} x${item.quantity}</span>
            <span>$${(item.price * item.quantity).toFixed(2)}</span>
        </div>
    `).join('');
    
    const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    
    checkoutOrderSummary.innerHTML = `
        <h4>Order Summary</h4>
        ${itemsHTML}
        <div class="order-summary-total">
            <span>Total:</span>
            <span>$${total.toFixed(2)}</span>
        </div>
    `;
}

// Close modals
function closeModal(modal) {
    modal.classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Setup event listeners
function setupEventListeners() {
    // Cart toggle
    cartBtn.addEventListener('click', toggleCart);
    closeCartBtn.addEventListener('click', toggleCart);
    cartOverlay.addEventListener('click', toggleCart);
    
    // Checkout
    checkoutBtn.addEventListener('click', openCheckoutModal);
    
    // Modal close buttons
    closeProductModal.addEventListener('click', () => closeModal(productModal));
    closeCheckoutModal.addEventListener('click', () => closeModal(checkoutModal));
    closeSuccessBtn.addEventListener('click', () => {
        closeModal(successModal);
        location.reload(); // Refresh page after order
    });
    
    // Close modals when clicking outside
    productModal.addEventListener('click', (e) => {
        if (e.target === productModal) closeModal(productModal);
    });
    checkoutModal.addEventListener('click', (e) => {
        if (e.target === checkoutModal) closeModal(checkoutModal);
    });
    successModal.addEventListener('click', (e) => {
        if (e.target === successModal) {
            closeModal(successModal);
            location.reload();
        }
    });
    
    // Payment method toggle for Buy Now modal
    const paymentRadios = document.querySelectorAll('#productForm input[name="paymentMethod"]');
    paymentRadios.forEach(radio => {
        radio.addEventListener('change', (e) => {
            const cardGroup = document.getElementById('cardNumberGroup');
            const cardInput = cardGroup.querySelector('input[name="cardNumber"]');
            if (e.target.value === 'credit_card') {
                cardGroup.style.display = 'block';
                cardInput.required = true;
            } else {
                cardGroup.style.display = 'none';
                cardInput.required = false;
            }
        });
    });
    
    // Payment method toggle for Checkout modal
    const checkoutPaymentRadios = document.querySelectorAll('#checkoutForm input[name="paymentMethod"]');
    checkoutPaymentRadios.forEach(radio => {
        radio.addEventListener('change', (e) => {
            const cardGroup = document.getElementById('checkoutCardNumberGroup');
            const cardInput = cardGroup.querySelector('input[name="cardNumber"]');
            if (e.target.value === 'credit_card') {
                cardGroup.style.display = 'block';
                cardInput.required = true;
            } else {
                cardGroup.style.display = 'none';
                cardInput.required = false;
            }
        });
    });
    
    // Card number input - only allow digits
    const cardInputs = document.querySelectorAll('input[name="cardNumber"]');
    cardInputs.forEach(input => {
        input.addEventListener('input', (e) => {
            e.target.value = e.target.value.replace(/\D/g, '').slice(0, 8);
        });
    });
    
    // Form submission for Buy Now
    productForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = new FormData(productForm);
        const data = {
            firstName: formData.get('firstName'),
            lastName: formData.get('lastName'),
            email: formData.get('email'),
            phone: formData.get('phone'),
            address: formData.get('address'),
            city: formData.get('city'),
            postalCode: formData.get('postalCode'),
            paymentMethod: formData.get('paymentMethod'),
            cardNumber: formData.get('cardNumber'),
            products: [currentBuyNowProduct],
            totalPrice: currentBuyNowProduct.price * currentBuyNowProduct.quantity
        };
        
        // Validate payment method
        if (data.paymentMethod === 'credit_card') {
            if (!data.cardNumber || data.cardNumber.length !== 8) {
                showNotification('Please enter a valid 8-digit card number', 'error');
                return;
            }
        }
        
        await submitOrder(data);
    });
    
    // Form submission for Checkout
    checkoutForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = new FormData(checkoutForm);
        const data = {
            firstName: formData.get('firstName'),
            lastName: formData.get('lastName'),
            email: formData.get('email'),
            phone: formData.get('phone'),
            address: formData.get('address'),
            city: formData.get('city'),
            postalCode: formData.get('postalCode'),
            paymentMethod: formData.get('paymentMethod'),
            cardNumber: formData.get('cardNumber'),
            products: cart,
            totalPrice: cart.reduce((sum, item) => sum + (item.price * item.quantity), 0)
        };
        
        // Validate payment method
        if (data.paymentMethod === 'credit_card') {
            if (!data.cardNumber || data.cardNumber.length !== 8) {
                showNotification('Please enter a valid 8-digit card number', 'error');
                return;
            }
        }
        
        await submitOrder(data);
    });
}

// Submit order to backend
async function submitOrder(data) {
    try {
        const response = await fetch('checkout.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (result.success) {
            // Show success modal
            document.getElementById('orderId').textContent = result.orderId;
            closeModal(productModal);
            closeModal(checkoutModal);
            successModal.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Clear cart
            cart = [];
            saveCart();
        } else {
            showNotification(result.message || 'Error placing order', 'error');
        }
    } catch (error) {
        console.error('Error submitting order:', error);
        showNotification('Error placing order. Please try again.', 'error');
    }
}

// Show notification
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        background-color: ${type === 'success' ? '#000000' : '#cc0000'};
        color: #ffffff;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
        z-index: 2000;
        animation: slideIn 0.3s ease;
    `;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Add animations to CSS dynamically
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
