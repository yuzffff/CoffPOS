<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
//Delete Staff
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $adn = "DELETE FROM  rpos_staff  WHERE  staff_id = ?";
  $stmt = $mysqli->prepare($adn);
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $stmt->close();
  if ($stmt) {
    $success = "Deleted" && header("refresh:1; url=hrm.php");
  } else {
    $err = "Try Again Later";
  }
}

//Codeใช้ลบข้อมูลพนักงานออกจากDatabase เมื่อมีคำขอลบข้อมูลจากuser โดยมีการป้องกันการโจมตีแบบ SQL injection 
//และแสดงผลลัพธ์ให้userทราบผ่านทางหน้าเว็บไซต์ โดยมีการรีเฟรชหน้าใหม่ทุกๆ 1 วินาที
//โดยCode ตรวจสอบว่ามีการส่งค่า parameter "delete" ผ่าน URL หรือไม่ ถ้ามีก็จะดึงค่านั้นมาและแปลงเป็นตัวเลขจำนวนเต็ม (int) เพื่อป้องกันการโจมตีแบบ SQL injection
//Code จะสร้างคำสั่ง SQL DELETE ลบข้อมูลพนักงานที่มี staff_id เท่ากับค่าที่ได้รับมาจาก URL parameter โดยใช้คำสั่ง prepared เพื่อบล็อคการโจมตีแบบ SQL injection จากนั้นทำการ execute คำสั่ง SQL เพื่อทำการลบข้อมูลพนักงาน
//จากนั้นเมื่อลบข้อมูลเสร็จสมบูรณ์ Codeจะเเจ้ง "Deleted" และทำการ redirect ผู้ใช้ไปยังหน้าเพจ "hrm.php" โดยใช้ header("refresh:1; url=hrm.php") เพื่อให้userเห็นข้อความและไปยังหน้าเพจที่ต้องการ ซึ่งในที่นี้จะมีการรีเฟรชหน้าใหม่ทุกๆ 1 วินาที

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
              <a href="add_staff.php" class="btn btn-outline-success"><i class="fas fa-user-plus"></i>Add New Staff</a>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Staff Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ret = "SELECT * FROM  rpos_staff ";
                  $stmt = $mysqli->prepare($ret);
                  $stmt->execute();
                  $res = $stmt->get_result();
                  while ($staff = $res->fetch_object()) {
                  ?>
                    <tr>
                      <td><?php echo $staff->staff_number; ?></td>
                      <td><?php echo $staff->staff_name; ?></td>
                      <td><?php echo $staff->staff_email; ?></td>
                      <td>
                        <a href="hrm.php?delete=<?php echo $staff->staff_id; ?>">
                          <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                            Delete
                          </button>
                        </a>

                        <a href="update_staff.php?update=<?php echo $staff->staff_id; ?>">
                          <button class="btn btn-sm btn-primary">
                            <i class="fas fa-user-edit"></i>
                            Update
                          </button>
                        </a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody> <!--Code จะสร้างคำสั่ง SQL SELECT เพื่อดึงข้อมูลพนักงานทั้งหมดจากตาราง rpos_staff โดยไม่มีเงื่อนไขเพิ่มเติมใดๆ-->
                         <!--Code จะใช้ while loop เพื่อวนลูปผ่านผลลัพธ์ที่ได้จากการ query เพื่อแสดงข้อมูลของพนักงานที่ได้รับมา โดยแต่ละแถวจะแสดงข้อมูลของพนักงานแต่ละคนในรูปแบบของตาราง HTML โดยแต่ละคอลัมน์จะแสดงข้อมูลต่างๆ เช่น หมายเลขพนักงาน (staff_number), ชื่อพนักงาน (staff_name), อีเมลของพนักงาน (staff_email) และลิงก์สำหรับลบหรือแก้ไขข้อมูลพนักงาน-->
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