<?php
session_start();  // Bắt đầu session để kiểm tra đăng nhập

// Kiểm tra nếu chưa đăng nhập thì chuyển đến trang login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: /admin/loginadmin.php");  // Điều hướng tới trang đăng nhập nếu chưa đăng nhập
    exit; // Dừng thực thi phần còn lại của mã
}

// Bao gồm header.php (sẽ được include nếu đăng nhập thành công)
include('includes/header.php');
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include('includes/sidebar.php'); ?>

        <!-- Main Content -->
        <?php include('includes/main-content.php'); ?>
    </div>
</div>

<?php
// Bao gồm footer.php
include('includes/footer.php');
?>
