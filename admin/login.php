<?php
session_start();
require 'db.php';

if (isset($_POST['login_admin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'admin';

    $stmt = $con->prepare("SELECT * FROM users WHERE email = ? AND password = ? AND role = ?");
    $stmt->bind_param("sss", $email, $password, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
            if ($user['password'] === $password) {
            $_SESSION['admin'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Wrong password');</script>";
        }
    } else {
        echo "<script>alert('User not found');</script>";
    }
    $stmt->close();
}

if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
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
                        Admin Login
                    </h2>
                </div>
                <form action="login.php" method="POST">
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
                            <button type="submit" name="login_admin" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-orange-900 hover:bg-orange-800 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                            Login
                            </button>
                        </span>
                    </div>
                </form>

                <hr class="mt-2 border-t-2 border-gray-200">
            </div>
        </div>
    </div>

</body>
</html>