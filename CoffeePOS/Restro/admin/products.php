<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();

if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $adn = "DELETE FROM rpos_products WHERE prod_id = ?";
  $stmt = $mysqli->prepare($adn);
  $stmt->bind_param('i', $id); // Change 's' to 'i' for integer parameter
  $stmt->execute();
  if ($stmt->affected_rows > 0) {
    $success = "Deleted";
  } else {
    $err = "Try Again Later";
  }
  $stmt->close();
  header("refresh:1; url=products.php");
}

//ส่วนของหน้าเว็บที่ใช้ในการลบสินค้าออกจากระบบ
//Codeจะตรวจสอบว่ามีการส่งParameter 'delete' ผ่าน URL ไหม ถ้ามี จะดึงค่า 'delete' และทำการลบข้อมูลสินค้าที่มี prod_id ตรงกับค่า 'delete' ออกจากตาราง 'rpos_products'
//ใช้คำสั่ง SQL DELETE เพื่อลบข้อมูลสินค้าจากตาราง 'rpos_products' โดยใช้ prod_id เป็นเงื่อนไข
//ตรวจสอบผลลัพธ์จากการลบข้อมูล เพื่อตรวจสอบว่าข้อมูลถูกลบออกจากDatabaseหรือไม่ และแสดงข้อความเป็นผลลัพธ์ที่สมบูรณ์ หากข้อมูลถูกลบ
//หลังจากที่ทำการลบข้อมูลเสร็จสิ้น Codeจะเปลี่ยนเส้นทางของหน้าเว็บไปยังหน้า 'products.php' ภายในเวลา 1 วินาที

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
              <a href="add_product.php" class="btn btn-outline-success">
                <i class="fas fa-utensils"></i>
                Add New Product
              </a>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product Code</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ret = "SELECT * FROM rpos_products";
                  $stmt = $mysqli->prepare($ret);
                  $stmt->execute();
                  $res = $stmt->get_result();
                  while ($prod = $res->fetch_object()) {
                  ?>
                    <tr>
                      <td>
                        <?php
                        $imagePath = 'assets/img/products/' . ($prod->prod_img ? $prod->prod_img : 'default.jpg');
                        echo "<img src='$imagePath' height='60' width='60' class='img-thumbnail'>";
                        ?>
                      </td>
                      <td><?php echo $prod->prod_code; ?></td>
                      <td><?php echo $prod->prod_name; ?></td>
                      <td>฿ <?php echo $prod->prod_price; ?></td>
                      <td>
                        <a href="products.php?delete=<?php echo $prod->prod_id; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                          <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                            Delete
                          </button>
                        </a>

                        <a href="update_product.php?update=<?php echo $prod->prod_id; ?>">
                          <button class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                            Update
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