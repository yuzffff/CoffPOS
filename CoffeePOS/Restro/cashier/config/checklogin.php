<?php
function check_login()
{
if(strlen($_SESSION['staff_id'])==0)
	{
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="index.php";
		$_SESSION["staff_id"]="";
		header("Location: http://$host$uri/$extra");
	}
}
?>

<!--1.ตรวจสอบว่าตัวแปรเซสชัน staff_id ว่างหรือไม่:
ตัวแปรเซสชัน staff_id ถูกใช้เพื่อเก็บรหัสพนักงานของผู้ใช้ที่ล็อกอินเข้าสู่ระบบ
ฟังก์ชัน strlen() ใช้เพื่อตรวจสอบความยาวของสตริง
หากความยาวของ $_SESSION['staff_id'] เป็น 0 แสดงว่าผู้ใช้ไม่ได้ล็อกอิน

2.กำหนดค่าตัวแปรสำหรับการเปลี่ยนเส้นทาง:
$_SERVER['HTTP_HOST'] เก็บชื่อโฮสต์ของเซิร์ฟเวอร์
rtrim(dirname($_SERVER['PHP_SELF']), '/\\') เก็บไดเร็กทอรีของสคริปต์ PHP ปัจจุบัน
$extra เก็บชื่อไฟล์ที่จะเปลี่ยนเส้นทางไป

3.ล้างตัวแปรเซสชัน staff_id:
$_SESSION["staff_id"] = ""; ตั้งค่าตัวแปรเซสชัน staff_id ให้ว่าง

4.ปลี่ยนเส้นทางผู้ใช้ไปยังหน้าเข้าสู่ระบบ:
header("Location: http://$host$uri/$extra"); ใช้ฟังก์ชัน header() เพื่อส่งหัวข้อ HTTP ใหม่
หัวข้อ HTTP ใหม่จะเปลี่ยนเส้นทางผู้ใช้ไปยัง http://$host$uri/$extra ซึ่งน่าจะเป็นหน้าเข้าสู่ระบบ
