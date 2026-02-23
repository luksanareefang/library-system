<?php
include "config.php";
session_start();

if(isset($_POST['login'])){
    $email = trim($_POST['email']);
    $password = $_POST['password']; 

    // 1. ค้นหาผู้ใช้จาก "อีเมล" อย่างเดียว (ไม่ต้องหา password ใน SQL)
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email=?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    
    // ดึงผลลัพธ์ออกมาเช็ค
    $result = mysqli_stmt_get_result($stmt);

    // 2. เช็คว่าเจออีเมลนี้ในระบบไหม
    if($row = mysqli_fetch_assoc($result)){
        
        // 3. สำคัญ! เอารหัสผ่านที่ผู้ใช้พิมพ์ มาเทียบกับรหัสที่เข้ารหัสไว้ในฐานข้อมูล ($row['password'])
        if(password_verify($password, $row['password'])){
            
            // ถ้ารหัสตรงกัน ให้เก็บค่าลง Session และเข้าสู่ระบบ
            $_SESSION['email'] = $row['email'];
            header("Location: dashboard.php");
            exit(); 
            
        } else {
            $error = "รหัสผ่านไม่ถูกต้อง";
        }
    } else {
        $error = "ไม่พบอีเมลนี้ในระบบ";
    }
    
    mysqli_stmt_close($stmt);
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

