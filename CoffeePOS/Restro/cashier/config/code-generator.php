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
?>

<!-- 1. สร้างรหัสยืนยันการรีเซ็ทรหัสผ่าน (Password Reset Token)
กำหนดความยาวของ token ($length) เป็น 30 ตัวอักษร
สร้างชุดอักขระสุ่ม ($tk) จากตัวพิมพ์ใหญ่ A-Z, ตัวเลข 0-9 โดยใช้ฟังก์ชัน str_shuffle สุ่มตำแหน่งของตัวอักขระเดิม
ตัดเอาเฉพาะส่วนที่ต้องการ ($length) ตัวอักษร ด้วยฟังก์ชัน substr

2.สร้างรหัสผ่านชั่วคราว (Dummy Password)
กำหนดความยาวของ password ($length) เป็น 10 ตัวอักษร
สร้างคล้ายกับส่วนที่ 1 โดยใช้ตัวอักษรพิมพ์ใหญ่ A-Z และตัวเลข 0-9

3. สร้างรหัสระบบ (System Generated Numbers)
สร้างรหัสตัวอักษร ($alpha) 4 ตัว จากตัวพิมพ์ใหญ่ A-Z ด้วยวิธีเดียวกับด้านบน
สร้างรหัสตัวเลข ($beta) 4 ตัว จากเลข 0-9 ด้วยวิธีเดียวกับด้านบน
สร้างค่า checksum ($checksum) ยาว 24 หลักฐานสิบหก (hex)
ฟังก์ชัน random_bytes สร้างไบต์ข้อมูลสุ่ม 12 ไบต์
ฟังก์ชัน bin2hex แปลงไบต์ข้อมูลเป็นเลขฐานสิบหก
สร้างรหัสต่างๆ ($operation_id, $cus_id, $prod_id, $orderid, $payid) ยาว 8, 12, 10, 10, 6 หลักฐานสิบหกตามลำดับ ด้วยวิธีเดียวกับ checksum
สร้างรหัส MpesaCode ($mpesaCode) ยาว 10 ตัวอักษร จากชุดอักขระผสม A-Z, ตัวเลข 0-9 และสัญลักษณ์พิเศษบางตัว