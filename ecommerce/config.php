<?php
// Database configuration
$host = 'localhost';
$db = 'ecommerce_db';
$user = 'root';
$password = '';
$port = 3306;

try {
    $conn = new mysqli($host, $user, $password, $db, $port);
    
    if ($conn->connect_error) {
        die(json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]));
    }
    
    $conn->set_charset("utf8");
} catch (Exception $e) {
    die(json_encode(['error' => 'Connection error: ' . $e->getMessage()]));
}
?>
