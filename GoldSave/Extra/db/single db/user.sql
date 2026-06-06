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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `userId` varchar(50) DEFAULT NULL,
  `referred_id` int(11) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `status` enum('active','deactivate','cancellation') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `number`, `email`, `gender`, `userId`, `referred_id`, `pass`, `profile_picture`, `status`, `created_at`) VALUES
(1, 'রাকিব হাসান', '01710000001', 'rakib@gmail.com', 'male', 'USER1001', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rakib.jpg', 'active', '2024-01-15 04:30:00'),
(2, 'সাবরিনা আক্তার', '01710000002', 'sabrina@gmail.com', 'female', 'USER1002', 1, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sabrina.jpg', 'active', '2024-01-20 08:45:00'),
(3, 'ইমরান খান', '01710000003', 'imran@gmail.com', 'male', 'USER1003', 1, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'imran.jpg', 'active', '2024-02-05 03:15:00'),
(4, 'নুসরাত জাহান', '01710000004', 'nusrat@gmail.com', 'female', 'USER1004', 2, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'nusrat.jpg', 'deactivate', '2024-02-10 10:20:00'),
(5, 'তানভীর আহমেদ', '01710000005', 'tanvir@gmail.com', 'male', 'USER1005', 3, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tanvir.jpg', 'active', '2024-02-18 05:00:00'),
(6, 'ফারজানা ইসলাম', '01710000006', 'farzana@gmail.com', 'female', 'USER1006', 2, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'farzana.jpg', 'active', '2024-03-01 02:30:00'),
(7, 'শাহরিয়ার হোসেন', '01710000007', 'shahriyar@gmail.com', 'male', 'USER1007', 5, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'shahriyar.jpg', 'cancellation', '2024-03-10 07:45:00'),
(8, 'মিম আক্তার', '01710000008', 'mim@gmail.com', 'female', 'USER1008', 4, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mim.jpg', 'active', '2024-03-15 13:00:00'),
(9, 'রিয়াদ মিয়া', '01710000009', 'riyad@gmail.com', 'male', 'USER1009', 6, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'riyad.jpg', 'active', '2024-03-20 06:10:00'),
(10, 'তাসনিম সুলতানা', '01710000010', 'tasnim@gmail.com', 'female', 'USER1010', 8, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tasnim.jpg', 'active', '2024-04-01 04:00:00'),
(11, 'Md Hridoy Islam', 'admin@gmail.com', '3253.', '', NULL, NULL, 'male', NULL, 'active', '2026-04-16 10:25:15'),
(12, 'Md Hridoy Islam', '3253.', 'admin@gmail.com', 'female', '50380349', NULL, '$2y$10$RWh8G1FeGPKkIh.CkeyZEeCSom9KxoQ9dyZuvW36QT1pPDhJcmuvi', 'image5.jpg', 'active', '2026-04-16 11:00:04'),
(13, 'Md Hridoy Islam', '1', '1@gmail.com', 'other', '79048946', NULL, '$2y$10$U02vZ6sKw7btZRfzesJuJ.OUT2ZA8qc3TN66CBvWGTPtEsAAnuk8K', 'image4.jpg', 'active', '2026-04-16 11:02:09'),
(14, 'Md Hridoy Islam', '50', '50@gmail.com', 'male', '29594044', NULL, '$2y$10$vCBzw9VxsvJ4JVZQnfi9i.tsI756HZxTu8OgqeiYiqp8S1hz.fto6', 'login-Image.png', 'active', '2026-04-16 11:19:12'),
(15, 'Md Hridoy Islam', '258', '258@gmail.com', 'male', '93490839', 29594044, '$2y$10$uCT0HZEloF4RhcwpHPyNxOPKW15HmNFi63.IelWGGFAvanaCRJsRO', 'user.png', 'active', '2026-04-16 11:24:08'),
(16, 'Md Hridoy Islam', '23', 'admigfrwe@gmail.com', 'female', '91806098', 15, '$2y$10$tGcISaY48nYZvEeI3Tdz2ONmLc0gmE0s8VXA/yxDAAq5SDz66A5Zm', 'image2.jpg', 'active', '2026-04-16 11:29:10'),
(17, 'Md Hridoy', '1230', '123@gmail.com', 'male', '91856214', 16, '$2y$10$FRwD4jx1Fh.Yf4C7mF0sYuTei0bJDG9M10T3m4aNsK7W0.q80XCSu', 'login-Image.png', 'active', '2026-04-16 14:33:45'),
(18, 'chack', '01893331426', 'chack@gmail.com', 'other', '44642724', 17, '$2y$10$3oDV6LoLx4bO67jqVhPGo.66MjN9OtQjKsKdgeSTZ8ubrEriPCeDO', 'image6.jpg', 'active', '2026-04-17 18:09:57'),
(19, 'sumi', '01893331416', 'sumi@gmail.com', 'female', '87860489', 17, '$2y$10$MRvo4osK9jR3jKaWaZprtOvDIHPQrp.e.gV1UuNouHxrnhJFD5kXu', 'image4.jpg', 'active', '2026-04-17 18:13:45'),
(20, 'mithu', '01747254110', 'mithu@gmail.com', 'male', '92988509', 17, '$2y$10$lSKH/mIrE56QR/TNPKUpNer7eJt0828JnX0JlJcVAHlPiFd1s3fSi', 'image2.jpg', 'active', '2026-04-17 18:21:01'),
(21, 'extra', '01478529630', 'extra@gmail.com', 'other', '31975244', 17, '$2y$10$72XrOCi9A9MVvSDlS86lNeXpW8y9Lkogh9DXwG9sHHfYRv1I5HHWK', 'image3.jpg', 'active', '2026-04-17 18:29:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
