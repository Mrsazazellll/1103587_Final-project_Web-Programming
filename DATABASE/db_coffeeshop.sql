-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 01:58 PM
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
-- Database: `db_coffeeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `temperature` enum('hot','ice') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu`, `price`, `picture`) VALUES
(3, 'Expresso', 50, 'expresso.jpg'),
(4, 'Macha Latte', 40, 'macha latte.jpg'),
(5, 'Americano', 30, 'americano.jpg'),
(6, 'Cappucino', 50, 'cappucino.jpg'),
(8, 'Creamy Machiato', 45, 'creamy machiato.jpg'),
(9, 'Coffee Latte', 50, 'coffee late.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','completed','cancelled') DEFAULT 'pending',
  `delivery_option` enum('pickup','delivery') NOT NULL DEFAULT 'pickup',
  `delivery_address` text DEFAULT NULL,
  `payment_method` enum('transfer','cash_on_delivery') NOT NULL,
  `transfer_image` varchar(255) NOT NULL DEFAULT 'Not Paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `users_id`, `total_price`, `order_date`, `status`, `delivery_option`, `delivery_address`, `payment_method`, `transfer_image`) VALUES
(35, 5, 120, '2024-12-23 12:45:56', 'completed', 'pickup', 'Coffee Shop', 'cash_on_delivery', 'Not Paid'),
(36, 5, 240, '2024-12-23 12:47:47', 'completed', 'delivery', 'indo', 'transfer', 'dadu.jpg'),
(37, 7, 70, '2024-12-23 12:54:19', 'cancelled', 'pickup', 'Coffee Shop', 'cash_on_delivery', 'Not Paid'),
(38, 7, 30, '2024-12-23 12:54:37', 'pending', 'pickup', 'Coffee Shop', 'cash_on_delivery', 'Not Paid');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `temperature` enum('hot','ice') NOT NULL,
  `price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `orders_id`, `menu_id`, `quantity`, `temperature`, `price`) VALUES
(47, 35, 4, 2, 'hot', 40),
(48, 35, 4, 1, 'ice', 40),
(50, 36, 3, 2, 'hot', 50),
(51, 36, 8, 1, 'hot', 45),
(52, 36, 8, 1, 'ice', 45),
(53, 36, 6, 1, 'hot', 50),
(57, 37, 4, 1, 'hot', 40),
(58, 37, 5, 1, 'ice', 30),
(60, 38, 5, 1, 'hot', 30);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `create_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `create_datetime`) VALUES
(5, 'alpa', 'alpa@alpa.com', 'a1f95bd4da1f9c2d95521801cf4a5952', 'user', '2024-12-19 11:55:37'),
(6, 'admin', 'admin@admin.com', 'admin1234log', 'admin', '2024-12-19 15:30:37'),
(7, 'bravo', 'bravo@bravo.com', '5719ca76c663b0113ab63520e1208610', 'user', '2024-12-20 04:29:14'),
(8, 'charlie', 'charile@charlie.com', 'ee28204683a71677225aab6e3a2ab390', 'user', '2024-12-20 17:24:06'),
(9, 'delta', 'delta@delta.com', '02699e24e3d7ba3d33efc5e791f1feca', 'user', '2024-12-21 02:38:14'),
(11, 'Echo', 'echo@echo.com', '9e8acc5d49877acdb8837b032b7b9010', 'user', '2024-12-22 05:07:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id` (`users_id`,`menu_id`,`temperature`) USING BTREE;

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_id` (`orders_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
