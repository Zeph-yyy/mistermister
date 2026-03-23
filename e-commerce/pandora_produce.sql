-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2026 at 02:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pandora_produce`
--

-- --------------------------------------------------------

--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `shipping` decimal(10,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_email`, `subtotal`, `total_amount`, `tax`, `shipping`, `status`, `created_at`) VALUES
(1, 'Rex@gmail.com', 23.97, 31.88, 1.92, 5.99, 'Pending', '2026-02-09 05:55:09'),
(2, 'iambolbie@gmail.com', 59.90, 64.69, 4.79, 0.00, 'Pending', '2026-02-09 06:11:19');

-- --------------------------------------------------------
INSERT INTO `products` (`id`, `name`, `description`, `price`, `emoji`, `bg_color`, `stock`, `created_at`) VALUES
(1, 'Fresh Apples', 'Delicious and crispy organic apples, hand-picked from our partner farms. Rich in fiber and vitamin C, perfect for your daily health routine.', 5.99, '🍎', '#ff6b6b', 50, '2026-02-09 05:54:12'),
(2, 'Organic Bananas', 'Sweet and creamy organic bananas, ripened naturally. Great source of potassium and energy. Perfect for breakfast or a healthy snack.', 3.49, '🍌', '#ffd93d', 100, '2026-02-09 05:54:12'),
(3, 'Fresh Strawberries', 'Juicy and sweet strawberries, packed with antioxidants. Harvested at peak ripeness for maximum flavor and nutrition.', 7.99, '🍓', '#ff6b9d', 30, '2026-02-09 05:54:12'),
(4, 'Crisp Cucumbers', 'Fresh and hydrating cucumbers, perfect for salads and snacks. 100% organic and pesticide-free. Great for weight management.', 2.99, '🥒', '#6bcf7f', 40, '2026-02-09 05:54:12'),
(5, 'Organic Carrots', 'Sweet, crunchy carrots loaded with beta-carotene. Perfect for cooking, juicing, or eating raw as a healthy snack.', 4.49, '🥕', '#ff9f43', 60, '2026-02-09 05:54:12'),
(6, 'Ripe Tomatoes', 'Farm-fresh tomatoes, naturally ripened on the vine. Perfect for salads, sauces, and cooking. Always fresh and flavorful.', 4.99, '🍅', '#ee5a6f', 35, '2026-02-09 05:54:12');

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`, `subtotal`) VALUES
(1, 1, 3, 'Fresh Strawberries', 7.99, 3, 23.97),
(2, 2, 1, 'Fresh Apples', 5.99, 10, 59.90);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `emoji` varchar(10) DEFAULT NULL,
  `bg_color` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `emoji`, `bg_color`, `created_at`) VALUES
(1, 'Fresh Apples', 'Delicious and crispy organic apples, hand-picked from our partner farms. Rich in fiber and vitamin C, perfect for your daily health routine.', 5.99, '🍎', '#ff6b6b', '2026-02-09 05:54:12'),
(2, 'Organic Bananas', 'Sweet and creamy organic bananas, ripened naturally. Great source of potassium and energy. Perfect for breakfast or a healthy snack.', 3.49, '🍌', '#ffd93d', '2026-02-09 05:54:12'),
(3, 'Fresh Strawberries', 'Juicy and sweet strawberries, packed with antioxidants. Harvested at peak ripeness for maximum flavor and nutrition.', 7.99, '🍓', '#ff6b9d', '2026-02-09 05:54:12'),
(4, 'Crisp Cucumbers', 'Fresh and hydrating cucumbers, perfect for salads and snacks. 100% organic and pesticide-free. Great for weight management.', 2.99, '🥒', '#6bcf7f', '2026-02-09 05:54:12'),
(5, 'Organic Carrots', 'Sweet, crunchy carrots loaded with beta-carotene. Perfect for cooking, juicing, or eating raw as a healthy snack.', 4.49, '🥕', '#ff9f43', '2026-02-09 05:54:12'),
(6, 'Ripe Tomatoes', 'Farm-fresh tomatoes, naturally ripened on the vine. Perfect for salads, sauces, and cooking. Always fresh and flavorful.', 4.99, '🍅', '#ee5a6f', '2026-02-09 05:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `phone`, `address`, `created_at`) VALUES
(1, 'Rex@gmail.com', 'Rex', '09123456789', 'Hi', '2026-02-09 05:55:09'),
(2, 'iambolbie@gmail.com', 'Rexel Luther Tojon Pili', '09123456789', 'Novaliches Q.C. (Manghula ka kung saan)', '2026-02-09 06:11:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
  ALTER TABLE `orders`
    ADD PRIMARY KEY (`id`);

  --
  -- Indexes for table `order_items`
  --
  ALTER TABLE `order_items`
    ADD PRIMARY KEY (`id`),
    ADD KEY `order_id` (`order_id`),
    ADD KEY `product_id` (`product_id`);

  --
  -- Indexes for table `products`
  --
  ALTER TABLE `products`
    ADD PRIMARY KEY (`id`);

  --
  -- Indexes for table `users`
  --
  ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `email` (`email`);

  --
  -- AUTO_INCREMENT for dumped tables
  --

  --
  -- AUTO_INCREMENT for table `orders`
  --
  ALTER TABLE `orders`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

  --
  -- AUTO_INCREMENT for table `order_items`
  --
  ALTER TABLE `order_items`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

  --
  -- AUTO_INCREMENT for table `products`
  --
  ALTER TABLE `products`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

  --
  -- AUTO_INCREMENT for table `users`
  --
  ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

  --
  -- Constraints for dumped tables
  --

  --
  -- Constraints for table `order_items`
  --
  ALTER TABLE `order_items`
    ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
    ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
  COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
