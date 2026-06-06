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
(1, 'বেসিক প্যাকেজ', 300.00, 20.00, 3.00, 20, '2024-01-01'),
(2, 'স্ট্যান্ডার্ড প্যাকেজ', 500.00, 35.00, 5.00, 20, '2024-01-01'),
(3, 'প্রিমিয়াম প্যাকেজ', 1000.00, 60.00, 10.00, 20, '2024-01-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `p2p_sevings`
--
ALTER TABLE `p2p_sevings`
  ADD PRIMARY KEY (`package_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `p2p_sevings`
--
ALTER TABLE `p2p_sevings`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
