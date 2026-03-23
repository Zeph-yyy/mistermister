// Product data
const products = {
    1: {
        title: 'Fresh Apples',
        price: '$5.99',
        description: 'Delicious and crispy organic apples, hand-picked from our partner farms. Rich in fiber and vitamin C, perfect for your daily health routine.',
    },
    2: {
        title: 'Organic Bananas',
        price: '$3.49',
        description: 'Sweet and creamy organic bananas, ripened naturally. Great source of potassium and energy. Perfect for breakfast or a healthy snack.',
    },
    3: {
        title: 'Fresh Strawberries',
        price: '$7.99',
        description: 'Juicy and sweet strawberries, packed with antioxidants. Harvested at peak ripeness for maximum flavor and nutrition.',
    },
    4: {
        title: 'Crisp Cucumbers',
        price: '$2.99',
        description: 'Fresh and hydrating cucumbers, perfect for salads and snacks. 100% organic and pesticide-free. Great for weight management.',

    },
    5: {
        title: 'Organic Carrots',
        price: '$4.49',
        description: 'Sweet, crunchy carrots loaded with beta-carotene. Perfect for cooking, juicing, or eating raw as a healthy snack.',
    },
    6: {
        title: 'Ripe Tomatoes',
        price: '$4.99',
        description: 'Farm-fresh tomatoes, naturally ripened on the vine. Perfect for salads, sauces, and cooking. Always fresh and flavorful.',
    }
};

// Get emoji based on product ID
function getEmoji(productId) {
    const emojis = {
        1: '🍎',
        2: '🍌',
        3: '🍓',
        4: '🥒',
        5: '🥕',
        6: '🍅'
    };
    return emojis[productId] || '🥗';
}

// Open modal with product details
function openModal(productId) {
    const product = products[productId];
    const modal = document.getElementById('productModal');
    
    // Set modal content
    document.getElementById('modalTitle').textContent = product.title;
    document.getElementById('modalPrice').textContent = product.price;
    document.getElementById('modalDescription').textContent = product.description;
    
    // Set modal image
    const modalImage = document.getElementById('modalImage');
    modalImage.textContent = getEmoji(productId);
    
    // Reset quantity
    document.getElementById('quantity').value = 1;
    
    // Store current product ID
    window.currentProductId = productId;
    
    // Show modal
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

// Close modal
function closeModal() {
    const modal = document.getElementById('productModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('productModal');
    if (event.target === modal) {
        closeModal();
    }
}

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
    updateCartCount();
}

// Update cart count in header
function updateCartCount() {
    const cart = getCart();
    const count = Object.values(cart).reduce((sum, item) => sum + item.quantity, 0);
    const cartCountElement = document.getElementById('cartCount');
    if (cartCountElement) {
        cartCountElement.textContent = count > 0 ? `(${count})` : '';
    }
}

// Add to cart
function addToCart() {
    const product = products[window.currentProductId];
    const quantity = parseInt(document.getElementById('quantity').value);
    const productId = window.currentProductId;
    
    let cart = getCart();
    
    if (cart[productId]) {
        cart[productId].quantity += quantity;
    } else {
        cart[productId] = {
            name: product.title,
            price: parseFloat(product.price.substring(1)),
            quantity: quantity,
            emoji: getEmoji(productId),
        };
    }
    
    saveCart(cart);
    alert(`✓ Added ${quantity} x ${product.title} to your cart!\n\nPrice: ${product.price}\nTotal: $${(parseFloat(product.price.substring(1)) * quantity).toFixed(2)}`);
    closeModal();
}

// Buy now
function buyNow() {
    const product = products[window.currentProductId];
    const quantity = parseInt(document.getElementById('quantity').value);
    const productId = window.currentProductId;
    
    // Add to cart
    let cart = getCart();
    
    if (cart[productId]) {
        cart[productId].quantity += quantity;
    } else {
        cart[productId] = {
            name: product.title,
            price: parseFloat(product.price.substring(1)),
            quantity: quantity,
            emoji: getEmoji(productId),
        };
    }
    
    saveCart(cart);
    closeModal();
    window.location.href = 'cart.php';
}

// Close modal on Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
});

// Update cart count on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
});
