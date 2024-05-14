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
    //ใช้ PDO (PHP Data Objects) เป็นวิธีที่ปลอดภัยและมีประสิทธิภาพในการเชื่อมต่อกับDatabase MySQL ในส่วน try เเละ catch, 
    //ซึ่งจะพยายามเชื่อมต่อกับDatabase โดยใช้ข้อมูลการเข้าถึงที่มีการกำหนดขึ้น ถ้ามีข้อผิดพลาดเกิดขึ้นในการเชื่อมต่อ PDO 
    //จะส่งERRORมาในรูปแบบของ PDOException Ref.Patiphan Phengpao
?>