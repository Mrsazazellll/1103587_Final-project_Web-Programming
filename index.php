<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Planet Roast</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2Hhh_14Uam62GXGaTMcXWhhVkYg0EbDY&callback=initMap"
        async defer></script>

    <!-- Custom CSS File Link -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- font awesome cdn link -->
    <link rel="icon" type="image/x-icon" href="assets/images/1.png"><!-- Favicon / Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"><!-- Google font cdn link -->
</head>

<body>
    <!-- HEADER SECTION -->
    <header class="header">
        <a href="#" class="logo">
            <img src="assets/images/1.png" class="img-logo" alt="store Logo">
        </a>

        <!-- MAIN MENU FOR SMALLER DEVICES -->
        <nav class="navbar navbar-expand-lg">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#home" class="text-decoration-none">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#about" class="text-decoration-none">About</a>
                </li>
                <li class="nav-item">
                    <a href="#menu" class="text-decoration-none">Menu</a>
                </li>
                <li class="nav-item d-none d-sm-block">
                    <a href="users/login.php" class="text-decoration-none">Login</a>
                </li>
            </ul>
            </div>
        </nav>
        <div class="icons">
            <div class="d-flex align-items-center">
                <a href="users/login.php" class="d-lg-none text-decoration-none text-warning">Login</a>
                <div class="fas fa-shopping-cart me-3" id="cart-btn" style="cursor: pointer;"></div>
                <div class="fas fa-bars" id="menu-btn"></div>
            </div>
        </div>

        <!-- CART SECTION -->
        <div class="cart">
            <h2 class="cart-title">Your Cart:</h2>
            <div class="cart-content">

            </div>
            <div class="total">
                <div class="total-title">Total: </div>
                <div class="total-price">NTD 0</div>
            </div>
            <!-- BUY BUTTON -->
            <button type="button" class="btn-buy">Checkout Now</button>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="home" id="home">
        <div class="content">
            <h3>Welcome to Planet Roast Coffee Shop</h3>
            <p>
                <strong>We are open 4:00 PM to 9:00 PM.</strong>
            </p>
            <a href="#menu" class="btn btn-dark text-decoration-none">Order Now!</a>
        </div>
    </section>

    <!-- ABOUT US SECTION -->
    <section class="about" id="about">
        <h1 class="heading"> <span>About</span> Us</h1>
        <div class="row g-0">
            <div class="image">
                <img src="assets/images/about-img.png" alt="" class="img-fluid">
            </div>
            <div class="content">
                <h3>Welcome to Planet Roast!</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus nulla reprehenderit atque
                    deleniti. Nam animi debitis ea quisquam iusto? Corrupti iusto excepturi labore molestias at earum
                    inventore omnis laudantium cupiditate alias sit rerum necessitatibus praesentium voluptas illum,
                    obcaecati quia velit. Fugit qui blanditiis nulla tempore molestias eveniet earum consequatur
                    doloremque.
                </p>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim velit, cumque nostrum iure excepturi
                    molestiae aliquam odit voluptatum provident asperiores. Iure aspernatur assumenda provident harum
                    cupiditate perferendis sunt enim consequuntur.
                </p>
            </div>
        </div>
    </section>

    <!-- MENU SECTION -->
    <section class="menu" id="menu">
        <h1 class="heading">Our <span>Menu</span></h1>
        <div class="box-container">
            <div class="container">
                <div class='row'>
                    <?php
                        require('users/db.php');
                        $sql = "SELECT * FROM menu";
                        $result = $con->query($sql);
                        while ($menu = $result->fetch_assoc()) {
                        echo "   
                                <div class='col-6 col-lg-4'>
                                    <div class='box'>
                                        <img src='assets/images/menu/{$menu['picture']}' alt='' class='product-img mt-3'>
                                        <h3 class='product-title text-truncate'>{$menu['menu']}</h3>
                                        <div class='price'>NTD {$menu['price']}</div>
                                        <button type='button' class='btn' data-bs-toggle='modal' data-bs-target='#modalProduct?id={$menu['id']}'>
                                            Order
                                        </button>
                                        
                                    </div>
                                </div><br />

                                <div class='modal fade' id='modalProduct?id={$menu['id']}' tabindex='-1' aria-labelledby='modalProductLabel' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered'>
                                        <div class='modal-content'>

                                            <div class='box p-0'>
                                                <img src='assets/images/menu/{$menu['picture']}' alt='' class='product-img'>
                                                <h3 class='product-title text-black'>{$menu['menu']}</h3>
                                                <div class='price text-black'>NTD {$menu['price']}</div>    
                                            </div>
                                            <div class='modal-body text-center'>
                                                <a class='btn add-cart' onclick='redirectCart()'>Your Not Logged in</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            ";
                        }
                        ?>
                </div><br />
            </div>
        </div>
    </section>


    <!-- FOOTER SECTION -->
    <section class="footer">
        <div class="footer-container">
            <div class="logo">
                <img src="assets/images/1.png" class="img"><br />
                <i class="fas fa-envelope"></i>
                <p>s1103587@mail.yzu.edu.tw</p><br />
                <i class="fas fa-phone"></i>
                <p>+886-666-666</p><br />
                <i class="fab fa-facebook-messenger"></i>
                <p>@Planet Roast</p><br />
            </div>
            <div class="support">
                <h2>Support</h2>
                <br />
                <a href="#">Contact Us</a>
                <a href="#">Customer Service</a>
            </div>
            <div class="company">
                <h2>Company</h2>
                <br />
                <a href="#">About Us</a>
                <a href="#">Affiliates</a>
                <a href="#">Resources</a>
                <a href="#">Partnership</a>
                <a href="#">Suppliers</a>
            </div>
            <div class="newsletters">
                <h2>Newsletters</h2>
                <br />
                <p>Subscribe to our newsletter for news and updates!</p>
                <div class="input-wrapper">
                    <input type="email" class="newsletter" placeholder="Your email address">
                    <i id="paper-plane-icon" class="fas fa-paper-plane"></i>
                </div>
            </div>
            <div class="credit">
                <hr /><br />
                <h2>1103587 © 2024 | All Rights Reserved.</h2>
                <h2>Designed by <span>Muhammad Zaki 莫山奇</span> | Web Programming</h2>
            </div>
        </div>
    </section>


    <!-- JS File Link -->
    <script src="assets/js/cart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
    // CODE FOR THE FORMSPREE
    window.onbeforeunload = () => {
        for (const form of document.getElementsByTagName('form')) {
            form.reset();
        }
    }


    // CODE FOR THE SHOW MORE & SHOW LESS BUTTON IN MENU
    $(document).ready(function() {
        $(".row-to-hide").hide();
        $("#showHideBtn").text("SHOW MORE");
        $("#showHideBtn").click(function() {
            $(".row-to-hide").toggle();
            if ($(".row-to-hide").is(":visible")) {
                $(this).text("SHOW LESS");
            } else {
                $(this).text("SHOW MORE");
            }
        });
    });



    // CODE FOR THE REDIRECT CART
    function redirectCart() {
        // Check if the user is logged in
        if (!"<?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : '' ?>") {
            // Redirect the user to the login page
            alert("You are not logged in. Please log into your account and try again.");
            window.location.href = "users/login.php";
        }
    }
    </script>
</body>

</html>