<?php
    include("auth_session.php");
    require('db.php');
    $order_id = $_GET['order_id'];

    // Ambil data pesanan
    $sql_order = "SELECT o.id, o.total_price, o.delivery_option, o.delivery_address, o.payment_method, o.order_date, o.status, u.username
                FROM orders o
                JOIN users u ON o.users_id = u.id
                WHERE o.id = ?";
    $stmt_order = $con->prepare($sql_order);
    $stmt_order->bind_param("i", $order_id);
    $stmt_order->execute();
    $result_order = $stmt_order->get_result();
    $order = $result_order->fetch_assoc();

    // Ambil detail menu
    $sql_items = "SELECT oi.menu_id, m.menu, oi.quantity, oi.price, oi.temperature, (oi.quantity * oi.price) AS subtotal
                FROM order_items oi
                JOIN menu m ON oi.menu_id = m.id
                WHERE oi.orders_id = ?";
    $stmt_items = $con->prepare($sql_items);
    $stmt_items->bind_param("i", $order_id);
    $stmt_items->execute();
    $result_items = $stmt_items->get_result();
?>

<!DOCTYPE html>
<html lang="en" class="bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planet Roast | Order Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="../assets/images/1.png" type="image/x-icon">
</head>
<body>
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-5 sm:px-6 lg:px-8 px-6">
    
    <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="card bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <h2 class="text-center text-3xl leading-9 font-extrabold text-gray-900">
                    Order Details
                </h2>
            </div>
            <div class="flex justify-center">
                <img src="../assets/images/1.png" class="w-52 h-52 object-cover" alt="">
            </div>
            
            <div class="grid grid-cols-12">
                <div class="col-span-9">
                    <h1 class="mt-2 font-bold text-black">Order ID</h1>
                    <h1 class="mt-2 font-bold text-black">Customer</h1>
                </div>
                <div class="col-span-3">
                    <h1 class="mt-2 font-bold text-black"><?= $order['id'] ?></h1>
                    <h1 class="mt-2 font-bold text-black"><?= $order['username'] ?></h1>
                </div>
            </div>
            <hr class="my-2 border-gray-900">
            <ul>
                <?php while ($item = $result_items->fetch_assoc()): ?>
                    <li>
                        <div class="grid grid-cols-12">
                            <div class="col-span-9">
                                <h1 class="mt-2 font-bold text-black"><?= $item['menu'] ?><span class="capitalize"> <?= $item['temperature'] ?></span></h1>
                            </div>
                        </div>
                        <div class="grid grid-cols-12">
                            <div class="col-span-2">
                                <h1 class="text-black"><?= $item['quantity'] ?> x</h1>
                            </div>
                            <div class="col-span-7">
                                <h1 class="text-black">NTD <?= ($item['price']) ?></h1>
                            </div>
                            <div class="col-span-3">
                                <h1 class="font-bold text-black">NTD <?= ($item['subtotal']) ?></h1>
                            </div>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
            <hr class="my-2 border-gray-900">
            <div class="grid grid-cols-12">
                <div class="col-span-9">
                    <h1 class="mt-2 font-bold text-black">Delivery Option</h1>
                </div>
                <div class="col-span-3">
                    <h1 class="mt-2 font-bold text-black capitalize"><?= $order['delivery_option'] ?></h1>
                </div>
            </div>
            <?php if ($order['delivery_option'] == 'delivery'): ?>
                <div class="grid grid-cols-12">
                    <div class="col-span-9">
                        <h1 class="mt-2 font-bold text-black">Delivery Address</h1>
                    </div>
                    <div class="col-span-3">
                        <h1 class="mt-2 font-bold text-black capitalize"><?= $order['delivery_address'] ?></h1>
                    </div>
                </div>
            <?php endif; ?>
            <div class="grid grid-cols-12">
                <div class="col-span-9">
                    <h1 class="mt-2 font-bold text-black">Payment Method</h1>
                </div>
                <div class="col-span-3">
                    <?php if ($order['payment_method'] == 'cash_on_delivery'): ?>
                        <h1 class="mt-2 font-bold text-black">Cash</h1>
                    <?php else: ?>
                        <h1 class="mt-2 font-bold text-black capitalize"><?= $order['payment_method'] ?></h1>
                    <?php endif; ?>
                </div>
            </div>
            <div class="grid grid-cols-12">
                <div class="col-span-9">
                    <h1 class="mt-2 font-bold text-black">Status Order</h1>
                </div>
                <div class="col-span-3">
                    <h1 class="mt-2 font-bold text-black capitalize"><?= $order['status'] ?></h1>
                </div>
            </div>
            <hr class="my-2 border-gray-900">
            <div class="grid grid-cols-12">
                <div class="col-span-9">
                    <h1 class="mt-2 font-bold text-black">Subtotal</h1>
                </div>
                <div class="col-span-3">
                    <h1 class="mt-2 font-bold text-green-600">NTD <?= $order['total_price'] ?></h1>
                </div>
            </div>
            <hr class="mt-4 border-gray-900">
                <h1><?= $order['order_date'] ?></h1>
        </div>
    </div>
</div>
</body>
</html>

