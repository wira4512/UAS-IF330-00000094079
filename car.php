<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rent'])) {
    $car_id = $_POST['car_id'];
    $user_id = $_SESSION['user_id'];
    $start_date = date('Y-m-d');
    $end_date = date('Y-m-d', strtotime('+7 days'));

    $stmt = $conn->prepare("CALL RentCar(?, ?, ?, ?)");
    $stmt->bind_param("iiss", $user_id, $car_id, $start_date, $end_date);
    $stmt->execute();
}

$cars = $conn->query("SELECT * FROM cars WHERE availability = 1");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rent a Car</title>
</head>
<body>
    <h1>Rent a Car</h1>
    <form method="POST">
        <select name="car_id">
            <?php while ($car = $cars->fetch_assoc()): ?>
                <option value="<?= $car['car_id'] ?>"><?= $car['make'] . ' ' . $car['model'] ?></option>
            <?php endwhile; ?>
        </select>
        <button type="submit" name="rent">Rent</button>
    </form>
</body>
</html>
