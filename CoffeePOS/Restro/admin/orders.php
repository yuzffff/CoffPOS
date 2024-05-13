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
              Select On Any Product To Make An Order
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col"><b>Image</b></th>
                    <th scope="col"><b>Product Code</b></th>
                    <th scope="col"><b>Name</b></th>
                    <th scope="col"><b>Price</b></th>
                    <th scope="col"><b>Action</b></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ret = "SELECT * FROM  rpos_products ";
                  $stmt = $mysqli->prepare($ret);
                  $stmt->execute();
                  $res = $stmt->get_result();
                  while ($prod = $res->fetch_object()) {
                  ?>
                    <tr>
                      <td>
                        <?php
                        if ($prod->prod_img) {
                          echo "<img src='assets/img/products/$prod->prod_img' height='60' width='60 class='img-thumbnail'>";
                        } else {
                          echo "<img src='assets/img/products/default.jpg' height='60' width='60 class='img-thumbnail'>";
                        }

                        ?>
                      </td>
                      <td><?php echo $prod->prod_code; ?></td>
                      <td><?php echo $prod->prod_name; ?></td>
                      <td>฿ <?php echo $prod->prod_price; ?></td>
                      <td>
                        <a href="make_oder.php?prod_id=<?php echo $prod->prod_id; ?>&prod_name=<?php echo $prod->prod_name; ?>&prod_price=<?php echo $prod->prod_price; ?>">
                          <button class="btn btn-sm btn-warning">
                            <i class="fas fa-cart-plus"></i>
                            Place Order
                          </button>
                        </a>
                      </td>
                    </tr>
                  <?php } ?>
                  <!--Codeใช้สำหรับแสดงข้อมูลสินค้าในรูปแบบตาราง HTML และสร้างลิงก์ "Place Order" เพื่อให้Userสามารถเริ่มการสั่งซื้อสินค้าได้ในระบบ-->
                  <!--ดึงข้อมูลสินค้าจากตาราง rpos_products ในDatabase Codeวนลูปผ่านผลลัพธ์ที่ได้รับจากการ execute เพื่อแสดงข้อมูลของสินค้าในรูปแบบของแถวในตาราง HTML แต่ละแถวจะแสดงรายละเอียดของสินค้าเช่น รูปภาพสินค้า (ถ้ามี), รหัสสินค้า, ชื่อสินค้า, ราคาสินค้า, และปุ่ม "Place Order" เพื่อเริ่มการสั่งซื้อสินค้า-->
                  <!--ตรวจสอบว่าสินค้ามีรูปภาพหรือไม่ ถ้ามีจะแสดงรูปภาพของสินค้านั้น หากไม่มีจะแสดงรูปภาพที่กำหนดไว้สำหรับรูปภาพที่ไม่มี-->
                  <!--สำหรับแต่ละสินค้า จะมีปุ่ม "Place Order" ที่เป็นลิงก์ไปยังหน้า make_order.php เพื่อเริ่มกระบวนการสั่งซื้อสินค้า โดยจะส่งparameter prod_id, prod_name และ prod_price เพื่อให้สามารถเพิ่มสินค้าลงในคำสั่งซื้อได้-->
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