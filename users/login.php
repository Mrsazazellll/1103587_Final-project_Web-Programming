<?php
            require('db.php');
            session_start();
            // When form submitted, check and create user session.
            if (isset($_POST['username'])) {
                $username = stripslashes($_REQUEST['username']);// removes backslashes
                $username = mysqli_real_escape_string($con, $username);
                $password = stripslashes($_REQUEST['password']);
                $password = mysqli_real_escape_string($con, $password);
                // Check user is exist in the database
                $query    = "SELECT * FROM `users` WHERE username='$username'
                            AND password='" . md5($password) . "'";
                $result = mysqli_query($con, $query);
                $rows = mysqli_num_rows($result);
                $users = mysqli_fetch_array($result);
                $id = $users['id'];
                if ($rows == 1) {
                    $_SESSION['id'] = $id;
                    $_SESSION['username'] = $username;
                    // Redirect to user dashboard page
                    header("Location: index.php");
                } else {
                    echo "<div class='form'>
                        <h3>Incorrect Username/password.</h3><br/>
                        <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                        </div>";
                }
            }

            if (isset($_SESSION['username'])) {
                header("Location: index.php");
                exit();
            }
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planet Roast | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="../../../assets/image/wave.jpg" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
    <div class="min-h-screen bg-stone-900 flex flex-col justify-center py-12 sm:px-6 lg:px-8 px-6">
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <div class="sm:mx-auto sm:w-full sm:max-w-md">
                    <img class="mx-auto w-48 h-48 object-cover" src="../assets/images/1.png" alt="Workflow">
                    <hr class="border-t-2 border-gray-200">
                    <h2 class="mt-2 text-center text-3xl leading-9 font-extrabold text-gray-900">
                        Login
                    </h2>
                </div>
                <form action="login.php" method="POST">
                    <div class="mt-6">
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input id="username" name="username" placeholder="Username" type="text" required="" value="" class="appearance-none bg-white block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-orange-900 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="password" name="password" placeholder="Password" type="password" required="" class="appearance-none bg-white block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-orange-900 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        </div>
                    </div>

                    <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-orange-900 hover:bg-orange-800 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                            Login
                            </button>
                        </span>
                    </div>
                </form>
                <p class="mt-2 text-center text-sm leading-5 max-w">
                        Or
                        <a href="registration.php" class="font-medium text-orange-900 hover:text-orange-800 focus:outline-none focus:underline transition ease-in-out duration-150">
                            create a new acccount
                        </a>
                </p>
                <hr class="mt-2 border-t-2 border-gray-200">
            </div>
        </div>
    </div>

</body>
</html>