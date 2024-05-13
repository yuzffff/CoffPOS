<?php
function check_login()
{
if(strlen($_SESSION['admin_id'])==0)
	{
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="index.php";
		$_SESSION["admin_id"]="";
		header("Location: http://$host$uri/$extra");
	}
}
 //ตรวจสอบว่ามีuserเข้าสู่ระบบหรือไม่ โดยจะตรวจสอบที่ตัวแปร $_SESSION['admin_id'] มีความยาวเท่ากับ 0 หรือไม่ ถ้ามีความยาวเท่ากับ 0 
 //แสดงว่าuserยังไม่ได้เข้าสู่ระบบ ในกรณีนี้ฟังก์ชันจะทำการ redirect ผู้ใช้ไปยังหน้า index.php เพื่อให้ผู้ใช้เข้าสู่ระบบก่อนที่จะเข้าถึงหน้าอื่น ๆ ในระบบได้
 //หากผู้ใช้ยังไม่ได้เข้าสู่ระบบ จะทำการกำหนดค่า $_SESSION["admin_id"] เป็นข้อความว่าง
 //สร้างตัวแปร $host ซึ่งจะเก็บชื่อโฮสต์ที่เรียกใช้งาน, $uri ซึ่งจะเก็บ URI ปัจจุบันของเว็บไซต์, และ $extra ซึ่งจะกำหนดให้ไปยังหน้า index.php
 //ใช้ฟังก์ชัน header() เพื่อ redirect ผู้ใช้ไปยังหน้า index.php ที่ต้องการให้ผู้ใช้เข้าสู่ระบบ
?>


