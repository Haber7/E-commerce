-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 07, 2021 at 12:44 PM
-- Server version: 5.7.36-log
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8_bin NOT NULL,
  `address2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(85) COLLATE utf8_bin NOT NULL,
  `state` varchar(56) COLLATE utf8_bin NOT NULL,
  `zipcode` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `address`, `address2`, `city`, `state`, `zipcode`, `created_at`, `updated_at`) VALUES
(1, 'Anywhere', 'Anywhere', 'Baguio City', 'Benguet', 2600, '2021-12-02 09:56:16', '2021-12-02 09:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_bin NOT NULL COMMENT '[Order in process],[Shipped],[Cancelled],[Cart]',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orders_users1_idx` (`user_id`),
  KEY `fk_orders_payments1_idx` (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `payment_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 10, 'Cancelled', '2021-12-02 02:02:36', '2021-12-02 02:02:36'),
(4, 2, 11, 'Cancelled', '2021-12-03 12:34:28', '2021-12-03 12:34:28'),
(5, 2, 12, 'Shipped', '2021-12-04 09:51:55', '2021-12-04 09:51:55'),
(7, 2, NULL, 'Cart', '2021-12-06 00:56:47', '2021-12-06 00:56:47'),
(8, 4, 14, 'Order in process', '2021-12-06 00:59:43', '2021-12-06 00:59:43'),
(9, 3, NULL, 'Order in process', '2021-12-06 01:00:19', '2021-12-06 01:00:19'),
(10, 3, 13, 'Shipped', '2021-12-07 06:24:33', '2021-12-07 06:24:33'),
(11, 4, 15, 'Order in process', '2021-12-07 06:26:27', '2021-12-07 06:26:27'),
(12, 3, 16, 'Order in process', '2021-12-07 06:27:05', '2021-12-07 06:27:05'),
(13, 3, NULL, 'Cart', '2021-12-07 06:27:17', '2021-12-07 06:27:17'),
(14, 4, NULL, 'Cart', '2021-12-07 06:27:26', '2021-12-07 06:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orders_has_products_products1_idx` (`product_id`),
  KEY `fk_orders_has_products_orders1_idx` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(25, 1, 3, 2, '2021-12-03 07:57:56', '2021-12-03 07:57:56'),
(26, 1, 4, 1, '2021-12-03 12:26:57', '2021-12-03 12:26:57'),
(27, 4, 2, 3, '2021-12-03 12:35:26', '2021-12-03 12:35:26'),
(28, 4, 4, 3, '2021-12-03 12:35:29', '2021-12-03 12:35:29'),
(29, 5, 3, 7, '2021-12-04 09:51:55', '2021-12-04 09:51:55'),
(30, 5, 1, 2, '2021-12-04 09:59:52', '2021-12-04 09:59:52'),
(32, 7, 2, 3, '2021-12-06 00:56:47', '2021-12-06 00:56:47'),
(33, 8, 1, 3, '2021-12-06 00:59:43', '2021-12-06 00:59:43'),
(34, 9, 2, 3, '2021-12-06 01:00:19', '2021-12-06 01:00:19'),
(35, 9, 4, 2, '2021-12-06 01:00:23', '2021-12-06 01:00:23'),
(36, 8, 3, 3, '2021-12-06 01:00:48', '2021-12-06 01:00:48'),
(37, 10, 10, 3, '2021-12-07 06:24:33', '2021-12-07 06:24:33'),
(38, 11, 2, 3, '2021-12-07 06:26:27', '2021-12-07 06:26:27'),
(39, 11, 3, 3, '2021-12-07 06:26:30', '2021-12-07 06:26:30'),
(40, 12, 10, 3, '2021-12-07 06:27:05', '2021-12-07 06:27:05'),
(41, 13, 10, 3, '2021-12-07 06:27:17', '2021-12-07 06:27:17'),
(42, 14, 2, 3, '2021-12-07 06:27:26', '2021-12-07 06:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shipping_address_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payments_shipping_addresses1_idx` (`shipping_address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `shipping_address_id`, `amount`, `created_at`, `updated_at`) VALUES
(9, 21, 16, '2021-12-03 12:34:01', '2021-12-03 12:34:01'),
(10, 22, 16, '2021-12-03 12:34:16', '2021-12-03 12:34:16'),
(11, 23, 186, '2021-12-03 12:35:57', '2021-12-03 12:35:57'),
(12, 24, 20, '2021-12-05 14:28:23', '2021-12-05 14:28:23'),
(13, 25, 9, '2021-12-07 06:24:56', '2021-12-07 06:24:56'),
(14, 26, 21, '2021-12-07 06:26:23', '2021-12-07 06:26:23'),
(15, 27, 156, '2021-12-07 06:26:40', '2021-12-07 06:26:40'),
(16, 28, 9, '2021-12-07 06:27:12', '2021-12-07 06:27:12');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `category` varchar(45) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL,
  `inventory_count` int(11) NOT NULL,
  `quantity_sold` int(11) NOT NULL,
  `tags` varchar(45) COLLATE utf8_bin DEFAULT 'none' COMMENT 'Used for sorting products',
  `classification` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT 'Used for classification of similar products',
  `status` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '[Active][Inactive]',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category`, `price`, `inventory_count`, `quantity_sold`, `tags`, `classification`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Blue Cap', 'Cool Blue Cap ', 'Headwear', 5, 100, 0, 'none', 'Cap', 'Active', '2021-12-01 09:57:50', '2021-12-06 08:11:02'),
(2, 'Black Helmet', 'Cool Black Helmet', 'Headwear', 50, 100, 11, 'none', 'Helmet', 'Active', '2021-12-01 09:57:50', '2021-12-06 08:10:45'),
(3, 'Blue T-shirt', 'Cool Blue T-shirt', 'Clothes', 2, 100, 1, 'none', 'T-shirt', 'Active', '2021-12-01 09:59:33', '2021-12-06 08:11:34'),
(4, 'Black Jacket', 'Cool Black Jacket', 'Clothes', 100, 100, 50, 'none', 'Cap', 'Active', '2021-12-01 09:59:33', '2021-12-07 08:30:42'),
(10, 'Red T-shirt', 'Cool Red T-shirt', 'Clothes', 3, 100, 25, 'none', 'T-shirt', 'Active', '2021-12-06 03:30:27', '2021-12-06 08:12:24');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(255) COLLATE utf8_bin NOT NULL,
  `image_category` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'extra',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_images_products1_idx` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_url`, `image_category`, `created_at`, `updated_at`) VALUES
(1, 1, 'cap.png', 'Main', '2021-11-30 15:14:45', '2021-11-30 15:14:45'),
(2, 1, 'cap2.png', 'extra', '2021-11-30 15:14:45', '2021-11-30 15:14:45'),
(3, 2, 'helmet.png', 'Main', '2021-11-30 15:21:31', '2021-11-30 15:21:31'),
(4, 2, 'helmet2.png', 'extra', '2021-11-30 15:21:31', '2021-11-30 15:21:31'),
(5, 3, 't-shirt.png', 'Main', '2021-11-30 15:22:25', '2021-11-30 15:22:25'),
(6, 3, 't-shirt2.png', 'extra', '2021-11-30 15:22:25', '2021-11-30 15:22:25'),
(7, 4, 'jacket.png', 'Main', '2021-11-30 15:23:07', '2021-11-30 15:23:07'),
(8, 4, 'jacket2.png', 'extra', '2021-11-30 15:23:07', '2021-11-30 15:23:07'),
(9, 1, 'cap3.png', 'extra', '2021-11-30 19:29:56', '2021-11-30 19:29:56'),
(10, 1, 'cap4.png', 'extra', '2021-11-30 19:29:56', '2021-11-30 19:29:56'),
(11, 3, 't-shirt3.png', 'extra', '2021-12-01 18:05:35', '2021-12-01 18:05:35'),
(12, 10, 'red_t-shirt.png', 'Main', '2021-12-06 03:30:27', '2021-12-06 03:30:27'),
(13, 11, '', 'Main', '2021-12-07 08:24:01', '2021-12-07 08:24:01'),
(14, 12, '', 'Main', '2021-12-07 08:26:45', '2021-12-07 08:26:45'),
(15, 13, '', 'Main', '2021-12-07 08:30:23', '2021-12-07 08:30:23'),
(16, 14, '', 'Main', '2021-12-07 08:31:42', '2021-12-07 08:31:42'),
(17, 15, '', 'Main', '2021-12-07 08:51:42', '2021-12-07 08:51:42'),
(18, 16, '', 'Main', '2021-12-07 08:55:03', '2021-12-07 08:55:03'),
(19, 17, '', 'Main', '2021-12-07 12:32:16', '2021-12-07 12:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

DROP TABLE IF EXISTS `shipping_addresses`;
CREATE TABLE IF NOT EXISTS `shipping_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8_bin NOT NULL,
  `address2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(85) COLLATE utf8_bin NOT NULL,
  `state` varchar(56) COLLATE utf8_bin NOT NULL,
  `zipcode` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`id`, `address`, `address2`, `city`, `state`, `zipcode`, `created_at`, `updated_at`) VALUES
(21, 'Anywhere', '', 'Baguio City', 'Benguet', 2600, '2021-12-03 12:34:01', '2021-12-03 12:34:01'),
(22, 'Anywhere', '', 'Baguio City', 'Benguet', 2600, '2021-12-03 12:34:16', '2021-12-03 12:34:16'),
(23, 'Anywhere', '', 'Baguio City', 'Benguet', 2600, '2021-12-03 12:35:57', '2021-12-03 12:35:57'),
(24, '', '', '', '', 0, '2021-12-05 14:28:23', '2021-12-05 14:28:23'),
(25, 'Anywhere', '', 'Baguio City', 'Benguet', 2600, '2021-12-07 06:24:56', '2021-12-07 06:24:56'),
(26, 'Anywhere', '', 'Baguio City', 'Benguet', 2600, '2021-12-07 06:26:23', '2021-12-07 06:26:23'),
(27, 'Anywhere', '', 'Baguio City', 'Benguet', 2600, '2021-12-07 06:26:40', '2021-12-07 06:26:40'),
(28, 'Anywhere', '', 'Baguio City', 'Benguet', 2600, '2021-12-07 06:27:12', '2021-12-07 06:27:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address_id` int(11) NOT NULL,
  `first_name` varchar(45) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(45) COLLATE utf8_bin NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(45) COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_billing_addresses1_idx` (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `address_id`, `first_name`, `last_name`, `is_admin`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin', 1, 'admin@gmail.com', 'f6fdffe48c908deb0f4c3bd36c032e72', '2021-12-01 09:56:52', '2021-12-01 09:56:52'),
(2, 1, 'Christian', 'Haber', 0, 'ch@gmail.com', 'f6fdffe48c908deb0f4c3bd36c032e72', '2021-12-01 09:56:52', '2021-12-01 09:56:52'),
(3, 1, 'Maree', 'Peters', 0, 'am@gmail.com', 'f6fdffe48c908deb0f4c3bd36c032e72', '2021-12-06 08:58:16', '2021-12-06 08:58:16'),
(4, 1, 'Suzy', 'Nelson', 0, 'sn@gmail.com', 'f6fdffe48c908deb0f4c3bd36c032e72', '2021-12-06 08:58:16', '2021-12-06 08:58:16');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_payments1` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orders_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_orders_has_products_orders1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_orders_has_products_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_shipping_addresses1` FOREIGN KEY (`shipping_address_id`) REFERENCES `shipping_addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_billing_addresses1` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
