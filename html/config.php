<?php
$conn = mysqli_connect(
    "db",              // ชื่อ Host (ใน Docker ต้องใช้ชื่อ service คือ 'db')
    "root",            // ชื่อ Username (ใน Docker คือ 'root')
    "root",            // รหัสผ่าน Password (ใน Docker คือ 'root')
    "s673190105"       // ชื่อ Database ที่เราตั้งไว้ใน docker-compose.yml
);

mysqli_set_charset($conn, "utf8");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>