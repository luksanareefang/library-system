<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "config.php";
session_start();

if(isset($_POST['register'])){

    // แนะนำให้ใช้ trim() เพื่อตัดช่องว่างหน้า-หลังที่ผู้ใช้อาจเผลอพิมพ์มา
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 1. ตรวจสอบอีเมลซ้ำ (ใช้ Prepared Statement ป้องกัน SQL Injection)
    $check_stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email=?");
    mysqli_stmt_bind_param($check_stmt, "s", $email);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if(mysqli_stmt_num_rows($check_stmt) > 0){
        $error = "อีเมลนี้ถูกใช้งานแล้ว";
    } else {
        // 2. เข้ารหัสผ่านก่อนลงฐานข้อมูล (สำคัญมาก!)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // 3. บันทึกข้อมูล (ใช้ Prepared Statement)
        $insert_stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 0)");
        mysqli_stmt_bind_param($insert_stmt, "sss", $name, $email, $hashed_password);

        if(mysqli_stmt_execute($insert_stmt)){
            $success = "สมัครสมาชิกสำเร็จ สามารถเข้าสู่ระบบได้";
        } else {
            $error = "เกิดข้อผิดพลาดในการบันทึกข้อมูล";
        }
        mysqli_stmt_close($insert_stmt);
    }
    mysqli_stmt_close($check_stmt);
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

