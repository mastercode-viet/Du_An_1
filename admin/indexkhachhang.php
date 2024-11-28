<?php
session_start(); // Khởi tạo session
require_once 'db.php'; // Kết nối cơ sở dữ liệu

// Lấy giá trị của hành động (action) từ URL
$act = isset($_GET['act']) ? $_GET['act'] : 'login'; // Nếu không có hành động, mặc định là login

// Kiểm tra hành động và gọi các controller tương ứng
switch ($act) {
    case 'login':
        require_once 'controllers/AuthController.php'; // Include controller
        $authController = new AuthController($conn); // Tạo đối tượng controller
        $authController->login(); // Gọi phương thức login
        break;
        
    case 'register':
        require_once 'controllers/AuthController.php'; // Include controller
        $authController = new AuthController($conn); // Tạo đối tượng controller
        $authController->register(); // Gọi phương thức register
        break;
        
    case 'logout':
        require_once 'controllers/AuthController.php'; // Include controller
        $authController = new AuthController($conn); // Tạo đối tượng controller
        $authController->logout(); // Gọi phương thức logout
        break;

    default:
        require_once 'controllers/AuthController.php'; // Include controller
        $authController = new AuthController($conn); // Tạo đối tượng controller
        $authController->login(); // Gọi phương thức login mặc định
        break;
}
?>
