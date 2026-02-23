<?php
session_start();
include "config.php";

// ถ้ายังไม่ login ให้กลับไปหน้า login
if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE email='$email'"));
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fc;
        }
        .sidebar {
            height: 100vh;
            background: #4e73df;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px;
        }
        .sidebar a:hover {
            background: rgba(255,255,255,0.2);
        }
        .card-box {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- เมนูด้านซ้าย -->
        <div class="col-md-2 sidebar p-3">
            <h4 class="text-center mb-4">📚 Library</h4>
            <a href="dashboard.php">🏠 หน้าหลัก</a>
            <a href="borrow.php">📖 ยืมหนังสือ</a>
            <a href="return.php">🔄 คืนหนังสือ</a>
            <a href="logout.php">🚪 ออกจากระบบ</a>
        </div>

        <!-- เนื้อหา -->
        <div class="col-md-10 p-4">

            <h3>ยินดีต้อนรับ, <?php echo $user['name']; ?> 👋</h3>
            <p class="text-muted">ระบบจัดการยืม-คืนหนังสือ</p>

            <div class="row mt-4">

                <div class="col-md-4">
                    <div class="card card-box p-4 text-center">
                        <h5>📚 หนังสือทั้งหมด</h5>
                        <h2>
                            <?php
                            $books = mysqli_query($conn,"SELECT * FROM books");
                            echo mysqli_num_rows($books);
                            ?>
                        </h2>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-box p-4 text-center">
                        <h5>📖 กำลังถูกยืม</h5>
                        <h2>
                            <?php
                            $borrow = mysqli_query($conn,"SELECT * FROM borrows WHERE status='borrowed'");
                            echo mysqli_num_rows($borrow);
                            ?>
                        </h2>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-box p-4 text-center">
                        <h5>👥 สมาชิกทั้งหมด</h5>
                        <h2>
                            <?php
                            $users = mysqli_query($conn,"SELECT * FROM users");
                            echo mysqli_num_rows($users);
                            ?>
                        </h2>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

</body>
</html>
