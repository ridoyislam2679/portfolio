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
(10, 10, 120.00, '2024-04-09 18:00:00'),
(12, 1, 20.00, '2026-04-17 01:34:41'),
(13, 17, 20.00, '2026-04-17 02:01:00'),
(14, 17, 10.00, '2026-04-20 10:47:56'),
(15, 17, 0.00, '2026-04-21 01:29:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bonus`
--
ALTER TABLE `bonus`
  ADD PRIMARY KEY (`bonus_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bonus`
--
ALTER TABLE `bonus`
  MODIFY `bonus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bonus`
--
ALTER TABLE `bonus`
  ADD CONSTRAINT `bonus_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
