<?php
//1. Customers
$query = "SELECT COUNT(*) FROM `rpos_customers` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($customers);
$stmt->fetch();
$stmt->close();

//2. Orders
$query = "SELECT COUNT(*) FROM `rpos_orders` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($orders);
$stmt->fetch();
$stmt->close();

//3. Orders
$query = "SELECT COUNT(*) FROM `rpos_products` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($products);
$stmt->fetch();
$stmt->close();

//4.Sales
$query = "SELECT SUM(pay_amt) FROM `rpos_payments` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($sales);
$stmt->fetch();
$stmt->close();

//ใช้การสร้างและ execute query เพื่อดึงข้อมูลจากตารางในฐานข้อมูล และเก็บผลลัพธ์ที่ได้ลงในตัวแปรผลลัพธ์ โดยใช้คำสั่ง prepare, execute, bind_result, และ fetch ในแต่ละส่วนของCode
//Code query คำสั่ง SQL เพื่อนับจำนวนแถวในตาราง rpos_customers และเก็บผลลัพธ์ลงในตัวแปร $customers.
//คำสั่ง prepare ใช้เตรียม query สำหรับการ execute.
//คำสั่ง execute ใช้สั่ง execute query.
//คำสั่ง bind_result ใช้เพื่อกำหนดตัวแปรที่จะใช้เก็บผลลัพธ์ที่ได้จาก query.
//คำสั่ง fetch ใช้เก็บผลลัพธ์ที่ได้จากการ execute query เข้าไปยังตัวแปรที่ถูก bind
//ส่วนดึงข้อมูลของSales เป็นการดึงผลรวมของคอลัมน์ pay_amt ในตาราง rpos_payments โดยใช้ขั้นตอนเดียวกับส่วนที่ 1 แต่เก็บผลลัพธ์ลงในตัวแปร $sales
//หลังจาก execute query และ bind_result เสร็จสิ้น จะได้ผลลัพธ์ของ query ที่ดึงมาจากDatabaseแล้วลงในตัวแปรที่กำหนดไว้ใน bind_result โดยสามารถเข้าถึงผลลัพธ์นี้ได้ผ่านตัวแปรพวกนี้ต่อไปในงาน