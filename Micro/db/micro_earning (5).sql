-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2025 at 04:52 PM
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
-- Database: `micro_earning`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(200) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `admin_image` varchar(255) NOT NULL DEFAULT 'admin.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`, `admin_image`) VALUES
(1, 'alif', 'alif@gmail.com', 'alif', 'admin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `blance`
--

CREATE TABLE `blance` (
  `blance_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_earning` int(11) NOT NULL DEFAULT 0,
  `main_blance` int(11) NOT NULL DEFAULT 0,
  `total_coin` int(11) NOT NULL DEFAULT 10,
  `rit_coin` int(11) NOT NULL DEFAULT 0,
  `free_spain` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blance`
--

INSERT INTO `blance` (`blance_id`, `user_id`, `total_earning`, `main_blance`, `total_coin`, `rit_coin`, `free_spain`) VALUES
(1, 1, 5650, 620, 810, 20, 0),
(2, 3, 3000, 1510, 600, 300, 3),
(3, 6, 2000, 1010, 400, 200, 2),
(4, 7, 4000, 2010, 800, 400, 4),
(5, 29, 6010, 3030, 1200, 600, 6),
(6, 38, 280, -610, 511, 5, 0),
(10, 42, 1000, 598, 400, 3, 0),
(11, 43, 1095, 1180, 10, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `coin`
--

CREATE TABLE `coin` (
  `coin_id` int(11) NOT NULL,
  `coin_price` int(11) NOT NULL,
  `submited_coin_price` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coin`
--

INSERT INTO `coin` (`coin_id`, `coin_price`, `submited_coin_price`) VALUES
(1, 10, '2025-06-01'),
(2, 12, '2025-06-05'),
(3, 15, '2025-06-10'),
(4, 18, '2025-06-15');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `content`, `parent_id`, `created_at`) VALUES
(1, 1, 'This is the first main comment', NULL, '2025-06-19 12:00:00'),
(2, 2, 'I agree with the first comment!', 1, '2025-06-19 12:05:00'),
(3, 3, 'Here is another main comment', NULL, '2025-06-19 12:10:00'),
(4, 1, 'Replying to the second main comment', 3, '2025-06-19 12:15:00'),
(5, 4, 'A new main comment with no replies yet', NULL, '2025-06-19 12:20:00'),
(6, 2, 'This is a reply to the first comment', 1, '2025-06-19 12:25:00'),
(7, 3, 'Another main comment to test the system', NULL, '2025-06-19 12:30:00'),
(8, 4, 'Reply to the last main comment', 7, '2025-06-19 12:35:00'),
(9, 1, 'Nested reply to a reply comment', 2, '2025-06-19 12:40:00'),
(10, 2, 'Final test comment with no replies', NULL, '2025-06-19 12:45:00'),
(11, 38, 'This is the two test main comment', NULL, '2025-07-01 06:29:04'),
(12, 1, 'replay comment', 11, '2025-07-04 03:31:21');

-- --------------------------------------------------------

--
-- Table structure for table `daily_earn_log`
--

CREATE TABLE `daily_earn_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `earn_date` date DEFAULT NULL,
  `active_slot` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daily_earn_log`
--

INSERT INTO `daily_earn_log` (`id`, `user_id`, `earn_date`, `active_slot`, `amount`) VALUES
(1, 43, '2025-07-04', 0, 95.00);

-- --------------------------------------------------------

--
-- Table structure for table `deposite`
--

CREATE TABLE `deposite` (
  `deposite_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deposite_number` varchar(200) NOT NULL,
  `deposite_method` varchar(250) NOT NULL,
  `deposite_amount` varchar(200) NOT NULL,
  `transaction_id` varchar(250) NOT NULL,
  `deposite_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `processed_date` timestamp NULL DEFAULT NULL,
  `approve_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deposite`
--

INSERT INTO `deposite` (`deposite_id`, `user_id`, `deposite_number`, `deposite_method`, `deposite_amount`, `transaction_id`, `deposite_date`, `processed_date`, `approve_status`) VALUES
(1, 1, '1712345678', 'bKash', '1000', 'BKASH12345678', '2025-06-09 18:00:00', '2025-07-04 14:38:07', 'rejected'),
(2, 3, '1812345678', 'Nagad', '500', 'NAGAD12345678', '2025-06-10 18:00:00', NULL, 'pending'),
(3, 6, '1912345678', 'Rocket', '2000', 'ROCKET12345678', '2025-06-11 18:00:00', NULL, ''),
(4, 7, '2012345678', 'Bank Transfer', '1500', 'BANK12345678', '2025-06-12 18:00:00', NULL, 'pending'),
(20, 38, '01751520156', 'bikash', '600', 'TX98765', '2025-06-26 03:54:38', NULL, ''),
(22, 38, '01751520156', 'nagod', '600', 'TX98766', '2025-06-26 05:35:30', NULL, ''),
(23, 38, '01751520156', 'bikash', '650', 'TX98767', '2025-06-26 05:58:32', NULL, ''),
(24, 38, '01783832675', 'rocket', '650', 'TX98768', '2025-06-26 06:06:48', NULL, ''),
(25, 38, '01783832675', 'nagod', '690', 'TX98770', '2025-06-26 07:04:02', '2025-07-04 10:51:09', 'rejected'),
(26, 38, '01783832675', 'nagod', '690', 'TX98772', '2025-06-26 07:59:37', '2025-07-04 10:43:14', 'rejected'),
(27, 38, '01783832675', 'rocket', '650', 'TX98775', '2025-06-26 08:37:07', NULL, ''),
(28, 38, '01783832675', 'rocket', '900', 'TX98780', '2025-06-27 05:31:14', NULL, ''),
(29, 38, '01783832675', 'nagod', '600', 'TX98782', '2025-06-27 05:50:28', NULL, ''),
(30, 38, '01783832675', 'binance', '900', 'TX98785', '2025-06-27 05:54:45', NULL, ''),
(31, 38, '01783832675', 'nagod', '900', 'TX9879', '2025-06-27 05:57:18', NULL, ''),
(32, 1, '01783832675', 'nagod', '4530', 'ji-521', '2025-07-03 05:00:53', NULL, ''),
(34, 43, '01783832675', 'binance', '120', 'ds57', '2025-07-04 14:13:06', NULL, ''),
(35, 43, '01783832675', 'rocket', '350', '4tgfh', '2025-07-04 14:44:27', '2025-07-04 10:44:49', 'approved'),
(36, 43, '01783832675', 'rocket', '400', 'svbsd', '2025-07-04 14:50:55', '2025-07-04 10:51:10', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `exchange`
--

CREATE TABLE `exchange` (
  `exchange_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blance` int(11) NOT NULL,
  `coin` int(11) NOT NULL,
  `exchange_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exchange`
--

INSERT INTO `exchange` (`exchange_id`, `user_id`, `blance`, `coin`, `exchange_date`) VALUES
(1, 1, 1000, 100, '2025-06-04 18:00:00'),
(2, 3, 500, 50, '2025-06-05 18:00:00'),
(3, 6, 2000, 200, '2025-06-06 18:00:00'),
(4, 7, 1500, 150, '2025-06-07 18:00:00'),
(5, 1, 10, 10, '2025-06-23 17:14:24'),
(6, 1, 10, 10, '2025-06-23 17:16:17'),
(7, 1, 20, 20, '2025-06-23 17:16:38'),
(8, 1, 10, 10, '2025-06-23 17:18:12'),
(9, 1, 105, 105, '2025-06-23 17:19:25'),
(10, 1, 1, 1, '2025-06-23 17:37:55'),
(11, 1, 20, 20, '2025-06-25 03:57:21'),
(12, 1, 80, 80, '2025-06-25 04:00:04'),
(13, 42, 98, 98, '2025-06-25 08:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `mobile_recharge`
--

CREATE TABLE `mobile_recharge` (
  `recharge_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recharge_number` int(11) NOT NULL,
  `recharge_amount` int(11) NOT NULL,
  `recharge_coin` int(11) NOT NULL,
  `recharge_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `approve_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `approve_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mobile_recharge`
--

INSERT INTO `mobile_recharge` (`recharge_id`, `user_id`, `recharge_number`, `recharge_amount`, `recharge_coin`, `recharge_date`, `approve_date`, `approve_status`) VALUES
(1, 1, 1712345678, 500, 0, '2025-06-09 18:00:00', '2025-07-01 15:27:11', 'approved'),
(2, 3, 1812345678, 300, 0, '2025-06-10 18:00:00', '2025-07-01 19:21:43', 'pending'),
(3, 6, 1912345678, 1000, 0, '2025-06-11 18:00:00', '2025-07-01 19:21:43', 'rejected'),
(4, 1, 5273743, 20, 20, '2025-06-22 18:00:00', '2025-07-01 15:27:56', 'approved'),
(5, 1, 5273743, 20, 20, '2025-06-22 18:00:00', '2025-07-01 15:28:08', 'approved'),
(6, 2, 104353, 30, 30, '2025-06-22 18:00:00', '2025-07-01 19:21:43', 'pending'),
(7, 2, 104353, 30, 30, '2025-06-22 18:00:00', '2025-07-01 19:21:43', 'pending'),
(8, 1, 147852369, 36, 36, '2025-06-22 18:00:00', '2025-07-01 15:28:04', 'approved'),
(9, 1, 4147254, 50, 50, '2025-06-23 16:14:30', '2025-07-01 19:21:43', 'pending'),
(10, 1, 424524, 40, 40, '2025-06-23 16:14:43', '2025-07-01 15:30:49', 'rejected'),
(11, 1, 3665663, 32, 32, '2025-06-25 04:19:26', '2025-07-01 15:32:22', 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(11) NOT NULL,
  `referrer_id` int(11) NOT NULL,
  `referred_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `referrer_id`, `referred_id`) VALUES
(1, 9, 16),
(2, 1, 17),
(3, 18, 19),
(9, 38, 42),
(10, 1, 43);

-- --------------------------------------------------------

--
-- Table structure for table `rit_coin`
--

CREATE TABLE `rit_coin` (
  `rit_id` int(11) NOT NULL,
  `rit_coin_price` int(11) NOT NULL,
  `price_submited_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rit_coin`
--

INSERT INTO `rit_coin` (`rit_id`, `rit_coin_price`, `price_submited_date`) VALUES
(1, 20, '2025-06-01'),
(5, 25, '2025-07-02'),
(6, 20, '2025-07-02'),
(7, 25, '2025-07-02'),
(8, 20, '2025-07-02'),
(9, 60, '2025-07-02'),
(10, 90, '2025-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_description` text NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_coin` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `product_name`, `product_description`, `product_price`, `product_coin`, `product_image`, `created_at`) VALUES
(1, 'iPhone 15 Pro', '6.1-inch Super Retina XDR display, A16 Bionic chip, 48MP main camera.6.1-inch Super Retina XDR display, A16 Bionic chip, 48MP main camera.6.1-inch Super Retina XDR display, A16 Bionic chip, 48MP main camera.6.1-inch Super Retina XDR display, A16 Bionic chip, 48MP main camera.6.1-inch Super Retina XDR display, A16 Bionic chip, 48MP main camera.6.1-inch Super Retina XDR display, A16 Bionic chip, 48MP main camera.6.1-inch Super Retina XDR display, A16 Bionic chip, 48MP main camera.6.1-inch Super Retina XDR display, A16 Bionic chip, 48MP main camera.6.1-inch Super Retina XDR display, A16 Bionic chip, 48MP main camera.', 999, 9990, 'mobile1.jpg', '2025-06-22'),
(2, 'Samsung Galaxy S23', '6.1-inch Dynamic AMOLED 2X, Snapdragon 8 Gen 2, 50MP triple camera', 799, 7990, 'mobile2.jpg', '2025-06-22'),
(3, 'Google Pixel 7 Pro', '6.7-inch LTPO OLED, Google Tensor G2, 50MP main camera with 5x optical zoom', 899, 8990, 'mobile3.jpg', '2025-06-22'),
(4, 'OnePlus 11', '6.7-inch Fluid AMOLED, Snapdragon 8 Gen 2, Hasselblad triple camera system', 699, 6990, 'mobile2.jpg', '2025-06-22'),
(5, 'Xiaomi 13 Pro', '6.73-inch AMOLED, Snapdragon 8 Gen 2, 1-inch type main sensor', 799, 7990, 'mobile1.jpg', '2025-06-22'),
(6, 'Realme GT 3', '6.74-inch AMOLED, Snapdragon 8+ Gen 1, 50MP Sony IMX890 main camera', 499, 4990, 'mobile3.jpg', '2025-06-22'),
(7, 'Vivo X90 Pro', '6.78-inch AMOLED, MediaTek Dimensity 9200, 1-inch type main sensor', 899, 8990, 'mobile3.jpg', '2025-06-22'),
(8, 'Oppo Find X5 Pro', '6.7-inch LTPO AMOLED, Snapdragon 8 Gen 1, Hasselblad camera system', 899, 8990, 'mobile2.jpg', '2025-06-22'),
(9, 'Nothing Phone 2', '6.7-inch OLED, Snapdragon 8+ Gen 1, unique glyph interface design', 599, 5990, 'mobile1.jpg', '2025-06-22'),
(10, 'Asus ROG Phone 7', '6.78-inch AMOLED 165Hz, Snapdragon 8 Gen 2, gaming-focused design', 999, 9990, 'mobile2.jpg', '2025-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `spin_history`
--

CREATE TABLE `spin_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `spin_type` enum('coin','free') NOT NULL,
  `bet_amount` decimal(10,2) NOT NULL,
  `prize_text` varchar(20) NOT NULL,
  `prize_value` decimal(10,2) NOT NULL,
  `winnings` decimal(10,2) NOT NULL,
  `spin_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spin_history`
--

INSERT INTO `spin_history` (`id`, `user_id`, `spin_type`, `bet_amount`, `prize_text`, `prize_value`, `winnings`, `spin_date`) VALUES
(1, 1, 'coin', 10.00, '0.8X', 0.80, 8.00, '2025-06-21 03:24:11'),
(2, 1, 'coin', 10.00, '1X', 1.00, 10.00, '2025-06-21 03:30:57'),
(3, 1, 'coin', 10.00, '1X', 1.00, 10.00, '2025-06-21 03:31:27'),
(4, 1, 'coin', 10.00, 'JACKPOT', 10.00, 100.00, '2025-06-21 03:31:42'),
(5, 1, 'coin', 10.00, '0X', 0.00, 0.00, '2025-06-21 03:37:18'),
(6, 1, 'coin', 10.00, '1.5X', 1.50, 15.00, '2025-06-21 03:37:33'),
(7, 1, 'coin', 10.00, '2X', 2.00, 20.00, '2025-06-21 03:37:44'),
(8, 1, 'coin', 10.00, '1.5X', 1.50, 15.00, '2025-06-21 03:38:11'),
(9, 1, 'coin', 10.00, '0.5X', 0.50, 5.00, '2025-06-21 03:43:55'),
(124, 1, 'coin', 10.00, '1X', 1.00, 10.00, '2025-06-22 03:30:30'),
(125, 1, 'coin', 10.00, 'JACKPOT', 10.00, 100.00, '2025-06-22 03:31:36'),
(126, 1, 'free', 1.00, 'JACKPOT', 10.00, 10.00, '2025-06-22 03:31:49'),
(127, 1, 'free', 1.00, '1.2X', 1.20, 1.20, '2025-06-22 03:40:05'),
(128, 1, 'coin', 10.00, '0.5X', 0.50, 5.00, '2025-06-22 03:40:11'),
(129, 1, 'coin', 10.00, '2X', 2.00, 20.00, '2025-06-22 03:47:07'),
(130, 1, 'coin', 10.00, '0X', 0.00, 0.00, '2025-06-22 03:47:20'),
(131, 1, 'coin', 10.00, '0.8X', 0.80, 8.00, '2025-06-22 03:49:06'),
(132, 1, 'coin', 10.00, '1X', 1.00, 10.00, '2025-06-22 03:49:57'),
(133, 1, 'coin', 10.00, '1.5X', 1.50, 15.00, '2025-06-22 03:50:01'),
(134, 1, 'coin', 10.00, '1.2X', 1.20, 12.00, '2025-06-22 04:21:37'),
(135, 1, 'coin', 10.00, '0.5X', 0.50, 5.00, '2025-06-23 08:13:44'),
(136, 42, 'coin', 10.00, '1.2X', 1.20, 12.00, '2025-06-25 08:03:57'),
(137, 42, 'coin', 10.00, '1.5X', 1.50, 15.00, '2025-06-25 08:04:15'),
(138, 42, 'coin', 10.00, '0X', 0.00, 0.00, '2025-06-25 08:04:35'),
(139, 42, 'free', 1.00, '1X', 1.00, 1.00, '2025-06-25 08:04:48'),
(140, 38, 'coin', 10.00, '2X', 2.00, 20.00, '2025-06-27 05:42:02'),
(141, 38, 'free', 1.00, '0X', 0.00, 0.00, '2025-06-27 05:42:51'),
(142, 38, 'free', 1.00, '1.2X', 1.20, 1.20, '2025-06-27 05:42:58');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `task_image` varchar(255) DEFAULT NULL,
  `target_url` varchar(255) DEFAULT NULL,
  `task_earn` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `title`, `description`, `task_image`, `target_url`, `task_earn`, `created_at`) VALUES
(1, 'Follow Our Facebook Page', 'Go to our Facebook page and follow it to complete the task.', 'mobile2.jpg', 'https://facebook.com/yourpage', '10 TK', '2025-06-27 17:57:30'),
(2, 'task id 2', 'subscrive our youtube chanel', 'rit-coin.jpeg', 'https://www.facebook.com/', '10TK', '2025-06-27 19:21:47'),
(3, 'test', 'add task', 'Image_fx (15).jpg', 'http://example.com', '12', '2025-07-01 11:42:29'),
(4, 'test 2', 'test2', 'Image_fx (13).jpg', 'https://example.com', '15', '2025-07-01 11:44:05'),
(5, 'test 2', 'test2', 'Image_fx (13).jpg', 'https://example.com', '15', '2025-07-01 11:44:50');

-- --------------------------------------------------------

--
-- Table structure for table `task_submissions`
--

CREATE TABLE `task_submissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `screenshot_url` varchar(255) DEFAULT NULL,
  `proof_text` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_submissions`
--

INSERT INTO `task_submissions` (`id`, `user_id`, `task_id`, `screenshot_url`, `proof_text`, `status`, `submitted_at`) VALUES
(1, 29, 1, 'mobile1.jpg', 'https://www.google.com/', 'approved', '2025-06-27 18:51:58'),
(2, 29, 1, 'mobile1.jpg', 'https://www.facebook.com/', 'approved', '2025-06-27 19:06:25'),
(3, 29, 1, 'mobile1.jpg', 'https://www.instagram.com/', 'rejected', '2025-06-27 19:10:30'),
(4, 29, 1, 'mobile1.jpg', 'https://www.instagram.com/', 'pending', '2025-06-27 19:10:49'),
(5, 29, 1, 'mobile1.jpg', 'https://www.instagram.com/', 'approved', '2025-06-27 19:11:15'),
(6, 1, 1, 'Image_fx (15).jpg', 'https://chatgpt.com/c/6864bc4d-17fc-8001-a8b4-c478dd38d95f', 'approved', '2025-07-04 03:09:42');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `transfer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transfer_user_id` varchar(250) NOT NULL,
  `blance_type` varchar(255) NOT NULL,
  `transfer_amount` int(11) NOT NULL,
  `transfer_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`transfer_id`, `user_id`, `transfer_user_id`, `blance_type`, `transfer_amount`, `transfer_date`) VALUES
(1, 1, '3', 'main_blance', 500, '2025-06-04 18:00:00'),
(2, 3, '6', 'rit_coin', 50, '2025-06-05 18:00:00'),
(3, 6, '7', 'total_coin', 100, '2025-06-06 18:00:00'),
(4, 7, '1', 'main_blance', 300, '2025-06-07 18:00:00'),
(5, 42, '0', 'Coin', 100, '2025-06-25 05:38:33'),
(6, 42, 'JWIBZMG6', 'Coin', 100, '2025-06-25 05:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `referral_code` varchar(10) NOT NULL,
  `referred_by` int(11) DEFAULT NULL,
  `account_type` enum('SILVER MEMBER','GOLD MEMBER','DAIMOND MEMBER') DEFAULT 'SILVER MEMBER',
  `account_rank` enum('genarel account','vip account') DEFAULT 'genarel account',
  `active_status` enum('0','1') DEFAULT '0',
  `image` varchar(250) NOT NULL DEFAULT 'mobile1.jpg',
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `referral_code`, `referred_by`, `account_type`, `account_rank`, `active_status`, `image`, `created_at`, `update_at`) VALUES
(1, 'tarikh', 'admin@gmail.com', '$2y$10$ES.FQ1SxrdWnP5qg03E/rOq9k.px6bcn5KUQL/2U4wiJdYA81VIIO', 'JWIBZMG6', 38, 'DAIMOND MEMBER', 'vip account', '1', 'mobile1.jpg', '2025-06-25', NULL),
(29, 'account2', 'account2@gmail.com', '1230', '', 1, 'SILVER MEMBER', 'genarel account', '0', 'mobile1.jpg', '2025-06-25', NULL),
(35, 'okay', 'okay@gmail.com', '$2y$10$/nn2pq.CWwUm6yDxemMUmeo.gPebgn9siUle12kiHV77dwk5HB6U2', 'KLHFDDAQ', NULL, 'SILVER MEMBER', 'genarel account', '0', 'mobile1.jpg', '2025-06-25', NULL),
(38, 'ridoy', 'ridoy@gmail.com', '$2y$10$WFMbGZJ5GOcTEYiw/M8iIu1Wboy4EolxtOVxoyRXL//sLTwfJEqge', 'CKLJ82VH', NULL, 'SILVER MEMBER', 'genarel account', '1', '484602.jpg', '2025-06-25', NULL),
(42, 'refere', 'refer@gmail.com', '$2y$10$t0uABv9MxPS47TFTD4M0eOTipImPEw4pNYIZGKZQ2M0vJbZQOSwAe', '8R133H5T', 38, 'SILVER MEMBER', 'genarel account', '1', 'mobile1.jpg', '2025-06-25', NULL),
(43, 'akash', 'akash@gmail.com', '$2y$10$2LGROHAoc7OXKW0QjEk/KeOaHz1Cl7bw3rtf/aDYusPNZZreIPiN2', 'T2506D54', 1, 'SILVER MEMBER', 'genarel account', '1', 'mobile1.jpg', '2025-07-04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_slots`
--

CREATE TABLE `user_slots` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `slot_type` enum('core','vip') NOT NULL,
  `slot_count` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `purchase_time` datetime DEFAULT current_timestamp(),
  `expire_time` datetime NOT NULL,
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_slots`
--

INSERT INTO `user_slots` (`id`, `user_id`, `slot_type`, `slot_count`, `price`, `purchase_time`, `expire_time`, `status`) VALUES
(1, 43, 'core', 5, 100.00, '2025-07-04 10:42:58', '2025-08-04 06:42:58', 1),
(2, 43, 'core', 1, 100.00, '2025-07-04 10:48:56', '2025-08-04 06:48:56', 1),
(3, 43, 'core', 1, 100.00, '2025-07-04 10:56:02', '2025-08-04 06:56:02', 1),
(12, 43, 'vip', 2, 200.00, '2025-07-04 20:01:04', '2025-07-04 16:01:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_requests`
--

CREATE TABLE `withdrawal_requests` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `method` varchar(100) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `request_date` datetime DEFAULT current_timestamp(),
  `processed_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `withdrawal_requests`
--

INSERT INTO `withdrawal_requests` (`request_id`, `user_id`, `method`, `account_number`, `amount`, `status`, `request_date`, `processed_date`) VALUES
(1, 1, '', '0147852036', 600.00, 'rejected', '2025-06-23 09:08:11', NULL),
(2, 1, '', '0147852036', 600.00, 'rejected', '2025-06-23 09:08:35', NULL),
(3, 1, '', '0410224', 700.00, 'rejected', '2025-06-23 09:24:21', NULL),
(4, 1, 'rocket', '0104785203', 620.00, 'pending', '2025-06-23 09:48:14', NULL),
(5, 1, 'nagod', '01585215', 520.00, 'rejected', '2025-06-23 15:14:04', '2025-07-01 21:11:36'),
(6, 1, 'bikash', '052563625', 690.00, 'approved', '2025-06-23 15:14:16', '2025-07-01 21:13:07'),
(7, 1, 'binance', '14895261248', 980.00, 'rejected', '2025-06-23 15:14:29', NULL),
(8, 1, 'rocket', '14661', 630.00, 'rejected', '2025-06-23 15:15:01', '2025-07-01 21:12:25'),
(9, 43, 'nagod', '01751520156', 520.00, 'approved', '2025-07-04 20:17:08', '2025-07-04 16:17:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `blance`
--
ALTER TABLE `blance`
  ADD PRIMARY KEY (`blance_id`);

--
-- Indexes for table `coin`
--
ALTER TABLE `coin`
  ADD PRIMARY KEY (`coin_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `daily_earn_log`
--
ALTER TABLE `daily_earn_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposite`
--
ALTER TABLE `deposite`
  ADD PRIMARY KEY (`deposite_id`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `exchange`
--
ALTER TABLE `exchange`
  ADD PRIMARY KEY (`exchange_id`);

--
-- Indexes for table `mobile_recharge`
--
ALTER TABLE `mobile_recharge`
  ADD PRIMARY KEY (`recharge_id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referrer_id` (`referrer_id`),
  ADD KEY `referred_id` (`referred_id`);

--
-- Indexes for table `rit_coin`
--
ALTER TABLE `rit_coin`
  ADD PRIMARY KEY (`rit_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `spin_history`
--
ALTER TABLE `spin_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `task_submissions`
--
ALTER TABLE `task_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`transfer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `referral_code` (`referral_code`),
  ADD KEY `referred_by` (`referred_by`);

--
-- Indexes for table `user_slots`
--
ALTER TABLE `user_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blance`
--
ALTER TABLE `blance`
  MODIFY `blance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `coin`
--
ALTER TABLE `coin`
  MODIFY `coin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `daily_earn_log`
--
ALTER TABLE `daily_earn_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deposite`
--
ALTER TABLE `deposite`
  MODIFY `deposite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `exchange`
--
ALTER TABLE `exchange`
  MODIFY `exchange_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mobile_recharge`
--
ALTER TABLE `mobile_recharge`
  MODIFY `recharge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rit_coin`
--
ALTER TABLE `rit_coin`
  MODIFY `rit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `spin_history`
--
ALTER TABLE `spin_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `task_submissions`
--
ALTER TABLE `task_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_slots`
--
ALTER TABLE `user_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `referrals`
--
ALTER TABLE `referrals`
  ADD CONSTRAINT `referrals_ibfk_1` FOREIGN KEY (`referrer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `referrals_ibfk_2` FOREIGN KEY (`referred_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `spin_history`
--
ALTER TABLE `spin_history`
  ADD CONSTRAINT `spin_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`referred_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
