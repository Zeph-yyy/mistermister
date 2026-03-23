<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Pandora's Produce</title>
    <link rel="stylesheet" href="style.css">
    <style>
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <div class="cart-container">
            <h1>Shopping Cart</h1>

            <div class="cart-content">
                <div class="cart-items-section">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="cartTableBody">
                            <!-- Cart items will be populated here -->
                        </tbody>
                    </table>
                    <div id="emptyCartMessage" class="empty-cart-message" style="display: none;">
                        <p>Your cart is empty</p>
                        <a href="index.php" class="btn-continue-shopping">Continue Shopping</a>
                    </div>
                </div>

                <div class="cart-summary">
                    <div class="summary-box">
                        <h2>Order Summary</h2>
                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span id="subtotal">$0.00</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping:</span>
                            <span id="shipping">$0.00</span>
                        </div>
                        <div class="summary-row">
                            <span>Tax:</span>
                            <span id="tax">$0.00</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total:</span>
                            <span id="total">$0.00</span>
                        </div>
                        <button class="btn-checkout" onclick="proceedToCheckout()">Proceed to Checkout</button>
                        <button class="btn-continue-shopping" onclick="window.location.href='index.php'">Continue Shopping</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="cart.js"></script>
</body>
</html>
