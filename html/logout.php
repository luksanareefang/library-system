<?php
session_start();        // เริ่ม session
session_unset();        // ลบค่าทั้งหมดใน session
session_destroy();      // ทำลาย session

header("Location: login.php"); // กลับไปหน้า login
exit();
?>
