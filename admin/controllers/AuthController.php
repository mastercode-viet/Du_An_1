<?php
// controllers/Customer/AuthController.php
class AuthController {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // Đăng ký khách hàng
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $username = $_POST['username'];
            $fullName = $_POST['fullName'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];

            // Kiểm tra mật khẩu khớp không
            if ($password !== $confirmPassword) {
                $_SESSION['error'] = "Mật khẩu không khớp!";
                header("Location: indexkhachhang.php?act=register");
                exit();
            }

            // Mã hóa mật khẩu
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Kiểm tra email đã tồn tại
            $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            if ($stmt->fetchColumn() > 0) {
                $_SESSION['error'] = "Email đã tồn tại!";
                header("Location: indexkhachhang.php?act=register");
                exit();
            }

            // Thêm người dùng mới vào cơ sở dữ liệu
            $sql = "INSERT INTO users (username, full_name, email, phone, password) VALUES (:username, :full_name, :email, :phone, :password)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':full_name', $fullName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Đăng ký thành công!";
                header("Location: indexkhachhang.php?act=login");
                exit();
            } else {
                $_SESSION['error'] = "Đăng ký thất bại!";
                header("Location: indexkhachhang.php?act=register");
                exit();
            }
        }

        require_once 'views/Customer/register.php'; // Gọi view đăng ký
    }

    // Kiểm tra email đã tồn tại chưa
    private function checkEmailExists($email) {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Đăng nhập khách hàng
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Kiểm tra thông tin đăng nhập
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user; // Lưu thông tin người dùng vào session
                header("Location: indexkhachhang.php?act=home");
                exit();
            } else {
                $_SESSION['error'] = "Thông tin đăng nhập không chính xác!";
            }
        }

        require_once 'views/Khachhang/login.php'; // Giao diện đăng nhập
    }

    // Đăng xuất
    public function logout() {
        session_unset();
        session_destroy();
        header("Location: indexkhachhang.php?act=login");
        exit();
    }
}