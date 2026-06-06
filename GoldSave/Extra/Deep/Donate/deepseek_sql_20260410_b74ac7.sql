-- Donations table
CREATE TABLE IF NOT EXISTS donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    donation_id VARCHAR(50) UNIQUE NOT NULL,
    user_id INT NOT NULL,
    campaign_id INT NOT NULL,
    campaign_name VARCHAR(255) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    message TEXT,
    status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Campaigns table (optional, for managing campaigns)
CREATE TABLE IF NOT EXISTS campaigns (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    goal_amount DECIMAL(10,2) NOT NULL,
    raised_amount DECIMAL(10,2) DEFAULT 0,
    image_url VARCHAR(255),
    status ENUM('active', 'completed', 'inactive') DEFAULT 'active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);