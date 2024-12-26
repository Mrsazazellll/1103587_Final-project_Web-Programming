<?php
require('db.php');
session_start();

$user_id = $_SESSION['id'];
$delivery_option = $_POST['delivery_option'];
$delivery_address = $delivery_option === 'delivery' ? $_POST['delivery_address'] : 'Coffee Shop';
$payment_method = $_POST['payment_method'];

// Step 1: Get cart
$sql_cart = "SELECT c.menu_id, c.quantity, m.price, (c.quantity * m.price) AS subtotal
             FROM cart c
             JOIN menu m ON c.menu_id = m.id
             WHERE c.users_id = ?";
$stmt_cart = $con->prepare($sql_cart);
$stmt_cart->bind_param("i", $user_id);
$stmt_cart->execute();
$result_cart = $stmt_cart->get_result();

$total_price = 0;
$cart_items = [];
while ($row = $result_cart->fetch_assoc()) {
    $cart_items[] = $row;
    $total_price += $row['subtotal'];
}

// Step 2: Make a new order in orders
$sql_order = "INSERT INTO orders (users_id, total_price, delivery_option, delivery_address, payment_method)
              VALUES (?, ?, ?, ?, ?)";
$stmt_order = $con->prepare($sql_order);
$stmt_order->bind_param("iisss", $user_id, $total_price, $delivery_option, $delivery_address, $payment_method);
$stmt_order->execute();
$order_id = $con->insert_id;

// Step 3: Move data from cart to order_items
$sql_order_items = "INSERT INTO order_items (orders_id, menu_id, quantity, price, temperature)
                    SELECT ?, c.menu_id, c.quantity, m.price, c.temperature
                    FROM cart c
                    JOIN menu m ON c.menu_id = m.id
                    WHERE c.users_id = ?";
$stmt_order_items = $con->prepare($sql_order_items);
$stmt_order_items->bind_param("ii", $order_id, $user_id);
$stmt_order_items->execute();


// Step 4: Empty cart
$sql_clear_cart = "DELETE FROM cart WHERE users_id = ?";
$stmt_clear_cart = $con->prepare($sql_clear_cart);
$stmt_clear_cart->bind_param("i", $user_id);
$stmt_clear_cart->execute();

// Show confirmation
if ($stmt_order->affected_rows > 0) {
    $_SESSION['add_order'] = "cafe ini tidak menggunakan sedotan sebagai bentuk menjaga lingkungan, dan gelas yang kamu gunakan adalah gelas yang berkolaborasi dengan yayasan penghijauan alam yang menggunakan limbah plastik untuk didaur ulang kembali menjadi gelas kami!";
    header("Location: order.php");
} else {
    echo "Terjadi kesalahan saat membuat pesanan.";
}

// Close conections
$stmt_cart->close();
$stmt_order->close();
$stmt_order_items->close();
$stmt_clear_cart->close();
$con->close();
?>