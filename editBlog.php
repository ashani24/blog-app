<?php

include "authen.php";
include "database.php";

if (!isset($_GET['id'])) {
    die("Blog not found.");
}

$blog_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

/* Get the blog that belongs to the logged-in user */
$stmt = mysqli_prepare(
    $conn,
    "SELECT id, title, content
     FROM blogPost
     WHERE id = ? AND user_id = ?"
);

mysqli_stmt_bind_param($stmt, "ii", $blog_id, $user_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) != 1) {
    die("You are not authorized to edit this blog.");
}

$blog = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


/* Update the blog */
if (isset($_POST['update'])) {

    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE blogPost
         SET title = ?, content = ?, updated_at = CURRENT_TIMESTAMP
         WHERE id = ? AND user_id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssii",
        $title,
        $content,
        $blog_id,
        $user_id
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: viewBlog.php?id=" . $blog_id);
        exit();
    } else {
        $error = "Error updating blog: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Blog</title>
</head>

<body>

    <h2>Edit Blog</h2>

    <?php
    if (isset($error)) {
        echo "<p>$error</p>";
    }
    ?>

    <form action="" method="POST">

        <label>Blog Title</label><br>

        <input
            type="text"
            name="title"
            value="<?php echo htmlspecialchars($blog['title']); ?>"
            required
        >

        <br><br>

        <label>Blog Content</label><br>

        <textarea
            name="content"
            rows="10"
            cols="50"
            required
        ><?php echo htmlspecialchars($blog['content']); ?></textarea>

        <br><br>

        <button type="submit" name="update">
            Update Blog
        </button>

    </form>

    <br>

    <a href="viewBlog.php?id=<?php echo $blog_id; ?>">
        Cancel
    </a>

</body>

</html>