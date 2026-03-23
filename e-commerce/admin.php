<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders - Pandora's Produce</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: #f5f5f5;">
    <div class="container">
        <div class="admin-container">
            <h1>📋 Admin Dashboard - Orders</h1>
            <p class="admin-subtitle">View and manage all customer orders</p>

            <div id="ordersTableContainer">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Email</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="ordersTableBody">
                        <tr>
                            <td colspan="6" style="text-align: center; color: #999; padding: 40px;">
                                <p>Loading orders...</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="noOrdersMessage" style="display: none; text-align: center; padding: 40px; background: white; border-radius: 8px; margin-top: 20px;">
                <p style="font-size: 1.1rem; color: #999;">No orders found yet</p>
            </div>

            <!-- Order Details Modal -->
            <div id="orderModal" class="modal">
                <div class="modal-content larger">
                    <span class="close" onclick="closeOrderModal()">&times;</span>
                    <div class="modal-body">
                        <h2>Order Details</h2>
                        <div id="orderDetailsContent"></div>
                        <button onclick="closeOrderModal()" class="btn-close-modal">Close</button>
                    </div>
                </div>
            </div>

            <div style="margin-top: 30px; text-align: center;">
                <a href="index.php" class="btn-back-home">Back to Home</a>
            </div>
        </div>
    </div>

    <script src="admin.js"></script>
</body>
</html>
