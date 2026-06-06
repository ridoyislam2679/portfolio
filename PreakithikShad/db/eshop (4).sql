-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2025 at 05:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(11) NOT NULL,
  `article_name` varchar(250) NOT NULL,
  `article_dsc` text NOT NULL,
  `article_image` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `article_name`, `article_dsc`, `article_image`, `created_at`) VALUES
(1, 'ফলের উপকারিতা', 'নিয়মিত ফল খাওয়ার মাধ্যমে শরীরে ভিটামিন ও মিনারেলের চাহিদা পূরণ হয়।', 'fruit_benefits.jpg', '2025-08-31 17:02:26'),
(2, 'গুড়ের স্বাস্থ্য উপকারিতা', 'গুড় রক্ত পরিষ্কার করে এবং হজমশক্তি বৃদ্ধি করে।', 'gur_benefits.jpg', '2025-08-31 17:02:26'),
(3, 'মধুর ঔষধি গুণ', 'মধু কাশি ও গলা ব্যথা কমাতে সাহায্য করে এবং এনার্জি প্রদান করে।', 'honey_benefits.jpg', '2025-08-31 17:02:26'),
(4, 'তেলের গুরুত্ব', 'খাটি তেল রান্নার পুষ্টিগুণ বজায় রাখে এবং স্বাস্থ্যের জন্য উপকারী।', 'oil_benefits.avif', '2025-08-31 17:02:26'),
(5, 'শুকনো ফলের পুষ্টি', 'শুকনো ফল আয়রন ও ফাইবারের ভালো উৎস।', 'dry_fruits_benefits.jpg', '2025-08-31 17:02:26'),
(6, 'আমের বিভিন্ন প্রজাতি', 'বাংলাদেশে বিভিন্ন ধরনের আম পাওয়া যায়, যার各有 স্বাদ ও গন্ধ।', 'mango_varieties.jpg', '2025-08-31 17:02:26'),
(7, 'পেয়ারা খাওয়ার উপকারিতা', 'পেয়ারা ভিটামিন সি সমৃদ্ধ এবং রোগ প্রতিরোধ ক্ষমতা বৃদ্ধি করে।', 'guava_benefits.jpg', '2025-08-31 17:02:26'),
(8, 'বরই এর গুণাগুণ', 'বরই ভিটামিন সি ও অ্যান্টিঅক্সিডেন্টে ভরপুর।', 'boroi_benefits.jpg', '2025-08-31 17:02:26'),
(9, 'আচার তৈরির পদ্ধতি', 'কাঁচা আম দিয়ে সুস্বাদু আচার তৈরি করার সহজ পদ্ধতি।', 'achar_recipe.jpg', '2025-08-31 17:02:26'),
(10, 'অর্গানিক খাদ্যের গুরুত্ব', 'অর্গানিক খাবার স্বাস্থ্য ও পরিবেশের জন্য ভালো।', 'organic_food.jpg', '2025-08-31 17:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `session_id`, `product_id`, `quantity`, `added_at`) VALUES
(135, NULL, '6oc20o5rekrpu2use8rbmag0cl', 4, 5, '2025-09-11 02:44:58'),
(136, NULL, '6oc20o5rekrpu2use8rbmag0cl', 3, 3, '2025-09-11 02:49:27'),
(137, NULL, '6oc20o5rekrpu2use8rbmag0cl', 9, 2, '2025-09-11 02:55:48'),
(143, NULL, '6oc20o5rekrpu2use8rbmag0cl', 5, 2, '2025-09-11 03:03:02');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(250) NOT NULL,
  `categories_image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_image`) VALUES
(1, 'ফল', 'fruits.avif\r\n'),
(2, 'মিষ্টান্ন', 'sweets.webp'),
(3, 'তেল', 'oil.jpg'),
(4, 'গুড়', 'gur.jpg'),
(5, 'মধু', 'honey.jpg'),
(6, 'শুকনো ফল', 'dry_fruits.jpg'),
(7, 'বিভিন্ন', 'mixed.avif'),
(8, 'সবজি', 'vegetables.jpg'),
(9, 'পানীয়', 'beverages.jpg'),
(10, 'মসলা', 'spices.jpg'),
(11, 'মিশ্র', 'mixed.avif'),
(12, 'অফার পণ্য', 'pngtree-big-offer.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image_id`, `product_id`, `image`) VALUES
(1, 1, 'dragon_fruit_1.jpg'),
(2, 1, 'dragon_fruit_2.jpg'),
(3, 2, 'mango_1.jpg'),
(4, 2, 'mango_2.avif'),
(5, 3, 'date_gur_1.webp'),
(6, 3, 'date_gur_2.jpg'),
(7, 4, 'cane_gur_1.webp'),
(8, 4, 'cane_gur_2.webp'),
(9, 5, 'guava_1.jpg'),
(10, 5, 'guava_2.jpg'),
(11, 1, 'dragon_fruit_2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','confirmed','shipped','delivered','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `session_id`, `total`, `status`, `created_at`, `update_at`) VALUES
(35, 1, '1', 800.00, 'pending', '2025-09-11 01:31:11', NULL),
(36, 1, '1', 850.00, 'pending', '2025-09-11 01:34:11', NULL),
(37, 1, '1', 180.00, 'pending', '2025-09-11 01:38:07', NULL),
(38, 1, '1', 360.00, 'pending', '2025-09-11 01:40:01', NULL),
(39, NULL, '6oc20o5rekrpu2use8rbmag0cl', 350.00, 'pending', '2025-09-11 01:40:55', NULL),
(40, NULL, '6oc20o5rekrpu2use8rbmag0cl', 120.00, 'pending', '2025-09-11 01:47:53', NULL),
(41, NULL, '6oc20o5rekrpu2use8rbmag0cl', 850.00, 'pending', '2025-09-11 01:49:03', NULL),
(42, NULL, '6oc20o5rekrpu2use8rbmag0cl', 540.00, 'pending', '2025-09-11 01:50:27', NULL),
(43, NULL, '6oc20o5rekrpu2use8rbmag0cl', 400.00, 'pending', '2025-09-11 02:27:57', NULL),
(44, 1, '1', 350.00, 'pending', '2025-09-11 02:42:57', NULL),
(45, NULL, '6oc20o5rekrpu2use8rbmag0cl', 800.00, 'pending', '2025-09-11 02:43:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `orderItem_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`orderItem_id`, `order_id`, `product_id`, `price`, `quantity`) VALUES
(1, 35, 3, 400.00, 2),
(2, 36, 11, 850.00, 1),
(3, 37, 9, 180.00, 1),
(4, 38, 9, 180.00, 2),
(5, 39, 4, 350.00, 1),
(6, 40, 6, 120.00, 1),
(7, 41, 11, 850.00, 1),
(8, 42, 9, 180.00, 3),
(9, 43, 3, 400.00, 1),
(10, 44, 4, 350.00, 1),
(11, 45, 3, 400.00, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_users`
--

CREATE TABLE `order_users` (
  `order_user_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_number` varchar(250) NOT NULL,
  `user_address` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_users`
--

INSERT INTO `order_users` (`order_user_id`, `session_id`, `user_name`, `user_number`, `user_address`, `created_at`) VALUES
(7, '6oc20o5rekrpu2use8rbmag0cl', 'hridoy', '01893331426', 'waliya', '2025-09-11 01:40:55'),
(8, '6oc20o5rekrpu2use8rbmag0cl', 'hridoy', '01893331426', 'waliya', '2025-09-11 01:47:53'),
(9, '6oc20o5rekrpu2use8rbmag0cl', 'hridoy', '01893331426', 'dilalpur', '2025-09-11 01:49:03'),
(10, '6oc20o5rekrpu2use8rbmag0cl', 'hridoy', '01893331426', 'dilalpur', '2025-09-11 01:50:27'),
(11, '6oc20o5rekrpu2use8rbmag0cl', 'hridoy', '01893331426', 'uniqId', '2025-09-11 02:26:43'),
(12, '6oc20o5rekrpu2use8rbmag0cl', 'hridoy', '01893331426', 'uniqId', '2025-09-11 02:27:57'),
(13, '6oc20o5rekrpu2use8rbmag0cl', 'hridoy', '01893331426', 'deg', '2025-09-11 02:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(250) DEFAULT NULL,
  `phone_number` varchar(15) NOT NULL,
  `method` varchar(255) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `trxId` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`payment_id`, `order_id`, `user_id`, `session_id`, `phone_number`, `method`, `amount`, `trxId`, `created_at`) VALUES
(5, 0, 1, NULL, '', 'cash_on_delivery', '800', '', '2025-09-11 01:31:11'),
(6, 0, 1, NULL, '01763029679', 'Bikash', '900', '950id', '2025-09-11 01:34:11'),
(7, 0, 1, NULL, '01763029679', 'Nogod', '230', '230Id', '2025-09-11 01:38:07'),
(8, 0, 1, NULL, '', 'cash_on_delivery', '360', '', '2025-09-11 01:40:01'),
(9, 0, NULL, '6oc20o5rekrpu2use8rbmag0cl', '', 'cash_on_delivery', '350', '', '2025-09-11 01:40:55'),
(10, 0, NULL, '6oc20o5rekrpu2use8rbmag0cl', '01893331426', 'Bikash', '170', '170Id', '2025-09-11 01:47:53'),
(11, 0, NULL, '6oc20o5rekrpu2use8rbmag0cl', '', 'cash_on_delivery', '850', '', '2025-09-11 01:49:03'),
(12, 0, NULL, '6oc20o5rekrpu2use8rbmag0cl', '01893331426', 'Nogod', '590', '590Id', '2025-09-11 01:50:27'),
(13, NULL, NULL, '6oc20o5rekrpu2use8rbmag0cl', '', 'cash_on_delivery', '400', 'COD_68c233ad38d70', '2025-09-11 02:27:57'),
(14, 44, 1, NULL, '', 'cash_on_delivery', '350', 'COD_68c23731c04d6', '2025-09-11 02:42:57'),
(15, 45, NULL, '6oc20o5rekrpu2use8rbmag0cl', '01893331426', 'Bikash', '8500', '850Id', '2025-09-11 02:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) NOT NULL,
  `product_dsc` text NOT NULL,
  `product_stock` enum('Available','Limited','Out of stock','') NOT NULL DEFAULT 'Available',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `categories_id`, `product_name`, `product_price`, `old_price`, `product_dsc`, `product_stock`, `image`, `created_at`) VALUES
(1, 1, 'ড্রাগন ফল', 250.00, 300.00, 'তাজা ও সুস্বাদু ড্রাগন ফল, ভিটামিন সি সমৃদ্ধ', 'Available', 'dragon_fruit_2.jpg', '2025-08-31 17:02:25'),
(2, 1, 'আম', 150.00, 180.00, 'সুগন্ধি ও মিষ্টি ফজলি আম', 'Limited', 'mango_1.jpg', '2025-08-31 17:02:25'),
(3, 4, 'খেজুরের গুড়', 400.00, 450.00, 'প্রাকৃতিক ও অর্গানিক খেজুরের গুড়', 'Available', 'date_gur_1.webp', '2025-08-31 17:02:25'),
(4, 4, 'আখের গুড়', 350.00, 400.00, 'শুদ্ধ আখের রস থেকে তৈরি তাজা গুড়', 'Available', 'cane_gur_1.webp', '2025-08-31 17:02:25'),
(5, 1, 'পেয়ারা ফল', 80.00, 100.00, 'তাজা ও ভিটামিন সমৃদ্ধ পেয়ারা', 'Available', 'guava_1.jpg', '2025-08-31 17:02:25'),
(6, 1, 'বরই', 120.00, 150.00, 'টক-মিষ্টি স্বাদের তাজা বরই', 'Limited', 'boroi.jpg', '2025-08-31 17:02:25'),
(7, 1, 'নাটোরের কাঁচা আম', 200.00, 250.00, 'নাটোরের বিখ্যাত কাঁচা আম, আচার তৈরির জন্য উত্তম', 'Available', 'mango_2.avif', '2025-08-31 17:02:25'),
(8, 5, 'মধু', 500.00, 600.00, 'প্রাকৃতিক ও খাঁটি মধু, রোগ প্রতিরোধ ক্ষমতা বৃদ্ধি করে', 'Available', 'honey.jpg', '2025-08-31 17:02:25'),
(9, 3, 'খাটি সরিষার তেল', 180.00, 200.00, '১০০% খাটি সরিষার তেল, রান্নার জন্য উত্তম', 'Available', 'mustard_oil.webp', '2025-08-31 17:02:25'),
(10, 6, 'শুকনো আম', 300.00, 350.00, 'সুস্বাদু ও টক-মিষ্টি শুকনো আম', 'Available', 'anaros.avif', '2025-08-31 17:02:25'),
(11, 11, 'স্পেশাল কম্বো অফার ১', 850.00, 920.00, 'খেজুর গুড় + আকর গুড় + নাটোরের কাচা গুড়', 'Available', 'mixed.avif', '2025-08-31 19:42:36'),
(12, 11, 'স্পেশাল কম্বো অফার ২', 1050.00, 1200.00, 'আম + ড্রাগন + পেয়ারা + বরই', 'Available', 'mixed.avif', '2025-08-31 19:42:36'),
(13, 12, 'স্পেশাল অফার ১', 1230.00, 1050.00, 'খেজুর গুড় + আকর গুড় + নাটোরের কাচা গুড় ak sathe nile akti dhamaka offer pacchen. dhamaka offer thakbe shudhu matro black friday te. ', 'Available', 'mixed.avif', '2025-08-31 19:42:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_number` varchar(15) NOT NULL,
  `user_address` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_number`, `user_address`, `created_at`) VALUES
(1, 'রহিম আহমেদ', '01712345678', 'মিরপুর, ঢাকা', '2025-08-31 17:02:25'),
(2, 'সিমা আক্তার', '01887654321', 'গুলশান, ঢাকা', '2025-08-31 17:02:25'),
(3, 'কামাল হোসেন', '01911223344', 'উত্তরা, ঢাকা', '2025-08-31 17:02:25'),
(4, 'নুসরাত জাহান', '01655667788', 'ধানমন্ডি, ঢাকা', '2025-08-31 17:02:25'),
(5, 'আরিফুল ইসলাম', '01512345678', 'বাড্ডা, ঢাকা', '2025-08-31 17:02:25'),
(6, 'তানজিনা আক্তার', '01798765432', 'মোহাম্মদপুর, ঢাকা', '2025-08-31 17:02:25'),
(7, 'সজীব সরকার', '01833445566', 'ফার্মগেট, ঢাকা', '2025-08-31 17:02:25'),
(8, 'ফারহানা ইয়াসমিন', '01966778899', 'লালবাগ, ঢাকা', '2025-08-31 17:02:25'),
(9, 'ইমরান খান', '01677889900', 'মতিঝিল, ঢাকা', '2025-08-31 17:02:25'),
(10, 'শারমিন সুলতানা', '01598765432', 'ঢাকেশ্বরী, ঢাকা', '2025-08-31 17:02:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`orderItem_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_users`
--
ALTER TABLE `order_users`
  ADD PRIMARY KEY (`order_user_id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `categories_id` (`categories_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `orderItem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_users`
--
ALTER TABLE `order_users`
  MODIFY `order_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`categories_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
