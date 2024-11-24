<?php
class RapModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // Lấy tất cả rạp
    public function getAllRaps($page = 1, $limit = 10) {
        $offset = ($page - 1) * $limit;

        $sql = "SELECT * FROM rap LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllRap() {
        $sql = "SELECT * FROM rap"; // Truy vấn lấy tất cả các rạp
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // Thêm rạp mới
    public function addRap($ten, $diachi, $thoi_gian_mo, $thoi_gian_dong, $status,$dienthoai) {
        $sql = "INSERT INTO rap (ten, diachi, thoi_gian_mo, thoi_gian_dong, status, dienthoai) 
                VALUES (:ten, :diachi, :thoi_gian_mo, :thoi_gian_dong, :status, :dienthoai)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':ten', $ten, PDO::PARAM_STR);
        $stmt->bindParam(':diachi', $diachi, PDO::PARAM_STR);
        $stmt->bindParam(':thoi_gian_mo', $thoi_gian_mo, PDO::PARAM_STR);
        $stmt->bindParam(':thoi_gian_dong', $thoi_gian_dong, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':dienthoai', $dienthoai, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Sửa thông tin rạp
    public function updateRap($id,$ten, $diachi, $thoi_gian_mo, $thoi_gian_dong, $status,$dienthoai) {
        $sql = "UPDATE rap SET 
                    ten = :ten, 
                    diachi = :diachi, 
                    thoi_gian_mo = :thoi_gian_mo, 
                    thoi_gian_dong = :thoi_gian_dong, 
                    status = :status,  
                    dienthoai = :dienthoai 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':ten', $ten, PDO::PARAM_STR);
        $stmt->bindParam(':diachi', $diachi, PDO::PARAM_STR);
        $stmt->bindParam(':thoi_gian_mo', $thoi_gian_mo, PDO::PARAM_STR);
        $stmt->bindParam(':thoi_gian_dong', $thoi_gian_dong, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':dienthoai', $dienthoai, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Xóa rạp
    public function deleteRap($id) {
        $sql = "DELETE FROM rap WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Lấy số lượng rạp để phân trang
    public function getTotalRaps() {
        $sql = "SELECT COUNT(*) FROM rap";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();
    }
    
    public function getRapById($id) {
        $sql = "SELECT * FROM rap WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Model_Rap.php
public function isRapUsed($id) {
    // Giả sử bạn có bảng phòng chiếu lưu trữ id rạp
    $sql = "SELECT COUNT(*) FROM phongchieu WHERE id_rap = :id_rap";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id_rap', $id, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    // Nếu có phòng chiếu nào sử dụng rạp, trả về true, ngược lại false
    return $count > 0;
}

}

?>