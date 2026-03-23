<?php
require_once 'db-functions.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

if ($action === 'save_order') {
    // Get POST data
    $postData = json_decode(file_get_contents("php://input"), true);
    
    $email = $postData['email'] ?? '';
    $name = $postData['name'] ?? '';
    $phone = $postData['phone'] ?? '';
    $address = $postData['address'] ?? '';
    $cart = $postData['cart'] ?? array();
    $totals = $postData['totals'] ?? array();
    
    if (empty($email) || empty($name) || empty($cart)) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }
    
    // Save or update user
    saveUser($email, $name, $phone, $address);
    
    // Create order
    $result = createOrder($email, $cart, $totals);
    
    echo json_encode($result);
    exit;
}

if ($action === 'get_products') {
    $products = getAllProducts();
    echo json_encode(['success' => true, 'products' => $products]);
    exit;
}

if ($action === 'get_order') {
    $order_id = intval($_GET['order_id'] ?? 0);
    if ($order_id > 0) {
        $order = getOrderById($order_id);
        if ($order) {
            echo json_encode(['success' => true, 'order' => $order]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Order not found']);
        }
    }
    exit;
}

if ($action === 'get_all_orders') {
    $orders = getAllOrders();
    echo json_encode(['success' => true, 'orders' => $orders]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid action']);
?>
