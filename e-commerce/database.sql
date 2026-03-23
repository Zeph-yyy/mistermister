-- Pandora's Produce E-Commerce Database Schema

-- Products Table
CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    emoji VARCHAR(10),
    bg_color VARCHAR(10),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) UNIQUE NOT NULL,
    name VARCHAR(100),
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_email VARCHAR(100),
    subtotal DECIMAL(10, 2),
    total_amount DECIMAL(10, 2),
    tax DECIMAL(10, 2),
    shipping DECIMAL(10, 2),
    stock INT NOT NULL DEFAULT 0,
    status VARCHAR(50) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Order Items Table
CREATE TABLE IF NOT EXISTS order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(100),
    price DECIMAL(10, 2),
INSERT INTO products (name, description, price, emoji, bg_color, stock) VALUES
('Fresh Apples', 'Delicious and crispy organic apples, hand-picked from our partner farms. Rich in fiber and vitamin C, perfect for your daily health routine.', 5.99, '🍎', '#ff6b6b', 50),
('Organic Bananas', 'Sweet and creamy organic bananas, ripened naturally. Great source of potassium and energy. Perfect for breakfast or a healthy snack.', 3.49, '🍌', '#ffd93d', 100),
('Fresh Strawberries', 'Juicy and sweet strawberries, packed with antioxidants. Harvested at peak ripeness for maximum flavor and nutrition.', 7.99, '🍓', '#ff6b9d', 30),
('Crisp Cucumbers', 'Fresh and hydrating cucumbers, perfect for salads and snacks. 100% organic and pesticide-free. Great for weight management.', 2.99, '🥒', '#6bcf7f', 40),
('Organic Carrots', 'Sweet, crunchy carrots loaded with beta-carotene. Perfect for cooking, juicing, or eating raw as a healthy snack.', 4.49, '🥕', '#ff9f43', 60),
('Ripe Tomatoes', 'Farm-fresh tomatoes, naturally ripened on the vine. Perfect for salads, sauces, and cooking. Always fresh and flavorful.', 4.99, '🍅', '#ee5a6f', 35);
    quantity INT,
    subtotal DECIMAL(10, 2),
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Insert Sample Products
INSERT INTO products (name, description, price, emoji, bg_color) VALUES
('Fresh Apples', 'Delicious and crispy organic apples, hand-picked from our partner farms. Rich in fiber and vitamin C, perfect for your daily health routine.', 5.99, '🍎', '#ff6b6b'),
('Organic Bananas', 'Sweet and creamy organic bananas, ripened naturally. Great source of potassium and energy. Perfect for breakfast or a healthy snack.', 3.49, '🍌', '#ffd93d'),
('Fresh Strawberries', 'Juicy and sweet strawberries, packed with antioxidants. Harvested at peak ripeness for maximum flavor and nutrition.', 7.99, '🍓', '#ff6b9d'),
('Crisp Cucumbers', 'Fresh and hydrating cucumbers, perfect for salads and snacks. 100% organic and pesticide-free. Great for weight management.', 2.99, '🥒', '#6bcf7f'),
('Organic Carrots', 'Sweet, crunchy carrots loaded with beta-carotene. Perfect for cooking, juicing, or eating raw as a healthy snack.', 4.49, '🥕', '#ff9f43'),
('Ripe Tomatoes', 'Farm-fresh tomatoes, naturally ripened on the vine. Perfect for salads, sauces, and cooking. Always fresh and flavorful.', 4.99, '🍅', '#ee5a6f');
