<?php

//---------Password Reset Token generator-------------------------------------------//
    $length = 30;
    $tk = substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM1234567890"),1,$length);
//--Password Reset Token generator: สร้าง token สำหรับการรีเซ็ตรหัสผ่าน โดยสุ่มตัวอักษรและตัวเลขจากชุดตัวอักษรและตัวเลขที่กำหนดไว้ 
//และนำมาเรียงต่อกันเพื่อสร้าง token ที่มีความยาว 30 ตัวอักษร 
    
//------------Dummy Password Generator----------------------------------------------//
    $length = 10;
    $rc= substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM1234567890"),1,$length);
//สร้างรหัสผ่านสำหรับการใช้งานแบบชั่วคราวหรือเป็นรหัสทดสอบ โดยสุ่มตัวอักษรและตัวเลขจากชุดตัวอักษรและตัวเลขที่กำหนดไว้
//และนำมาเรียงต่อกันเพื่อสร้างรหัสที่มีความยาว 10 ตัวอักษร


    //----------System Generated Numbers------------------------------------------//
    //สร้างตัวเลขที่สร้างโดยระบบสำหรับการใช้งานในระบบ โดยสุ่มตัวอักษรและตัวเลขจากชุดตัวอักษรและตัวเลขที่กำหนดไว้ 
    //และนำมาเรียงต่อกันเพื่อสร้างตัวเลขที่มีความยาว 4 หรือ 4 ตัวอักษร


    $length = 4;
    $alpha= substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM"),1,$length);
    $ln = 4;
    $beta = substr(str_shuffle("1234567890"),1,$length);

    $checksum= bin2hex(random_bytes('12'));
    $operation_id = bin2hex(random_bytes('4'));
    $cus_id = bin2hex(random_bytes('6'));
    $prod_id  = bin2hex(random_bytes('5'));
    $orderid = bin2hex(random_bytes('5'));
    $payid = bin2hex(random_bytes('3'));

    //Random Bytes Generation: สร้างค่าที่สุ่มมาจาก bytes ที่สร้างโดยการเรียกใช้ฟังก์ชัน random_bytes() 
    //ด้วยขนาดของ bytes ที่กำหนดไว้ และแปลงให้อยู่ในรูปแบบ hex (ฐาน 16) เพื่อใช้เป็นรหัสหรือตัวอ้างอิงในระบบ


    $length = 10;
    $mpesaCode = substr(str_shuffle("Q1W2E3R4T5Y6U7I8O9PLKJHGFDSAZXCVBNM"),1,$length);
//Mpesa Code Generation สร้างรหัสสำหรับการทำรายการแบบเงินอิเล็กทรอนิกส์ (e-money) 
//จากชุดตัวอักษรและตัวเลขที่กำหนดไว้ และนำมาเรียงต่อกันเพื่อสร้างรหัสที่มีความยาว 10 ตัวอักษร
?>

<!-- เป็นตัวสร้างรหัสอัตโนมัติและตัวเลขที่สร้างโดยระบบที่ใช้ในการสร้างโค้ดอ้างอิงหรือรหัสสำหรับใช้ในการตรวจสอบหรือกระทำต่าง ๆ 

-->
