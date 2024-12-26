<?php 
    session_start();
    require('../db.php');
    $id = $_GET['id'];

    $sql = "SELECT picture FROM menu WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($picture);
    $stmt->fetch();
    $stmt->close();

    if (!empty($picture)) {
        $filePath = "../../assets/images/menu/" . $picture;
        if (file_exists($filePath)) {
            unlink($filePath);         }
    }
    
    $stmt = $con->prepare("DELETE FROM menu WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $_SESSION['delete_menu'] = "Menu successfully deleted!";
        header("Location: ../dashboard.php?page=menu");
    } else {
        $_SESSION['error'] = "Sorry, there was an error: " . $stmt->error;
        header("Location: ../dashboard.php?page=menu");
    }
    $stmt->close();
    $con->close();
?>