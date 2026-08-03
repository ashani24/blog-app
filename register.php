<?php
include "database.php";
if (isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql="INSERT INTO user(username, email, password)
        VALUES('$username', '$email', '$password')";

    if(mysqli_query($conn, $sql)){
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " .mysqli_error($conn);
    }
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