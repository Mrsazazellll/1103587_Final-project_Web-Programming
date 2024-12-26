<?php 
    include("session_alert.php");
    if(!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planet Roast | Order</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="assets/images/1.png" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-black">
    <div class="min-h-screen max-w-screen-xl mx-auto p-5 sm:p-10 md:px-14 relative">
        <div class="grid grid-cols-1 sm:grid-cols-12 gap-5">

            <div class="sm:col-span-12 grid grid-cols-1 lg:grid-cols-1 gap-5">
                <div class="col-span-1">
                    <div class="border-b border-gray-600 mb-2 flex justify-between text-sm">
                        <div class="flex items-center pb-2 pr-2 border-b-2 border-[#9F5C44] uppercase">
                            <a href="#" class="font-semibold inline-block"><span class="text-2xl text-[#9F5C44]">Your
                                    |</span><span class="text-2xl text-white ml-2">Order</span></a>
                        </div>
                        <a href="index.php"
                            class="bg-orange-800 hover:bg-orange-900 text-white font-bold py-2 px-4 rounded">Back</a>
                    </div>
                </div>

                <?php
            require('db.php');
            $user_id = $_SESSION['id'];
            $sql = "SELECT * FROM orders WHERE users_id = $user_id ORDER BY id DESC";
            $result = $con->query($sql);
            while ($orders = $result->fetch_assoc()) {
                $modal_input = "modal_input" . $orders['id'];

                $card_bg = 'bg-white'; 
                $badge_bg = 'badge-warning badge-xs lg:badge-md'; 
                $button_html = "<button class='btn btn-info mb-2' onclick='document.getElementById(\"$modal_input\").showModal()'>Payment Confirmation</button>";
                $qr_code = "<img class='object-cover w-32' src='../assets/images/qr.jpeg'>";

                if ($orders['status'] === 'completed') {
                    $card_bg = 'bg-green-200'; 
                    $badge_bg = 'badge-success badge-xs lg:badge-md'; 
                    $button_html = "<a href='order_confirmation.php?order_id={$orders['id']}' target='_blank' class='btn btn-warning mb-2'>View Detail</a>"; 
                } elseif ($orders['status'] === 'cancelled') {
                    $card_bg = 'bg-red-300'; 
                    $badge_bg = 'badge-error'; 
                    $button_html = ''; 
                }

                if ($orders['payment_method'] === 'cash_on_delivery') {
                    $order = "Cash";
                }elseif ($orders['payment_method'] === 'transfer') {
                    $order = "Transfer";
                }
                echo "
                    <div class='card $card_bg rounded-lg shadow-lg p-5 cursor-pointer hover:scale-105'>
                        <div class='grid grid-cols-1 lg:grid-cols-12 gap-3'>
                            <p class='col-span-12 text-xs lg:text-md text-gray-900'>" . date('d F Y - h:i:sa', strtotime($orders['order_date'])) . "</p>
                            <hr class='col-span-12 border-t border-gray-600'/>
                            <div class='col-span-5 lg:col-span-3 text-xs lg:text-lg'>
                                <p class='text-gray-900'>Order ID</p>
                                <p class='text-gray-900'>Total Price</p>
                                <p class='text-gray-900'>Delivery Option</p>
                                <p class='text-gray-900'>Order Status</p>
                                <p class='text-gray-900'>Payment Method</p>
                            </div>
                            <div class='col-span-7 lg:col-span-7 text-xs lg:text-lg'>
                                <p class='text-gray-900'>: {$orders['id']}</p>
                                <p class='text-gray-900'>: NTD {$orders['total_price']}</p>
                                <p class='text-gray-900 capitalize'>: {$orders['delivery_option']}</p>
                                <p class='text-gray-900 capitalize badge $badge_bg'> {$orders['status']}</p>
                                <p class='text-gray-900 capitalize'>: $order</p>
                            </div>
                            <div class='col-span-12 flex justify-center lg:col-span-2' lg:flex-none>
                                $qr_code
                            </div>
                            <div class='col-span-12 flex justify-center lg:flex-none'>
                                $button_html
                            </div>
                            <dialog id='$modal_input' class='modal'>
                                <div class='modal-box'>
                                    <form action='payment.php' method='post' enctype='multipart/form-data' class='max-w-sm mx-auto'>
                                        <input type='hidden' name='id' value='{$orders['id']}'>
                                        <label for='transfer_image' class='label-text font-extrabold'>Screenshot Payment</label>
                                        
                                        <input type='file' name='transfer_image' id='transfer_image' required class='bg-gray-700 file-input file-input-bordered file-input-warning w-full max-w-md mb-2'/>
                                        <button type='submit' class='btn btn-warning mt-3'>Input</button>
                                        <button type='button' class='btn btn-error mt-3' onclick='document.getElementById(\"$modal_input\").close()'>Close</button>
                                    </form>
                                </div>
                            </dialog>
                        </div>
                    </div>";
            }
            ?>
            </div>
        </div>
    </div>
</body>

</html>