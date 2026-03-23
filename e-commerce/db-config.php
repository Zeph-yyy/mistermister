<?php
// Database Configuration
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'pandora_produce';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql_db = "CREATE DATABASE IF NOT EXISTS $db_name";
if ($conn->query($sql_db) === TRUE) {
    // Database created or already exists
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($db_name);

// Set charset to utf8
$conn->set_charset("utf8");

// Function to close connection
function closeConnection() {
    global $conn;
    $conn->close();
}
?>
