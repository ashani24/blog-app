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
</head>

<body>

    <h2>Create New Blog</h2>

    <?php
    if (isset($error)) {
        echo "<p>$error</p>";
    }
    ?>

    <form action="" method="POST">

        <label>Blog Title</label><br>
        <input type="text" name="title" required><br><br>

        <label>Blog Content</label><br>
        <textarea name="content" rows="10" cols="50" required></textarea><br><br>

        <button type="submit" name="create">Create Blog</button>

    </form>

</body>
</html>