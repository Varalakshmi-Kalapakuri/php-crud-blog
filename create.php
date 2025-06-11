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
            justify-content: center;
            align-items: center;
            height: 100vh;
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
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #4a90e2;
            outline: none;
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
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #27ae60;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #4a90e2;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .success {
            background-color: #e8f6ef;
            color: #5a4caf;
            border: 1px solid #c9eadb;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            text-align: center;
        }

        .error {
            background-color: #fdecea;
            color: #a94442;
            border: 1px solid #f5c2c2;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            text-align: center;
        }
    </style>
</head>
<body>
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
