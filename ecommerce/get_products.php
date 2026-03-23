<?php
header('Content-Type: application/json');
require_once 'config.php';

$result = $conn->query("SELECT id, name, price, image_data FROM products");

if (!$result) {
    echo json_encode(['error' => 'Query failed']);
    exit;
}

$products = [];
while ($row = $result->fetch_assoc()) {
    if (!empty($row['image_data'])) {
        $mime = mime_content_type_from_data($row['image_data']);
        $row['image_data'] = 'data:' . $mime . ';base64,' . base64_encode($row['image_data']);
    } else {
        $row['image_data'] = '';
    }
    $products[] = $row;
}

echo json_encode($products);
$conn->close();

function mime_content_type_from_data($data) {
    if (function_exists('finfo_buffer')) {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        return $finfo->buffer($data);
    }
    return 'application/octet-stream';
}
?>
