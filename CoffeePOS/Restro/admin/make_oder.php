<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
include('config/code-generator.php');

check_login();
if (isset($_POST['make'])) {
  
  if (empty($_POST["order_code"]) || empty($_POST["customer_name"]) || empty($_GET['prod_price'])) {
    $err = "Blank Values Not Accepted";
  } else {
    $order_id = $_POST['order_id'];
    $order_code  = $_POST['order_code'];
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $prod_id  = $_GET['prod_id'];
    $prod_name = $_GET['prod_name'];
    $prod_price = $_GET['prod_price'];
    $prod_qty = $_POST['prod_qty'];

    
    $postQuery = "INSERT INTO rpos_orders (prod_qty, order_id, order_code, customer_id, customer_name, prod_id, prod_name, prod_price) VALUES(?,?,?,?,?,?,?,?)";
    $postStmt = $mysqli->prepare($postQuery);
    
    $rc = $postStmt->bind_param('ssssssss', $prod_qty, $order_id, $order_code, $customer_id, $customer_name, $prod_id, $prod_name, $prod_price);
    $postStmt->execute();
    
    if ($postStmt) {
      $success = "Order Submitted" && header("refresh:1; url=payments.php");
    } else {
      $err = "Please Try Again Or Try Later";
    }
  }
}

//Codeนี้มีหน้าที่ในการสร้างคำสั่ง SQL เพื่อบันทึกข้อมูลการสั่งซื้อลงในDatabase
//Codeจะรับค่าที่Userป้อนผ่านฟอร์มการทำรายการสั่งซื้อ และตรวจสอบว่ามีข้อมูลที่จำเป็นไม่ว่างเปล่าหรือไม่ โดยข้อมูลที่จำเป็นรวมถึง order_code, customer_name, และ prod_price
//หากข้อมูลถูกต้องและไม่ว่างเปล่า Codeจะทำการสร้างคำสั่ง SQL INSERT เพื่อเพิ่มข้อมูลการทำรายการสั่งซื้อลงในDatabase โดยใช้ค่าที่ได้รับจากฟอร์มและค่าที่สร้างโดย code generator
//หลังจากที่ทำการสร้างรายการสั่งซื้อสำเร็จแล้ว จะทำการเปลี่ยนเส้นทางไปยังหน้า payments.php ซึ่งเป็นหน้าที่แสดงรายการการชำระเงิน

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
              <h3>Please Fill All Fields</h3>
            </div>
            <div class="card-body">
              <form method="POST" enctype="multipart/form-data">
                <div class="form-row">

                  <div class="col-md-4">
                    <label>Customer Name</label>
                    <select class="form-control" name="customer_name" id="custName" onChange="getCustomer(this.value)">
                      <option value="">Select Customer Name</option>
                      <?php
                      //Load All Customers
                      $ret = "SELECT * FROM  rpos_customers ";
                      $stmt = $mysqli->prepare($ret);
                      $stmt->execute();
                      $res = $stmt->get_result();
                      while ($cust = $res->fetch_object()) {
                      ?>
                        <option><?php echo $cust->customer_name; ?></option>
                      <?php } ?>
                        <!--มีหน้าที่ในการโหลดข้อมูลลูกค้าทั้งหมดจากฐานข้อมูลและแสดงเป็นตัวเลือกในเมนู dropdown ในฟอร์ม HTML-->
                        <!--Codeจะสร้างคำสั่ง SQL SELECT เพื่อดึงข้อมูลลูกค้าทั้งหมดจากตาราง rpos_customers-->
                        <!--ทำการเตรียมและ execute คำสั่ง SQL ดังกล่าว และรับผลลัพธ์ที่ได้จากการ execute มาเก็บไว้ในตัวแปร $res-->
                        <!--Codeจะวนลูปผ่านผลลัพธ์ที่ได้รับจากการ execute เพื่อแสดงข้อมูลลูกค้าแต่ละรายการในรูปแบบของตัวเลือก (option) ในเมนู dropdown ของฟอร์ม HTML-->
                        <!--แต่ละชื่อลูกค้าจะถูกแสดงในรูปแบบของตัวเลือกในเมนู dropdown ซึ่งสามารถเลือกได้จากฟอร์ม HTML ที่ส่งข้อมูลไปยังเซิร์ฟเวอร์-->
                    </select>
                    <input type="hidden" name="order_id" value="<?php echo $orderid; ?>" class="form-control">
                  </div>

                  <div class="col-md-4">
                    <label>Customer ID</label>
                    <input type="text" name="customer_id" readonly id="customerID" class="form-control">
                  </div>

                  <div class="col-md-4">
                    <label>Order Code</label>
                    <input type="text" name="order_code" value="<?php echo $alpha; ?>-<?php echo $beta; ?>" class="form-control" value="">
                  </div>
                </div>
                <hr>
                <?php
                $prod_id = $_GET['prod_id'];
                $ret = "SELECT * FROM  rpos_products WHERE prod_id = '$prod_id'";
                $stmt = $mysqli->prepare($ret);
                $stmt->execute();
                $res = $stmt->get_result();
                while ($prod = $res->fetch_object()) {
                ?>
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Product Price ($)</label>
                      <input type="text" readonly name="prod_price" value="$ <?php echo $prod->prod_price; ?>" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label>Product Quantity</label>
                      <input type="text" name="prod_qty" class="form-control" value="">
                    </div>
                  </div>
                <?php } ?>
                <br>
                <div class="form-row">
                  <div class="col-md-6">
                    <input type="submit" name="make" value="Make Order" class="btn btn-success" value="">
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
      ?>
    </div>
  </div>
  <!-- Argon Scripts -->
  <?php
  require_once('partials/_scripts.php');
  ?>
</body>

</html>