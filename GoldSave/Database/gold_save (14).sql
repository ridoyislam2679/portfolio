-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2026 at 05:16 PM
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
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `admin_email` varchar(250) NOT NULL,
  `admin_pass` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`) VALUES
(1, 'hridoy', 'hridoy@gmail.com', '1230');

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `balance_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_balance` decimal(12,2) DEFAULT 0.00,
  `gold_balance` decimal(18,8) DEFAULT 0.00000000,
  `coin_balance` decimal(12,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`balance_id`, `user_id`, `total_balance`, `gold_balance`, `coin_balance`) VALUES
(1, 22, 80.00, 0.10000000, 81.00),
(2, 23, 0.00, 0.00000000, 0.00),
(3, 24, 0.00, 0.00000000, 0.00),
(4, 25, 0.00, 0.00000000, 0.00),
(5, 26, 140.00, 0.07000000, 50.00);

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
(2, 22, 50.00, '2026-04-23 02:04:50'),
(3, 22, 0.00, '2026-05-03 18:08:44'),
(4, 22, 0.00, '2026-05-05 03:02:00');

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
(1, 50.00, '2026-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `buygold`
--

CREATE TABLE `buygold` (
  `buy_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `bonus_coin` int(11) DEFAULT NULL,
  `buy_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buygold`
--

INSERT INTO `buygold` (`buy_id`, `user_id`, `amount`, `quantity`, `bonus_coin`, `buy_date`) VALUES
(1, 22, 500.00, 0.07, 10, '2026-05-06 01:00:03'),
(2, 22, 200.00, 0.03, 0, '2026-05-06 01:00:37'),
(3, 26, 500.00, 0.07, 10, '2026-05-06 02:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `coin_price`
--

CREATE TABLE `coin_price` (
  `coin_price_id` int(11) NOT NULL,
  `coin_price` decimal(12,6) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collectgold`
--

CREATE TABLE `collectgold` (
  `collect_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `method` enum('coin','biscuit','jewelry','') DEFAULT NULL,
  `delivery_user` varchar(100) DEFAULT NULL,
  `delivery_user_number` varchar(15) DEFAULT NULL,
  `delivery_address` text DEFAULT NULL,
  `collect_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivery_date` date DEFAULT NULL,
  `collect_status` enum('pending','processing','delivered','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `deposit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deposit_amount` decimal(10,2) DEFAULT NULL,
  `deposit_number` int(15) NOT NULL,
  `deposit_method` enum('Bkash','Nagad','Binance','Upay') DEFAULT NULL,
  `deposit_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `deposit_status` enum('pending','approve','cancle') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`deposit_id`, `user_id`, `deposit_amount`, `deposit_number`, `deposit_method`, `deposit_date`, `deposit_status`) VALUES
(1, 22, 100.00, 17983, 'Binance', '2026-04-23 01:43:40', 'pending');

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
(1, 0, 500.00, 'gedery', '2026-04-23 01:51:54'),
(2, 0, 100.00, '', '2026-05-06 01:04:48'),
(3, 22, 10.00, '', '2026-05-06 01:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `gold_price`
--

CREATE TABLE `gold_price` (
  `gold_price_id` int(11) NOT NULL,
  `gold_price` decimal(12,2) DEFAULT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gold_price`
--

INSERT INTO `gold_price` (`gold_price_id`, `gold_price`, `date`) VALUES
(1, 7580.00, '2026-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `marketing_drop`
--

CREATE TABLE `marketing_drop` (
  `marketing_id` int(11) NOT NULL,
  `marketing_title` varchar(255) DEFAULT NULL,
  `marketing_dsc` text DEFAULT NULL,
  `marketing_image` varchar(255) DEFAULT NULL,
  `coin` int(11) DEFAULT NULL,
  `marketing_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `marketing_status` enum('active','deactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marketing_drop`
--

INSERT INTO `marketing_drop` (`marketing_id`, `marketing_title`, `marketing_dsc`, `marketing_image`, `coin`, `marketing_date`, `marketing_status`) VALUES
(1, 'test', 'gewrgewrgfwer', 'image1.jpg', 20, '2026-05-03 16:07:28', 'active');

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
(1, 22, 'https://www.facebook.com/', '2026-04-23 01:56:54', 'approve'),
(2, 22, 'http://localhost/GoldSave/register.php', '2026-05-06 01:24:07', 'approve');

-- --------------------------------------------------------

--
-- Table structure for table `marque`
--

CREATE TABLE `marque` (
  `marque_id` int(11) NOT NULL,
  `marque_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 22, 1, '2026-05-05', '2026-05-12', '2026-05-06', 'active'),
(2, 26, 1, '2026-05-06', '2026-05-13', '2026-05-06', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `p2p_sevings`
--

CREATE TABLE `p2p_sevings` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(100) DEFAULT NULL,
  `package_price` decimal(12,2) DEFAULT NULL,
  `daily_income` decimal(12,2) DEFAULT NULL,
  `daily_coin` decimal(10,2) DEFAULT NULL,
  `duration_date` int(11) DEFAULT NULL COMMENT 'Duration in days',
  `create_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p2p_sevings`
--

INSERT INTO `p2p_sevings` (`package_id`, `package_name`, `package_price`, `daily_income`, `daily_coin`, `duration_date`, `create_date`) VALUES
(1, 'বেসিক প্যাকেজ', 300.00, 40.00, 40.00, 7, '2024-01-01'),
(2, 'স্ট্যান্ডার্ড প্যাকেজ', 1000.00, 60.00, 60.00, 15, '2024-01-01'),
(3, 'প্রিমিয়াম প্যাকেজ', 3000.00, 100.00, 70.00, 30, '2024-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `recharge`
--

CREATE TABLE `recharge` (
  `recharge_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `recharge_amount` decimal(10,2) DEFAULT NULL,
  `recharge_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `recharge_status` enum('pending','approve','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recharge`
--

INSERT INTO `recharge` (`recharge_id`, `user_id`, `mobile_number`, `recharge_amount`, `recharge_date`, `recharge_status`) VALUES
(1, 22, '01763029679', 50.00, '2026-05-05 03:01:48', 'pending');

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
(1, 26, 22);

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

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `transfer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transfer_amount` int(250) NOT NULL,
  `transfer_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(22, 'Md Hridoy Islam', '1230', 'hridoy@gmail.com', 'male', '28180698', NULL, '$2y$10$Ag5wYc8K14z3xgw8ZaY/Oumqb6lbE3D2/tTac3ComEcyUbLwlmPFq', 'Oppo A6i.jpg', 'active', '2026-04-23 01:43:07'),
(23, 'okay', '6589', 'admin@gmail.com', 'male', '09900389', NULL, '$2y$10$UojeLjAS37JHb4CUYXkFhOb7gp4UdPSKzV7Q7KGQ8d/2gFHg1oTIa', 'PrakithikShad.png', 'active', '2026-05-06 01:55:52'),
(24, 'test', '01893331426', 'test@gmail.com', 'male', '83548866', 22, '$2y$10$/5YF.QBHohSZDbfCp9bmL.ajvJl7mJkZqu/63LJsZtULElmW14Cb2', 'PrakithikShad1.png', 'active', '2026-05-06 01:58:11'),
(25, 'selima', '7854', 'selima@gmail.com', 'female', '42262084', NULL, '$2y$10$Q3XJu2eN7seYO.nuiOkK0.O8YVpAt4Yay.Mcs.VbnYE1ANZnMOo7O', 'Screenshot (68).png', 'active', '2026-05-06 02:01:16'),
(26, 'mithu', '321456', 'mithu@gmail.com', 'male', '54932741', 22, '$2y$10$GUzfW4dvophumvxn/wW58uPe8GGcaMiADYIJ83/iwDSfS6ug/bAxW', '1778034363_PrakithikShad1.png', 'active', '2026-05-06 02:26:03');

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
(1, 22, '2026-05-05', '2026-06-04', 'deactive'),
(2, 26, '2026-05-06', '2026-06-05', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `withdraw_id` int(11) NOT NULL,
  `userr_id` int(11) NOT NULL,
  `withdraw_amount` varchar(250) NOT NULL,
  `withdraw_number` varchar(15) NOT NULL,
  `withdraw_method` varchar(250) NOT NULL,
  `withdraw_date` date NOT NULL DEFAULT current_timestamp(),
  `withdraw_status` enum('panding','approve','cancle','') NOT NULL DEFAULT 'panding'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `withdraw`
--

INSERT INTO `withdraw` (`withdraw_id`, `userr_id`, `withdraw_amount`, `withdraw_number`, `withdraw_method`, `withdraw_date`, `withdraw_status`) VALUES
(1, 22, '100', '01478523369', 'Bkash', '2026-05-05', 'panding');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`balance_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bonus`
--
ALTER TABLE `bonus`
  ADD PRIMARY KEY (`bonus_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bonus_coin`
--
ALTER TABLE `bonus_coin`
  ADD PRIMARY KEY (`bonus_coin_id`);

--
-- Indexes for table `buygold`
--
ALTER TABLE `buygold`
  ADD PRIMARY KEY (`buy_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `coin_price`
--
ALTER TABLE `coin_price`
  ADD PRIMARY KEY (`coin_price_id`),
  ADD UNIQUE KEY `date` (`date`);

--
-- Indexes for table `collectgold`
--
ALTER TABLE `collectgold`
  ADD PRIMARY KEY (`collect_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`deposit_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `donate`
--
ALTER TABLE `donate`
  ADD PRIMARY KEY (`donate_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `gold_price`
--
ALTER TABLE `gold_price`
  ADD PRIMARY KEY (`gold_price_id`);

--
-- Indexes for table `marketing_drop`
--
ALTER TABLE `marketing_drop`
  ADD PRIMARY KEY (`marketing_id`);

--
-- Indexes for table `marketing_submissions`
--
ALTER TABLE `marketing_submissions`
  ADD PRIMARY KEY (`submission_id`);

--
-- Indexes for table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`marque_id`);

--
-- Indexes for table `p2p`
--
ALTER TABLE `p2p`
  ADD PRIMARY KEY (`p2p_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `p2p_sevings`
--
ALTER TABLE `p2p_sevings`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `recharge`
--
ALTER TABLE `recharge`
  ADD PRIMARY KEY (`recharge_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reffer`
--
ALTER TABLE `reffer`
  ADD PRIMARY KEY (`refer_id_no`),
  ADD KEY `refer_id` (`refer_id`),
  ADD KEY `referred_id` (`referred_id`);

--
-- Indexes for table `sellgold`
--
ALTER TABLE `sellgold`
  ADD PRIMARY KEY (`sell_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`transfer_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- Indexes for table `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`verify_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`withdraw_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `balance`
--
ALTER TABLE `balance`
  MODIFY `balance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bonus`
--
ALTER TABLE `bonus`
  MODIFY `bonus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bonus_coin`
--
ALTER TABLE `bonus_coin`
  MODIFY `bonus_coin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buygold`
--
ALTER TABLE `buygold`
  MODIFY `buy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coin_price`
--
ALTER TABLE `coin_price`
  MODIFY `coin_price_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collectgold`
--
ALTER TABLE `collectgold`
  MODIFY `collect_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `deposit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donate`
--
ALTER TABLE `donate`
  MODIFY `donate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gold_price`
--
ALTER TABLE `gold_price`
  MODIFY `gold_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `marketing_drop`
--
ALTER TABLE `marketing_drop`
  MODIFY `marketing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `marketing_submissions`
--
ALTER TABLE `marketing_submissions`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `marque`
--
ALTER TABLE `marque`
  MODIFY `marque_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `p2p`
--
ALTER TABLE `p2p`
  MODIFY `p2p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `p2p_sevings`
--
ALTER TABLE `p2p_sevings`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `recharge`
--
ALTER TABLE `recharge`
  MODIFY `recharge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reffer`
--
ALTER TABLE `reffer`
  MODIFY `refer_id_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sellgold`
--
ALTER TABLE `sellgold`
  MODIFY `sell_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `verify`
--
ALTER TABLE `verify`
  MODIFY `verify_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `withdraw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buygold`
--
ALTER TABLE `buygold`
  ADD CONSTRAINT `buygold_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `collectgold`
--
ALTER TABLE `collectgold`
  ADD CONSTRAINT `collectgold_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `deposit`
--
ALTER TABLE `deposit`
  ADD CONSTRAINT `deposit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `p2p`
--
ALTER TABLE `p2p`
  ADD CONSTRAINT `p2p_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `recharge`
--
ALTER TABLE `recharge`
  ADD CONSTRAINT `recharge_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `sellgold`
--
ALTER TABLE `sellgold`
  ADD CONSTRAINT `sellgold_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `verify`
--
ALTER TABLE `verify`
  ADD CONSTRAINT `verify_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
