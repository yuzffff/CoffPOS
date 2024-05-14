<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
include('config/code-generator.php');
//เริ่มต้นด้วยการเรียกใช้ session_start() เพื่อเริ่มเซสชัน และ include ไฟล์ config.php, checklogin.php, และ code-generator.php 
//เพื่อเรียกใช้งานการเชื่อมต่อฐานข้อมูล MySQL, การตรวจสอบสถานะการเข้าสู่ระบบของผู้ใช้, และรหัสสร้างรหัสอัตโนมัติตามลำดับ 

check_login();
//Udpate Staff
if (isset($_POST['UpdateStaff'])) {
  //ป้องกันการโพสต์ค่าที่ว่างเปล่า
  if (empty($_POST["staff_number"]) || empty($_POST["staff_name"]) || empty($_POST['staff_email']) || empty($_POST['staff_password'])) {
    $err = "Blank Values Not Accepted";
  } else {
    $staff_number = $_POST['staff_number'];
    $staff_name = $_POST['staff_name'];
    $staff_email = $_POST['staff_email'];
    $staff_password = $_POST['staff_password'];
    $update = $_GET['update'];

    //แทรกข้อมูลที่บันทึกลงในตาราง database
    $postQuery = "UPDATE rpos_staff SET  staff_number =?, staff_name =?, staff_email =?, staff_password =? WHERE staff_id =?";
    $postStmt = $mysqli->prepare($postQuery);
    //bind paramaters
    $rc = $postStmt->bind_param('ssssi', $staff_number, $staff_name, $staff_email, $staff_password, $update);
    $postStmt->execute();
    //ประกาศตัวแปรที่จะส่งไปฟังก์ชั่นการแจ้งเตือน
    if ($postStmt) {
      $success = "Staff Updated" && header("refresh:1; url=hrm.php");
    } else {
      $err = "Please Try Again Or Try Later";
    }
  }
}
require_once('partials/_head.php');
?>

  <!--เตรวจสอบว่าผู้ใช้ได้ทำการส่งข้อมูลแบบ POST ที่มีชื่อ "UpdateStaff" หรือไม่ หากมี ให้ดำเนินการต่อไป -->
  <!--ตรวจสอบว่าข้อมูลที่ส่งมาไม่มีค่าว่าง ซึ่งรวมถึง staff_number, staff_name, staff_email, 
  และ staff_password ถ้ามีข้อมูลว่าง จะกำหนดข้อความข้อผิดพลาดในตัวแปร $err ว่า "Blank Values Not Accepted"
  <!- หากข้อมูลไม่ว่าง จะดึงข้อมูลจาก $_POST และ $_GET เกี่ยวกับ staff_number, staff_name, staff_email, staff_password, และ update 
  โดยใช้งาน bind_param() เพื่อป้องกันการทำ SQL Injection และ execute() เพื่อประมวลผลคำสั่ง SQL UPDATE เพื่ออัปเดตข้อมูลของพนักงานในฐานข้อมูล
   ตรวจสอบว่าคำสั่ง SQL UPDATE ประสบความสำเร็จหรือไม่ หากสำเร็จ จะกำหนดข้อความ "Staff Updated" ในตัวแปร $success และใช้ฟังก์ชัน header() 
   Line29 เพื่อเปลี่ยนเส้นทางไปยังหน้า hrm.php ภายในเวลา 1 วินาที หากไม่สำเร็จ จะกำหนดข้อความ "Please Try Again Or Try Later" ในตัวแปร $err
<body>
  

<!- Sidenav -->
  <?php
  require_once('partials/_sidebar.php');
  ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <?php
    require_once('partials/_topnav.php');
    $update = $_GET['update'];
    $ret = "SELECT * FROM  rpos_staff WHERE staff_id = '$update' ";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($staff = $res->fetch_object()) {
    ?>
<!-- สร้างคำสั่ง SQL SELECT เพื่อดึงข้อมูลของพนักงานจากตาราง rpos_staff โดยกำหนดเงื่อนไขว่า staff_id ต้องเท่ากับค่าที่ได้รับมาจากพารามิเตอร์ 'update'
prepare() เพื่อเตรียมคำสั่ง SQL สำหรับการประมวลผล,execute() เพื่อประมวลผลคำสั่ง SQL
get_result() เพื่อดึงผลลัพธ์จากการสั่งคำสั่ง SQL และเก็บไว้ในตัวแปร $res เป็นออบเจกต์ที่เป็นผลลัพธ์ของการสั่งคำสั่ง SQL
while เพื่อวนลูปผลลัพธ์ที่ได้รับจากการดึงข้อมูล โดยใช้เมท็อด fetch_object() เพื่อดึงข้อมูลเป็นออบเจกต์ ซึ่งในที่นี้คือข้อมูลของพนักงาน
-->
      
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
                <h3>Please Fill All Fields</h3>
              </div>
              <div class="card-body">
                <form method="POST">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Staff Number</label>
                      <input type="text" name="staff_number" class="form-control" value="<?php echo $staff->staff_number; ?>">
                    </div>
                    <div class="col-md-6">
                      <label>Staff Name</label>
                      <input type="text" name="staff_name" class="form-control" value="<?php echo $staff->staff_name; ?>">
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Staff Email</label>
                      <input type="email" name="staff_email" class="form-control" value="<?php echo $staff->staff_email; ?>">
                    </div>
                    <div class="col-md-6">
                      <label>Staff Password</label>
                      <input type="password" name="staff_password" class="form-control" value="">
                    </div>
                  </div>
                  <br>
                  <div class="form-row">
                    <div class="col-md-6">
                      <input type="submit" name="UpdateStaff" value="Update Staff" class="btn btn-success" value="">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Footer -->
      <?php
      require_once('partials/_footer.php');
    }
      ?>
      </div>
  </div>
  <!-- Argon Scripts -->
  <?php
  require_once('partials/_scripts.php');
  ?>
</body>

</html>