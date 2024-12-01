<!-- <<<<<<< HEAD
<?php
// Bắt đầu session
session_start();
=======
<?php 

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';

// Require toàn bộ file Models
require_once './models/Student.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
     => (new HomeController())->index(),
};
>>>>>>> 8847ae7f033cf8a56dc739c08fb4c5ba33dbc7f3

// Kiểm tra trạng thái đăng nhập
if (!isset($_SESSION['user'])) {
    // Nếu chưa đăng nhập, điều hướng đến trang đăng nhập
    header('Location: views/login.php');
    exit();
}

<<<<<<< HEAD
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
=======

    
};
>>>>>>> 8847ae7f033cf8a56dc739c08fb4c5ba33dbc7f3 -->
