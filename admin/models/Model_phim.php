<?php
class PhimModel {
    private $conn;

    // Khởi tạo với kết nối cơ sở dữ liệu
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Lấy danh sách phim
    public function getAllPhim($limit, $offset) {
        $sql = "SELECT phim.*, GROUP_CONCAT(the_loai.ten SEPARATOR ', ') AS theloai
                FROM phim
                LEFT JOIN the_loai_phim ON phim.id = the_loai_phim.id_phim
                LEFT JOIN the_loai ON the_loai_phim.id_theloai = the_loai.id_theloai
                GROUP BY phim.id
                LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    // Lấy tổng số phim để tính tổng số trang
    public function getTotalPhim() {
        $sql = "SELECT COUNT(*) FROM phim";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }


    // Thêm phim mới
    public function addPhim($ten, $ngayramat, $ngaychieu, $thoiluong, $noidung, $gioithieu, $daodien, $status, $image) {
        $sql = "INSERT INTO phim (ten, ngayramat, ngaychieu, thoiluong, noidung, gioithieu, daodien, status, image)
                VALUES (:ten, :ngayramat, :ngaychieu, :thoiluong, :noidung, :gioithieu, :daodien, :status, :image)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':ten' => $ten,
            ':ngayramat' => $ngayramat,
            ':ngaychieu' => $ngaychieu,
            ':thoiluong' => $thoiluong,
            ':noidung' => $noidung,
            ':gioithieu' => $gioithieu,
            ':daodien' => $daodien,
            ':status' => $status,
            ':image' => $image
        ]);
        return $this->conn->lastInsertId(); // Trả về ID của phim vừa thêm
    }

    public function getAllTheLoai() {
        $sql = "SELECT * FROM the_loai";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   // Lấy danh sách thể loại của phim
     // Lấy thể loại của phim
     public function getTheLoaiByPhimId($id) {
        $sql = "SELECT id_theloai FROM the_loai_phim WHERE id_phim = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    

    // Thêm thể loại phim vào cơ sở dữ liệu
    public function addTheLoaiPhim($phimId, $theLoaiIds) {
        $sql = "INSERT INTO the_loai_phim (id_phim, id_theloai, status) VALUES (:id_phim, :id_theloai, :status)";
        $stmt = $this->conn->prepare($sql);

        foreach ($theLoaiIds as $theLoaiId) {
            $stmt->execute([
                ':id_phim' => $phimId,
                ':id_theloai' => $theLoaiId,
                ':status' => 1 // Cung cấp giá trị cho status (ví dụ là 1 cho 'đang chiếu')
            ]);
        }
    }

   
    // Hàm lấy thể loại đã chọn của phim
    public function getTheLoaiByPhim($id_phim) {
        $sql = "SELECT id_theloai FROM phim_theloai WHERE id_phim = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_phim]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Cập nhật thông tin phim
    public function updatePhim($id, $ten, $ngayramat, $ngaychieu, $thoiluong, $noidung, $gioithieu, $daodien, $status) {
        $sql = "UPDATE phim SET ten = ?, ngayramat = ?, ngaychieu = ?, thoiluong = ?, noidung = ?, gioithieu = ?, daodien = ?, status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$ten, $ngayramat, $ngaychieu, $thoiluong, $noidung, $gioithieu, $daodien, $status, $id]);
    }

    // Cập nhật thể loại cho phim
    public function updateTheLoaiForPhim($id_phim, $theloaiIds) {
        // Xóa các thể loại cũ
        $sqlDelete = "DELETE FROM the_loai_phim WHERE id_phim = ?";
        $stmtDelete = $this->conn->prepare($sqlDelete);
        $stmtDelete->execute([$id_phim]);

        // Thêm các thể loại mới
        foreach ($theloaiIds as $id_theloai) {
            $sqlInsert = "INSERT INTO the_loai_phim (id_phim, id_theloai,status) VALUES (?, ?,1)";
            $stmtInsert = $this->conn->prepare($sqlInsert);
            $stmtInsert->execute([$id_phim, $id_theloai]);
        }
    }

    // Xóa phim
    public function deletePhim($id) {
        try {
            // Bắt đầu transaction để đảm bảo tính toàn vẹn dữ liệu
            $this->conn->beginTransaction();

            // Xóa liên kết phim với thể loại trong bảng the_loai_phim
            $sql = "DELETE FROM the_loai_phim WHERE id_phim = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

        
    
            // Sau khi đã xóa liên kết, xóa phim khỏi bảng phim
            $sql = "DELETE FROM phim WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Commit transaction nếu cả hai câu lệnh xóa thành công
            $this->conn->commit();

            return true;  // Trả về true nếu xóa thành công
        } catch (Exception $e) {
            // Nếu có lỗi, rollback transaction
            $this->conn->rollBack();
            echo "Lỗi khi xóa phim: " . $e->getMessage();
            return false;  // Trả về false nếu có lỗi
        }
    }

    // Lấy thông tin phim theo ID
    public function getPhimById($id) {
        $sql = "SELECT * FROM phim WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        try {
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    
}
?>
