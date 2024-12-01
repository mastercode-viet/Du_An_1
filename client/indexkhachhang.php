<?php
// client/indexkhachhang.php
session_start();

require_once __DIR__ . '/controllers/ClientController.php';
require_once __DIR__ . '/models/User.php';
require_once 'db.php';  // Đảm bảo đường dẫn đúng tới file Database.php

// Khởi tạo đối tượng Database và tạo kết nối
$database = new Database();

// Bây giờ bạn có thể truy cập kết nối PDO qua $database->pdo
$pdo = $database->pdo; 
$pdo = new PDO("mysql:host=localhost;dbname=da1", "root", "");
$controller = new ClientController($pdo);

$error = $controller->login(); // Xử lý đăng nhập

// Gọi view hiển thị giao diện đăng nhập
include __DIR__ . '/view/login.php';
?>
