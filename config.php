<?php
$conn = mysqli_connect(
    "sql312.infinityfree.com",
    "if0_12345678",
    "yourpassword",
    "if0_12345678_library_db"
);

mysqli_set_charset($conn, "utf8");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
