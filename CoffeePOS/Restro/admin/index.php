<?php
session_start();
include('config/config.php');
//login 
if (isset($_POST['login'])) {
  $admin_email = $_POST['admin_email'];
  $admin_password = sha1(md5($_POST['admin_password'])); // เข้ารหัสสองครั้งเพื่อเพิ่มความปลอดภัย
  $stmt = $mysqli->prepare("SELECT admin_email, admin_password, admin_id  FROM   rpos_admin WHERE (admin_email =? AND admin_password =?)"); //sql to log in user
  $stmt->bind_param('ss',  $admin_email, $admin_password); //bind fetched parameters
  $stmt->execute(); //execute bind 
  $stmt->bind_result($admin_email, $admin_password, $admin_id); //bind result
  $rs = $stmt->fetch();
  $_SESSION['admin_id'] = $admin_id;
  if ($rs) {
    //if its sucessfull
	
    header("location:dashboard.php");
  } else {
    $err = "Incorrect Authentication Credentials ";
  }
}

//สำหรับการตรวจสอบการเข้าสู่ระบบของadmin โดยมีการตรวจสอบอีเมลและรหัสผ่านว่าถูกต้องหรือไม่ และเปลี่ยนเส้นทางไปยังหน้า dashboard.php 
//หากการเข้าสู่ระบบประสบความสำเร็จ หรือแสดงข้อความผิดพลาดหากไม่สามารถเข้าสู่ระบบได้
//Codeจะรับค่าที่Userป้อนผ่านฟอร์มการเข้าสู่ระบบ ซึ่งประกอบด้วยอีเมลของadminและรหัสผ่านของadmin โดยรหัสผ่านจะถูกเข้ารหัสด้วยวิธีการที่ปลอดภัย 
//ซึ่งใช้วิธีการเข้ารหัสแบบ sha1(md5()) เพื่อเพิ่มความปลอดภัย
//Code ใช้คำสั่ง SQL SELECT เพื่อสอบถามฐานข้อมูลเพื่อตรวจสอบว่ามีอีเมลและรหัสผ่านที่ถูกต้องหรือไม่ โดยใช้เงื่อนไข WHERE ในการเลือกข้อมูลที่ตรงกับค่าที่Userป้อนเข้ามา
//หลังจากที่ทำการตรวจสอบDatabaseเสร็จสิ้น Codeจะตรวจสอบผลลัพธ์ที่ได้รับว่าเป็นผลลัพธ์ที่ถูกต้องหรือไม่ ถ้าผู้ใช้ป้อนข้อมูลที่ถูกต้องจะทำการเปลี่ยนเส้นทาง (redirect) ไปยังหน้า dashboard.php ซึ่งเป็นหน้าหลักของระบบหลังบ้าน
//หากข้อมูลที่Userป้อนไม่ถูกต้อง ระบบจะแสดงข้อความผิดพลาดว่า "Incorrect Authentication Credentials"
require_once('partials/_head.php');
?>

<body  class="bg-dark">
  <div class="main-content">
    <div class="header bg-gradient-primar py-7">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">Coffee Point Of Sale System</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <form method="post" role="form">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" required name="admin_email" placeholder="Email" type="email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" required name="admin_password" placeholder="Password" type="password">
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Remember Me</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" name="login" class="btn btn-primary my-4">Log In</button>
                </div>
              </form>

            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <!-- <a href="forgot_pwd.php" class="text-light"><small>Forgot password?</small></a> -->
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
  <!-- Argon Scripts -->
  <?php
  require_once('partials/_scripts.php');
  ?>
</body>

</html>