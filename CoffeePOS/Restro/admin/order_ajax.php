<?php
include('config/config.php');
// รับค่าราคาของต่อปริมาณที่ซื้อ
$ret = "SELECT * FROM  LAMCorp_waterTariffs";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
$cnt = 1;
while ($row = $res->fetch_object()) {
    $tariffCost = $row->cost_per_litre;

    if (!empty($_POST["purchasedLitres"])) {
        $litresPurchased = $_POST['purchasedLitres'];
        $payableAmt = $tariffCost * $litresPurchased;
        echo htmlentities($payableAmt);
    }
}
//Codeคำนวณค่าใช้จ่ายที่ต้องจ่ายสำหรับปริมาณน้ำที่ซื้อ โดยดึงราคาต่อหน่วยของน้ำจากDatabaseและคูณกับปริมาณน้ำที่ซื้อเพื่อคำนวณค่าใช้จ่ายที่ต้องจ่าย และแสดงผลลัพธ์ที่ได้ใน HTML
//Codeจะดึงข้อมูลราคาต่อหน่วยของน้ำจากตาราง LAMCorp_waterTariffs ในDatabase โดยใช้คำสั่ง SQL SELECT
//ตรวจสอบว่ามีการส่งค่าจำนวนน้ำที่ซื้อมาหรือไม่ หากมีการส่งมา จะรับค่านั้นและทำการคำนวณค่าใช้จ่ายตามราคาต่อหน่วยของน้ำ
//Codeจะคูณราคาต่อหน่วยของน้ำกับจำนวนน้ำที่ซื้อ (litresPurchased) เพื่อคำนวณค่าใช้จ่ายที่ต้องจ่าย และแสดงผลลัพธ์ที่ได้