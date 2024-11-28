<?php
// models/Model_LichChieuPhim.php
class LichChieuPhim {
    private $conn;
    private $table = "lich_chieu_phim";

    public $id_lichchieu;
    public $id_phim;
    public $id_phongchieu;
    public $status;
    public $thoigianbatdau;
    public $thoigianketthuc;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Tạo lịch chiếu phim mới
    public function create() {
        $query = "INSERT INTO " . $this->table . " (id_phim, id_phongchieu, status, thoigianbatdau, thoigianketthuc)
                  VALUES (:id_phim, :id_phongchieu, :status, :thoigianbatdau, :thoigianketthuc)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':id_phim', $this->id_phim);
        $stmt->bindParam(':id_phongchieu', $this->id_phongchieu);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':thoigianbatdau', $this->thoigianbatdau);
        $stmt->bindParam(':thoigianketthuc', $this->thoigianketthuc);

        return $stmt->execute();
    }

    public function read() {
        // Truy vấn lấy dữ liệu từ bảng lich_chieu_phim, kèm theo tên phim và tên phòng chiếu
        $query = "SELECT 
                    lc.id, 
                    lc.id_phim, 
                    lc.id_phongchieu, 
                    lc.thoigianbatdau, 
                    lc.thoigianketthuc, 
                    lc.status,
                    p.ten AS ten_phim,  -- Đổi tên trường 'ten' từ bảng phim thành 'ten_phim'
                    pc.ten AS ten_phongchieu  -- Đổi tên trường 'ten' từ bảng phongchieu thành 'ten_phongchieu'
                  FROM 
                    " . $this->table . " lc
                  JOIN phim p ON lc.id_phim = p.id
                  JOIN phongchieu pc ON lc.id_phongchieu = pc.id_phongchieu";
    
        // Chuẩn bị câu truy vấn
        $stmt = $this->conn->prepare($query);
    
        // Thực thi câu truy vấn
        $stmt->execute();
    
        // Trả về kết quả dưới dạng mảng các bản ghi
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Đọc lịch chiếu phim theo ID
    public function readById($id_lichchieu) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id_lichchieu);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật lịch chiếu phim
    public function update() {
        $query = "UPDATE " . $this->table . " 
                  SET id_phim = :id_phim, id_phongchieu = :id_phongchieu, status = :status, 
                      thoigianbatdau = :thoigianbatdau, thoigianketthuc = :thoigianketthuc
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':id_phim', $this->id_phim);
        $stmt->bindParam(':id_phongchieu', $this->id_phongchieu);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':thoigianbatdau', $this->thoigianbatdau);
        $stmt->bindParam(':thoigianketthuc', $this->thoigianketthuc);
        $stmt->bindParam(':id', $this->id_lichchieu);

        return $stmt->execute();
    }

    // Xóa lịch chiếu phim
    public function delete($id_lichchieu) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id_lichchieu);
        return $stmt->execute();
    }
}
?>
