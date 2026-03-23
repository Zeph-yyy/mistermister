<?php
require_once 'db-config.php';

// Get all products from database
function getAllProducts() {
    global $conn;
    $sql = "SELECT * FROM products ORDER BY id";
    $result = $conn->query($sql);
    
    $products = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[$row['id']] = array(
                'id' => $row['id'],
                'title' => $row['name'],
                'description' => $row['description'],
                'price' => '$' . $row['price'],
                'price_raw' => $row['price'],
                'emoji' => $row['emoji'],
                'bgColor' => $row['bg_color'],
                'stock' => isset($row['stock']) ? $row['stock'] : 0
            );
        }
    }
    return $products;
}

// Get product by ID
function getProductById($id) {
    global $conn;
    $id = intval($id);
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return array(
            'id' => $row['id'],
            'title' => $row['name'],
            'description' => $row['description'],
            'price' => '$' . $row['price'],
            'price_raw' => $row['price'],
            'emoji' => $row['emoji'],
            'bgColor' => $row['bg_color'],
            'stock' => isset($row['stock']) ? $row['stock'] : 0
        );
    }
    return null;
}

// Create order
function createOrder($userEmail, $cartData, $totals) {
    global $conn;
    
    $userEmail = $conn->real_escape_string($userEmail);
    $subtotal = floatval($totals['subtotal']);
    $tax = floatval($totals['tax']);
    $shipping = floatval($totals['shipping']);
    $total = floatval($totals['total']);
    
    // Insert order
    $sql = "INSERT INTO orders (user_email, subtotal, total_amount, tax, shipping, status) 
            VALUES ('$userEmail', $subtotal, $total, $tax, $shipping, 'Pending')";
    
    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id;
        
        // Insert order items
        foreach ($cartData as $productId => $item) {
            $productId = intval($productId);
            $productName = $conn->real_escape_string($item['name']);
            $price = floatval($item['price']);
            $quantity = intval($item['quantity']);
            $subtotal_item = $price * $quantity;
            
            $item_sql = "INSERT INTO order_items (order_id, product_id, product_name, price, quantity, subtotal) 
                        VALUES ($order_id, $productId, '$productName', $price, $quantity, $subtotal_item)";
            $conn->query($item_sql);
        }
        
        return array('success' => true, 'order_id' => $order_id);
    } else {
        return array('success' => false, 'error' => $conn->error);
    }
}

// Get order by ID
function getOrderById($order_id) {
    global $conn;
    $order_id = intval($order_id);
    
    $sql = "SELECT * FROM orders WHERE id = $order_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        
        // Get order items
        $items_sql = "SELECT * FROM order_items WHERE order_id = $order_id";
        $items_result = $conn->query($items_sql);
        
        $items = array();
        while($item = $items_result->fetch_assoc()) {
            $items[] = $item;
        }
        
        $order['items'] = $items;
        return $order;
    }
    return null;
}

// Get all orders
function getAllOrders() {
    global $conn;
    $sql = "SELECT * FROM orders ORDER BY created_at DESC";
    $result = $conn->query($sql);
    
    $orders = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }
    return $orders;
}

// Update order status
function updateOrderStatus($order_id, $status) {
    global $conn;
    $order_id = intval($order_id);
    $status = $conn->real_escape_string($status);
    
    $sql = "UPDATE orders SET status = '$status' WHERE id = $order_id";
    return $conn->query($sql);
}

// Save or update user
function saveUser($email, $name, $phone, $address) {
    global $conn;
    
    $email = $conn->real_escape_string($email);
    $name = $conn->real_escape_string($name);
    $phone = $conn->real_escape_string($phone);
    $address = $conn->real_escape_string($address);
    
    // Check if user exists
    $check_sql = "SELECT id FROM users WHERE email = '$email'";
    $check_result = $conn->query($check_sql);
    
    if ($check_result->num_rows > 0) {
        // Update existing user
        $sql = "UPDATE users SET name = '$name', phone = '$phone', address = '$address' WHERE email = '$email'";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (email, name, phone, address) VALUES ('$email', '$name', '$phone', '$address')";
    }
    
    return $conn->query($sql);
}

// Get user by email
function getUserByEmail($email) {
    global $conn;
    $email = $conn->real_escape_string($email);
    
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}
?>
