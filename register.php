<?php
include 'db_connect.php';

$message = "";
$message_class = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST["fullname"]);
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirm = trim($_POST["confirm_password"]);

    if ($password !== $confirm) {
        $message = "Passwords do not match.";
        $message_class = "error";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        // Insert fullname, email, username, password
        $stmt = $conn->prepare("INSERT INTO users (fullname, email, username, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullname, $email, $username, $hashed);

        if ($stmt->execute()) {
            $message = "Registration successful. <a href='login.php'>Click here to login</a>.";
            $message_class = "success";
        } else {
            $message = "Error: Username or Email might already exist.";
            $message_class = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #BFFCDD;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #ffffff;
            padding: 35px 40px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
            width: 360px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #444;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 18px;
            border: 1.5px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #4a90e2;
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #2ecc71;
            border: none;
            color: white;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #27ae60;
        }

        .success {
            background-color: #e8f6ef;
            color: #2d624d;
            border: 1px solid #c9eadb;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .error {
            background-color: #fdecea;
            color: #a94442;
            border: 1px solid #f5c2c2;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }

        a {
            color: #4a90e2;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>User Registration</h2>

    <?php if ($message): ?>
        <p class="<?= htmlspecialchars($message_class) ?>"><?= $message ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <input type="submit" value="Register">
    </form>
</div>
</body>
</html>
