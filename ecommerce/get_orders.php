<?php
header('Content-Type: application/json');
require_once 'config.php';

$result = $conn->query("SELECT * FROM checkout_orders ORDER BY created_at DESC");

if (!$result) {
    echo json_encode(['error' => 'Query failed']);
    exit;
}

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

echo json_encode($orders);
$conn->close();
?>
