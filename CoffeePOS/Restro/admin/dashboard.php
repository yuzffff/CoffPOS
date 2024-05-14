<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
require_once('partials/_head.php');
require_once('partials/_analytics.php');
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
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Customers</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $customers; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Products</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $products; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                        <i class="fas fa-utensils"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Orders</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $orders; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-shopping-cart"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                      <span class="h2 font-weight-bold mb-0">฿<?php echo $sales; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                        <i class="fas fa-dollar-sign"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Recent Orders</h3>
                </div>
                <div class="col text-right">
                  <a href="orders_reports.php" class="btn btn-sm btn-primary">See all</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th class="text-success" scope="col"><b>Code</b></th>
                    <th scope="col"><b>Customer</b></th>
                    <th class="text-success" scope="col"><b>Product</b></th>
                    <th scope="col"><b>Unit Price</b></th>
                    <th class="text-success" scope="col"><b>Quantity</b></th>
                    <th scope="col"><b>Total</b></th>
                    <th scop="col"><b>Status</b></th>
                    <th class="text-success" scope="col"><b>Date</b></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ret = "SELECT * FROM  rpos_orders ORDER BY `rpos_orders`.`created_at` DESC LIMIT 7 ";
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
                      <td>฿<?php echo $order->prod_price; ?></td>
                      <td class="text-success"><?php echo $order->prod_qty; ?></td>
                      <td>฿<?php echo $total; ?></td>
                      <td><?php if ($order->order_status == '') {
                            echo "<span class='badge badge-danger'>Not Paid</span>";
                          } else {
                            echo "<span class='badge badge-success'>$order->order_status</span>";
                          } ?></td>
                      <td class="text-success"><?php echo date('d/M/Y g:i', strtotime($order->created_at)); ?></td>
                      <!--ใช้เพื่อแสดงวันที่และเวลาที่อ่านได้จากฟิลด์ created_at ในวัตถุ $order โดยใช้ฟังก์ชัน date() เพื่อจัดรูปแบบของวันที่และเวลา และ strtotime() เพื่อแปลงวันที่และเวลาจากรูปแบบที่เก็บในDatabase (สมมติว่าเป็น timestamp) เป็นรูปแบบที่สามารถอ่านได้-->
                      <!--รูปแบบของวันที่และเวลาที่กำหนดในฟังก์ชัน date() คือ 'd/M/Y g:i'-->
                      <!--d: แทนวันที่ในรูปแบบเลข 2 หลัก (01-31)-->
                      <!--M: แทนเดือนในรูปแบบของตัวย่อ (Jan-Dec)-->
                      <!--Y: แทนปีในรูปแบบเลข 4 หลัก (e.g., 2024)-->
                      <!--g: แทนชั่วโมงในรูปแบบ 12 ชั่วโมง (1-12)-->
                      <!--i: แทนนาทีในรูปแบบเลข 2 หลัก (00-59)-->
                    </tr>
                  <?php } ?>
                </tbody> <!--Codeใช้สำหรับดึงข้อมูลการสั่งซื้อจากDatabaseและแสดงผลในรูปแบบตาราง HTML -->
                        <!--ใช้คำสั่ง SQL SELECT เพื่อดึงข้อมูลการสั่งซื้อจากตาราง rpos_orders โดยเรียงลำดับตามวันที่สร้าง (created_at) จากล่าสุดไปยังเก่าที่สุด (ORDER BY rpos_orders.created_at DESC) และใช้ LIMIT ในการจำกัดจำนวนของรายการที่จะแสดง ในที่นี้กำหนดให้แสดงข้อมูลล่าสุด 7 รายการ-->
                        <!--แต่ละรายการการสั่งซื้อ Code ทำการคำนวณราคารวมโดยการคูณราคาของสินค้าด้วยจำนวนสินค้า (prod_price * prod_qty) และเก็บผลลัพธ์ในตัวแปร $total-->
                        <!--Code ใช้ while loop เพื่อวนลูปผ่านผลลัพธ์ที่ได้จากการ query เพื่อแสดงข้อมูลของการสั่งซื้อในรูปแบบของตาราง HTML โดยแต่ละแถวจะแสดงข้อมูลของการสั่งซื้อแต่ละรายการ เช่น รหัสการสั่งซื้อ (order_code), ชื่อลูกค้า (customer_name), ชื่อสินค้า (prod_name), ราคาสินค้า (prod_price), จำนวนสินค้า (prod_qty), ราคารวม (total), สถานะการสั่งซื้อ (order_status), และวันที่สร้างการสั่งซื้อ (created_at) โดยที่บางข้อมูลอาจมีการปรับแต่งการแสดงผลเพื่อให้เหมาะสมกับลักษณะของข้อมูลและการแสดงผล-->
                        <!--ตรวจสอบสถานะการสั่งซื้อ (order_status) และแสดงข้อความแสดงสถานะที่เหมาะสม เช่น "Not Paid" หรือ "Paid" โดยใช้แท็ก <span> และ class ของ Bootstrap badge เพื่อเน้นสถานะที่แตกต่างกัน-->
              </table>
            </div>
          </div>
        </div>
      </div>
		
      <div class="row mt-5">
        <div class="col-xl-12">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Recent Payments</h3>
                </div>
                <div class="col text-right">
                  <a href="payments_reports.php" class="btn btn-sm btn-primary">See all</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th class="text-success" scope="col"><b>Code</b></th>
                    <th scope="col"><b>Amount</b></th>
                    <th class='text-success' scope="col"><b>Order Code</b></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ret = "SELECT * FROM   rpos_payments   ORDER BY `rpos_payments`.`created_at` DESC LIMIT 7 ";
                  $stmt = $mysqli->prepare($ret);
                  $stmt->execute();
                  $res = $stmt->get_result();
                  while ($payment = $res->fetch_object()) {
                  ?>
                    <tr>
                      <th class="text-success" scope="row">
                        <?php echo $payment->pay_code; ?>
                      </th>
                      <td>
                        ฿<?php echo $payment->pay_amt; ?>
                      </td>
                      <td class='text-success'>
                        <?php echo $payment->order_code; ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody> <!--ดึงข้อมูลการชำระเงินจากฐานข้อมูลและแสดงผลในรูปแบบของตาราง HTML-->
                         <!--ใช้คำสั่ง SQL SELECT เพื่อดึงข้อมูลการชำระเงินจากตาราง rpos_payments โดยเรียงลำดับตามวันที่สร้าง (created_at) จากล่าสุดไปยังเก่าที่สุด (ORDER BY rpos_payments.created_at DESC) และใช้ LIMIT ในการจำกัดจำนวนของรายการที่จะแสดง ในที่นี้กำหนดให้แสดงข้อมูลล่าสุด 7 รายการ-->
                         <!--จะใช้ while loop เพื่อวนลูปผ่านผลลัพธ์ที่ได้จากการ query เพื่อแสดงข้อมูลของการชำระเงินในรูปแบบของตาราง HTML โดยแต่ละแถวจะแสดงข้อมูลของการชำระเงินแต่ละรายการ เช่น รหัสการชำระเงิน (pay_code), จำนวนเงินที่ชำระ (pay_amt), รหัสการสั่งซื้อ (order_code) โดยที่ข้อมูลเหล่านี้จะถูกแสดงในคอลัมน์ของตารางที่ต่างกัน-->
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <?php require_once('partials/_footer.php'); ?>
    </div>
  </div>
  <!-- Argon Scripts -->
  <?php
  require_once('partials/_scripts.php');
  ?>
</body>

</html>