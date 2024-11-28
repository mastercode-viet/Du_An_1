<?php
// Bắt đầu session
session_start();

// Kiểm tra trạng thái đăng nhập
if (!isset($_SESSION['user'])) {
    // Nếu chưa đăng nhập, điều hướng đến trang đăng nhập
    header('Location: views/login.php');
    exit();
}

// Nếu đã đăng nhập, tiếp tục xử lý các hành động
include "./views/trangchu.php";
switch ($_GET['act']) {
    case 'Register':
        include "./views/Register.php";
        break;
    case 'dangnhap':
        include "./views/login.php";  
        break;
    case 'lichchieu':
        include "./views/lichchieu.php";
        break;      
    default:
        // Hiển thị trang mặc định nếu không có action cụ thể
        include "./views/trangchu.php";
}
?>
