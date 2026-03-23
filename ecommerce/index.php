<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header with Cart Button -->
    <header class="header">
        <div class="header-content">
            <h1 class="logo">STORE</h1>
            <button class="cart-btn" id="cartBtn">
                <span class="cart-icon">🛒</span>
                <span class="cart-count" id="cartCount">0</span>
            </button>
        </div>
    </header>

    <!-- Main Products Section -->
    <main class="main-content">
        <section class="products-section">
            <h2>Our Products</h2>
            <div class="products-grid" id="productsGrid">
                <!-- Products will be loaded here by JavaScript -->
            </div>
        </section>
    </main>

    <!-- Cart Sidebar -->
    <aside class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h3>Shopping Cart</h3>
            <button class="close-cart" id="closeCartBtn">✕</button>
        </div>
        <div class="cart-items" id="cartItems">
            <!-- Cart items will be populated here -->
        </div>
        <div class="cart-footer">
            <div class="cart-total">
                <strong>Total:</strong>
                <span id="cartTotal">$0.00</span>
            </div>
            <button class="checkout-btn" id="checkoutBtn">Checkout</button>
        </div>
    </aside>

    <!-- Cart Overlay -->
    <div class="overlay" id="cartOverlay"></div>

    <!-- Product Modal (Buy Now) -->
    <div class="modal" id="productModal">
        <div class="modal-content">
            <button class="modal-close" id="closeProductModal">✕</button>
            <h2>Order Details</h2>
            
            <form id="productForm">
                <div class="form-row">
                    <div class="form-group">
                        <label>First Name *</label>
                        <input type="text" name="firstName" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name *</label>
                        <input type="text" name="lastName" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="tel" name="phone">
                </div>

                <div class="form-group">
                    <label>Address *</label>
                    <input type="text" name="address" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>City *</label>
                        <input type="text" name="city" required>
                    </div>
                    <div class="form-group">
                        <label>Postal Code</label>
                        <input type="text" name="postalCode">
                    </div>
                </div>

                <div class="form-group">
                    <label>Payment Method *</label>
                    <div class="payment-options">
                        <label class="checkbox-label">
                            <input type="radio" name="paymentMethod" value="cash" required>
                            Cash on Delivery
                        </label>
                        <label class="checkbox-label">
                            <input type="radio" name="paymentMethod" value="credit_card" required>
                            Credit Card
                        </label>
                    </div>
                </div>

                <div class="form-group" id="cardNumberGroup" style="display: none;">
                    <label>Card Number (8 digits) *</label>
                    <input type="text" name="cardNumber" maxlength="8" placeholder="12345678">
                </div>

                <div class="order-summary" id="orderSummary">
                    <!-- Order items summary will be here -->
                </div>

                <button type="submit" class="submit-btn">Place Order</button>
            </form>
        </div>
    </div>

    <!-- Checkout Modal (Same as Product Modal but for cart checkout) -->
    <div class="modal" id="checkoutModal">
        <div class="modal-content">
            <button class="modal-close" id="closeCheckoutModal">✕</button>
            <h2>Checkout</h2>
            
            <form id="checkoutForm">
                <div class="form-row">
                    <div class="form-group">
                        <label>First Name *</label>
                        <input type="text" name="firstName" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name *</label>
                        <input type="text" name="lastName" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="tel" name="phone">
                </div>

                <div class="form-group">
                    <label>Address *</label>
                    <input type="text" name="address" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>City *</label>
                        <input type="text" name="city" required>
                    </div>
                    <div class="form-group">
                        <label>Postal Code</label>
                        <input type="text" name="postalCode">
                    </div>
                </div>

                <div class="form-group">
                    <label>Payment Method *</label>
                    <div class="payment-options">
                        <label class="checkbox-label">
                            <input type="radio" name="paymentMethod" value="cash" required>
                            Cash on Delivery
                        </label>
                        <label class="checkbox-label">
                            <input type="radio" name="paymentMethod" value="credit_card" required>
                            Credit Card
                        </label>
                    </div>
                </div>

                <div class="form-group" id="checkoutCardNumberGroup" style="display: none;">
                    <label>Card Number (8 digits) *</label>
                    <input type="text" name="cardNumber" maxlength="8" placeholder="12345678">
                </div>

                <div class="order-summary" id="checkoutOrderSummary">
                    <!-- Order items summary will be here -->
                </div>

                <button type="submit" class="submit-btn">Place Order</button>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal" id="successModal">
        <div class="modal-content success-content">
            <h2>✓ Order Successful!</h2>
            <p>Your order has been placed successfully.</p>
            <p>Order ID: <strong id="orderId"></strong></p>
            <button class="submit-btn" id="closeSuccessBtn">Close</button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
