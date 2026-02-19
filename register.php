<?php
include "config.php";
session_start();

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ตรวจสอบอีเมลซ้ำ
    $check = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn,$check);

    if(mysqli_num_rows($result) > 0){
        $error = "อีเมลนี้ถูกใช้งานแล้ว";
    } else {

        $sql = "INSERT INTO users (name,email,password,role)
                VALUES ('$name','$email','$password','user')";

        if(mysqli_query($conn,$sql)){
            $success = "สมัครสมาชิกสำเร็จ สามารถเข้าสู่ระบบได้";
        } else {
            $error = "เกิดข้อผิดพลาด";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สมัครสมาชิก</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #36b9cc, #1cc88a);
            height: 100vh;
        }
        .register-card {
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">

<div class="card register-card p-5 bg-white" style="width: 420px;">
    <h3 class="text-center mb-4">📝 สมัครสมาชิก</h3>

    <?php if(isset($error)) { ?>
        <div class="alert alert-danger text-center">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <?php if(isset($success)) { ?>
        <div class="alert alert-success text-center">
            <?php echo $success; ?>
        </div>
    <?php } ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">ชื่อ-นามสกุล</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">อีเมล</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">รหัสผ่าน</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" name="register" class="btn btn-success w-100">
            สมัครสมาชิก
        </button>
    </form>

    <hr>

    <div class="text-center">
        <a href="login.php">เข้าสู่ระบบ</a> |
        <a href="index.php">หน้าหลัก</a>
    </div>
</div>

</body>
</html>

