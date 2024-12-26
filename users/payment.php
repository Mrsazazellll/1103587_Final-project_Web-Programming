<?php
session_start();
require('db.php');

$id = $_POST['id'];

$target_dir = "../assets/images/payment/";
$target_file = $target_dir . basename($_FILES["transfer_image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (!getimagesize($_FILES["transfer_image"]["tmp_name"])) {
    $_SESSION['not_image'] = "Sorry, file is not an image";
    header("Location: order.php");
} elseif ($_FILES["transfer_image"]["size"] > 500000) {
    $_SESSION['big_size'] = "Sorry, your file is too large, max 500KB";
    header("Location: order.php");
} elseif (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
    $_SESSION['not_format'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed";
    header("Location: order.php");
} elseif (!move_uploaded_file($_FILES["transfer_image"]["tmp_name"], $target_file)) {
    $_SESSION['image_error'] = "Sorry, there was an error uploading your file";
    header("Location: order.php");
}

$transfer_image = basename($_FILES["transfer_image"]["name"]);


$stmt = $con->prepare("UPDATE orders SET transfer_image = ? WHERE id = ?");
$stmt->bind_param("si", $transfer_image, $id);

if ($stmt->execute()) {
    $_SESSION['payment'] = "Please wait, your payment is being processed!";
    header("Location: order.php");
} else {
    $_SESSION['error'] = "There was an error: " . $stmt->error;
    header("Location: order.php");
}

$stmt->close();
$con->close();
?>
