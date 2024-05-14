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

<!--ตรวจสอบว่าความยาวของตัวแปร $_SESSION['staff_id'] เป็น 0 หรือไม่ 
ซึ่งหมายถึงว่าผู้ใช้ยังไม่ได้เข้าสู่ระบบ (ไม่มีค่า staff_id ใน session) --!

หากความยาวของ $_SESSION['staff_id'] เป็น 0 คือผู้ใช้ยังไม่ได้เข้าสู่ระบบ 
จะทำการเรียกใช้งานฟังก์ชัน header() เพื่อเปลี่ยนเส้นทาง (redirect) 
ไปยังหน้า index.php เพื่อให้ผู้ใช้ทำการเข้าสู่ระบบ

หากค่า staff_id ไม่ใช่ 0 หรือมีค่าความยาวมากกว่า 0 หมายถึงผู้ใช้เข้าสู่ระบบแล้ว 
ไม่ต้องทำการ redirect และฟังก์ชันจะไม่มีการทำงานเพิ่มเติม
