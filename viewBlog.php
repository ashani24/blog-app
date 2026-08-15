<?php

include "database.php";

session_start();

if (!isset($_GET['id'])) {
    die("Blog not found.");
}

$blog_id = $_GET['id'];

$stmt = mysqli_prepare(
    $conn,
    "SELECT blogPost.id, blogPost.user_id, blogPost.title,
            blogPost.content, blogPost.created_at,
            blogPost.updated_at, user.username
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

    <link rel="stylesheet" href="css/style.css">

    <script src="js/script.js"></script>
</head>

<body>

    <nav class="navbar">

        <h2>My Blog</h2>

        <div>
            <a href="index.php">Home</a>
            <a href="createBlog.php">Create Blog</a>
            <a href="logout.php">Logout</a>
        </div>

    </nav>

    <div class="container">

        <div class="blog-card">

            <h1>
                <?php echo htmlspecialchars($blog['title']); ?>
            </h1>

            <p>
                <strong>Author:</strong>
                <?php echo htmlspecialchars($blog['username']); ?>
            </p>

            <p>
                <strong>Published:</strong>
                <?php echo $blog['created_at']; ?>
            </p>

            <?php if ($blog['updated_at'] != $blog['created_at']) { ?>

                <p>
                    <strong>Updated:</strong>
                    <?php echo $blog['updated_at']; ?>
                </p>

            <?php } ?>

            <hr>

            <p class="blog-content">
                <?php
                echo nl2br(htmlspecialchars($blog['content']));
                ?>
            </p>

            <br>

            <?php

            if (
                isset($_SESSION['user_id']) &&
                $_SESSION['user_id'] == $blog['user_id']
            ) {
            ?>

                <a
                    class="btn"
                    href="editBlog.php?id=<?php echo $blog['id']; ?>"
                >
                    Edit Blog
                </a>

                <a
                    class="btn delete-btn"
                    href="deleteBlog.php?id=<?php echo $blog['id']; ?>"
                    onclick="return confirmDelete();"
                >
                    Delete Blog
                </a>

            <?php
            }
            ?>

            <a class="btn" href="index.php">
                Back to Home
            </a>

        </div>

    </div>

</body>

</html>