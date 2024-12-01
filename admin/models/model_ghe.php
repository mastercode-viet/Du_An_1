<?php
class Ghe {
    private $conn;
    public $id_ghe;
    public $id_phongchieu;
    public $id_dayghe;
    public $ten;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy danh sách ghế
    public function read() {
        $query = "
            SELECT ghe.id_ghe, ghe.id_phongchieu, ghe.id_dayghe, ghe.ten, ghe.status, 
                   phongchieu.ten AS ten_phongchieu, dayghe.ten AS ten_dayghe
            FROM ghe
            LEFT JOIN phongchieu ON ghe.id_phongchieu = phongchieu.id_phongchieu
            LEFT JOIN dayghe ON ghe.id_dayghe = dayghe.id
        ";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Thêm ghế mới
    public function create() {
        $query = "
            INSERT INTO ghe (id_phongchieu, id_dayghe, ten, status)
            VALUES (:id_phongchieu, :id_dayghe, :ten, :status)
        ";
    
        $stmt = $this->conn->prepare($query);
    
        // Bind các tham số
        $stmt->bindParam(':id_phongchieu', $this->id_phongchieu);
        $stmt->bindParam(':id_dayghe', $this->id_dayghe);
        $stmt->bindParam(':ten', $this->ten);
        $stmt->bindParam(':status', $this->status);
    
        // Thực hiện câu lệnh SQL
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }
    
    // Cập nhật ghế
    public function update() {
        $query = "UPDATE ghe SET id_phongchieu = :id_phongchieu, id_dayghe = :id_dayghe, ten = :ten, status = :status WHERE id_ghe = :id_ghe";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_ghe', $this->id_ghe);
        $stmt->bindParam(':id_phongchieu', $this->id_phongchieu);
        $stmt->bindParam(':id_dayghe', $this->id_dayghe);
        $stmt->bindParam(':ten', $this->ten);
        $stmt->bindParam(':status', $this->status);

        return $stmt->execute();
    }

    // Xóa ghế
    public function delete($id_ghe) {
        $query = "DELETE FROM ghe WHERE id_ghe = :id_ghe";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_ghe', $id_ghe);
        return $stmt->execute();
    }
}
?>
