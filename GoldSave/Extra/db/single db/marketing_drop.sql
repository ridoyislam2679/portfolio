-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2026 at 04:35 AM
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
-- Table structure for table `marketing_drop`
--

CREATE TABLE `marketing_drop` (
  `marketing_id` int(11) NOT NULL,
  `marketing_title` varchar(255) DEFAULT NULL,
  `marketing_dsc` text DEFAULT NULL,
  `marketing_image` varchar(255) DEFAULT NULL,
  `coin` int(11) DEFAULT NULL,
  `marketing_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `marketing_status` enum('active','deactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marketing_drop`
--

INSERT INTO `marketing_drop` (`marketing_id`, `marketing_title`, `marketing_dsc`, `marketing_image`, `coin`, `marketing_date`, `marketing_status`) VALUES
(1, 'নতুন বছরের অফার', 'সোনা কেনায় ১০% ডিসকাউন্ট', 'new_year_offer.jpg', NULL, '2023-12-31 18:00:00', 'deactive'),
(2, 'ভ্যালেন্টাইন স্পেশাল', 'প্রেমিক-প্রেমিকাদের জন্য বিশেষ উপহার', 'valentine.jpg', NULL, '2024-02-13 18:00:00', 'active'),
(3, 'স্বাধীনতা দিবস অফার', 'সকল পণ্যে ১৫% ছাড়', 'independence.jpg', NULL, '2024-03-25 18:00:00', 'active'),
(4, 'বৈশাখী অফার', 'পহেলা বৈশাখে সোনা কিনুন উপহার পান', 'boishakhi.jpg', NULL, '2024-04-13 18:00:00', 'active'),
(5, 'গ্রীষ্মকালীন অফার', 'গরমের সময় বিশেষ ডিসকাউন্ট', 'summer_offer.jpg', NULL, '2024-04-30 18:00:00', 'active'),
(6, 'ঈদুল ফিতর স্পেশাল', 'ঈদ উপলক্ষ্যে সোনা ও কয়েনে ছাড়', 'eid_fitar.jpg', NULL, '2024-04-09 18:00:00', 'active'),
(7, 'নতুন ইউজার বোনাস', 'নিবন্ধন করেই পেয়ে যান ৫০০ টাকা', 'new_user_bonus.jpg', NULL, '2024-01-14 18:00:00', 'deactive'),
(8, 'রেফারেল বোনাস', 'বন্ধুকে আনুন, উপার্জন করুন', 'referral_bonus.jpg', NULL, '2024-01-31 18:00:00', 'active'),
(9, 'লাকি ড্র', 'প্রতি মাসে লাকি ড্র ও ১ গ্রাম সোনা', 'lucky_draw.jpg', NULL, '2024-02-29 18:00:00', 'active'),
(10, 'ফ্ল্যাশ সেল', '২৪ ঘন্টার জন্য বিশেষ অফার', 'flash_sale.jpg', NULL, '2024-04-04 18:00:00', 'deactive'),
(11, 'eryre', 'herthth', 'image6.jpg', 10, '2026-04-19 18:00:00', 'active'),
(12, 'test1', 'test1', 'Oppo A6i.jpg', 50, '2026-04-19 18:00:00', 'active'),
(13, 'final test', 'final test', 'PrakithikShad.png', 30, '2026-04-19 18:00:00', 'active'),
(14, 'last test ', 'last test', 'Screenshot (62).png', 40, '2026-04-19 18:00:00', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `marketing_drop`
--
ALTER TABLE `marketing_drop`
  ADD PRIMARY KEY (`marketing_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `marketing_drop`
--
ALTER TABLE `marketing_drop`
  MODIFY `marketing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
