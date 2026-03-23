<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Pandora's Produce</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="shop-style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <div class="shop-wrapper">
            <!-- Main Shop Content -->
            <div class="shop-content">
                <div class="shop-header">
                    <h1>🛍️ Our Products</h1>
                    <p class="product-count">Showing <span id="productCount">6</span> products</p>
                </div>

                <!-- View Toggle -->
                <div class="view-toggle">
                    <button class="view-btn active" onclick="toggleView('grid')" title="Grid View">⊞ Grid</button>
                    <button class="view-btn" onclick="toggleView('list')" title="List View">≡ List</button>
                </div>

                <!-- Products Display -->
                <div class="products-container" id="productsContainer">
                    <!-- Grid View -->
                    <div id="gridView" class="products-grid">
                        <!-- Products will be loaded here by JavaScript -->
                    </div>

                    <!-- List View -->
                    <div id="listView" class="products-list" style="display: none;">
                        <!-- Products will be loaded here by JavaScript -->
                    </div>

                    <!-- Empty State -->
                    <div id="emptyState" class="empty-state" style="display: none;">
                        <p>😔 No products found matching your filters</p>
                        <button class="btn-filter" onclick="resetFilters()">Clear Filters</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Modal -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="modal-body">
                <div class="modal-image" id="modalImage"></div>
                <div class="modal-details">
                    <h2 id="modalTitle"></h2>
                    <p class="modal-price" id="modalPrice"></p>
                    <p class="modal-rating" id="modalRating"></p>
                    <p class="modal-description" id="modalDescription"></p>
                    
                    <div class="quantity-section">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" min="1" value="1">
                    </div>

                    <div class="modal-buttons">
                        <button class="btn-add-cart" onclick="addToCart()">Add to Cart</button>
                        <button class="btn-buy-now" onclick="buyNow()">Buy Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
    <script src="shop.js"></script>
</body>
</html>
