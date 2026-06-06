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
-- Table structure for table `coin_price`
--

CREATE TABLE `coin_price` (
  `coin_price_id` int(11) NOT NULL,
  `coin_price` decimal(12,6) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coin_price`
--

INSERT INTO `coin_price` (`coin_price_id`, `coin_price`, `date`) VALUES
(1, 2.500000, '2024-01-01'),
(2, 2.550000, '2024-02-01'),
(3, 2.600000, '2024-03-01'),
(4, 2.580000, '2024-03-15'),
(5, 2.620000, '2024-04-01'),
(6, 2.650000, '2024-04-05'),
(7, 2.630000, '2024-04-08'),
(8, 2.670000, '2024-04-10'),
(9, 2.700000, '2024-04-11'),
(10, 2.680000, '2024-04-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coin_price`
--
ALTER TABLE `coin_price`
  ADD PRIMARY KEY (`coin_price_id`),
  ADD UNIQUE KEY `date` (`date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coin_price`
--
ALTER TABLE `coin_price`
  MODIFY `coin_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
