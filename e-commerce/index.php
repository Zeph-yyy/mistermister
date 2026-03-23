<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pandora's Produce - Fresh Organic Fruits & Vegetables</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <!-- Main Content -->
    <div class="container">
        <section class="hero">
            <h1>Welcome to Pandora's Produce</h1>
            <p>Fresh, Organic Fruits & Vegetables Delivered to Your Doorstep</p>
        </section>

        <section class="products-section">
            <h2>Featured Products</h2>
            <div class="products-grid">
                <!-- Product 1 -->
                <div class="product-card" onclick="openModal(1)">
                    <div class="product-image" style="background-color: #ff6b6b;">🍎</div>
                    <h3>Fresh Apples</h3>
                    <p class="price">$5.99</p>
                    <button class="btn-view">View Details</button>
                </div>

                <!-- Product 2 -->
                <div class="product-card" onclick="openModal(2)">
                    <div class="product-image" style="background-color: #ffd93d;">🍌</div>
                    <h3>Organic Bananas</h3>
                    <p class="price">$3.49</p>
                    <button class="btn-view">View Details</button>
                </div>

                <!-- Product 3 -->
                <div class="product-card" onclick="openModal(3)">
                    <div class="product-image" style="background-color: #ff6b9d;">🍓</div>
                    <h3>Fresh Strawberries</h3>
                    <p class="price">$7.99</p>
                    <button class="btn-view">View Details</button>
                </div>

                <!-- Product 4 -->
                <div class="product-card" onclick="openModal(4)">
                    <div class="product-image" style="background-color: #6bcf7f;">🥒</div>
                    <h3>Crisp Cucumbers</h3>
                    <p class="price">$2.99</p>
                    <button class="btn-view">View Details</button>
                </div>

                <!-- Product 5 -->
                <div class="product-card" onclick="openModal(5)">
                    <div class="product-image" style="background-color: #ff9f43;">🥕</div>
                    <h3>Organic Carrots</h3>
                    <p class="price">$4.49</p>
                    <button class="btn-view">View Details</button>
                </div>

                <!-- Product 6 -->
                <div class="product-card" onclick="openModal(6)">
                    <div class="product-image" style="background-color: #ee5a6f;">🍅</div>
                    <h3>Ripe Tomatoes</h3>
                    <p class="price">$4.99</p>
                    <button class="btn-view">View Details</button>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal -->
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
</body>
</html>
