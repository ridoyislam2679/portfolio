-- Ad watch history table
CREATE TABLE IF NOT EXISTS ad_watch_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    ad_id INT NOT NULL,
    reward_coins DECIMAL(10,2) DEFAULT 1,
    watched_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_date (user_id, DATE(watched_at)),
    UNIQUE KEY unique_user_ad_day (user_id, ad_id, DATE(watched_at))
);