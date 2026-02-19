<?php
session_start();
include "config.php";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users 
            WHERE email='$email' 
            AND password='$password'";

    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    if($row){
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        header("Location: dashboard.php");
    }else{
        echo "Login Failed";
    }
}
?>

<form method="POST">
<input name="email" placeholder="Email"><br>
<input name="password" type="password"><br>
<button name="login">Login</button>
</form>
