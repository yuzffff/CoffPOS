<?php
session_start();
unset($_SESSION['admin_id']);
session_destroy();
header("Location: ../../index.php");
exit;
//ใช้สำหรับการทำลาย session และเริ่มต้น session ใหม่โดยการลบตัวแปร session และทำลาย session ทั้งหมดที่ถูกสร้างขึ้น 
//และเปลี่ยนเส้นทางไปยังหน้า index.php ซึ่งเป็นหน้าหลักของเว็บไซต์