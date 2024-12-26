<?php
    session_start();

    if (isset($_SESSION['add_order'])) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'Success',
                    title: 'Order Added!!!', 
                    icon: 'success',
                    text: '{$_SESSION['add_order']}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        ";
        unset($_SESSION['add_order']); 
    }

    if (isset($_SESSION['payment'])) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'Success',
                    title: 'Uplodad Payment Success!!!', 
                    icon: 'success',
                    text: '{$_SESSION['payment']}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        ";
        unset($_SESSION['payment']); 
    }
    
    if (isset($_SESSION['not_image'])) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Sorry!!!', 
                    icon: 'success',
                    text: '{$_SESSION['not_image']}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        ";
        unset($_SESSION['not_image']); 
    }
    if (isset($_SESSION['big_size'])) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Sorry!!!', 
                    icon: 'success',
                    text: '{$_SESSION['big_size']}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        ";
        unset($_SESSION['big_size']); 
    }
    if (isset($_SESSION['not_format'])) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Sorry!!!', 
                    icon: 'success',
                    text: '{$_SESSION['not_format']}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        ";
        unset($_SESSION['not_format']); 
    }
    if (isset($_SESSION['image_error'])) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Sorry!!!', 
                    icon: 'success',
                    text: '{$_SESSION['image_error']}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        ";
        unset($_SESSION['image_error']); 
    }

?>