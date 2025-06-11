<?php
session_start();
include 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$message = "";

// Handle delete form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['post_id'])) {
    $id = (int) $_POST['post_id'];
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $message = "Post deleted successfully!";
    }
}

// Fetch all posts
$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Posts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #BFFCDD;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 750px;
            margin: auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            color: #333;
        }

        .message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .post {
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #BFFCDD;
            background-color: #f0fffb;
            border-radius: 4px;
        }

        h3 {
            margin-top: 0;
        }

        form {
            margin-top: 10px;
        }

        input[type="submit"] {
            background-color: #dc3545;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #c82333;
        }

        .nav-link {
            color: #007187;
            text-decoration: none;
            margin-right: 10px;
        }

        .nav-link:hover {
            text-decoration: underline;
        }

        p {
            color: #444;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="read.php" class="nav-link">← Back to Posts</a> | <a href="logout.php" class="nav-link">Logout</a>
    <h2>Delete Posts</h2>

    <?php if (!empty($message)): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="post">
                <h3><?= htmlspecialchars($row['title']) ?></h3>
                <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
                <form method="post" onsubmit="return confirm('Delete this post?');">
                    <input type="hidden" name="post_id" value="<?= $row['id'] ?>">
                    <input type="submit" value="Delete">
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No posts available to delete.</p>
    <?php endif; ?>
</div>

</body>
</html>
