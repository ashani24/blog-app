<?php
session_start();
include "database.php";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare(
        $conn,
        "SELECT id, username, email, password, role FROM user WHERE email = ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            header("Location: index.php");
            exit();

        } else {
            $error = "Invalid email or password.";
        }

    } else {
        $error = "Invalid email or password.";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login - My Blog</title>
    <link rel="stylesheet" href="css/style.css">
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

        <h2>Welcome Back</h2>

        <p>Login to your account to continue.</p>

        <br>

        <?php
        if (isset($error)) {
            echo "<p>" . htmlspecialchars($error) . "</p>";
        }
        ?>

        <form action="" method="POST">

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
                name="password"
                placeholder="Enter your password"
                required
            >

            <button type="submit" name="login">
                Login
            </button>

        </form>

        <br>

        <p>
            Don't have an account?
            <a href="register.php">Register here</a>
        </p>

    </div>

</body>

</html>