<?php
include "config.php";
session_start();

if(isset($_POST['login'])){
    // ป้องกัน SQL Injection เบื้องต้น
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // 1. ค้นหาอีเมลในระบบก่อน (ยังไม่เช็ครหัสผ่านตรงนี้)
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    // ถ้าเจออีเมลนี้ในระบบ
    if(mysqli_num_rows($result) == 1){
        $user = mysqli_fetch_assoc($result); // ดึงข้อมูล user คนนั้นมา
        
        // 2. นำรหัสผ่านที่พิมพ์มา เทียบกับรหัสผ่านที่เข้ารหัสไว้ในฐานข้อมูล
        // หมายเหตุ: บรรทัดนี้จะใช้ได้กับรหัสที่ถูกเข้ารหัสด้วย password_hash() (บรรทัดที่ 5)
        if(password_verify($password, $user['password'])) {
            $_SESSION['email'] = $email;
            header("Location: dashboard.php");
            exit();
        } else {
            // ถ้ารหัสที่เป็นตัวเลขตรงๆ (เช่น แอดมิน) อนุโลมให้เข้าได้ไปก่อน (เพื่อให้เทสระบบได้)
            // แนะนำว่าในระบบจริง ควรเข้ารหัสผ่านให้หมดทุก User ครับ
            if ($password == $user['password']) {
                $_SESSION['email'] = $email;
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "อีเมลหรือรหัสผ่านไม่ถูกต้อง";
            }
        }
    } else {
        $error = "ไม่พบอีเมลนี้ในระบบ";
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
        .guide-box {
            background-color: #f8f9fc;
            border-radius: 15px;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">

<div class="card login-card p-5 bg-white" style="width: 450px;">
    <h3 class="text-center mb-4">🔐 เข้าสู่ระบบ</h3>ssss

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

    <!-- วิธีเข้าใช้งาน -->
    <div class="guide-box p-3 mt-3">
        <h6>📌 วิธีเข้าใช้งานระบบ</h6>
        <ul class="small">
            <li>หากยังไม่มีบัญชี ให้กด "สมัครสมาชิก"</li>
            <li>กรอกอีเมลและรหัสผ่านให้ถูกต้อง</li>
            <li>เมื่อเข้าสู่ระบบแล้ว สามารถยืมและคืนหนังสือได้</li>
            <li>กด "ออกจากระบบ" ทุกครั้งเมื่อใช้งานเสร็จ</li>
        </ul>
    </div>

    <div class="text-center mt-3">
        <a href="register.php">สมัครสมาชิก</a> |
        <a href="index.php">หน้าหลัก</a>
    </div>
</div>

</body>
</html>
