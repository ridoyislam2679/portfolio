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
-- Table structure for table `collectgold`
--

CREATE TABLE `collectgold` (
  `collect_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `method` enum('coin','biscuit','jewelry','') DEFAULT NULL,
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

INSERT INTO `collectgold` (`collect_id`, `user_id`, `quantity`, `method`, `delivery_user`, `delivery_user_number`, `delivery_address`, `collect_date`, `delivery_date`, `collect_status`) VALUES
(1, 1, 1.50, NULL, 'করিয়ার ম্যান ১', '01810000001', 'ঢাকা, বাংলাদেশ', '2024-02-15 04:00:00', '2024-02-20', 'delivered'),
(2, 2, 0.75, NULL, 'করিয়ার ম্যান ২', '01810000002', 'চট্টগ্রাম, বাংলাদেশ', '2024-02-25 08:30:00', '2024-03-01', 'delivered'),
(3, 3, 2.00, NULL, 'করিয়ার ম্যান ৩', '01810000003', 'রাজশাহী, বাংলাদেশ', '2024-03-05 05:15:00', '2024-03-10', 'processing'),
(4, 5, 1.25, NULL, 'করিয়ার ম্যান ৪', '01810000004', 'খুলনা, বাংলাদেশ', '2024-03-15 03:45:00', '2024-03-20', 'delivered'),
(5, 6, 0.90, NULL, 'করিয়ার ম্যান ৫', '01810000005', 'বরিশাল, বাংলাদেশ', '2024-03-22 10:20:00', '2026-04-20', ''),
(6, 8, 2.50, NULL, 'করিয়ার ম্যান ৬', '01810000006', 'সিলেট, বাংলাদেশ', '2024-04-01 07:50:00', '2024-04-07', 'processing'),
(7, 9, 0.60, NULL, 'করিয়ার ম্যান ৭', '01810000007', 'ময়মনসিংহ, বাংলাদেশ', '2024-04-05 04:30:00', '2026-04-20', 'cancelled'),
(8, 10, 1.80, NULL, 'করিয়ার ম্যান ৮', '01810000008', 'রংপুর, বাংলাদেশ', '2024-04-08 09:10:00', '2024-04-12', 'delivered'),
(9, 3, 1.00, NULL, 'করিয়ার ম্যান ৯', '01810000009', 'ঢাকা, বাংলাদেশ', '2024-04-10 06:40:00', NULL, 'pending'),
(10, 1, 0.85, NULL, 'করিয়ার ম্যান ১০', '01810000010', 'নারায়ণগঞ্জ, বাংলাদেশ', '2024-04-12 03:00:00', '2024-04-15', 'processing'),
(11, 17, 1.00, 'coin', 'Md Hridoy Islam', '01763029679', 'gopalpur road, waliya, lalpur, natore', '2026-04-17 16:53:33', NULL, 'pending'),
(12, 17, 1.00, 'biscuit', 'Md Hridoy Islam', '01763029679', 'gopalpur road, waliya, lalpur, natore', '2026-04-17 16:54:48', NULL, 'pending'),
(13, 17, 1.00, 'biscuit', 'Md Hridoy Islam', '01763029679', 'gopalpur road, waliya, lalpur, natore', '2026-04-17 16:54:52', '2026-04-20', 'delivered');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collectgold`
--
ALTER TABLE `collectgold`
  ADD PRIMARY KEY (`collect_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collectgold`
--
ALTER TABLE `collectgold`
  MODIFY `collect_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collectgold`
--
ALTER TABLE `collectgold`
  ADD CONSTRAINT `collectgold_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
