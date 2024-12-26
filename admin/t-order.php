<?php
    require('session_alert.php');
?>

<div class="flex justify-end">
    <div class="flex-col">
        <button class="btn btn-info mb-2" onclick="modal_input.showModal()">Input Order</button>
    </div>
</div>

<dialog id="modal_input" class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
        <form action="action/input-menu.php" method="post" enctype="multipart/form-data" class="max-w-5xl mx-auto">
            <label for="menu" class="label-text font-extrabold">Menu</label>
            <input type="text" name="menu" id="menu" required placeholder="Menu"
                class="bg-gray-700 input input-bordered input-primary w-full max-w-5xl mb-2" />

            <label for="harga" class="label-text font-extrabold">Harga</label>
            <input type="number" name="harga" id="harga" required
                class="bg-gray-700 input input-bordered input-primary w-full max-w-5xl mb-2" />

            <label for="gambar" class="label-text font-extrabold">Gambar</label>
            <input type="file" name="gambar" id="gambar" required
                class="bg-gray-700 file-input file-input-bordered file-input-primary w-full max-w-5xl mb-2" />

            <button type="submit" class="btn btn-info mt-3">Input</button>
            <button type="button" class="btn btn-error mt-3" onclick="modal_input.close()">Close</button>
        </form>
    </div>
</dialog>

<table id="example" class="table-xs">
    <thead>
        <tr class="bg-gray-50">
            <th class="font-semibold text-gray-900">No</th>
            <th class="font-semibold text-gray-900">Customer</th>
            <th class="font-semibold text-gray-900">Order ID</th>
            <th class="font-semibold text-gray-900">Total Price</th>
            <th class="font-semibold text-gray-900">Order Date</th>
            <th class="font-semibold text-gray-900">Status</th>
            <th class="font-semibold text-gray-900">Delivery Option</th>
            <th class="font-semibold text-gray-900">Delivery Address</th>
            <th class="font-semibold text-gray-900">Payment Method</th>
            <th class="font-semibold text-gray-900">Transfer Image</th>
            <th class="font-semibold text-gray-900">Confirm Order</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-300">
        <?php
        require('db.php');
        $no = 1;
        $sql = "SELECT orders.*, users.username FROM orders 
                JOIN users ON orders.users_id = users.id 
                ORDER BY orders.order_date DESC";
        $result = $con->query($sql);
        while ($order = $result->fetch_assoc()) {
        $modal_confirm = "modal_confirm" . $order['id'];
        $modal_picture = "modal_picture".$order['id'];

        if ($order['payment_method'] == 'cash_on_delivery') {
            $order_image = "<h1 class='text-gray-900 font-semibold text-center'>Cash</h1>";
            $payment = "Cash";
        }else if ($order['payment_method'] == 'transfer') {
            $order_image = "<img src='../assets/images/payment/{$order['transfer_image']}' alt='' class='w-20 h-20 object-cover' onclick='document.getElementById(\"$modal_picture\").showModal()'>";
            $payment = "Transfer";
        }
        
        if ($order['status'] == 'pending') {
            $badge = "badge badge-warning badge-xs p-2";
        }else if ($order['status'] == 'completed') {
            $badge = "badge badge-success badge-xs p-2";
        }else if ($order['status'] == 'cancelled') {
            $badge = "badge badge-error badge-xs p-2";
        }
            echo"
                <tr class='bg-white transition-all duration-500 hover:bg-gray-50'>
                    <td class='text-gray-900 font-semibold text-center'> {$no}</td>
                    <td class='text-gray-900 font-semibold text-center'> {$order['username']}</td>
                    <td class='text-gray-900 font-semibold text-center'> {$order['id']}</td>
                    <td class='text-gray-900 font-semibold text-center'> {$order['total_price']}</td>
                    <td class='text-gray-900 font-semibold text-center whitespace-nowrap'> " . date('d F Y - H:i a ', strtotime($order['order_date'])) . "</td>
                    <td class='text-gray-900 font-semibold text-center capitalize'>
                        <div class='$badge'>
                            {$order['status']}
                        </div>
                    </td>
                    <td class='text-gray-900 font-semibold text-center capitalize'> {$order['delivery_option']}</td>
                    <td class='text-gray-900 font-semibold text-center'> {$order['delivery_address']}</td>
                    <td class='text-gray-900 font-semibold text-center capitalize'> {$payment}</td>
                    <td class='ml-5'> $order_image </td>
                    <td class='flex p-5 justify-center gap-0.5'>
                        <button class='p-2 rounded-full bg-white group transition-all duration-500' onclick='document.getElementById(\"$modal_confirm\").showModal()'>
                            <i class='fa-solid fa-check-to-slot fa-2xl' style='color: #63E6BE;'></i>
                        </button>   
                         
                    </td>
                </tr>
                
                <dialog id='$modal_confirm' class='modal'>
                    <div class='modal-box bg-white'>
                        <form method='dialog'>
                            <button class='btn btn-sm btn-circle btn-ghost absolute right-2 top-2'>✕</button>
                        </form>
                        <div class='flex justify-between items-center'>
                            <a href='action/confirm-order.php?id={$order['id']}' class='btn btn-success mx-auto'>
                                <i class='fa-solid fa-check fa-2xl' style='color: #63E6BE;'> Confirm</i>
                            </a>
                            <a href='action/cancel-order.php?id={$order['id']}' class='btn btn-error mx-auto'>
                                <i class='fa-solid fa-xmark fa-2xl' style='color: #f50000;'> Cancel</i>
                            </a>
                        </div>
                    </div>
                </dialog>

                <dialog id='$modal_picture' class='modal'>
                    <div class='modal-box p-0'>
                        <form method='dialog'>
                            <button class='btn btn-sm btn-circle btn-error absolute right-2 top-2'>✕</button>
                        </form>
                        <img src='../assets/images/payment/{$order['transfer_image']}' alt='Image 1' class='w-full h-auto object-cover rounded-lg'/>
                    </div>
                </dialog>
                ";
            $no++;  
        }
    ?>
    </tbody>
</table>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.tailwindcss.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable({});
});
</script>