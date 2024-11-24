<?php
class TheLoaiModel {
    private $conn;

    // Khởi tạo với kết nối cơ sở dữ liệu
    public function __construct($conn) {
        $this->conn = $conn;
    }
    // Lấy danh sách thể loại với phân trang
    public function getTheLoaiByPage($page, $itemsPerPage) {
        $offset = ($page - 1) * $itemsPerPage; // Tính offset

        $sql = "SELECT * FROM the_loai LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Lỗi truy vấn: " . $e->getMessage();
            return [];
        }
    }

    // Lấy tổng số thể loại để tính số trang
    public function getTotalTheLoaiCount() {
        $sql = "SELECT COUNT(*) FROM the_loai";
        $stmt = $this->conn->prepare($sql);

        try {
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count;
        } catch (PDOException $e) {
            echo "Lỗi truy vấn: " . $e->getMessage();
            return 0;
        }
    }
    public function createTheLoai($ten, $status) {
        $sql = "INSERT INTO the_loai (ten, status) VALUES (:ten, :status)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ten', $ten, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    public function updateTheLoai($id, $ten, $status) {
        $sql = "UPDATE the_loai SET ten = :ten, status = :status WHERE id_theloai = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':ten', $ten, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Lấy thông tin thể loại theo ID
    public function getTheLoaiById($id) {
        $sql = "SELECT * FROM the_loai WHERE id_theloai = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }
    public function isTheLoaiUsed($id) {
        $sql = "SELECT COUNT(*) FROM the_loai_phim WHERE id_theloai = :id_theloai";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_theloai', $id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Nếu có bản ghi thì trả về true
    }

    // Xóa thể loại
    public function deleteTheLoai($id) {
        $sql = "DELETE FROM the_loai WHERE id_theloai = :id_theloai";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_theloai', $id, PDO::PARAM_INT);

        return $stmt->execute(); // Thực hiện xóa
    }
}
?>
