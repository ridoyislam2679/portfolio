<?php
// admin_marketing.php - For admin to set daily marketing posts
session_start();

// Check if admin logged in (you need to implement admin authentication)
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit;
}

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'gold_kinen');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $hashtags = $_POST['hashtags'] ?? '';
    $reward_coins = $_POST['reward_coins'] ?? 0;
    $post_date = $_POST['post_date'] ?? date('Y-m-d');
    
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    $stmt = $conn->prepare("INSERT INTO marketing_posts (title, description, hashtags, reward_coins, post_date, status, created_at) VALUES (?, ?, ?, ?, ?, 'active', NOW())");
    $stmt->bind_param("sssis", $title, $description, $hashtags, $reward_coins, $post_date);
    $stmt->execute();
    $conn->close();
    
    $success = "Post created successfully!";
}

// Get all posts
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$posts = $conn->query("SELECT * FROM marketing_posts ORDER BY post_date DESC");
$conn->close();
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Marketing Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0a0a1a; color: #fff; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .card { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,215,0,0.2); border-radius: 20px; padding: 20px; margin-bottom: 20px; }
        .form-control { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,215,0,0.2); color: #fff; }
        .form-control:focus { background: rgba(255,215,0,0.05); border-color: #FFD700; }
        .btn-primary { background: linear-gradient(135deg, #FFD700, #FFA500); border: none; color: #0a0a1a; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4"><i class="fas fa-chart-line"></i> Marketing Drop - Admin Panel</h1>
        
        <?php if(isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <div class="card">
            <h3>Create New Marketing Post</h3>
            <form method="POST">
                <div class="mb-3">
                    <label>Post Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Post Description</label>
                    <textarea name="description" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Hashtags (comma separated)</label>
                    <input type="text" name="hashtags" class="form-control" placeholder="GoldKinen, GoldKinenBangladesh, EarnCoins">
                </div>
                <div class="mb-3">
                    <label>Reward Coins</label>
                    <input type="number" name="reward_coins" class="form-control" value="50" required>
                </div>
                <div class="mb-3">
                    <label>Post Date</label>
                    <input type="date" name="post_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Post</button>
            </form>
        </div>
        
        <div class="card">
            <h3>Previous Posts</h3>
            <table class="table table-dark">
                <thead>
                    <tr><th>Date</th><th>Title</th><th>Reward</th><th>Status</th></tr>
                </thead>
                <tbody>
                    <?php while($post = $posts->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $post['post_date']; ?></td>
                        <td><?php echo htmlspecialchars($post['title']); ?></td>
                        <td><?php echo $post['reward_coins']; ?> Coins</td>
                        <td><?php echo $post['status']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>