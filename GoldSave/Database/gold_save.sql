-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2026 at 03:39 AM
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
-- Database: `gold_save`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `balance_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_balance` decimal(12,2) DEFAULT 0.00,
  `gold_balance` decimal(12,2) DEFAULT 0.00,
  `coin_balance` decimal(12,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`balance_id`, `user_id`, `total_balance`, `gold_balance`, `coin_balance`) VALUES
(1, 1, 5000.00, 10.50, 250.00),
(2, 2, 3200.00, 5.25, 180.50),
(3, 3, 7800.00, 15.75, 420.00),
(4, 4, 1200.00, 2.00, 75.00),
(5, 5, 6500.00, 12.00, 310.25),
(6, 6, 4300.00, 8.50, 195.00),
(7, 7, 900.00, 1.50, 45.00),
(8, 8, 10200.00, 20.00, 550.00),
(9, 9, 2800.00, 4.75, 125.50),
(10, 10, 5600.00, 11.25, 290.00);

-- --------------------------------------------------------

--
-- Table structure for table `bonus`
--

CREATE TABLE `bonus` (
  `bonus_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bonus_amount` decimal(10,2) DEFAULT NULL,
  `bonus_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bonus`
--

INSERT INTO `bonus` (`bonus_id`, `user_id`, `bonus_amount`, `bonus_date`) VALUES
(1, 1, 100.00, '2024-01-31 18:00:00'),
(2, 2, 75.00, '2024-02-14 18:00:00'),
(3, 3, 150.00, '2024-02-29 18:00:00'),
(4, 4, 50.00, '2024-03-09 18:00:00'),
(5, 5, 200.00, '2024-03-19 18:00:00'),
(6, 6, 80.00, '2024-03-24 18:00:00'),
(7, 7, 30.00, '2024-03-31 18:00:00'),
(8, 8, 250.00, '2024-04-04 18:00:00'),
(9, 9, 60.00, '2024-04-07 18:00:00'),
(10, 10, 120.00, '2024-04-09 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bonus_coin`
--

CREATE TABLE `bonus_coin` (
  `bonus_coin_id` int(11) NOT NULL,
  `bonus_coin` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bonus_coin`
--

INSERT INTO `bonus_coin` (`bonus_coin_id`, `bonus_coin`, `date`) VALUES
(1, 100.00, '2024-01-01'),
(2, 110.00, '2024-02-01'),
(3, 105.00, '2024-03-01'),
(4, 115.00, '2024-03-15'),
(5, 120.00, '2024-04-01'),
(6, 125.00, '2024-04-05'),
(7, 130.00, '2024-04-08'),
(8, 128.00, '2024-04-10'),
(9, 132.00, '2024-04-11'),
(10, 135.00, '2024-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `buygold`
--

CREATE TABLE `buygold` (
  `buy_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `buy_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buygold`
--

INSERT INTO `buygold` (`buy_id`, `user_id`, `amount`, `quantity`, `buy_date`) VALUES
(1, 1, 5000.00, 2.50, '2024-01-25 04:00:00'),
(2, 2, 3000.00, 1.50, '2024-02-05 08:30:00'),
(3, 3, 8000.00, 4.00, '2024-02-18 05:15:00'),
(4, 5, 4500.00, 2.25, '2024-03-01 03:45:00'),
(5, 6, 3500.00, 1.75, '2024-03-12 10:20:00'),
(6, 8, 10000.00, 5.00, '2024-03-20 07:50:00'),
(7, 9, 2500.00, 1.25, '2024-03-28 04:30:00'),
(8, 10, 6000.00, 3.00, '2024-04-05 09:10:00'),
(9, 3, 4000.00, 2.00, '2024-04-08 06:40:00'),
(10, 1, 3500.00, 1.75, '2024-04-10 03:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `coin_price`
--

CREATE TABLE `coin_price` (
  `coin_price_id` int(11) NOT NULL,
  `coin_price` decimal(12,6) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coin_price`
--

INSERT INTO `coin_price` (`coin_price_id`, `coin_price`, `date`) VALUES
(1, 2.500000, '2024-01-01'),
(2, 2.550000, '2024-02-01'),
(3, 2.600000, '2024-03-01'),
(4, 2.580000, '2024-03-15'),
(5, 2.620000, '2024-04-01'),
(6, 2.650000, '2024-04-05'),
(7, 2.630000, '2024-04-08'),
(8, 2.670000, '2024-04-10'),
(9, 2.700000, '2024-04-11'),
(10, 2.680000, '2024-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `collectgold`
--

CREATE TABLE `collectgold` (
  `collect_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `delivery_user` varchar(100) DEFAULT NULL,
  `delivery_user_number` varchar(15) DEFAULT NULL,
  `delivery_address` text DEFAULT NULL,
  `collect_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivery_date` date DEFAULT NULL,
  `collect_status` enum('pending','processing','delivered','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collectgold`
--

INSERT INTO `collectgold` (`collect_id`, `user_id`, `quantity`, `delivery_user`, `delivery_user_number`, `delivery_address`, `collect_date`, `delivery_date`, `collect_status`) VALUES
(1, 1, 1.50, 'করিয়ার ম্যান ১', '01810000001', 'ঢাকা, বাংলাদেশ', '2024-02-15 04:00:00', '2024-02-20', 'delivered'),
(2, 2, 0.75, 'করিয়ার ম্যান ২', '01810000002', 'চট্টগ্রাম, বাংলাদেশ', '2024-02-25 08:30:00', '2024-03-01', 'delivered'),
(3, 3, 2.00, 'করিয়ার ম্যান ৩', '01810000003', 'রাজশাহী, বাংলাদেশ', '2024-03-05 05:15:00', '2024-03-10', 'processing'),
(4, 5, 1.25, 'করিয়ার ম্যান ৪', '01810000004', 'খুলনা, বাংলাদেশ', '2024-03-15 03:45:00', '2024-03-20', 'delivered'),
(5, 6, 0.90, 'করিয়ার ম্যান ৫', '01810000005', 'বরিশাল, বাংলাদেশ', '2024-03-22 10:20:00', '2024-03-28', 'pending'),
(6, 8, 2.50, 'করিয়ার ম্যান ৬', '01810000006', 'সিলেট, বাংলাদেশ', '2024-04-01 07:50:00', '2024-04-07', 'processing'),
(7, 9, 0.60, 'করিয়ার ম্যান ৭', '01810000007', 'ময়মনসিংহ, বাংলাদেশ', '2024-04-05 04:30:00', NULL, 'pending'),
(8, 10, 1.80, 'করিয়ার ম্যান ৮', '01810000008', 'রংপুর, বাংলাদেশ', '2024-04-08 09:10:00', '2024-04-12', 'delivered'),
(9, 3, 1.00, 'করিয়ার ম্যান ৯', '01810000009', 'ঢাকা, বাংলাদেশ', '2024-04-10 06:40:00', NULL, 'pending'),
(10, 1, 0.85, 'করিয়ার ম্যান ১০', '01810000010', 'নারায়ণগঞ্জ, বাংলাদেশ', '2024-04-12 03:00:00', '2024-04-15', 'processing');

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `deposit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deposit_amount` decimal(10,2) DEFAULT NULL,
  `deposit_method` enum('Bkash','Nagad','Binance','Upay') DEFAULT NULL,
  `deposit_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `deposit_status` enum('pending','approve') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`deposit_id`, `user_id`, `deposit_amount`, `deposit_method`, `deposit_date`, `deposit_status`) VALUES
(1, 1, 2000.00, 'Bkash', '2024-01-18 05:00:00', 'approve'),
(2, 2, 1500.00, 'Nagad', '2024-01-22 08:30:00', 'approve'),
(3, 3, 5000.00, 'Upay', '2024-02-08 03:45:00', 'pending'),
(4, 4, 800.00, 'Bkash', '2024-02-12 10:20:00', 'approve'),
(5, 5, 3000.00, 'Bkash', '2024-02-22 07:10:00', 'approve'),
(6, 6, 2500.00, 'Bkash', '2024-03-08 04:30:00', 'pending'),
(7, 7, 400.00, 'Bkash', '2024-03-14 09:50:00', 'approve'),
(8, 8, 7000.00, 'Bkash', '2024-03-22 06:40:00', 'approve'),
(9, 9, 1200.00, 'Bkash', '2024-03-28 11:15:00', 'approve'),
(10, 10, 3500.00, 'Bkash', '2024-04-03 05:25:00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `donate`
--

CREATE TABLE `donate` (
  `donate_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `donate_amount` decimal(10,2) DEFAULT NULL,
  `donate_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donate`
--

INSERT INTO `donate` (`donate_id`, `user_id`, `donate_amount`, `donate_date`) VALUES
(1, 1, 100.00, '2024-02-01 02:30:00'),
(2, 2, 50.00, '2024-02-05 11:45:00'),
(3, 3, 200.00, '2024-02-15 06:00:00'),
(4, 5, 75.00, '2024-02-28 13:20:00'),
(5, 6, 150.00, '2024-03-10 04:15:00'),
(6, 8, 300.00, '2024-03-20 08:30:00'),
(7, 9, 40.00, '2024-03-28 05:50:00'),
(8, 10, 90.00, '2024-04-02 10:10:00'),
(9, 3, 120.00, '2024-04-08 03:00:00'),
(10, 1, 80.00, '2024-04-10 07:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `gold_price`
--

CREATE TABLE `gold_price` (
  `gold_price_id` int(11) NOT NULL,
  `gold_price` decimal(12,2) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gold_price`
--

INSERT INTO `gold_price` (`gold_price_id`, `gold_price`, `date`) VALUES
(1, 5200.00, '2024-01-01'),
(2, 5250.00, '2024-02-01'),
(3, 5300.00, '2024-03-01'),
(4, 5350.00, '2024-03-15'),
(5, 5400.00, '2024-04-01'),
(6, 5380.00, '2024-04-05'),
(7, 5420.00, '2024-04-08'),
(8, 5450.00, '2024-04-10'),
(9, 5480.00, '2024-04-11'),
(10, 5500.00, '2024-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `marketing_drop`
--

CREATE TABLE `marketing_drop` (
  `marketing_id` int(11) NOT NULL,
  `marketing_title` varchar(255) DEFAULT NULL,
  `marketing_dsc` text DEFAULT NULL,
  `marketing_image` varchar(255) DEFAULT NULL,
  `marketing_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `marketing_status` enum('active','deactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marketing_drop`
--

INSERT INTO `marketing_drop` (`marketing_id`, `marketing_title`, `marketing_dsc`, `marketing_image`, `marketing_date`, `marketing_status`) VALUES
(1, 'নতুন বছরের অফার', 'সোনা কেনায় ১০% ডিসকাউন্ট', 'new_year_offer.jpg', '2023-12-31 18:00:00', 'deactive'),
(2, 'ভ্যালেন্টাইন স্পেশাল', 'প্রেমিক-প্রেমিকাদের জন্য বিশেষ উপহার', 'valentine.jpg', '2024-02-13 18:00:00', 'active'),
(3, 'স্বাধীনতা দিবস অফার', 'সকল পণ্যে ১৫% ছাড়', 'independence.jpg', '2024-03-25 18:00:00', 'active'),
(4, 'বৈশাখী অফার', 'পহেলা বৈশাখে সোনা কিনুন উপহার পান', 'boishakhi.jpg', '2024-04-13 18:00:00', 'active'),
(5, 'গ্রীষ্মকালীন অফার', 'গরমের সময় বিশেষ ডিসকাউন্ট', 'summer_offer.jpg', '2024-04-30 18:00:00', 'active'),
(6, 'ঈদুল ফিতর স্পেশাল', 'ঈদ উপলক্ষ্যে সোনা ও কয়েনে ছাড়', 'eid_fitar.jpg', '2024-04-09 18:00:00', 'active'),
(7, 'নতুন ইউজার বোনাস', 'নিবন্ধন করেই পেয়ে যান ৫০০ টাকা', 'new_user_bonus.jpg', '2024-01-14 18:00:00', 'deactive'),
(8, 'রেফারেল বোনাস', 'বন্ধুকে আনুন, উপার্জন করুন', 'referral_bonus.jpg', '2024-01-31 18:00:00', 'active'),
(9, 'লাকি ড্র', 'প্রতি মাসে লাকি ড্র ও ১ গ্রাম সোনা', 'lucky_draw.jpg', '2024-02-29 18:00:00', 'active'),
(10, 'ফ্ল্যাশ সেল', '২৪ ঘন্টার জন্য বিশেষ অফার', 'flash_sale.jpg', '2024-04-04 18:00:00', 'deactive');

-- --------------------------------------------------------

--
-- Table structure for table `marketing_submissions`
--

CREATE TABLE `marketing_submissions` (
  `submission_id` int(11) NOT NULL,
  `post_link` varchar(255) DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `submission_status` enum('pending','approve','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `p2p`
--

CREATE TABLE `p2p` (
  `p2p_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `expair_date` date DEFAULT NULL,
  `last_collect_date` date DEFAULT NULL,
  `p2p_status` enum('active','deactive') DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p2p`
--

INSERT INTO `p2p` (`p2p_id`, `user_id`, `package_id`, `purchase_date`, `expair_date`, `last_collect_date`, `p2p_status`) VALUES
(1, 1, 1, '2024-01-20', '2025-01-20', '2024-04-10', 'active'),
(2, 2, 2, '2024-01-25', '2025-01-25', '2024-04-09', 'active'),
(3, 3, 1, '2024-02-10', '2025-02-10', '2024-04-08', 'active'),
(4, 4, 3, '2024-02-15', '2024-08-15', '2024-03-15', 'deactive'),
(5, 5, 2, '2024-02-22', '2025-02-22', '2024-04-07', 'active'),
(6, 6, 1, '2024-03-05', '2025-03-05', '2024-04-06', 'active'),
(7, 7, 3, '2024-03-12', '2024-09-12', '2024-03-20', 'deactive'),
(8, 8, 2, '2024-03-20', '2025-03-20', '2024-04-05', 'active'),
(9, 9, 1, '2024-03-28', '2025-03-28', '2024-04-04', 'active'),
(10, 10, 2, '2024-04-05', '2025-04-05', '2024-04-10', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `p2p_sevings`
--

CREATE TABLE `p2p_sevings` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(100) DEFAULT NULL,
  `package_price` decimal(12,2) DEFAULT NULL,
  `daily_income` decimal(12,2) DEFAULT NULL,
  `daily_coin` decimal(10,2) DEFAULT NULL,
  `duration_date` int(11) DEFAULT NULL COMMENT 'Duration in days',
  `create_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p2p_sevings`
--

INSERT INTO `p2p_sevings` (`package_id`, `package_name`, `package_price`, `daily_income`, `daily_coin`, `duration_date`, `create_date`) VALUES
(1, 'বেসিক প্যাকেজ', 5000.00, 50.00, 20.00, 90, '2024-01-01'),
(2, 'স্ট্যান্ডার্ড প্যাকেজ', 10000.00, 120.00, 45.00, 180, '2024-01-01'),
(3, 'প্রিমিয়াম প্যাকেজ', 20000.00, 300.00, 100.00, 365, '2024-01-01'),
(4, 'ডেইলি ইনকাম প্যাকেজ', 3000.00, 40.00, 15.00, 60, '2024-02-01'),
(5, 'হাই রিটার্ন প্যাকেজ', 15000.00, 200.00, 75.00, 150, '2024-02-15'),
(6, 'সিলভার প্যাকেজ', 7500.00, 85.00, 30.00, 120, '2024-03-01'),
(7, 'গোল্ড প্যাকেজ', 25000.00, 400.00, 150.00, 365, '2024-03-10'),
(8, 'প্লাটিনাম প্যাকেজ', 50000.00, 900.00, 350.00, 365, '2024-03-20'),
(9, 'স্টার্টার প্যাকেজ', 2000.00, 25.00, 10.00, 30, '2024-04-01'),
(10, 'ডায়মন্ড প্যাকেজ', 100000.00, 2000.00, 800.00, 500, '2024-04-05');

-- --------------------------------------------------------

--
-- Table structure for table `recharge`
--

CREATE TABLE `recharge` (
  `recharge_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `recharge_amount` decimal(10,2) DEFAULT NULL,
  `recharge_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `recharge_status` enum('pending','approve') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recharge`
--

INSERT INTO `recharge` (`recharge_id`, `user_id`, `mobile_number`, `recharge_amount`, `recharge_date`, `recharge_status`) VALUES
(1, 1, '01710000001', 500.00, '2024-01-20 04:00:00', 'approve'),
(2, 2, '01710000002', 1000.00, '2024-01-25 09:30:00', 'approve'),
(3, 3, '01710000003', 200.00, '2024-02-10 06:15:00', 'pending'),
(4, 4, '01710000004', 750.00, '2024-02-15 03:45:00', 'approve'),
(5, 5, '01710000005', 300.00, '2024-02-20 12:00:00', 'approve'),
(6, 6, '01710000006', 1500.00, '2024-03-05 08:20:00', 'pending'),
(7, 7, '01710000007', 450.00, '2024-03-12 05:10:00', 'approve'),
(8, 8, '01710000008', 800.00, '2024-03-18 10:45:00', 'approve'),
(9, 9, '01710000009', 600.00, '2024-03-25 07:30:00', 'pending'),
(10, 10, '01710000010', 1200.00, '2024-04-05 04:15:00', 'approve');

-- --------------------------------------------------------

--
-- Table structure for table `reffer`
--

CREATE TABLE `reffer` (
  `refer_id_no` int(11) NOT NULL,
  `refer_id` int(11) NOT NULL,
  `referred_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reffer`
--

INSERT INTO `reffer` (`refer_id_no`, `refer_id`, `referred_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 4),
(4, 3, 5),
(5, 2, 6),
(6, 5, 7),
(7, 4, 8),
(8, 6, 9),
(9, 8, 10),
(10, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sellgold`
--

CREATE TABLE `sellgold` (
  `sell_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `sell_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellgold`
--

INSERT INTO `sellgold` (`sell_id`, `user_id`, `amount`, `quantity`, `sell_date`) VALUES
(1, 2, 2500.00, 1.25, '2024-02-10 04:00:00'),
(2, 4, 800.00, 0.40, '2024-02-20 09:30:00'),
(3, 6, 1800.00, 0.90, '2024-03-05 05:45:00'),
(4, 7, 400.00, 0.20, '2024-03-15 08:20:00'),
(5, 9, 1500.00, 0.75, '2024-03-25 03:30:00'),
(6, 1, 3000.00, 1.50, '2024-04-01 10:10:00'),
(7, 3, 2000.00, 1.00, '2024-04-05 07:40:00'),
(8, 5, 3500.00, 1.75, '2024-04-08 05:00:00'),
(9, 8, 4000.00, 2.00, '2024-04-10 09:20:00'),
(10, 10, 2800.00, 1.40, '2024-04-12 04:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `userId` varchar(50) DEFAULT NULL,
  `referred_id` int(11) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `status` enum('active','deactivate','cancellation') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `number`, `email`, `gender`, `userId`, `referred_id`, `pass`, `profile_picture`, `status`, `created_at`) VALUES
(1, 'রাকিব হাসান', '01710000001', 'rakib@gmail.com', 'male', 'USER1001', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rakib.jpg', 'active', '2024-01-15 04:30:00'),
(2, 'সাবরিনা আক্তার', '01710000002', 'sabrina@gmail.com', 'female', 'USER1002', 1, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sabrina.jpg', 'active', '2024-01-20 08:45:00'),
(3, 'ইমরান খান', '01710000003', 'imran@gmail.com', 'male', 'USER1003', 1, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'imran.jpg', 'active', '2024-02-05 03:15:00'),
(4, 'নুসরাত জাহান', '01710000004', 'nusrat@gmail.com', 'female', 'USER1004', 2, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'nusrat.jpg', 'deactivate', '2024-02-10 10:20:00'),
(5, 'তানভীর আহমেদ', '01710000005', 'tanvir@gmail.com', 'male', 'USER1005', 3, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tanvir.jpg', 'active', '2024-02-18 05:00:00'),
(6, 'ফারজানা ইসলাম', '01710000006', 'farzana@gmail.com', 'female', 'USER1006', 2, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'farzana.jpg', 'active', '2024-03-01 02:30:00'),
(7, 'শাহরিয়ার হোসেন', '01710000007', 'shahriyar@gmail.com', 'male', 'USER1007', 5, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'shahriyar.jpg', 'cancellation', '2024-03-10 07:45:00'),
(8, 'মিম আক্তার', '01710000008', 'mim@gmail.com', 'female', 'USER1008', 4, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mim.jpg', 'active', '2024-03-15 13:00:00'),
(9, 'রিয়াদ মিয়া', '01710000009', 'riyad@gmail.com', 'male', 'USER1009', 6, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'riyad.jpg', 'active', '2024-03-20 06:10:00'),
(10, 'তাসনিম সুলতানা', '01710000010', 'tasnim@gmail.com', 'female', 'USER1010', 8, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tasnim.jpg', 'active', '2024-04-01 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `verify_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `verify_date` date DEFAULT NULL,
  `verify_expair` date DEFAULT NULL,
  `verify_status` enum('active','deactive') DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verify`
--

INSERT INTO `verify` (`verify_id`, `user_id`, `verify_date`, `verify_expair`, `verify_status`) VALUES
(1, 1, '2024-01-20', '2025-01-20', 'active'),
(2, 2, '2024-01-25', '2025-01-25', 'active'),
(3, 3, '2024-02-10', '2025-02-10', 'active'),
(4, 4, '2024-02-15', '2025-02-15', 'deactive'),
(5, 5, '2024-02-22', '2025-02-22', 'active'),
(6, 6, '2024-03-05', '2025-03-05', 'active'),
(7, 7, '2024-03-12', '2025-03-12', 'deactive'),
(8, 8, '2024-03-20', '2025-03-20', 'active'),
(9, 9, '2024-03-28', '2025-03-28', 'active'),
(10, 10, '2024-04-05', '2025-04-05', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`balance_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bonus`
--
ALTER TABLE `bonus`
  ADD PRIMARY KEY (`bonus_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bonus_coin`
--
ALTER TABLE `bonus_coin`
  ADD PRIMARY KEY (`bonus_coin_id`),
  ADD UNIQUE KEY `date` (`date`);

--
-- Indexes for table `buygold`
--
ALTER TABLE `buygold`
  ADD PRIMARY KEY (`buy_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `coin_price`
--
ALTER TABLE `coin_price`
  ADD PRIMARY KEY (`coin_price_id`),
  ADD UNIQUE KEY `date` (`date`);

--
-- Indexes for table `collectgold`
--
ALTER TABLE `collectgold`
  ADD PRIMARY KEY (`collect_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`deposit_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `donate`
--
ALTER TABLE `donate`
  ADD PRIMARY KEY (`donate_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `gold_price`
--
ALTER TABLE `gold_price`
  ADD PRIMARY KEY (`gold_price_id`),
  ADD UNIQUE KEY `date` (`date`);

--
-- Indexes for table `marketing_drop`
--
ALTER TABLE `marketing_drop`
  ADD PRIMARY KEY (`marketing_id`);

--
-- Indexes for table `marketing_submissions`
--
ALTER TABLE `marketing_submissions`
  ADD PRIMARY KEY (`submission_id`);

--
-- Indexes for table `p2p`
--
ALTER TABLE `p2p`
  ADD PRIMARY KEY (`p2p_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `p2p_sevings`
--
ALTER TABLE `p2p_sevings`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `recharge`
--
ALTER TABLE `recharge`
  ADD PRIMARY KEY (`recharge_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reffer`
--
ALTER TABLE `reffer`
  ADD PRIMARY KEY (`refer_id_no`),
  ADD KEY `refer_id` (`refer_id`),
  ADD KEY `referred_id` (`referred_id`);

--
-- Indexes for table `sellgold`
--
ALTER TABLE `sellgold`
  ADD PRIMARY KEY (`sell_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- Indexes for table `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`verify_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balance`
--
ALTER TABLE `balance`
  MODIFY `balance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bonus`
--
ALTER TABLE `bonus`
  MODIFY `bonus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bonus_coin`
--
ALTER TABLE `bonus_coin`
  MODIFY `bonus_coin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `buygold`
--
ALTER TABLE `buygold`
  MODIFY `buy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coin_price`
--
ALTER TABLE `coin_price`
  MODIFY `coin_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `collectgold`
--
ALTER TABLE `collectgold`
  MODIFY `collect_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `deposit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `donate`
--
ALTER TABLE `donate`
  MODIFY `donate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gold_price`
--
ALTER TABLE `gold_price`
  MODIFY `gold_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `marketing_drop`
--
ALTER TABLE `marketing_drop`
  MODIFY `marketing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `marketing_submissions`
--
ALTER TABLE `marketing_submissions`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `p2p`
--
ALTER TABLE `p2p`
  MODIFY `p2p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `p2p_sevings`
--
ALTER TABLE `p2p_sevings`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `recharge`
--
ALTER TABLE `recharge`
  MODIFY `recharge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reffer`
--
ALTER TABLE `reffer`
  MODIFY `refer_id_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sellgold`
--
ALTER TABLE `sellgold`
  MODIFY `sell_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `verify`
--
ALTER TABLE `verify`
  MODIFY `verify_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `balance`
--
ALTER TABLE `balance`
  ADD CONSTRAINT `balance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `bonus`
--
ALTER TABLE `bonus`
  ADD CONSTRAINT `bonus_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `buygold`
--
ALTER TABLE `buygold`
  ADD CONSTRAINT `buygold_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `collectgold`
--
ALTER TABLE `collectgold`
  ADD CONSTRAINT `collectgold_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `deposit`
--
ALTER TABLE `deposit`
  ADD CONSTRAINT `deposit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `donate`
--
ALTER TABLE `donate`
  ADD CONSTRAINT `donate_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `p2p`
--
ALTER TABLE `p2p`
  ADD CONSTRAINT `p2p_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `recharge`
--
ALTER TABLE `recharge`
  ADD CONSTRAINT `recharge_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `reffer`
--
ALTER TABLE `reffer`
  ADD CONSTRAINT `reffer_ibfk_1` FOREIGN KEY (`refer_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `reffer_ibfk_2` FOREIGN KEY (`referred_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `sellgold`
--
ALTER TABLE `sellgold`
  ADD CONSTRAINT `sellgold_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `verify`
--
ALTER TABLE `verify`
  ADD CONSTRAINT `verify_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
