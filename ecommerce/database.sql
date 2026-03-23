-- Create Database
CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

-- Products Table with LONGBLOB for images
CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image_data LONGBLOB
);

-- Orders Table
CREATE TABLE IF NOT EXISTS checkout_orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    address VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    postal_code VARCHAR(20),
    payment_method VARCHAR(50) NOT NULL,
    card_number VARCHAR(20),
    products JSON NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample Products (replace images with your actual images)
INSERT INTO products (name, price, image_data) VALUES
('Product 1', 29.99, NULL),
('Product 2', 49.99, NULL),
('Product 3', 39.99, NULL);
