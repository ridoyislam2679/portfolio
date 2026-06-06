-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2026 at 04:34 AM
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
-- Table structure for table `buygold`
--

CREATE TABLE `buygold` (
  `buy_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `bonus_coin` int(11) DEFAULT NULL,
  `buy_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buygold`
--

INSERT INTO `buygold` (`buy_id`, `user_id`, `amount`, `quantity`, `bonus_coin`, `buy_date`) VALUES
(1, 1, 5000.00, 2.50, NULL, '2024-01-25 04:00:00'),
(2, 2, 3000.00, 1.50, NULL, '2024-02-05 08:30:00'),
(3, 3, 8000.00, 4.00, NULL, '2024-02-18 05:15:00'),
(4, 5, 4500.00, 2.25, NULL, '2024-03-01 03:45:00'),
(5, 6, 3500.00, 1.75, NULL, '2024-03-12 10:20:00'),
(6, 8, 10000.00, 5.00, NULL, '2024-03-20 07:50:00'),
(7, 9, 2500.00, 1.25, NULL, '2024-03-28 04:30:00'),
(8, 10, 6000.00, 3.00, NULL, '2024-04-05 09:10:00'),
(9, 3, 4000.00, 2.00, NULL, '2024-04-08 06:40:00'),
(10, 1, 3500.00, 1.75, NULL, '2024-04-10 03:00:00'),
(18, 17, 1000.00, 0.14, 10, '2026-04-20 14:38:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buygold`
--
ALTER TABLE `buygold`
  ADD PRIMARY KEY (`buy_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buygold`
--
ALTER TABLE `buygold`
  MODIFY `buy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buygold`
--
ALTER TABLE `buygold`
  ADD CONSTRAINT `buygold_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
