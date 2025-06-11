<?php
session_start();
include 'db_connect.php';

// Redirect if user not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$message = "";

// Handle form submission for updating a specific post
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['post_id'])) {
    $id = (int)$_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $update = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $update->bind_param("ssi", $title, $content, $id);
    if ($update->execute()) {
        $message = "Post updated successfully!";
    }
}

// Fetch all posts
$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Posts</title>
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
            background: #fff;
            padding: 25px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
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

        .form-container {
            margin-bottom: 30px;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            background-color: #fdfdfd;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .update-btn {
            background-color: #007187;
            color: white;
            padding: 10px 20px;
            margin-top: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .update-btn:hover {
            background-color: #005b6e;
        }

        .nav-link {
            color: #007187;
            text-decoration: none;
            margin-right: 10px;
        }

        .nav-link:hover {
            text-decoration: underline;
        }

        .actions {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="actions">
        <a href="read.php" class="nav-link">← Back to Posts</a> |
        <a href="logout.php" class="nav-link">Logout</a>
    </div>

    <h2>Edit Posts</h2>

    <?php if (!empty($message)): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="form-container">
                <form method="post">
                    <input type="hidden" name="post_id" value="<?= $row['id'] ?>">

                    <label for="title_<?= $row['id'] ?>">Title:</label>
                    <input type="text" id="title_<?= $row['id'] ?>" name="title" value="<?= htmlspecialchars($row['title']) ?>" required>

                    <label for="content_<?= $row['id'] ?>">Content:</label>
                    <textarea id="content_<?= $row['id'] ?>" name="content" rows="4" required><?= htmlspecialchars($row['content']) ?></textarea>

                    <input type="submit" value="Update" class="update-btn">
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No posts available to edit.</p>
    <?php endif; ?>
</div>
</body>
</html>
