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
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `deposit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deposit_amount` decimal(10,2) DEFAULT NULL,
  `deposit_number` int(15) NOT NULL,
  `deposit_method` enum('Bkash','Nagad','Binance','Upay') DEFAULT NULL,
  `deposit_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `deposit_status` enum('pending','approve','cancle') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`deposit_id`, `user_id`, `deposit_amount`, `deposit_number`, `deposit_method`, `deposit_date`, `deposit_status`) VALUES
(1, 1, 2000.00, 0, 'Bkash', '2024-01-18 05:00:00', 'approve'),
(2, 2, 1500.00, 0, 'Nagad', '2024-01-22 08:30:00', 'approve'),
(3, 3, 5000.00, 0, 'Upay', '2024-02-08 03:45:00', 'approve'),
(4, 4, 800.00, 0, 'Bkash', '2024-02-12 10:20:00', 'approve'),
(5, 5, 3000.00, 0, 'Bkash', '2024-02-22 07:10:00', 'approve'),
(6, 6, 2500.00, 0, 'Bkash', '2024-03-08 04:30:00', 'approve'),
(7, 7, 400.00, 0, 'Bkash', '2024-03-14 09:50:00', 'approve'),
(8, 8, 7000.00, 0, 'Bkash', '2024-03-22 06:40:00', 'approve'),
(9, 9, 1200.00, 0, 'Bkash', '2024-03-28 11:15:00', 'approve'),
(10, 10, 3500.00, 0, 'Bkash', '2024-04-03 05:25:00', ''),
(11, 17, 500.00, 1478523369, 'Binance', '2026-04-21 02:09:11', ''),
(12, 17, 100.00, 1478523369, 'Binance', '2026-04-21 02:10:26', ''),
(13, 17, 300.00, 4566626, 'Binance', '2026-04-21 02:10:33', 'approve'),
(14, 17, 600.00, 1478523369, 'Binance', '2026-04-21 02:12:29', 'cancle');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`deposit_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `deposit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposit`
--
ALTER TABLE `deposit`
  ADD CONSTRAINT `deposit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
