<?php require('db.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM cart WHERE id=$id";
    $con->query($sql);
    header("Location: index.php");

?>