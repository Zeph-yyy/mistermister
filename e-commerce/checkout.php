<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Pandora's Produce</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <div class="checkout-container">
            <h1>Checkout</h1>

            <div class="checkout-content">
                <div class="checkout-form-section">
                    <form id="checkoutForm" onsubmit="submitOrder(event)">
                        <h2>Shipping Information</h2>
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone">
                        </div>

                        <div class="form-group">
                            <label for="address">Delivery Address *</label>
                            <textarea id="address" name="address" rows="4" required></textarea>
                        </div>

                        <div class="form-group checkbox">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">I agree to the Terms & Conditions and Privacy Policy</label>
                        </div>

                        <button type="submit" class="btn-place-order">Place Order</button>
                        <button type="button" class="btn-cancel" onclick="window.location.href='cart.php'">Back to Cart</button>
                    </form>
                </div>

                <div class="checkout-summary-section">
                    <div class="summary-box">
                        <h2>Order Summary</h2>
                        <div id="checkoutItems"></div>
                        
                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span id="summarySubtotal">$0.00</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping:</span>
                            <span id="summaryShipping">$0.00</span>
                        </div>
                        <div class="summary-row">
                            <span>Tax:</span>
                            <span id="summaryTax">$0.00</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total:</span>
                            <span id="summaryTotal">$0.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="checkout.js"></script>
</body>
</html>
