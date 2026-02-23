<?php
session_start();
include "config.php";

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$user = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE email='$email'"));

// เมื่อกดยืมหนังสือ
if(isset($_POST['borrow'])){
    $book_id = $_POST['book_id'];
    $user_id = $user['id'];
    $date = date("Y-m-d");

    mysqli_query($conn,"INSERT INTO borrows (user_id, book_id, borrow_date, status)
                        VALUES ('$user_id','$book_id','$date','borrowed')");

    $success = "ยืมหนังสือสำเร็จ";
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>ยืมหนังสือ</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <h3 class="mb-4">📖 ยืมหนังสือ</h3>

    <?php if(isset($success)) { ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php } ?>

    <div class="card p-4 shadow-sm">
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">เลือกหนังสือ</label>
                <select name="book_id" class="form-select" required>
                    <option value="">-- เลือกหนังสือ --</option>
                    <?php
                    $books = mysqli_query($conn,"SELECT * FROM books");
                    while($row = mysqli_fetch_assoc($books)){
                        echo "<option value='".$row['id']."'>".$row['title']."</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" name="borrow" class="btn btn-primary">
                ยืมหนังสือ
            </button>

            <a href="dashboard.php" class="btn btn-secondary">
                กลับหน้าหลัก
            </a>
        </form>
    </div>

    <hr class="my-5">

    <h4>📚 รายการที่คุณกำลังยืม</h4>

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>ชื่อหนังสือ</th>
                <th>วันที่ยืม</th>
                <th>สถานะ</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $user_id = $user['id'];
        $query = mysqli_query($conn,"
            SELECT books.title, borrows.borrow_date, borrows.status
            FROM borrows
            JOIN books ON borrows.book_id = books.id
            WHERE borrows.user_id='$user_id' AND borrows.status='borrowed'
        ");

        while($row = mysqli_fetch_assoc($query)){
            echo "<tr>
                    <td>".$row['title']."</td>
                    <td>".$row['borrow_date']."</td>
                    <td>".$row['status']."</td>
                  </tr>";
        }
        ?>
        </tbody>
    </table>

</div>

</body>
</html>

