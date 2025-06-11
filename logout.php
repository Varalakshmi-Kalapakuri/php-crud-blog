<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="refresh" content="3;url=login.php">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Logged Out</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .message-box {
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
        }
        h2 {
            color: #333;
            margin-bottom: 15px;
        }
        p {
            color: #666;
            font-size: 16px;
        }
        .redirect {
            margin-top: 20px;
            font-size: 14px;
        }
        .redirect a {
            color: #007bff;
            text-decoration: none;
        }
        .redirect a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <h2>Logged Out</h2>
        <p>You have been logged out successfully.</p>
        <p class="redirect">Redirecting to <a href="login.php">Login Page</a> in 3 seconds...</p>
    </div>
</body>
</html>
