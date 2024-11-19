<?php
session_start(); // Bắt đầu phiên làm việc

// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    // Xóa tất cả các biến session
    session_unset();

    // Hủy phiên làm việc
    session_destroy();

    // Chuyển hướng người dùng về trang đăng nhập
    header("Location: loginadmin.php");
    exit;
} else {
    // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
    header("Location: loginadmin.php");
    exit;
}
?>
