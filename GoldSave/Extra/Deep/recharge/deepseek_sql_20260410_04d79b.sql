-- Recharge history table
CREATE TABLE IF NOT EXISTS recharge_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recharge_id VARCHAR(50) UNIQUE NOT NULL,
    user_id INT NOT NULL,
    mobile_number VARCHAR(20) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    coins_used DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);