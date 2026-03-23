// Product data (same as in script.js)
const allProducts = {
    1: {
        title: 'Fresh Apples',
        price: '$5.99',
        price_raw: 5.99,
        description: 'Delicious and crispy organic apples, hand-picked from our partner farms. Rich in fiber and vitamin C, perfect for your daily health routine.',
        emoji: '🍎',
        bgColor: '#ff6b6b',
        category: 'fruits'
    },
    2: {
        title: 'Organic Bananas',
        price: '$3.49',
        price_raw: 3.49,
        description: 'Sweet and creamy organic bananas, ripened naturally. Great source of potassium and energy. Perfect for breakfast or a healthy snack.',
        emoji: '🍌',
        bgColor: '#ffd93d',
        category: 'fruits'
    },
    3: {
        title: 'Fresh Strawberries',
        price: '$7.99',
        price_raw: 7.99,
        description: 'Juicy and sweet strawberries, packed with antioxidants. Harvested at peak ripeness for maximum flavor and nutrition.',
        emoji: '🍓',
        bgColor: '#ff6b9d',
        category: 'fruits'
    },
    4: {
        title: 'Crisp Cucumbers',
        price: '$2.99',
        price_raw: 2.99,
        description: 'Fresh and hydrating cucumbers, perfect for salads and snacks. 100% organic and pesticide-free. Great for weight management.',
        emoji: '🥒',
        bgColor: '#6bcf7f',
        category: 'vegetables'
    },
    5: {
        title: 'Organic Carrots',
        price: '$4.49',
        price_raw: 4.49,
        description: 'Sweet, crunchy carrots loaded with beta-carotene. Perfect for cooking, juicing, or eating raw as a healthy snack.',
        emoji: '🥕',
        bgColor: '#ff9f43',
        category: 'vegetables'
    },
    6: {
        title: 'Ripe Tomatoes',
        price: '$4.99',
        price_raw: 4.99,
        description: 'Farm-fresh tomatoes, naturally ripened on the vine. Perfect for salads, sauces, and cooking. Always fresh and flavorful.',
        emoji: '🍅',
        bgColor: '#ee5a6f',
        category: 'vegetables'
    }
};

let currentFilter = 'all';
let currentSort = 'default';
let currentView = 'grid';
let maxPrice = 10;

// Initialize shop
document.addEventListener('DOMContentLoaded', function() {
    displayProducts(allProducts);
    setupPriceRange();
});

// Setup price range slider
function setupPriceRange() {
    const slider = document.getElementById('priceRange');
    const priceValue = document.getElementById('priceValue');
    
    slider.addEventListener('input', function() {
        priceValue.textContent = parseFloat(this.value).toFixed(2);
        maxPrice = parseFloat(this.value);
    });
}

// Display products
function displayProducts(products) {
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    const emptyState = document.getElementById('emptyState');
    const productCount = document.getElementById('productCount');
    
    // Clear previous content
    gridView.innerHTML = '';
    listView.innerHTML = '';
    
    // Check if there are any products
    if (Object.keys(products).length === 0) {
        emptyState.style.display = 'block';
        gridView.style.display = 'none';
        listView.style.display = 'none';
        return;
    }
    
    emptyState.style.display = 'none';
    productCount.textContent = Object.keys(products).length;
    
    // Create cards for each product
    Object.entries(products).forEach(([productId, product]) => {
        // Grid view card
        const gridCard = document.createElement('div');
        gridCard.className = 'product-card';
        gridCard.innerHTML = `
            <div class="product-image" style="background-color: ${product.bgColor};">${product.emoji}</div>
            <div class="product-details">
                <div class="product-name">${product.title}</div>
                <div class="product-price">${product.price}</div>
                <div class="product-stock">Stock: <span>${typeof product.stock !== 'undefined' ? product.stock : 'N/A'}</span></div>
                <div class="product-action">
                    <button class="btn-view-modal" onclick="openShopModal(${productId})">View</button>
                    <button class="btn-quick-add" onclick="quickAddToCart(${productId})">+ Add</button>
                </div>
            </div>
        `;
        gridView.appendChild(gridCard);
        
        // List view item
        const listItem = document.createElement('div');
        listItem.className = 'product-list-item';
        listItem.innerHTML = `
            <div class="list-item-image" style="background-color: ${product.bgColor};">${product.emoji}</div>
            <div class="list-item-info">
                <div class="list-item-name">${product.title}</div>
                <div class="list-item-description">${product.description}</div>
                <div class="list-item-stock">Stock: <span>${typeof product.stock !== 'undefined' ? product.stock : 'N/A'}</span></div>
            </div>
            <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                <div class="list-price">${product.price}</div>
                <div class="list-item-actions">
                    <button class="btn-view-modal" onclick="openShopModal(${productId})">View Details</button>
                    <button class="btn-quick-add" onclick="quickAddToCart(${productId})">Add to Cart</button>
                </div>
            </div>
        `;
        listView.appendChild(listItem);
    });
}

// Toggle between grid and list view
function toggleView(view) {
    currentView = view;
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    const buttons = document.querySelectorAll('.view-btn');
    
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    if (view === 'grid') {
        gridView.style.display = 'grid';
        listView.style.display = 'none';
    } else {
        gridView.style.display = 'none';
        listView.style.display = 'flex';
    }
}

// Filter by category
function filterByCategory(category) {
    currentFilter = category;
    
    // Update active button
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
    
    applyAllFilters();
}

// Filter by price
function filterByPrice() {
    applyAllFilters();
}

// Apply all filters
function applyAllFilters() {
    let filtered = { ...allProducts };
    
    // Filter by category
    if (currentFilter !== 'all') {
        filtered = Object.fromEntries(
            Object.entries(filtered).filter(([id, product]) => product.category === currentFilter)
        );
    }
    
    // Filter by price
    filtered = Object.fromEntries(
        Object.entries(filtered).filter(([id, product]) => product.price_raw <= maxPrice)
    );
    
    // Sort products
    filtered = sortProductsArray(filtered);
    
    displayProducts(filtered);
}

// Sort products
function sortProducts() {
    currentSort = document.getElementById('sortBy').value;
    applyAllFilters();
}

// Sort products array
function sortProductsArray(products) {
    const entries = Object.entries(products);
    
    if (currentSort === 'price-low') {
        entries.sort((a, b) => a[1].price_raw - b[1].price_raw);
    } else if (currentSort === 'price-high') {
        entries.sort((a, b) => b[1].price_raw - a[1].price_raw);
    } else if (currentSort === 'name') {
        entries.sort((a, b) => a[1].title.localeCompare(b[1].title));
    }
    
    return Object.fromEntries(entries);
}

// Reset filters
function resetFilters() {
    document.getElementById('sortBy').value = 'default';
    document.getElementById('priceRange').value = 10;
    document.getElementById('priceValue').textContent = '10.00';
    maxPrice = 10;
    currentFilter = 'all';
    currentSort = 'default';
    
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    document.querySelector('.category-btn').classList.add('active');
    
    displayProducts(allProducts);
}

// Open modal from shop
function openShopModal(productId) {
    const product = allProducts[productId];
    const modal = document.getElementById('productModal');
    
    document.getElementById('modalTitle').textContent = product.title;
    document.getElementById('modalPrice').textContent = product.price;
    document.getElementById('modalDescription').textContent = product.description;
    
    const modalImage = document.getElementById('modalImage');
    modalImage.style.backgroundColor = product.bgColor;
    modalImage.textContent = product.emoji;
    
    document.getElementById('quantity').value = 1;
    window.currentProductId = productId;
    
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

// Close modal
function closeModal() {
    const modal = document.getElementById('productModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Quick add to cart
function quickAddToCart(productId) {
    const product = allProducts[productId];
    let cart = getCart();
    
    if (cart[productId]) {
        cart[productId].quantity += 1;
    } else {
        cart[productId] = {
            name: product.title,
            price: product.price_raw,
            quantity: 1,
            emoji: product.emoji,
            bgColor: product.bgColor
        };
    }
    
    saveCart(cart);
    alert(`✓ Added 1 x ${product.title} to your cart!`);
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('productModal');
    if (event.target === modal) {
        closeModal();
    }
};

// Close modal on Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
});
