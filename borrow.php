<?php
session_start();
include "config.php";

$user_id = $_SESSION['user_id'];
$book_id = $_GET['id'];

mysqli_query($conn,"
INSERT INTO transactions(user_id,book_id,borrow_date)
VALUES($user_id,$book_id,CURDATE())
");

mysqli_query($conn,"
UPDATE books SET status='borrowed' WHERE id=$book_id
");

header("Location: dashboard.php");
?>
