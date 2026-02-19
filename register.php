<?php
include "config.php";

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    mysqli_query($conn,"INSERT INTO users(name,email,password) 
    VALUES('$name','$email','$password')");

    echo "<script>alert('สมัครสำเร็จ');</script>";
}
?>

<form method="POST">
<input name="name" placeholder="ชื่อ"><br>
<input name="email" placeholder="Email"><br>
<input name="password" type="password" placeholder="Password"><br>
<button name="register">สมัครสมาชิก</button>
</form>
