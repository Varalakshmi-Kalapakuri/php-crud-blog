<?php
include 'auth_check.php';
include 'db_connect.php';
$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #BFFCDD;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #00A7C3;
        }

        .top-nav {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 30px;
        }

        a.button {
            background: #007187;
            color: white;
            padding: 10px 22px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s ease;
            border: none;
        }

        a.button:hover {
            background: #00A7C3;
        }

        .post {
            border-bottom: 1px solid #d1d9e6;
            padding: 15px 0;
        }

        .post h3 {
            margin: 0 0 10px;
            color: #333;
        }

        .post p {
            margin-bottom: 10px;
            color: #555;
        }

        .post small {
            color: #999;
        }

        .post .actions {
            margin-top: 10px;
        }

        .post .actions a {
            margin-right: 12px;
            color: #4169e1;
            text-decoration: none;
        }

        .post .actions a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="top-nav">
        <a href="create.php" class="button">Create Post</a>
        <a href="read.php" class="button">Read Post</a>
        <a href="edit.php" class="button">Update Post</a>
        <a href="delete.php" class="button">Delete Post</a>
        <a href="logout.php" class="button">Logout</a>
    </div>
</div>
</body>
</html>
