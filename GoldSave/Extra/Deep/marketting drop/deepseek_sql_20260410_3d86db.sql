-- Marketing posts table (for admin to set daily posts)
CREATE TABLE IF NOT EXISTS marketing_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    hashtags VARCHAR(255),
    reward_coins DECIMAL(10,2) DEFAULT 50,
    post_date DATE NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_date (post_date)
);

-- Marketing submissions table (for user submissions)
CREATE TABLE IF NOT EXISTS marketing_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    submission_id VARCHAR(50) UNIQUE NOT NULL,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    platform ENUM('facebook', 'instagram', 'twitter') NOT NULL,
    post_link TEXT NOT NULL,
    screenshot_url TEXT,
    reward_coins DECIMAL(10,2) DEFAULT 0,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    admin_notes TEXT,
    submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    verified_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES marketing_posts(id) ON DELETE CASCADE
);