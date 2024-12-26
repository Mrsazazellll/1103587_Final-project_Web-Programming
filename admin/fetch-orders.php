<?php
require('db.php');

$sql = "SELECT orders.*, users.username FROM orders 
        JOIN users ON orders.users_id = users.id 
        ORDER BY orders.order_date DESC";
$result = $con->query($sql);

$data = [];
while ($order = $result->fetch_assoc()) {
    $data[] = $order;
}

echo json_encode($data);
