<?php
$conn = mysqli_connect(
    "localhost",
    "s673190105",
    "s673190105",
    "s673190105"
);

mysqli_set_charset($conn, "utf8");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
