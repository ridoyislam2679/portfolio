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
(1, 1, 1, '2024-01-20', '2025-01-20', '2024-04-10', 'deactive'),
(2, 2, 2, '2024-01-25', '2025-01-25', '2024-04-09', 'deactive'),
(3, 3, 1, '2024-02-10', '2025-02-10', '2024-04-08', 'deactive'),
(4, 4, 3, '2024-02-15', '2024-08-15', '2024-03-15', 'deactive'),
(5, 5, 2, '2024-02-22', '2025-02-22', '2024-04-07', 'deactive'),
(6, 6, 1, '2024-03-05', '2025-03-05', '2024-04-06', 'deactive'),
(7, 7, 3, '2024-03-12', '2024-09-12', '2024-03-20', 'deactive'),
(8, 8, 2, '2024-03-20', '2025-03-20', '2024-04-05', 'deactive'),
(9, 9, 1, '2024-03-28', '2025-03-28', '2024-04-04', 'deactive'),
(10, 10, 2, '2024-04-05', '2025-04-05', '2024-04-10', 'deactive'),
(11, 17, 1, '2026-01-18', '2026-02-17', '2026-04-21', 'deactive'),
(12, 17, 1, '2026-01-18', '2026-03-17', '2026-04-21', 'deactive'),
(13, 17, 1, '2026-04-15', '2026-05-08', '2026-04-21', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `p2p`
--
ALTER TABLE `p2p`
  ADD PRIMARY KEY (`p2p_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `p2p`
--
ALTER TABLE `p2p`
  MODIFY `p2p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `p2p`
--
ALTER TABLE `p2p`
  ADD CONSTRAINT `p2p_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
