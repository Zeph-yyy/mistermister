<?php
header('Content-Type: application/json');
require_once 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

// Validate required fields
$required = ['firstName', 'lastName', 'email', 'address', 'city', 'paymentMethod', 'products', 'totalPrice'];
foreach ($required as $field) {
    if (empty($data[$field])) {
        echo json_encode(['success' => false, 'message' => "Missing field: $field"]);
        exit;
    }
}

// Validate card if credit card payment
if ($data['paymentMethod'] === 'credit_card') {
    if (strlen($data['cardNumber'] ?? '') !== 8) {
        echo json_encode(['success' => false, 'message' => 'Invalid card number']);
        exit;
    }
    $cardNumber = $data['cardNumber'];
} else {
    $cardNumber = null;
}

// Prepare and execute insert
$stmt = $conn->prepare("INSERT INTO checkout_orders (first_name, last_name, email, phone, address, city, postal_code, payment_method, card_number, products, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$phone = $data['phone'] ?? '';
$postalCode = $data['postalCode'] ?? '';
$products = json_encode($data['products']);

$stmt->bind_param(
    'ssssssssssd',
    $data['firstName'],
    $data['lastName'],
    $data['email'],
    $phone,
    $data['address'],
    $data['city'],
    $postalCode,
    $data['paymentMethod'],
    $cardNumber,
    $products,
    $data['totalPrice']
);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Order placed successfully', 'orderId' => $stmt->insert_id]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error placing order']);
}

$stmt->close();
$conn->close();
?>
