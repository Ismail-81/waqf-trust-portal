<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit;
}

include "config.php";

$error = "";



if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['user'] = $username;
        header("Location: home.php");
        exit;
    } else {
        $error = "Invalid Username or Password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login | Waqf Data</title>
    <link rel="icon" type="image/png" href="images/favicon.png">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/login_style.css">
</head>

<body>

<div class="container">
    <div class="box">
        <div class="logo">L</div>
        <h2>Welcome back</h2>
        <p class="subtitle">Enter your credentials to access your account</p>
        
        <form method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <div class="input-wrapper">
                    <input type="text" name="username" id="username" placeholder="Enter username" required>
                </div>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                </div>
            </div>

            <?php if ($error) { ?>
                <p style="color: red; text-align:center; margin-top: 8px;"><?php echo $error; ?></p>
            <?php } ?>
            
            <button type="submit" name="login">Sign in</button>
        </form>
    </div>
</div>
<?php include "footer.php"; ?>

</body>
</html>
