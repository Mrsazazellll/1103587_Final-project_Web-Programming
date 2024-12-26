<?php 
    session_start();
    require('../db.php');
    $id = $_GET['id'];
    
    $stmt = $con->prepare("UPDATE orders SET status = 'completed' WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $_SESSION['confirm_order'] = "Order successfully confirmed!";
        header("Location: ../dashboard.php?page=order");
    } else {
        $_SESSION['error'] = "Sorry, there was an error: " . $stmt->error;
        header("Location: ../dashboard.php?page=order");
    }
    $stmt->close();
    $con->close();

?>