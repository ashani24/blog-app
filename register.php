<?php
include "database.php";
if (isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($conn, "INSERT INTO user(username, email, password) VALUES (?,?,?)");
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);

    if(mysqli_stmt_execute($stmt)){
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " .mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registration</title>
    </head>
    <body>
        <h2>User Registration</h2>

        <form action="" method="POST">
        
            <label>Username</label><br>
            <input type="text" name="username" required><br><br>

            <label>Email</label><br>
            <input type="email" name="email" required><br><br>

            <label>Password</label><br>
            <input type="password" name="password" required><br><br>

            <button type="submit" name="register">Register</button>

        </form>
    </body>
</html>