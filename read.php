<?php
include 'auth_check.php';
include 'db_connect.php';

// Fetch all posts ordered by newest first
$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Posts</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #BFFCDD;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            background: #fff;
            padding: 35px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            color: #007187;
            margin-bottom: 35px;
        }

        .post {
            background: #f9f9ff;
            border: 1px solid #e0e0ff;
            padding: 20px;
            margin-bottom: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            transition: box-shadow 0.3s ease;
        }

        .post:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .post h3 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #007187;
            font-size: 22px;
        }

        .post p {
            white-space: pre-wrap;
            color: #444;
            line-height: 1.6;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .post small {
            display: block;
            color: #888;
            font-size: 13px;
            text-align: right;
        }

        .back-link {
            text-align: center;
            margin-top: 30px;
        }

        .back-link a {
            color: #007187;
            text-decoration: none;
            font-weight: bold;
            font-size: 15px;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>All Posts</h2>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="post">
                    <h3><?= htmlspecialchars($row['title']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
                    <small> Posted on <?= htmlspecialchars($row['created_at']) ?></small>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align: center; color: #999;">No posts available.</p>
        <?php endif; ?>

        <div class="back-link">
            <a href="main.php">⬅ Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
