<?php
include "database.php";

$sql = "SELECT blogPost.id, blogPost.title, blogPost.content,
               blogPost.created_at, blogPost.user_id, user.username
        FROM blogPost
        INNER JOIN user ON blogPost.user_id = user.id
        ORDER BY blogPost.created_at DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>My Blog Application</title>
    <link rel="stylesheet" href="css/style.css">
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

        <h1>Welcome to My Blog Application</h1>

        <br>

        <h2>Latest Blogs</h2>

        <br>

        <?php

        if (mysqli_num_rows($result) > 0) {

            while ($blog = mysqli_fetch_assoc($result)) {
        ?>

                <div class="blog-card">

                    <h3>
                        <?php echo htmlspecialchars($blog['title']); ?>
                    </h3>

                    <p>
                        <?php
                        echo nl2br(
                            htmlspecialchars(
                                substr($blog['content'], 0, 150)
                            )
                        );
                        ?>

                        <?php if (strlen($blog['content']) > 150) {
                            echo "...";
                        } ?>
                    </p>

                    <p>
                        <strong>Author:</strong>
                        <?php echo htmlspecialchars($blog['username']); ?>
                    </p>

                    <p>
                        <strong>Published:</strong>
                        <?php echo $blog['created_at']; ?>
                    </p>

                    <a
                        class="btn"
                        href="viewBlog.php?id=<?php echo $blog['id']; ?>"
                    >
                        Read More
                    </a>

                </div>

        <?php
            }

        } else {
            echo "<p>No blogs available yet.</p>";
        }
        ?>

    </div>

</body>

</html>