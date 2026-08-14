<?php

include "database.php";

if (!isset($_GET['id'])) {
    die("Blog not found.");
}

$blog_id = $_GET['id'];

$stmt = mysqli_prepare(
    $conn,
    "SELECT blogPost.title, blogPost.content, blogPost.created_at,
            user.username
     FROM blogPost
     INNER JOIN user ON blogPost.user_id = user.id
     WHERE blogPost.id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $blog_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 1) {

    $blog = mysqli_fetch_assoc($result);

} else {
    die("Blog not found.");
}

mysqli_stmt_close($stmt);

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($blog['title']); ?></title>
</head>

<body>

    <h1><?php echo htmlspecialchars($blog['title']); ?></h1>

    <p>
        <strong>Author:</strong>
        <?php echo htmlspecialchars($blog['username']); ?>
    </p>

    <p>
        <strong>Date:</strong>
        <?php echo $blog['created_at']; ?>
    </p>

    <hr>

    <p>
        <?php echo nl2br(htmlspecialchars($blog['content'])); ?>
    </p>

    <hr>

    <a href="index.php">Back to Home</a>

</body>
</html>