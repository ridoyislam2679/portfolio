<?php
require '../db/index.php';
session_start();

// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $content = trim($_POST['comment']);
    $parent_id = isset($_POST['parent_id']) ? (int)$_POST['parent_id'] : null;
    $user_id = $_SESSION['user_id'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO comments (user_id, content, parent_id) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $content, $parent_id]);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } catch (PDOException $e) {
        $error = "Error posting comment: " . $e->getMessage();
    }
}

// Fetch all comments with replies
function getComments($pdo) {
    $stmt = $pdo->query("
        SELECT c.*, u.username, u.image 
        FROM comments c
        JOIN users u ON c.user_id = u.id
        ORDER BY c.created_at DESC LIMIT 10
    ");
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Organize comments with replies
    $organized = [];
    foreach ($comments as $comment) {
        if ($comment['parent_id'] === null) {
            $comment['replies'] = [];
            $organized[$comment['id']] = $comment;
        }
    }
    
    foreach ($comments as $comment) {
        if ($comment['parent_id'] !== null && isset($organized[$comment['parent_id']])) {
            $organized[$comment['parent_id']]['replies'][] = $comment;
        }
    }
    
    return array_values($organized);
}

$comments = getComments($pdo);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Comments Section</title>
    <style>
        .comment-section {
            max-width: 800px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }
        .comment {
            margin-bottom: 20px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 8px;
        }
        .comment-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .user-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .username {
            font-weight: bold;
        }
        .comment-time {
            color: #666;
            font-size: 0.8em;
            margin-left: 10px;
        }
        .comment-content {
            margin-left: 50px;
        }
        .reply {
            margin-left: 50px;
            margin-top: 10px;
            padding-left: 15px;
            border-left: 3px solid #ddd;
        }
        .reply-form {
            margin-top: 10px;
            display: none;
        }
        .comment-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .comment-form button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .reply-btn {
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 0.8em;
        }
        .live-badge {
            background: #4CAF50;
            color: white;
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 0.7em;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="comment-section">
        <h2>Comments</h2>
        
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <div class="comment-header">
                    <img src="<?= htmlspecialchars($comment['image']) ?>" class="user-image" alt="User">
                    <span class="username"><?= htmlspecialchars($comment['username']) ?></span>
                    <span class="live-badge">Live (F)</span>
                    <span class="comment-time"><?= date('M j, Y g:i a', strtotime($comment['created_at'])) ?></span>
                </div>
                <div class="comment-content">
                    <?= nl2br(htmlspecialchars($comment['content'])) ?>
                    <button class="reply-btn" onclick="showReplyForm(<?= $comment['id'] ?>)">Reply</button>
                    
                    <div class="reply-form" id="reply-form-<?= $comment['id'] ?>">
                        <form method="post">
                            <input type="hidden" name="parent_id" value="<?= $comment['id'] ?>">
                            <textarea name="comment" rows="3" placeholder="Write your reply..."></textarea>
                            <button type="submit">Post Reply</button>
                        </form>
                    </div>
                </div>
                
                <?php foreach ($comment['replies'] as $reply): ?>
                    <div class="reply">
                        <div class="comment-header">
                            <img src="<?= htmlspecialchars($reply['image']) ?>" class="user-image" alt="User">
                            <span class="username"><?= htmlspecialchars($reply['username']) ?></span>
                            <span class="live-badge">Live (<?= $reply['user_id'] == 1 ? 'A' : 'I' ?>)</span>
                            <span class="comment-time"><?= date('M j, Y g:i a', strtotime($reply['created_at'])) ?></span>
                        </div>
                        <div class="comment-content">
                            <?= nl2br(htmlspecialchars($reply['content'])) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        
        <div class="comment-form">
            <h3>Write your comments...</h3>
            <form method="post">
                <textarea name="comment" rows="5" placeholder="Write your comment..."></textarea>
                <button type="submit">Post Comment</button>
            </form>
        </div>
    </div>

    <script>
        function showReplyForm(commentId) {
            var form = document.getElementById('reply-form-' + commentId);
            form.style.display = form.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>