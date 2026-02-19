<?php
<meta charset="UTF-8">
session_start();
include "config.php";

$user_id = $_SESSION['user_id'];
$book_id = $_GET['id'];

mysqli_query($conn,"
UPDATE transactions 
SET status='returned', return_date=CURDATE()
WHERE user_id=$user_id AND book_id=$book_id
AND status='borrowed'
");

mysqli_query($conn,"
UPDATE books SET status='available' WHERE id=$book_id
");

header("Location: dashboard.php");
?>
