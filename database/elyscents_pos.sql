-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2026 at 07:25 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elyscents_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT '',
  `birthday` date DEFAULT NULL,
  `notes` text DEFAULT '',
  `loyalty_tier` enum('bronze','silver','gold') DEFAULT 'bronze',
  `total_purchases` decimal(12,2) DEFAULT 0.00,
  `points` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `birthday`, `notes`, `loyalty_tier`, `total_purchases`, `points`, `created_at`, `updated_at`) VALUES
('CUST-001', 'Ahmed Khan', '0312-3456789', 'ahmed@example.com', '1990-05-15', '', 'gold', '85000.00', 1700, '2026-03-29 19:15:32', '2026-03-29 19:15:32'),
('CUST-002', 'Sara Ali', '0321-9876543', 'sara@example.com', '1995-08-22', '', 'silver', '32000.00', 640, '2026-03-29 19:15:32', '2026-03-29 19:15:32'),
('CUST-003', 'Muhammad Usman', '0333-1122334', '', NULL, '', 'bronze', '8500.00', 170, '2026-03-29 19:15:32', '2026-03-29 19:15:32');

-- --------------------------------------------------------

--
-- Table structure for table `customer_preferences`
--

CREATE TABLE `customer_preferences` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `preference` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_preferences`
--

INSERT INTO `customer_preferences` (`id`, `customer_id`, `preference`) VALUES
(2, 'CUST-001', 'Oriental'),
(1, 'CUST-001', 'Woody'),
(3, 'CUST-002', 'Floral'),
(4, 'CUST-002', 'Fresh'),
(5, 'CUST-003', 'Citrus');

-- --------------------------------------------------------

--
-- Table structure for table `customer_transactions`
--

CREATE TABLE `customer_transactions` (
  `id` varchar(30) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `payment_method` varchar(30) DEFAULT 'cash',
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `name_ur` varchar(100) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `category` enum('All','Men','Women','Unisex') NOT NULL DEFAULT 'All',
  `size` varchar(20) NOT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `low_stock_threshold` int(11) DEFAULT 5,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name_en`, `name_ur`, `brand`, `category`, `size`, `cost_price`, `sale_price`, `stock`, `low_stock_threshold`, `image`, `created_at`) VALUES
(1, 'PRF001', 'Dior Sauvage', 'ڈیور ساواج', NULL, 'Men', '100ml', '12000.00', '18000.00', 25, 5, 'sauvage.jpg', '2026-03-25 08:21:10'),
(2, 'PRF002', 'Chanel No 5', 'چینل نمبر 5', '', 'Unisex', '50ml', '15000.00', '22000.00', 2, 5, 'chanel5.jpg', '2026-03-25 08:21:10'),
(3, 'PRF003', 'Versace Eros', 'ورساچی ایروس', NULL, 'Men', '100ml', '11000.00', '17000.00', 20, 5, 'eros.jpg', '2026-03-25 08:21:10'),
(4, 'PRF004', 'CK One', 'سی کے ون', NULL, 'Unisex', '100ml', '8000.00', '13000.00', 30, 5, 'ckone.jpg', '2026-03-25 08:21:10');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `key` varchar(50) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`key`, `value`) VALUES
('currency', 'PKR'),
('receipt_footer', 'Thank you for shopping with us!'),
('store_name', 'Elyscents POS'),
('tax_rate', '0');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(30) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `created_at`) VALUES
(1, 'admin', '$2a$12$Cp1JVxewm8wHyJzS70yaaO9Udge2dq/vuEWxC4d0o7H3NLNi68rmu', '2026-03-25 08:21:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `customer_preferences`
--
ALTER TABLE `customer_preferences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_pref` (`customer_id`,`preference`);

--
-- Indexes for table `customer_transactions`
--
ALTER TABLE `customer_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_preferences`
--
ALTER TABLE `customer_preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_preferences`
--
ALTER TABLE `customer_preferences`
  ADD CONSTRAINT `customer_preferences_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_transactions`
--
ALTER TABLE `customer_transactions`
  ADD CONSTRAINT `customer_transactions_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `customer_transactions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;