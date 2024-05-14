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
                            Paid Orders
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-success" scope="col">Code</th>
                                        <th scope="col">Customer</th>
                                        <th class="text-success" scope="col">Product</th>
                                        <th scope="col">Unit Price</th>
                                        <th class="text-success" scope="col">Qty</th>
                                        <th scope="col">Total Price</th>
                                        <th class="text-success" scope="col">Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM  rpos_orders WHERE order_status = 'Paid' ORDER BY `rpos_orders`.`created_at` DESC  ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($order = $res->fetch_object()) {
                                        $total = ($order->prod_price * $order->prod_qty);
                                        //$ret กำหนดคำสั่ง SQL สำหรับดึงข้อมูลการสั่งซื้อที่มีสถานะ "Paid" โดยเรียงลำดับตามเวลาที่สร้างล่าสุด จากฐานข้อมูล.
                                        //prepare() เตรียมคำสั่ง SQL สำหรับการเตรียมใช้งานโดยใช้คำสั่ง SQL จาก $ret.
                                        //execute() ทำการ execute คำสั่ง SQL เพื่อดึงข้อมูลจากฐานข้อมูล.
                                        //get_result() รับผลลัพธ์ของคำสั่ง SQL จากการ execute และเก็บไว้ในตัวแปร $res.
                                        //ในลูป while จะทำการดึงข้อมูลแต่ละแถวจาก $res และเก็บไว้ในตัวแปร $order ในรูปแบบของออบเจกต์ ซึ่งแทนข้อมูลของแต่ละคอลัมน์ในฐานข้อมูล.
                                        //ภายในลูป while นี้ คำนวณค่ารวมของสินค้าแต่ละรายการโดยการคูณราคาของสินค้ากับปริมาณของสินค้า และเก็บไว้ในตัวแปร $total.
                                        //จากนั้นโค้ดที่อยู่ในลูป while จะทำการแสดงผลข้อมูลการสั่งซื้อที่มีสถานะ "Paid" ในรูปแบบของตารางหรือลิสต์ โดยแสดงรายละเอียดเช่น รหัสการสั่งซื้อ ชื่อลูกค้า รายการสินค้า ราคาของสินค้า ปริมาณของสินค้า รวมถึงสถานะของการสั่งซื้อและเวลาที่สร้างการสั่งซื้อ
                                    ?>
                                        <tr>
                                            <th class="text-success" scope="row"><?php echo $order->order_code; ?></th>
                                            <td><?php echo $order->customer_name; ?></td>
                                            <td class="text-success"><?php echo $order->prod_name; ?></td>
                                            <td>฿ <?php echo $order->prod_price; ?></td>
                                            <td class="text-success"><?php echo $order->prod_qty; ?></td>
                                            <td>฿ <?php echo $total; ?></td>
                                            <td><?php echo date('d/M/Y g:i', strtotime($order->created_at)); ?></td>
                                            <td>
                                                <a target="_blank" href="print_receipt.php?order_code=<?php echo $order->order_code; ?>">
                                                    <button class="btn btn-sm btn-primary">
                                                        <i class="fas fa-print"></i>
                                                        Print Receipt
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
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