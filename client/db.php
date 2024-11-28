<?php
$host = 'localhost';
$dbname = 'da1';  // Đảm bảo là cơ sở dữ liệu 'da1'
$username = 'root';
$password = '';  // Hoặc mật khẩu tương ứng với MySQL của bạn

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
}
?>
