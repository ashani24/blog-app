<?php

include "authen.php";
include "database.php";

if (!isset($_GET['id'])) {
    die("Blog not found.");
}

$blog_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM blogPost
     WHERE id = ? AND user_id = ?"
);

mysqli_stmt_bind_param($stmt, "ii", $blog_id, $user_id);

if (mysqli_stmt_execute($stmt)) {

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header("Location: index.php");
        exit();
    } else {
        echo "You are not authorized to delete this blog, or the blog does not exist.";
    }

} else {
    echo "Error deleting blog: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);

?>