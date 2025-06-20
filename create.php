<?php
include 'auth_check.php';
include 'db_connect.php';

$message = "";
$message_class = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        $message = "✅ Post created successfully!";
        $message_class = "success";
    } else {
        $message = "❌ Error: Could not create the post.";
        $message_class = "error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #BFFCDD;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 40px;
        }

        .form-container {
            background: #ffffff;
            padding: 35px 40px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            width: 420px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1.5px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        input[type="submit"] {
            background-color: #007187;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #27ae60;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .success, .error {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            text-align: center;
        }

        .success { background-color: #e8f6ef; color: #5a4caf; }
        .error { background-color: #fdecea; color: #a94442; }

        /* Search bar */
        .search-bar {
            margin-bottom: 25px;
            text-align: center;
        }

        .search-bar input[type="text"] {
            padding: 10px;
            width: 250px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .search-bar button {
            padding: 10px 15px;
            border: none;
            background-color: #007187;
            color: white;
            border-radius: 5px;
        }

        .search-bar button:hover {
            background-color: #005b6e;
        }
    </style>
</head>
<body>
    <div class="search-bar">
        <form method="get" action="search.php">
            <input type="text" name="q" placeholder="Search posts..." required />
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="form-container">
        <h2>Create New Post</h2>
        <?php if ($message): ?>
            <div class="<?= $message_class ?>"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="text" name="title" placeholder="Enter post title" required>
            <textarea name="content" rows="6" placeholder="Write your content here..." required></textarea>
            <input type="submit" value="Publish">
        </form>

        <div class="back-link">
            <a href="main.php">⬅ Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
