<?php
// Script to add products with images to database
header('Content-Type: application/json');
require_once 'config.php';

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Check if image file is uploaded
if (!isset($_FILES['image'])) {
    echo json_encode(['error' => 'No image file uploaded']);
    exit;
}

$name = $_POST['name'] ?? '';
$price = $_POST['price'] ?? 0;
$imageFile = $_FILES['image']['tmp_name'];

if (empty($name) || empty($price)) {
    echo json_encode(['error' => 'Missing product details']);
    exit;
}

if (!is_uploaded_file($imageFile)) {
    echo json_encode(['error' => 'Invalid image file']);
    exit;
}

// Read image file as binary
$imageData = file_get_contents($imageFile);

// Prepare and execute query
$stmt = $conn->prepare("INSERT INTO products (name, price, image_data) VALUES (?, ?, ?)");
$stmt->bind_param("sdb", $name, $price, $imageData);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Product added successfully', 'productId' => $stmt->insert_id]);
} else {
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
