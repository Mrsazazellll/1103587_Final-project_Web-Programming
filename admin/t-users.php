<table id="example" class="table-md">
    <thead>
        <tr class="bg-gray-50">
            <th class="font-semibold text-gray-900">No</th>
            <th class="font-semibold text-gray-900">Username</th>
            <th class="font-semibold text-gray-900">Email</th>
            <th class="font-semibold text-gray-900">Create Date</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-300 ">
        <?php
        require('db.php');
        $no = 1;
        $sql = "SELECT * FROM users";
        $result = $con->query($sql);
        while ($users = $result->fetch_assoc()) {
            echo"
                <tr class='bg-white transition-all duration-500 hover:bg-gray-50'>
                    <td class='text-gray-900 font-semibold text-center'> {$no}</td>
                    <td class='text-gray-900 font-semibold text-center'> {$users['username']}</td>
                    <td class='text-gray-900 font-semibold text-center'> {$users['email']}</td>
                    <td class='text-gray-900 font-semibold text-center'>" . date('d F Y - H:i a ', strtotime($users['create_datetime'])) . "</td>
                </tr>
                ";
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