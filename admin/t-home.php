<main class="flex-1 p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white rounded-xl shadow-lg p-6 h-64 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl animate-slide-up" style="animation-delay: 0.1s">
                    <h3 class="text-xl font-bold text-indigo-800">Total Menu</h3>
                    <?php
                        require('db.php');
                        $sql = "SELECT COUNT(*) AS total_menu FROM menu";
                        $result = $con->query($sql);
                        $total_menu = $result->fetch_assoc()['total_menu'];
                        echo "<h1 class='text-5xl font-bold text-indigo-800'>{$total_menu}</h1></h1>";
                    ?>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 h-64 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl animate-slide-up" style="animation-delay: 0.1s">
                    <h3 class="text-xl font-bold text-indigo-800">Total Orders</h3>
                    <?php
                        require('db.php');
                        $sql = "SELECT COUNT(*) AS total_orders FROM orders";
                        $result = $con->query($sql);
                        $total_orders = $result->fetch_assoc()['total_orders'];
                        echo "<h1 class='text-5xl font-bold text-indigo-800'>{$total_orders}</h1></h1>";
                    ?>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 h-64 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl animate-slide-up" style="animation-delay: 0.1s">
                    <h3 class="text-xl font-bold text-indigo-800">Total Users</h3>
                    <?php
                        require('db.php');
                        $sql = "SELECT COUNT(*) AS total_users FROM users";
                        $result = $con->query($sql);
                        $total_users = $result->fetch_assoc()['total_users'];
                        echo "<h1 class='text-5xl font-bold text-indigo-800'>{$total_users}</h1></h1>";
                    ?>
                </div>
            </div>
</main>