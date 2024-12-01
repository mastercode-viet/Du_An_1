<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'da1';  // Thay bằng tên CSDL của bạn
    private $username = 'root';         // Thay bằng username của bạn
    private $password = '';             // Thay bằng password của bạn
    public $pdo;

    public function __construct() {
        try {
            // Tạo kết nối PDO
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            // Thiết lập chế độ báo lỗi cho PDO
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Kết nối thành công!";  // Kiểm tra thông báo kết nối thành công (nếu cần)
        } catch (PDOException $e) {
            // Nếu không thể kết nối, thông báo lỗi
            die(" " . $e->getMessage());
        }
    }
    public function getConnection() {
        try {
            // Tạo kết nối PDO và lưu vào thuộc tính pdo
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            // Thiết lập chế độ báo lỗi cho PDO
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $exception) {
            echo "Kết nối cơ sở dữ liệu thất bại: " . $exception->getMessage();
            return null;
        }
    }
    

    
}
