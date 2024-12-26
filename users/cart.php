<?php
require('db.php');
session_start();

$id = $_SESSION['id']; // ID user
$menu_id = $_POST['menu_id']; // ID menu
$quantity = $_POST['quantity']; // Total ordered item
$temperature = $_POST['temperature']; // Ice or Hot

// Check if there is a same item combination
$sql_check = "SELECT id, quantity FROM cart WHERE users_id = ? AND menu_id = ? AND temperature = ?";
$stmt_check = $con->prepare($sql_check);
$stmt_check->bind_param("iis", $id, $menu_id, $temperature);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    // If there is a same item, adds quantity
    $row = $result_check->fetch_assoc();
    $new_quantity = $row['quantity'] + $quantity;

    $sql_update = "UPDATE cart SET quantity = ? WHERE id = ?";
    $stmt_update = $con->prepare($sql_update);
    $stmt_update->bind_param("ii", $new_quantity, $row['id']);
    $stmt_update->execute();
    $stmt_update->close();
} else {
    // If not, adds as new row
    $sql_insert = "INSERT INTO cart (users_id, menu_id, quantity, temperature) VALUES (?, ?, ?, ?)";
    $stmt_insert = $con->prepare($sql_insert);
    $stmt_insert->bind_param("iiis", $id, $menu_id, $quantity, $temperature);
    $stmt_insert->execute();
    $stmt_insert->close();
}

$stmt_check->close();
$con->close();

header("Location: index.php#menu");
?>