<?php

include "authen.php";
include "database.php";

if (isset($_POST['create'])) {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO blogPost (user_id, title, content) VALUES (?, ?, ?)"
    );

    mysqli_stmt_bind_param($stmt, "iss", $user_id, $title, $content);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Error creating blog: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Create Blog</title>
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

    <div class="form-container">

        <h2>Create New Blog</h2>

        <br>

        <?php
        if (isset($error)) {
            echo "<p>$error</p>";
        }
        ?>

        <form action="" method="POST">

            <label>Blog Title</label>

            <input
                type="text"
                name="title"
                placeholder="Enter your blog title"
                required
            >

            <label>Blog Content</label>

            <textarea
                name="content"
                rows="10"
                placeholder="Write your blog here..."
                required
            ></textarea>

            <button type="submit" name="create">
                Create Blog
            </button>

        </form>

    </div>

</body>

</html>