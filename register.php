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
    <title>Register - My Blog</title>
    <link rel="stylesheet" href="css/style.css">

    <script src="js/script.js"></script>
</head>

<body>

    <nav class="navbar">

        <h2>My Blog</h2>

        <div>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </div>

    </nav>


    <div class="form-container">

        <h2>Create an Account</h2>

        <p>Register to start creating your own blogs.</p>

        <br>


        <form action="" method="POST" onsubmit="return validateRegistration();">

            <label>Username</label>

            <input
                type="text"
                name="username"
                placeholder="Enter your username"
                required
            >


            <label>Email</label>

            <input
                type="email"
                name="email"
                placeholder="Enter your email"
                required
            >


            <label>Password</label>

            <input
    type="password"
    id="password"
    name="password"
    placeholder="Enter your password"
    required
>

            <label>Confirm Password</label>

<input
    type="password"
    id="confirm_password"
    name="confirm_password"
    placeholder="Confirm your password"
    required
>


            <button type="submit" name="register">
                Register
            </button>

        </form>


        <br>

        <p>
            Already have an account?
            <a href="login.php">Login here</a>
        </p>

    </div>

</body>

</html>