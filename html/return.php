<?php
session_start();
include "config.php";

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$user = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE email='$email'"));
$user_id = $user['id'];

// เมื่อกดคืนหนังสือ
if(isset($_GET['return_id'])){
    $borrow_id = $_GET['return_id'];
    $return_date = date("Y-m-d");

    mysqli_query($conn,"
        UPDATE borrows 
        SET status='returned', return_date='$return_date' 
        WHERE id='$borrow_id'
    ");

    $success = "คืนหนังสือสำเร็จ";
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>คืนหนังสือ</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <h3 class="mb-4">🔄 คืนหนังสือ</h3>

    <?php if(isset($success)) { ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php } ?>

    <table class="table table-bordered shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ชื่อหนังสือ</th>
                <th>วันที่ยืม</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>

        <?php
        $query = mysqli_query($conn,"
            SELECT borrows.id, books.title, borrows.borrow_date
            FROM borrows
            JOIN books ON borrows.book_id = books.id
            WHERE borrows.user_id='$user_id' AND borrows.status='borrowed'
        ");

        while($row = mysqli_fetch_assoc($query)){
            echo "<tr>
                    <td>".$row['title']."</td>
                    <td>".$row['borrow_date']."</td>
                    <td>
                        <a href='return.php?return_id=".$row['id']."' 
                           class='btn btn-danger btn-sm'
                           onclick=\"return confirm('ยืนยันการคืนหนังสือ?')\">
                           คืนหนังสือ
                        </a>
                    </td>
                  </tr>";
        }
        ?>

        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary">
        กลับหน้าหลัก
    </a>

</div>

</body>
</html>

