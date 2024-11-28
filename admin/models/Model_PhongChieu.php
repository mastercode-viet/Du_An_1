<?php
// models/Model_Phongchieu.php
class PhongchieuModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Lấy danh sách phòng chiếu
     // Lấy phòng chiếu với tên rạp (JOIN với bảng rap)
     public function getPhongChieuWithRap($limit, $offset) {
        // Câu lệnh SQL để lấy thông tin phòng chiếu và tên rạp
    $sql = "SELECT pc.id_phongchieu, pc.id_rap,pc.ten, pc.danhgia, pc.status, r.ten AS ten_rap
    FROM phongchieu pc
    LEFT JOIN rap r ON pc.id_rap = r.id
    LIMIT :limit OFFSET :offset";

// Chuẩn bị và thực thi câu lệnh SQL
$stmt = $this->db->prepare($sql);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

// Lấy kết quả trả về dưới dạng mảng
return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy tổng số phòng chiếu
    public function getTotalPhongChieu() {
        $sql = "SELECT COUNT(*) AS total FROM phongchieu";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Thêm phòng chiếu
    public function addPhongChieu($id_rap,$ten, $danhgia, $status) {
        try {
            $sql = "INSERT INTO phongchieu (id_rap,ten, danhgia, status) 
                    VALUES (:id_rap,:ten, :danhgia, :status)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_rap', $id_rap, PDO::PARAM_INT);
            $stmt->bindParam(':ten', $ten, PDO::PARAM_INT);
            $stmt->bindParam(':danhgia', $danhgia, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                return true;
            } else {
                // In thông báo lỗi nếu không thể thực thi
                var_dump($stmt->errorInfo());
                return false;
            }
        } catch (Exception $e) {
            // Catch ngoại lệ nếu có
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }

    public function getPhongChieuById($id) {
        $sql = "SELECT * FROM phongchieu WHERE id_phongchieu = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Cập nhật thông tin phòng chiếu
    public function updatePhongChieu($id, $id_rap,$ten, $danhgia, $status) {
        $sql = "UPDATE phongchieu SET id_rap = :id_rap,ten = :ten, danhgia = :danhgia, status = :status WHERE id_phongchieu = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_rap', $id_rap, PDO::PARAM_INT);
        $stmt->bindParam(':ten', $ten, PDO::PARAM_STR);
        $stmt->bindParam(':danhgia', $danhgia, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    public function read() {
        $query = "SELECT id_phongchieu, ten FROM phongchieu";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Trả về tất cả phòng chiếu
    }
    public function isPhongChieuUsed($id) {
        // Kiểm tra xem phòng chiếu này có buổi chiếu nào sử dụng không
        $sql = "SELECT COUNT(*) FROM lich_chieu_phim WHERE id_phongchieu = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $count = $stmt->fetchColumn();
    
        // Nếu có buổi chiếu nào sử dụng phòng chiếu này, trả về true (không thể xóa)
        return $count > 0;
    }

    // Xóa phòng chiếu
    public function deletePhongChieu($id) {
        // Xóa phòng chiếu khỏi cơ sở dữ liệu
        $sql = "DELETE FROM phongchieu WHERE id_phongchieu = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
