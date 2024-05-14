<?php
    $DB_host = "localhost";
    $DB_user = "root";
    $DB_pass = "root";
    $DB_name = "cposystem";
    try
    {
        $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
        $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
         $e->getMessage();
    }
?>

<!-- line6 ใช้คำสั่ง try-catch เพื่อจัดการกับข้อผิดพลาดที่อาจเกิดขึ้นในระหว่างการเชื่อมต่อกับฐานข้อมูล 
โดยในบล็อก try จะทำการเรียกใช้งานคำสั่ง new PDO() เพื่อสร้างอ็อบเจกต์ PDO 
และทำการเชื่อมต่อกับฐานข้อมูล MySQL ด้วยการระบุพารามิเตอร์เช่น ชื่อโฮสต์, ชื่อฐานข้อมูล, ชื่อผู้ใช้และรหัสผ่าน 

line9 หากเกิดข้อผิดพลาดระหว่างการเชื่อมต่อ (PDOException) จะถูกจับไว้ในบล็อก catch และเรียกใช้เมทอด 
getMessage() เพื่อแสดงข้อความของข้อผิดพลาดนั้นออกมา ซึ่งในที่นี้ข้อความของข้อผิดพลาดจะไม่ถูกใช้งานใด ๆ หรือแสดงในที่นี้ 
อาจต้องเป็นการแสดงหรือบันทึกข้อความผิดพลาดเพื่อการตรวจสอบหรือดำเนินการต่อในระบบแอปพลิเคชันต่อไป