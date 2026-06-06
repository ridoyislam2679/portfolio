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
-- Table structure for table `reffer`
--

CREATE TABLE `reffer` (
  `refer_id_no` int(11) NOT NULL,
  `refer_id` int(11) NOT NULL,
  `referred_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reffer`
--

INSERT INTO `reffer` (`refer_id_no`, `refer_id`, `referred_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 4),
(4, 3, 5),
(5, 2, 6),
(6, 5, 7),
(7, 4, 8),
(8, 6, 9),
(9, 8, 10),
(10, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reffer`
--
ALTER TABLE `reffer`
  ADD PRIMARY KEY (`refer_id_no`),
  ADD KEY `refer_id` (`refer_id`),
  ADD KEY `referred_id` (`referred_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reffer`
--
ALTER TABLE `reffer`
  MODIFY `refer_id_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reffer`
--
ALTER TABLE `reffer`
  ADD CONSTRAINT `reffer_ibfk_1` FOREIGN KEY (`refer_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `reffer_ibfk_2` FOREIGN KEY (`referred_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
