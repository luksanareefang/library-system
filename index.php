<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ระบบยืมคืนหนังสือ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            height: 100vh;
        }
        .card-box {
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }
        .btn-custom {
            width: 180px;
            border-radius: 30px;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">

    <div class="card card-box p-5 text-center bg-white">
        <h1 class="mb-3">📚 ระบบยืมคืนหนังสือ</h1>
        <p class="text-muted mb-4">Library Management System</p>

        <div class="d-flex justify-content-center gap-3">
            <a href="login.php" class="btn btn-primary btn-lg btn-custom">
                🔐 เข้าสู่ระบบ
            </a>
            <a href="register.php" class="btn btn-success btn-lg btn-custom">
                📝 สมัครสมาชิก
            </a>
        </div>

        <hr class="my-4">

        <small class="text-muted">
            พัฒนาโดย 673190105 | วิทยาลัยอาชีวศึกษา
        </small>
    </div>

</body>
</html>
