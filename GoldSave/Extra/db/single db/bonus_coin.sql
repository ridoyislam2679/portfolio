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
-- Table structure for table `bonus_coin`
--

CREATE TABLE `bonus_coin` (
  `bonus_coin_id` int(11) NOT NULL,
  `bonus_coin` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bonus_coin`
--

INSERT INTO `bonus_coin` (`bonus_coin_id`, `bonus_coin`, `date`) VALUES
(1, 100.00, '2024-01-01'),
(2, 110.00, '2024-02-01'),
(3, 105.00, '2024-03-01'),
(4, 115.00, '2024-03-15'),
(5, 120.00, '2024-04-01'),
(6, 125.00, '2024-04-05'),
(7, 130.00, '2024-04-08'),
(8, 128.00, '2024-04-10'),
(9, 132.00, '2024-04-11'),
(10, 135.00, '2024-04-12'),
(13, 20.00, '2026-04-17'),
(14, 10.00, '2026-04-20'),
(16, 50.00, '2026-04-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bonus_coin`
--
ALTER TABLE `bonus_coin`
  ADD PRIMARY KEY (`bonus_coin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bonus_coin`
--
ALTER TABLE `bonus_coin`
  MODIFY `bonus_coin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
