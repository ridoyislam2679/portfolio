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
-- Table structure for table `donate`
--

CREATE TABLE `donate` (
  `donate_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `donate_amount` decimal(10,2) DEFAULT NULL,
  `donate_dsc` text DEFAULT NULL,
  `donate_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donate`
--

INSERT INTO `donate` (`donate_id`, `user_id`, `donate_amount`, `donate_dsc`, `donate_date`) VALUES
(1, 1, 100.00, NULL, '2024-02-01 02:30:00'),
(2, 2, 50.00, NULL, '2024-02-05 11:45:00'),
(3, 3, 200.00, NULL, '2024-02-15 06:00:00'),
(4, 5, 75.00, NULL, '2024-02-28 13:20:00'),
(5, 6, 150.00, NULL, '2024-03-10 04:15:00'),
(6, 8, 300.00, NULL, '2024-03-20 08:30:00'),
(7, 9, 40.00, NULL, '2024-03-28 05:50:00'),
(8, 10, 90.00, NULL, '2024-04-02 10:10:00'),
(9, 3, 120.00, NULL, '2024-04-08 03:00:00'),
(10, 1, 80.00, NULL, '2024-04-10 07:25:00'),
(12, 0, 10.00, '', '2026-04-16 16:30:18'),
(13, 0, 10.00, '', '2026-04-16 16:33:03'),
(14, 0, 10.00, 'okay', '2026-04-16 16:35:48'),
(15, 0, 30.00, 'eoajgoe werhfg;jwae ewrfg [wgerjij bger g[regf gr grehfeoajgoe werhfg;jwae ewrfg [wgerjij bger g[regf gr grehfeoajgoe werhfg;jwae ewrfg [wgerjij bger g[regf gr grehfeoajgoe werhfg;jwae ewrfg [wgerjij bger g[regf gr grehfeoajgoe werhfg;jwae ewrfg [wgerjij bger g[regf gr grehfeoajgoe werhfg;jwae ewrfg [wgerjij bger g[regf gr grehfeoajgoe werhfg;jwae ewrfg [wgerjij bger g[regf gr grehfeoajgoe werhfg;jwae ewrfg [wgerjij bger g[regf gr grehfeoajgoe werhfg;jwae ewrfg [wgerjij bger g[regf gr grehfeoajgoe werhfg;jwae ewrfg [wgerjij bger g[regf gr grehfeoajgoe werhfg;jwae ewrfg [wgerjij bger g[regf gr grehfeoajgoe werhfg;jwae ewrfg [wgerjij bger g[regf gr grehfeoajgoe werhfg;jwae ewrfg [wgerjij bger g[regf gr grehf', '2026-04-16 16:36:40'),
(16, 0, 10.00, 'donate', '2026-04-16 16:40:32'),
(17, 0, 10.00, 'donate', '2026-04-16 16:40:39'),
(18, 0, 10.00, 'donate', '2026-04-16 16:40:45'),
(19, 0, 10.00, 'donate', '2026-04-16 16:40:45'),
(20, 0, 10.00, 'donate', '2026-04-16 16:41:30'),
(21, 0, 10.00, '', '2026-04-16 16:41:35'),
(22, 0, 10.00, '', '2026-04-16 16:41:42'),
(23, 0, 10.00, '', '2026-04-16 16:42:46'),
(24, 0, 20.00, 'lat try', '2026-04-16 16:45:10'),
(25, 0, 10.00, 'try', '2026-04-17 02:02:58'),
(26, 0, 10.00, '', '2026-04-17 03:11:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donate`
--
ALTER TABLE `donate`
  ADD PRIMARY KEY (`donate_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donate`
--
ALTER TABLE `donate`
  MODIFY `donate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
