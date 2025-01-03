<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];
$history = $conn->query("SELECT rentals.*, cars.make, cars.model FROM rentals JOIN cars ON rentals.car_id = cars.car_id WHERE rentals.user_id = $user_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rental History</title>
</head>
<body>
    <h1>Rental History</h1>
    <ul>
        <?php while ($rental = $history->fetch_assoc()): ?>
            <li><?= $rental['make'] . ' ' . $rental['model'] . ' (Rented: ' . $rental['start_date'] . ' to ' . $rental['end_date'] . ')' ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
