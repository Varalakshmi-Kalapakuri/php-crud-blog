<?php
include 'auth_check.php';
include 'db_connect.php';

$searchTerm = "";
$results = [];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["q"])) {
    $searchTerm = trim($_GET["q"]);
    $stmt = $conn->prepare("SELECT * FROM posts WHERE title LIKE ? OR content LIKE ? ORDER BY created_at DESC");
    $like = "%$searchTerm%";
    $stmt->bind_param("ss", $like, $like);
    $stmt->execute();
    $results = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #BFFCDD; padding: 20px; }
        .container { max-width: 800px; margin: auto; background: #fff; padding: 30px; border-radius: 10px; }
        h2 { text-align: center; color: #007187; margin-bottom: 20px; }
        .post { background: #f9f9ff; padding: 15px; margin-bottom: 15px; border-radius: 8px; }
        .post h3 { margin: 0 0 10px; }
        .post p { white-space: pre-wrap; }
        .back-link { text-align: center; margin-top: 20px; }
        .back-link a { color: #007187; font-weight: bold; text-decoration: none; }
        .back-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Search Results for "<?= htmlspecialchars($searchTerm) ?>"</h2>
        <?php if ($results && $results->num_rows > 0): ?>
            <?php while ($row = $results->fetch_assoc()): ?>
                <div class="post">
                    <h3><?= htmlspecialchars($row['title']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
                    <small>Posted on <?= $row['created_at'] ?></small>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align:center;">No results found.</p>
        <?php endif; ?>
        <div class="back-link">
            <a href="main.php">⬅ Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
