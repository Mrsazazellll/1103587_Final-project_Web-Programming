<?php
            require('db.php');
            // When form submitted, insert values into the database.
            if (isset($_REQUEST['username'])) {
                // removes backslashes
                $username = stripslashes($_REQUEST['username']);
                //escapes special characters in a string
                $username = mysqli_real_escape_string($con, $username);
                $email    = stripslashes($_REQUEST['email']);
                $email    = mysqli_real_escape_string($con, $email);
                $password = stripslashes($_REQUEST['password']);
                $password = mysqli_real_escape_string($con, $password);
                $create_datetime = date("Y-m-d H:i:s");
                $query    = "INSERT into `users` (username, password, email, create_datetime)
                            VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
                $result   = mysqli_query($con, $query);
                if ($result) {
                    echo "<script>
                            alert('You are registered successfully.');
                            window.location.href = 'login.php';
                        </script>";
                } else {
                    echo "<div class='form'>
                            <h3>Required fields are missing.</h3><br/>
                        <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
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
    <title>Planet Roast | Registration</title>
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
                        Registration
                    </h2>
                </div>
                <form action="registration.php" method="POST">
                    <div class="mt-6">
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input id="username" name="username" placeholder="Username" type="text" required="" value="" class="appearance-none bg-white block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-orange-900 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input id="email" name="email" placeholder="Email" type="email" required="" value="" class="appearance-none bg-white block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-orange-900 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
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
                            Register    
                            </button>
                        </span>
                    </div>
                </form>
                <p class="mt-2 text-center text-sm leading-5 max-w">
                        Already have an account?
                        <a href="registration.php" class="font-medium text-orange-900 hover:text-orange-800 focus:outline-none focus:underline transition ease-in-out duration-150">
                            Login here
                        </a>
                </p>
                <hr class="mt-2 border-t-2 border-gray-200">
            </div>
        </div>
    </div>

</body>
</html>