<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
require_once('partials/_head.php');
?>

<body>
    <!-- Sidenav -->
    <?php
    require_once('partials/_sidebar.php');
    ?>
    <!-- Main content -->
    <div class="main-content">
        <!-- Top navbar -->
        <?php
        require_once('partials/_topnav.php');
        ?>
        <!-- Header -->
        <div style="background-image: url(assets/img/theme/restro01.jpg); background-size: cover;" class="header  pb-8 pt-5 pt-md-8">
        <span class="mask bg-gradient-dark opacity-4"></span>
            <div class="container-fluid">
                <div class="header-body">
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--8">
            <!-- Table -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            Orders Records
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-success" scope="col">Code</th>
                                        <th scope="col">Customer</th>
                                        <th class="text-success" scope="col">Product</th>
                                        <th scope="col">Unit Price</th>
                                        <th class="text-success" scope="col">Quantity</th>
                                        <th scope="col">Total Price</th>
                                        <th scop="col">Status</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM  rpos_orders ORDER BY `created_at` DESC  ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($order = $res->fetch_object()) {
                                        $total = ($order->prod_price * $order->prod_qty);

                                    ?>
                                        <tr>
                                            <th class="text-success" scope="row"><?php echo $order->order_code; ?></th>
                                            <td><?php echo $order->customer_name; ?></td>
                                            <td class="text-success"><?php echo $order->prod_name; ?></td>
                                            <td>฿ <?php echo $order->prod_price; ?></td>
                                            <td class="text-success"><?php echo $order->prod_qty; ?></td>
                                            <td>฿ <?php echo $total; ?></td>
                                            <td><?php if ($order->order_status == '') {
                                                    echo "<span class='badge badge-danger'>Not Paid</span>";
                                                } else {
                                                    echo "<span class='badge badge-success'>$order->order_status</span>";
                                                } ?></td>
                                            <td><?php echo date('d/M/Y g:i', strtotime($order->created_at)); ?></td>
                                        </tr>
                                    <?php } ?>
                                    <!--ดึงข้อมูลคำสั่งซื้อจากฐานข้อมูลและแสดงผลลัพธ์ในรูปแบบตาราง HTML-->
                                    <!--Codeดึงข้อมูลคำสั่งซื้อจากตาราง rpos_orders ในDatabase โดยใช้คำสั่ง SQL SELECT และเรียงลำดับตามวันที่ที่สร้าง (created_at) จากล่าสุดไปยังเก่าที่สุด-->
                                    <!--วนลูปผ่านผลลัพธ์ที่ได้รับจากการ execute เพื่อแสดงข้อมูลของคำสั่งซื้อในรูปแบบของแถวในตาราง HTML แต่ละแถวจะแสดงรายละเอียดของคำสั่งซื้อเช่น รหัสคำสั่ง, ชื่อลูกค้า, ชื่อสินค้า, ราคาต่อหน่วยของสินค้า, จำนวนสินค้า, ราคารวม, สถานะคำสั่งซื้อ, และวันที่สร้างคำสั่งซื้อ-->
                                    <!--คำนวณราคารวมของแต่ละคำสั่งซื้อโดยคูณราคาต่อหน่วยของสินค้า (prod_price) กับจำนวนสินค้า (prod_qty) เพื่อหาผลรวมของราคาทั้งหมด (total)-->
                                    <!--สถานะของคำสั่งซื้อจะถูกแสดงในรูปแบบของแท็ก badge ซึ่งจะแสดงสถานะว่าคำสั่งซื้อนั้นๆ ชำระเงินแล้วหรือยัง วันที่และเวลาที่คำสั่งซื้อถูกสร้างจะถูกแสดงในรูปแบบของวันที่และเวลาที่อ่านได้ง่าย-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <?php
            require_once('partials/_footer.php');
            ?>
        </div>
    </div>
    <!-- Argon Scripts -->
    <?php
    require_once('partials/_scripts.php');
    ?>
</body>

</html>