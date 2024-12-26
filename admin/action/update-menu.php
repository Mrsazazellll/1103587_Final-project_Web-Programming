<?php 
session_start();
    require('../db.php');
    $id = $_POST['id'];
    $menu = $_POST['menu'];
    $price = $_POST['price'];
    $target_dir = "../../assets/images/menu/";
    $old_picture = $_POST['old_picture']; 
    $picture = $old_picture;

    if (!empty($_FILES["picture"]["tmp_name"])) {
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (!getimagesize($_FILES["picture"]["tmp_name"])) {
            $_SESSION['not_image'] = "Sorry, file is not an image";
            header("Location: ../dashboard.php?page=menu");
        } elseif (file_exists($target_file)) {
            $_SESSION['exist'] = "Sorry, file already exists";
            header("Location: ../dashboard.php?page=menu");
        } elseif ($_FILES["picture"]["size"] > 500000) {
            $_SESSION['big_size'] = "Sorry, your file is too large, max 500KB";
            header("Location: ../dashboard.php?page=menu");
        } elseif (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            $_SESSION['not_format'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed";
            header("Location: ../dashboard.php?page=menu");
        } else {
            if (!empty($old_picture) && file_exists($target_dir . $old_picture)) {
                unlink($target_dir . $old_picture); 
            }

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                $picture = basename($_FILES["picture"]["name"]);
            } else {
                $_SESSION['image_error'] = "Sorry, there was an error on uploading new image";
                header("Location: ../dashboard.php?page=menu");
            }
        }
    }

    $stmt = $con->prepare("UPDATE menu SET menu = ?, price = ?, picture = ? WHERE id = ?");
    $stmt->bind_param("sssi", $menu, $price, $picture, $id);

    if ($stmt->execute()) {
        $_SESSION['update_menu'] = "Menu successfully updated!";
        header("Location: ../dashboard.php?page=menu");
    } else {
        $_SESSION['error'] = "Sorry, there was an error: " . $stmt->error;
        header("Location: ../dashboard.php?page=menu");
    }

    $stmt->close();
    $con->close();

?>