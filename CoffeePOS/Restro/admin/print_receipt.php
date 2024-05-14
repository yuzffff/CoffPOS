<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="MartDevelopers Inc">
    <title>Coffee Point Of Sale </title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/img/icons/site.webmanifest">
    <link rel="mask-icon" href="assets/img/icons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link href="assets/css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/jquery.js"></script>
    <style>
        body {
            margin-top: 20px;
        }
    </style>
</head>
</style>
<?php
$order_code = $_GET['order_code'];
$ret = "SELECT * FROM  rpos_orders WHERE order_code = '$order_code'";
$stmt = $mysqli->prepare($ret);
$stmt->execute();
$res = $stmt->get_result();
while ($order = $res->fetch_object()) {
    $total = ($order->prod_price * $order->prod_qty);

    //ส่วนดึงข้อมูลคำสั่งซื้อจากDatabaseโดยใช้รหัสคำสั่งซื้อที่รับมาผ่านParameterใน URL (order_code) และคำนวณยอดรวมเงินของคำสั่งซื้อด้วย
    //Codeรับค่ารหัสคำสั่งซื้อจากParameterที่ระบุใน URL โดยใช้ $_GET['order_code'] และเก็บไว้ในตัวแปร $order_code
    //สร้างคำสั่ง SQL เพื่อดึงข้อมูลคำสั่งซื้อจากตาราง 'rpos_orders' โดยใช้รหัสคำสั่งซื้อเป็นเงื่อนไข และ execute คำสั่ง SQL นั้น เพื่อดึงข้อมูลจริงจากDatabase
    //คำนวณยอดรวมเงินโดยนำราคาสินค้าคูณกับปริมาณที่ซื้อ (prod_price * prod_qty) และเก็บผลลัพธ์ในตัวแปร $total
    //ข้อมูลคำสั่งซื้อทั้งหมดที่ดึงมาจะถูกนำมาใช้ในการแสดงผลในส่วนต่อไปของCode
?>

    <body>
        <div class="container">
            <div class="row">
                <div id="Receipt" class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <address>
                                <strong>Cooffe POS</strong>
                                <br>
                                889 Aspire Asoke DinDang, Bangkok
                                <br>
                                (+99) 062-886-0007
                            </address>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                            <p>
                                <em>Date: <?php echo date('d/M/Y g:i', strtotime($order->created_at)); ?></em>
                            </p>
                            <p>
                                <em class="text-success">Receipt #: <?php echo $order->order_code; ?></em>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-center">
                            <h2>Receipt</h2>
                        </div>
                        </span>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th class="text-center">Unit Price</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-md-9"><em> <?php echo $order->prod_name; ?> </em></h4>
                                    </td>
                                    <td class="col-md-1" style="text-align: center"> <?php echo $order->prod_qty; ?></td>
                                    <td class="col-md-1 text-center">฿<?php echo $order->prod_price; ?></td>
                                    <td class="col-md-1 text-center">฿<?php echo $total; ?></td>
                                </tr>
                                <tr>
                                    <td>   </td>
                                    <td>   </td>
                                    <td class="text-right">
                                        <p>
                                            <strong>Subtotal: </strong>
                                        </p>
                                        <p>
                                            <strong>Tax: </strong>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p>
                                            <strong>฿<?php echo $total; ?></strong>
                                        </p>
                                        <p>
                                            <strong>14%</strong>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>   </td>
                                    <td>   </td>
                                    <td class="text-right">
                                        <h4><strong>Total: </strong></h4>
                                    </td>
                                    <td class="text-center text-danger">
                                        <h4><strong>฿<?php echo $total; ?></strong></h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                    <button id="print" onclick="printContent('Receipt');" class="btn btn-success btn-lg text-justify btn-block">
                        Print <span class="fas fa-print"></span>
                    </button>
                </div>
            </div>
        </div>
    </body>

</html>
<script>
    function printContent(el) {
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
    //printContent(el) ทำหน้าที่ในการพิมพ์เนื้อหาที่อยู่ในองค์ประกอบ (element) ที่ระบุโดย el
    //var restorepage = $('body').html(); นำเนื้อหาทั้งหน้าเว็บมาเก็บไว้ในตัวแปร restorepage โดยใช้ jQuery เลือก element body และดึงเนื้อหา HTML ทั้งหมดของหน้าเว็บ
    //var printcontent = $('#' + el).clone(); เลือก element ที่ต้องการพิมพ์โดยใช้ jQuery เลือก element ด้วย ID ที่ระบุที่เข้ามาผ่านพารามิเตอร์ el และทำการคัดลอก element นั้นๆ โดยใช้ .clone() method แล้วเก็บไว้ในตัวแปร printcontent
    //$('body').empty().html(printcontent); ล้างเนื้อหาทั้งหมดของ element body ด้วย .empty() method และใส่เนื้อหาที่คัดลอกไว้ใน printcontent ด้วย .html() method
    //window.print(); เปิดหน้าต่างการพิมพ์
    //$('body').html(restorepage); คืนค่าเนื้อหาเว็บเพื่อให้เนื้อหาทั้งหมดกลับมาเหมือนเดิมหลังจากการพิมพ์เสร็จสิ้น
</script>
<?php } ?>