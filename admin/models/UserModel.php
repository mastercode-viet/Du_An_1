<?php
require_once 'db.php';

class UserModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // Đăng ký người dùng mới
    public function register($username, $password, $name) {
        // Kiểm tra xem username đã tồn tại trong cơ sở dữ liệu chưa
        if ($this->checkUsernameExists($username)) {
            return false; // Username đã tồn tại
        }

        // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Thêm người dùng mới vào cơ sở dữ liệu
        $sql = "INSERT INTO users (username, password, name) VALUES (:username, :password, :name)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Kiểm tra username có tồn tại hay không
    private function checkUsernameExists($username) {
        $sql = "SELECT COUNT(*) FROM users WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Đăng nhập người dùng
    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Đăng nhập thành công
        }
        return false; // Đăng nhập thất bại
    }

    // Lấy thông tin người dùng theo ID
    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
