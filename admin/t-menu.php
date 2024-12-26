<?php
    require('session_alert.php');
?>

<div class="flex justify-end">
    <div class="flex-col">
        <button class="btn btn-info mb-2" onclick="modal_input.showModal()">Input Menu</button>
    </div>
</div>

<dialog id="modal_input" class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
        <form action="action/input-menu.php" method="post" enctype="multipart/form-data" class="max-w-5xl mx-auto">
            <label for="menu" class="label-text font-extrabold">Menu</label>
            <input type="text" name="menu" id="menu" required placeholder="Menu"
                class="bg-gray-700 input input-bordered input-primary w-full max-w-5xl mb-2" />

            <label for="price" class="label-text font-extrabold">Price</label>
            <input type="number" name="price" id="price" required
                class="bg-gray-700 input input-bordered input-primary w-full max-w-5xl mb-2" />

            <label for="picture" class="label-text font-extrabold">Picture</label>
            <input type="file" name="picture" id="picture" required
                class="bg-gray-700 file-input file-input-bordered file-input-primary w-full max-w-5xl mb-2" />

            <button type="submit" class="btn btn-info mt-3">Input</button>
            <button type="button" class="btn btn-error mt-3" onclick="modal_input.close()">Close</button>
        </form>
    </div>
</dialog>

<table id="example" class="table-md">
    <thead>
        <tr class="bg-gray-50">
            <th class="font-semibold text-gray-900">No</th>
            <th class="font-semibold text-gray-900">Menu</th>
            <th class="font-semibold text-gray-900">Price</th>
            <th class="font-semibold text-gray-900">Picture</th>
            <th class="font-semibold text-gray-900"> Actions </th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-300 ">
        <?php
        require('db.php');
        $no = 1;
        $sql = "SELECT * FROM menu";
        $result = $con->query($sql);
        while ($menu = $result->fetch_assoc()) {
        $modal_edit = "modal_edit".$menu['id'];
        $modal_delete = "modal_delete".$menu['id'];
            echo"
                <tr class='bg-white transition-all duration-500 hover:bg-gray-50'>
                    <td class='text-gray-900 font-semibold text-center'> {$no}</td>
                    <td class='text-gray-900 font-semibold text-center'> {$menu['menu']}</td>
                    <td class='text-gray-900 font-semibold text-center'>NTD {$menu['price']}</td>
                    <td class='ml-5'>
                        <img src='../assets/images/menu/{$menu['picture']}' alt='' class='w-20 h-20 object-cover'>
                    </td>
                    <td class='flex p-5 justify-center gap-0.5'>
                        <button class='p-2  rounded-full bg-white group transition-all duration-500 hover:bg-indigo-600 flex item-center' onclick='document.getElementById(\"$modal_edit\").showModal()'>
                            <i class='fa-solid fa-pen-to-square' style='color: #74C0FC;'></i>
                        </button>
                        <button class='p-2 rounded-full bg-white group transition-all duration-500 hover:bg-red-200 flex item-center' onclick='document.getElementById(\"$modal_delete\").showModal()'>
                            <i class='fa-solid fa-trash' style='color: #f50000;'></i>
                        </button>    
                    </td>
                </tr>

                <dialog id='$modal_edit' class='modal'>
                    <div class='modal-box w-11/12 max-w-4xl'>
                        <form action='action/update-menu.php' method='post' enctype='multipart/form-data' class='max-w-sm mx-auto'>

                            <input type='hidden' name='id' value='{$menu['id']}'>
                            
                            <label for='menu' class='label-text font-extrabold'>Menu</label>
                            <input type='text' name='menu' id='menu' required value='{$menu['menu']}' class='bg-gray-700 input input-bordered input-primary w-full max-w-5xl mb-2'/>

                            <label for='price' class='label-text font-extrabold'>Price</label>
                            <input type='number' name='price' id='price' value='{$menu['price']}' required class='bg-gray-700 input input-bordered input-primary w-full max-w-5xl mb-2'/>

                            <label for='picture' class='label-text font-extrabold'>Picture</label>
                            <input type='file' name='picture' id='picture' class='bg-gray-700 file-input file-input-bordered file-input-primary w-full max-w-5xl mb-2'/>

                            <input type='hidden' name='old_picture' value='{$menu['picture']}' />

                            <button type='submit'class='btn btn-info mt-3'>Update</button>
                            <a class='btn btn-error mt-3' onclick='document.getElementById(\"$modal_edit\").close()'>Batal</a>

                        </form>
                    </div>
                </dialog>
                
                <dialog id='$modal_delete' class='modal'>
                    <div class='modal-box'>
                        <h3 class='text-lg font-bold'>Are you sure to delete {$menu['menu']}?</h3>
                        <div class='modal-action'>
                            <a href='action/delete-menu.php?id={$menu['id']}' class='btn btn-info mt-3'>Delete</a>
                            <button class='btn btn-error mt-3' onclick='document.getElementById(\"$modal_delete\").close()'>Cancel</button>
                        </div>
                    </div>
                </dialog>";
        $no++;
        }
    ?>
    </tbody>
</table>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable({});
});
</script>