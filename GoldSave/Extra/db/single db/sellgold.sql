-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2026 at 04:36 AM
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
(10, 10, 2800.00, 1.40, '2024-04-12 04:50:00'),
(11, 17, NULL, NULL, '2026-04-17 05:15:05'),
(12, 17, NULL, NULL, '2026-04-17 05:15:42'),
(13, 17, 2750.00, 0.50, '2026-04-17 05:16:48'),
(14, 17, 2750.00, 0.50, '2026-04-17 05:17:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sellgold`
--
ALTER TABLE `sellgold`
  ADD PRIMARY KEY (`sell_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sellgold`
--
ALTER TABLE `sellgold`
  MODIFY `sell_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sellgold`
--
ALTER TABLE `sellgold`
  ADD CONSTRAINT `sellgold_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
