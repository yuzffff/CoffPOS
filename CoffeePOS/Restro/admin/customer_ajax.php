<?php
include('config/pdoconfig.php');

if (!empty($_POST["custName"])) {
    $id = $_POST['custName'];
    $stmt = $DB_con->prepare("SELECT * FROM  rpos_customers WHERE customer_name = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['customer_id']); ?>
<?php
    }

    // Code PHP ด้านบนมีหน้าที่ดึงข้อมูลลูกค้าจากDatabaseโดยใช้ชื่อลูกค้าที่รับมาจากฟอร์ม (custName) และแสดงรหัสลูกค้าที่สอดคล้องกับชื่อลูกค้าออกมา
    //เริ่มด้วยการเรียกใช้งานไฟล์ pdoconfig.php ซึ่งเป็นไฟล์ที่กำหนดค่าเชื่อมต่อฐานข้อมูล PDO
    //Code จะตรวจสอบว่ามีการส่งค่า custName มาหรือไม่ หากมีจะนำค่านั้นมาใช้ในการดึงข้อมูลลูกค้าจากDatabase โดยใช้ชื่อลูกค้าเป็นเงื่อนไขใน SQL query
    //จากนั้นCodeจะทำการวน loop ผ่านผลลัพธ์ที่ได้จากการ query เพื่อแสดงรหัสลูกค้าที่สอดคล้องกับชื่อลูกค้าที่ได้รับมา โดยใช้ฟังก์ชัน htmlentities() เพื่อป้องกันการERRORของ HTML และแสดงข้อมูลออกทางหน้าจอ
}
