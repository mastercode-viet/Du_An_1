<?php
// client/models/User.php

class User {

    // Kết nối cơ sở dữ liệu
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Kiểm tra thông tin đăng nhập
    public function checkLogin($username, $password) {
        // Truy vấn kiểm tra tên đăng nhập trong bảng 'khach_hang'
        $sql = "SELECT * FROM khach_hang WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        // Lấy thông tin người dùng
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // So sánh mật khẩu trực tiếp
        if ($user && $password == $user['password']) {
            return $user;
        }

        return null;  // Không tìm thấy người dùng hoặc mật khẩu sai
    }
}
?>
