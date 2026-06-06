-- 1. USER TABLE
CREATE TABLE `user` (
    `user_id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_name` VARCHAR(50) NOT NULL,
    `number` VARCHAR(15) UNIQUE NOT NULL,
    `email` VARCHAR(100) UNIQUE NOT NULL,
    `gender` ENUM('male', 'female', 'other'),
    `userId` VARCHAR(50) UNIQUE,
    `referred_id` INT,
    `pass` VARCHAR(255) NOT NULL,
    `profile_picture` VARCHAR(255),
    `status` ENUM('active', 'deactivate', 'cancellation') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. BALANCE TABLE
CREATE TABLE `balance` (
    `balance_id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `total_balance` DECIMAL(12,2) DEFAULT 0.00,
    `gold_balance` DECIMAL(12,2) DEFAULT 0.00,
    `coin_balance` DECIMAL(12,2) DEFAULT 0.00,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE
);

-- 3. RECHARGE TABLE
CREATE TABLE `recharge` (
    `recharge_id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `mobile_number` VARCHAR(15),
    `recharge_amount` DECIMAL(10,2),
    `recharge_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `recharge_status` ENUM('pending', 'approve') DEFAULT 'pending',
    FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);

-- 4. DONATE TABLE
CREATE TABLE `donate` (
    `donate_id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `donate_amount` DECIMAL(10,2),
    `donate_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);

-- 5. DEPOSIT TABLE
CREATE TABLE `deposit` (
    `deposit_id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `deposit_amount` DECIMAL(10,2),
	`deposit_method` ENUM('Bkash', 'Nagad', 'Binance', 'Upay') DEFAULT NULL,
    `deposit_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deposit_status` ENUM('pending', 'approve') DEFAULT 'pending',
    FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);

-- 6. BONUS TABLE
CREATE TABLE `bonus` (
    `bonus_id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `bonus_amount` DECIMAL(10,2),
    `bonus_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);

-- 7. BUY GOLD TABLE
CREATE TABLE `buyGold` (
    `buy_id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `amount` DECIMAL(12,2),
    `quantity` DECIMAL(10,2),
    `buy_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);

-- 8. SELL GOLD TABLE
CREATE TABLE `sellGold` (
    `sell_id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `amount` DECIMAL(12,2),
    `quantity` DECIMAL(10,2),
    `sell_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);

-- 9. COLLECT GOLD TABLE
CREATE TABLE `collectGold` (
    `collect_id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `quantity` DECIMAL(10,2),
    `delivery_user` VARCHAR(100),
    `delivery_user_number` VARCHAR(15),
    `delivery_address` TEXT,
    `collect_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `delivery_date` DATE,
    `collect_status` ENUM('pending', 'processing', 'delivered', 'cancelled') DEFAULT 'pending',
    FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);

-- 10. REFERRAL TABLE
CREATE TABLE `reffer` (
    `refer_id_no` INT PRIMARY KEY AUTO_INCREMENT,
    `refer_id` INT NOT NULL,
    `referred_id` INT NOT NULL,
    FOREIGN KEY (`refer_id`) REFERENCES `user`(`user_id`),
    FOREIGN KEY (`referred_id`) REFERENCES `user`(`user_id`)
);

-- 11. VERIFY TABLE
CREATE TABLE `verify` (
    `verify_id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `verify_date` DATE,
    `verify_expair` DATE,
    `verify_status` ENUM('active', 'deactive') DEFAULT 'deactive',
    FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);

-- 12. P2P TABLE
CREATE TABLE `p2p` (
    `p2p_id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `package_id` INT,
    `purchase_date` DATE,
    `expair_date` DATE,
    `last_collect_date` DATE,
    `p2p_status` ENUM('active', 'deactive') DEFAULT 'deactive',
    FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);

-- 13. GOLD PRICE TABLE
CREATE TABLE `gold_price` (
    `gold_price_id` INT PRIMARY KEY AUTO_INCREMENT,
    `gold_price` DECIMAL(12,2),
    `date` DATE UNIQUE
);

-- 14. COIN PRICE TABLE
CREATE TABLE `coin_price` (
    `coin_price_id` INT PRIMARY KEY AUTO_INCREMENT,
    `coin_price` DECIMAL(12,6),
    `date` DATE UNIQUE
);

-- 15. BONUS COIN TABLE
CREATE TABLE `bonus_coin` (
    `bonus_coin_id` INT PRIMARY KEY AUTO_INCREMENT,
    `bonus_coin` DECIMAL(10,2),
    `date` DATE UNIQUE
);

-- 16. MARKETING DROP TABLE
CREATE TABLE `marketing_drop` (
    `marketing_id` INT PRIMARY KEY AUTO_INCREMENT,
    `marketing_title` VARCHAR(255),
    `marketing_dsc` TEXT,
    `marketing_image` VARCHAR(255),
    `marketing_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `marketing_status` ENUM('active', 'deactive') DEFAULT 'active'
);

-- 16. MARKETING DROP TABLE
CREATE TABLE `marketing_submissions` (
    `submission_id` INT PRIMARY KEY AUTO_INCREMENT,
    `post_link` VARCHAR(255),
    `submission_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `submission_status` ENUM('pending', 'approve', 'rejected') DEFAULT 'pending'
);

-- 17. P2P SAVINGS PACKAGE TABLE
CREATE TABLE `p2p_sevings` (
    `package_id` INT PRIMARY KEY AUTO_INCREMENT,
    `package_name` VARCHAR(100),
    `package_price` DECIMAL(12,2),
    `daily_income` DECIMAL(12,2),
    `daily_coin` DECIMAL(10,2),
    `duration_date` INT COMMENT 'Duration in days',
    `create_date` DATE
);