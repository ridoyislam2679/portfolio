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
-- Table structure for table `marketing_submissions`
--

CREATE TABLE `marketing_submissions` (
  `submission_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_link` varchar(255) DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `submission_status` enum('pending','approve','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marketing_submissions`
--

INSERT INTO `marketing_submissions` (`submission_id`, `user_id`, `post_link`, `submission_date`, `submission_status`) VALUES
(1, 0, 'https://www.facebook.com/', '2026-04-17 03:02:26', 'pending'),
(2, 0, 'https://www.facebook.com/', '2026-04-17 03:02:33', 'pending'),
(3, 0, 'https://www.facebook.com/', '2026-04-17 03:02:37', 'pending'),
(4, 0, 'https://www.facebook.com/', '2026-04-17 03:03:26', 'pending'),
(5, 17, 'https://www.facebook.com/', '2026-04-27 03:10:42', 'rejected'),
(6, 17, 'https://www.facebook.com/hridoy42679', '2026-04-17 03:16:20', 'approve');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `marketing_submissions`
--
ALTER TABLE `marketing_submissions`
  ADD PRIMARY KEY (`submission_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `marketing_submissions`
--
ALTER TABLE `marketing_submissions`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
