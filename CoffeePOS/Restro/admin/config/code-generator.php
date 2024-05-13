<?php

//---------Password Reset Token generator-------------------------------------------//
    $length = 30;
    $tk = substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM1234567890"),1,$length);
    
//------------Dummy Password Generator----------------------------------------------//
    $length = 10;
    $rc= substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM1234567890"),1,$length);


    //----------System Generated Numbers------------------------------------------//
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


    $length = 10;
    $mpesaCode = substr(str_shuffle("Q1W2E3R4T5Y6U7I8O9PLKJHGFDSAZXCVBNM"),1,$length);

    //Code PHP นี้สร้างข้อมูลที่สุ่มขึ้นมาเพื่อใช้ในระบบต่าง ๆ
    //การสร้าง Token สำหรับการรีเซ็ตรหัสผ่าน สร้างรหัสสำหรับการรีเซ็ตรหัสผ่านที่มีความยาว 30 ตัวอักษรโดยใช้ตัวอักษรและตัวเลขที่สุ่มมาจากชุดตัวอักษรและตัวเลข โดยเริ่มต้นด้วยตัวอักษรที่สุ่มมาที่ตำแหน่งที่ 1 ในชุดตัวอักษรและตัวเลข
    //การสร้างรหัสผ่านแบบสุ่ม สร้างรหัสผ่านที่มีความยาว 10 ตัวอักษรโดยใช้วิธีเดียวกับการสร้าง Token สำหรับการรีเซ็ตรหัสผ่าน
    //การสร้างตัวเลขแบบสุ่ม สร้างตัวเลขที่มีความยาว 4 ตัวอักษรโดยใช้ตัวอักษรและตัวเลขที่สุ่มมาจากชุดตัวอักษรและตัวเลข
    //การสร้างรหัส checksum และ operation ID สร้างรหัส checksum และ operation ID โดยใช้ฟังก์ชันที่สร้างข้อมูลสุ่มและแปลงเป็นรหัสฮีกซ์
    //การสร้างรหัสสำหรับลูกค้า, สินค้า, และรหัสคำสั่งซื้อ: สร้างรหัสสำหรับลูกค้า, สินค้า, และรหัสคำสั่งซื้อโดยใช้วิธีเดียวกับการสร้างรหัส checksum และ operation ID
    //การสร้างรหัสการชำระเงิน สร้างรหัสการชำระเงินที่มีความยาว 6 ตัวอักษรโดยใช้ฟังก์ชันที่สร้างข้อมูลสุ่มและแปลงเป็นรหัสฮีกซ์
    //ref.ลืมครับผมดูคลิปไปเยอะมากครับหาไม่เจอครับ //เต๋า
    
?>