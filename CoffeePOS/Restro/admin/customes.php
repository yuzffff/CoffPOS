<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
//Delete Staff
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $adn = "DELETE FROM  rpos_customers  WHERE  customer_id = ?";
  $stmt = $mysqli->prepare($adn);
  $stmt->bind_param('s', $id);
  $stmt->execute();
  $stmt->close();
  if ($stmt) {
    $success = "Deleted" && header("refresh:1; url=customes.php");
  } else {
    $err = "Try Again Later";
  }
}

//Codeใช้ในการลบข้อมูลของลูกค้าออกจากDatabase
//Code จะตรวจสอบว่ามีการส่งค่า parameter delete มาหรือไม่ หากมีจะนำค่านั้นมาใช้เป็นรหัสลูกค้า (customer_id) ที่ต้องการลบ จากนั้นจะทำการสร้างคำสั่ง SQL เพื่อลบข้อมูลลูกค้าที่มี customer_id เป็นตามที่ระบุ 
//หลังจากที่ลบข้อมูลลูกค้าออกจากDatabaseเสร็จสมบูรณ์ จะแสดงข้อความ "Deleted" และ redirect Userไปยังหน้า customes.php เพื่อแสดงข้อมูลลูกค้าอีกครั้ง 
//โดยใช้ header("refresh:1; url=customes.php") เพื่อให้Userเห็นข้อความดังกล่าวเป็นเวลาหนึ่งวินาทีก่อนที่จะไปยังหน้าถัดไป

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
              <a href="add_customer.php" class="btn btn-outline-success">
                <i class="fas fa-user-plus"></i>
                Add New Customer
              </a>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Full Name</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ret = "SELECT * FROM  rpos_customers  ORDER BY `rpos_customers`.`created_at` DESC ";
                  $stmt = $mysqli->prepare($ret);
                  $stmt->execute();
                  $res = $stmt->get_result();
                  while ($cust = $res->fetch_object()) {
                  ?>
                    <tr>
                      <td><?php echo $cust->customer_name; ?></td>
                      <td><?php echo $cust->customer_phoneno; ?></td>
                      <td><?php echo $cust->customer_email; ?></td>
                      <td>
                        <a href="customes.php?delete=<?php echo $cust->customer_id; ?>">
                          <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                            Delete
                          </button>
                        </a>

                        <a href="update_customer.php?update=<?php echo $cust->customer_id; ?>">
                          <button class="btn btn-sm btn-primary">
                            <i class="fas fa-user-edit"></i>
                            Update
                          </button>
                        </a>
                      </td>
                    </tr> <!--Code ใช้สำหรับแสดงรายการข้อมูลลูกค้าจากDatabase MySQL และให้Userสามารถดำเนินการแก้ไขหรือลบข้อมูลลูกค้าได้ทันทีผ่านทางเว็บไซต์-->
                          <!--โดยใช้คำสั่ง SQL SELECT เพื่อดึงข้อมูลลูกค้าจากตาราง rpos_customers โดยเรียงลำดับตามวันที่สร้าง (created_at) จากล่าสุดไปยังเก่าที่สุด (ORDER BY rpos_customers.created_at DESC) และทำการ execute คำสั่ง SQL นี้ เพื่อดึงข้อมูลลูกค้ามาเก็บไว้ในตัวแปร $res -->
                          <!--Code ใช้ while loop เพื่อวนลูปผ่านผลลัพธ์ที่ได้จากการ query เพื่อแสดงข้อมูลของลูกค้าในรูปแบบของตาราง โดยในแต่ละรอบของ loop จะนำข้อมูลของลูกค้าแต่ละรายการมาแสดงในแต่ละแถวของตาราง-->
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