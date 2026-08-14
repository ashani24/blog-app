<?php
include "database.php";

$sql = "SELECT blogPost.id, blogPost.title, blogPost.content,
               blogPost.created_at, user.username
        FROM blogPost
        INNER JOIN user ON blogPost.user_id = user.id
        ORDER BY blogPost.created_at DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Blog Application</title>
</head>

<body>

    <h1>Welcome to My Blog Application</h1>

    <a href="createBlog.php">Create New Blog</a>

    <hr>

    <h2>All Blogs</h2>

    <?php
    if (mysqli_num_rows($result) > 0) {

        while ($blog = mysqli_fetch_assoc($result)) {
    ?>

            <article>

                <h3><?php echo htmlspecialchars($blog['title']); ?></h3>

                <p>
                    <?php echo nl2br(htmlspecialchars($blog['content'])); ?>
                </p>

                <p>
                    <strong>Author:</strong>
                    <?php echo htmlspecialchars($blog['username']); ?>
                </p>

                <p>
                    <strong>Date:</strong>
                    <?php echo $blog['created_at']; ?>
                </p>

                <a href="viewBlog.php?id=<?php echo $blog['id']; ?>">
                    Read More
                </a>

            </article>

            <hr>

    <?php
        }

    } else {
        echo "<p>No blogs available.</p>";
    }
    ?>

</body>
</html>