<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Rental</title>
</head>
<body>
    <h1>Welcome to Car Rental Service</h1>
    <a href="login.php">Log In</a> or <a href="register.php">Register</a>
</body>
</html>
