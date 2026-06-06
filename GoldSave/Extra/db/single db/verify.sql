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
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `verify_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `verify_date` date DEFAULT current_timestamp(),
  `verify_expair` date DEFAULT NULL,
  `verify_status` enum('active','deactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verify`
--

INSERT INTO `verify` (`verify_id`, `user_id`, `verify_date`, `verify_expair`, `verify_status`) VALUES
(1, 1, '2024-01-20', '2025-01-20', 'deactive'),
(2, 2, '2024-01-25', '2025-01-25', 'deactive'),
(3, 3, '2024-02-10', '2025-02-10', 'deactive'),
(4, 4, '2024-02-15', '2025-02-15', 'deactive'),
(5, 5, '2024-02-22', '2025-02-22', 'deactive'),
(6, 6, '2024-03-05', '2025-03-05', 'deactive'),
(7, 7, '2024-03-12', '2025-03-12', 'deactive'),
(8, 8, '2024-03-20', '2025-03-20', 'deactive'),
(9, 9, '2024-03-28', '2025-03-28', 'deactive'),
(10, 10, '2024-04-05', '2025-04-05', 'deactive'),
(14, 17, '2026-01-18', '2026-02-18', 'deactive'),
(15, 17, '2026-04-18', '2026-05-18', 'active');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `verify`
--
ALTER TABLE `verify`
  MODIFY `verify_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `verify`
--
ALTER TABLE `verify`
  ADD CONSTRAINT `verify_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
