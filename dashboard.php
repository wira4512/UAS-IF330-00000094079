<?php
session_start();
include 'db.php';




if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to your Dashboard</h1>
    <a href="car.php">Rent a Car</a> | <a href="history.php">Rental History</a> | <a href="edit_user.php">Edit User</a>
    <a href="logout.php">Log Out</a>
</body>
</html>
