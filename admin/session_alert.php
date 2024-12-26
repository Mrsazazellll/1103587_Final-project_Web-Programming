<?php
    if (isset($_SESSION['input_menu'])) {
        echo "<script>Swal.fire('Success', '{$_SESSION['input_menu']}', 'success');</script>";
        unset($_SESSION['input_menu']);
    }
    if (isset($_SESSION['input_pesanan'])) {
        echo "<script>Swal.fire('Success', '{$_SESSION['input_pesanan']}', 'success');</script>";
        unset($_SESSION['input_pesanan']);
    }

    if (isset($_SESSION['confirm_order'])) {
        echo "<script>Swal.fire('Success', '{$_SESSION['confirm_order']}', 'success');</script>";
        unset($_SESSION['confirm_order']);
    }

    if (isset($_SESSION['cancel_order'])) {
        echo "<script>Swal.fire('Cancel', '{$_SESSION['cancel_order']}', 'error');</script>";
        unset($_SESSION['cancel_order']);
    }

    if (isset($_SESSION['update_menu'])) {
        echo "<script>Swal.fire('Success', '{$_SESSION['update_menu']}', 'success');</script>";
        unset($_SESSION['update_menu']);
    }

    if (isset($_SESSION['delete_menu'])) {
        echo "<script>Swal.fire('Success', '{$_SESSION['delete_menu']}', 'success');</script>";
        unset($_SESSION['delete_menu']);
    }

    if (isset($_SESSION['not_image'])) {
        echo "<script>Swal.fire('Error', '{$_SESSION['not_image']}', 'error');</script>";
        unset($_SESSION['not_image']);
    }

    if (isset($_SESSION['exist'])) {
        echo "<script>Swal.fire('Error', '{$_SESSION['exist']}', 'error');</script>";
        unset($_SESSION['exist']);
    }

    if (isset($_SESSION['big_size'])) {
        echo "<script>Swal.fire('Error', '{$_SESSION['big_size']}', 'error');</script>";
        unset($_SESSION['big_size']);
    }

    if (isset($_SESSION['not_format'])) {
        echo "<script>Swal.fire('Error', '{$_SESSION['not_format']}', 'error');</script>";
        unset($_SESSION['not_format']);
    }

    if (isset($_SESSION['image_error'])) {
        echo "<script>Swal.fire('Error', '{$_SESSION['image_error']}', 'error');</script>";
        unset($_SESSION['image_error']);
    }

    if (isset($_SESSION['error'])) {
        echo "<script>Swal.fire('Error', '{$_SESSION['error']}', 'error');</script>";
        unset($_SESSION['error']);
    }
?>