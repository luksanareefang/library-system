<?php
include "config.php";
session_start();

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 1){
        $_SESSION['email'] = $email;
        header("Location: dashboard.php");
    }else{
        $error = "อีเมลหรือรหัสผ่านไม่ถูกต้อง";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เข้าสู่ระบบ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            height: 100vh;
        }
        .login-card {
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">

<div class="card login-card p-5 bg-white" style="width: 400px;">
    <h3 class="text-center mb-4">🔐 เข้าสู่ระบบ</h3>

    <?php if(isset($error)) { ?>
        <div class="alert alert-danger text-center">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">อีเมล</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">รหัสผ่าน</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" name="login" class="btn btn-primary w-100">
            เข้าสู่ระบบ
        </button>
    </form>

    <hr>

    <div class="text-center">
        <a href="register.php">สมัครสมาชิก</a> |
        <a href="index.php">หน้าหลัก</a>
    </div>
</div>

</body>
</html>

