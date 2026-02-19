<?php
session_start();
include "config.php";

$result = mysqli_query($conn,"SELECT * FROM books");
?>

<h2>รายการหนังสือ</h2>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
    <p>
        <?php echo $row['title']; ?> -
        <?php echo $row['status']; ?>

        <?php if($row['status']=='available'){ ?>
            <a href="borrow.php?id=<?php echo $row['id']; ?>">
            ยืม</a>
        <?php } ?>
    </p>
<?php } ?>
