<?php
class DayGhe {
    private $conn;
    public $id;
    public $ten;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Thêm dãy ghế mới
    public function create() {
        $query = "INSERT INTO dayghe (ten) VALUES (:ten)";
        $stmt = $this->conn->prepare($query);
        
        // Liên kết các tham số với PDO
        $stmt->bindParam(':ten', $this->ten, PDO::PARAM_STR);
    
        return $stmt->execute();
    }
    public function isTenDayGheExists($ten, $id = null) {
        $query = "SELECT COUNT(*) FROM dayghe WHERE ten = :ten";
        
        // Nếu có $id (chỉnh sửa), thì bỏ qua kiểm tra tên của chính dãy ghế đó
        if ($id) {
            $query .= " AND id != :id";
        }
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':ten', $ten, PDO::PARAM_STR);
    
        if ($id) {
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        }
    
        $stmt->execute();
        $count = $stmt->fetchColumn();
    
        return $count > 0; // Trả về true nếu tên dãy ghế đã tồn tại
    }
    

  
    // Lấy danh sách dãy ghế
    public function read() {
        $query = "SELECT * FROM dayghe";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        // Sử dụng fetchAll() để lấy tất cả kết quả
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // Cập nhật dãy ghế
    public function update() {
        $query = "UPDATE dayghe SET ten = :ten WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        // Liên kết các tham số với PDO
        $stmt->bindParam(':ten', $this->ten, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }

    // Xóa dãy ghế
    public function delete($id) {
        // Câu lệnh SQL xóa dãy ghế
        $query = "DELETE FROM dayghe WHERE id = :id";
        
        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($query);
        
        // Gán giá trị cho tham số :id
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        // Thực thi câu lệnh và trả về kết quả
        return $stmt->execute();
    }
}
?>
