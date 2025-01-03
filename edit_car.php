<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $car_id = $_POST['car_id'];
    $make = $_POST['make'];
    $model = $_POST['model'];

    $stmt = $conn->prepare("UPDATE cars SET make = ?, model = ? WHERE id = ?");
    $stmt->bind_param("ssi", $make, $model, $car_id);
    $stmt->execute();
}

$cars = $conn->query("SELECT * FROM cars");
?>
<!DOCTYPE html>
<html lang="en">
<head[_{{{CITATION{{{_1{](https://github.com/shiaoyi/php_mysql_messageBoard/tree/545fc7a570594a69dd6a23ae9d0fe4a750a77171/login.php)[_{{{CITATION{{{_2{](https://github.com/the-real-sumsome/subrocks/tree/0e08a12f55acf1213a1f30fb2c77bb2859846c70/web%2Fstatic%2Flib%2Fnew%2Ffetch.php)[_{{{CITATION{{{_3{](https://github.com/bbdcmf/ITS450-Final/tree/d433bc4ced3b6798d08bab9e04252d5bc642d5e1/register.php)[_{{{CITATION{{{_4{](https://github.com/FelixTeoh/goldfish/tree/c6a0a76e1e852e3991da6a869d561c1517a32742/controllers%2Fauth%2Flogin.php)[_{{{CITATION{{{_5{](https://github.com/teng-aliya/deskboard-project/tree/bf1b9dfd37903faf89d2520181961f7d41dc984e/controllers%2FAuthController.php)[_{{{CITATION{{{_6{](https://github.com/melvin78/E-ticket/tree/3f3dbdac05c5cfd41606b3a8393eaf7f8b3483c4/views%2Fticket%2Fview-my-booked-tickets.php)e/3f3dbdac05c5cfd41606b3a8393eaf7f8b3483c4/views%2Fticket%2Fview-my-booked-tickets.php)