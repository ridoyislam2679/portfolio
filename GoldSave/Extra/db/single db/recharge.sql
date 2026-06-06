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
-- Table structure for table `recharge`
--

CREATE TABLE `recharge` (
  `recharge_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `recharge_amount` decimal(10,2) DEFAULT NULL,
  `recharge_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `recharge_status` enum('pending','approve','rejected') DEFAULT 'pending'
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
(6, 6, '01710000006', 1500.00, '2024-03-05 08:20:00', 'rejected'),
(7, 7, '01710000007', 450.00, '2024-03-12 05:10:00', 'approve'),
(8, 8, '01710000008', 800.00, '2024-03-18 10:45:00', 'approve'),
(9, 9, '01710000009', 600.00, '2024-03-25 07:30:00', 'pending'),
(10, 10, '01710000010', 1200.00, '2024-04-05 04:15:00', 'approve'),
(12, 17, '01763029679', 30.00, '2026-04-16 17:10:13', 'approve');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recharge`
--
ALTER TABLE `recharge`
  ADD PRIMARY KEY (`recharge_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recharge`
--
ALTER TABLE `recharge`
  MODIFY `recharge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recharge`
--
ALTER TABLE `recharge`
  ADD CONSTRAINT `recharge_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
