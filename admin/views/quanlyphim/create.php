<?php
include 'db.php';

// Lấy tất cả thể loại từ cơ sở dữ liệu để người dùng có thể chọn
$sql = "SELECT * FROM the_loai";
$stmt = $conn->prepare($sql);
$stmt->execute();
$theloaiList = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy thông tin từ form
    $tenPhim = $_POST['ten'];
    $ngayRaMat = $_POST['ngayramat'];
    $ngayChieu = $_POST['ngaychieu'];
    $thoiLuong = $_POST['thoiluong'];
    $noiDung = $_POST['noidung'];
    $gioiThieu = $_POST['gioithieu'];
    $daoDien = $_POST['daodien'];
    $status = $_POST['status'];
    $theLoaiIds = $_POST['theloai'];  // Mảng các ID thể loại đã chọn

    try {
        // Thêm phim vào bảng 'phim'
        $sqlPhim = "INSERT INTO phim (ten, ngayramat, ngaychieu, thoiluong, noidung, gioithieu, daodien, status) 
                    VALUES (:ten, :ngayramat, :ngaychieu, :thoiluong, :noidung, :gioithieu, :daodien, :status)";
        $stmtPhim = $conn->prepare($sqlPhim);
        $stmtPhim->execute([
            ':ten' => $tenPhim,
            ':ngayramat' => $ngayRaMat,
            ':ngaychieu' => $ngayChieu,
            ':thoiluong' => $thoiLuong,
            ':noidung' => $noiDung,
            ':gioithieu' => $gioiThieu,
            ':daodien' => $daoDien,
            ':status' => $status
        ]);
        
        // Lấy ID của phim vừa thêm vào
        $phimId = $conn->lastInsertId();

        $sqlTheLoai = "INSERT INTO the_loai_phim (id_phim, id_theloai, status) 
        VALUES (:id_phim, :id_theloai, :status)";
        $stmtTheLoai = $conn->prepare($sqlTheLoai);

        // Chèn các dữ liệu vào bảng
        foreach ($theLoaiIds as $theLoaiId) {
            $stmtTheLoai->execute([
                ':id_phim' => $phimId,    // ID của phim vừa được thêm
                ':id_theloai' => $theLoaiId,  // ID của thể loại
                ':status' => 1   // Cung cấp giá trị cho status (ví dụ là 1 cho 'đang chiếu')
            ]);
        }

        // Thiết lập session hoặc một tham số query để thông báo thành công
        header("Location: /admin/index.php?view=quanlyphim&status=success");
        exit; // Dừng thực thi mã sau khi redirect

    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Phim</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Thêm Phim Mới</h1>
        <form action="/admin/views/quanlyphim/create.php" method="POST">
            <div class="form-group">
                <label for="ten">Tên Phim</label>
                <input type="text" class="form-control" id="ten" name="ten" required>
            </div>
            <div class="form-group">
                <label for="ngayramat">Ngày Ra Mắt</label>
                <input type="date" class="form-control" id="ngayramat" name="ngayramat" required>
            </div>
            <div class="form-group">
                <label for="ngaychieu">Ngày Chiếu</label>
                <input type="date" class="form-control" id="ngaychieu" name="ngaychieu" required>
            </div>
            <div class="form-group">
                <label for="thoiluong">Thời Lượng (phút)</label>
                <input type="number" class="form-control" id="thoiluong" name="thoiluong" required>
            </div>
            <div class="form-group">
                <label for="noidung">Nội Dung</label>
                <textarea class="form-control" id="noidung" name="noidung" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="gioithieu">Giới Thiệu</label>
                <textarea class="form-control" id="gioithieu" name="gioithieu" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="daodien">Đạo Diễn</label>
                <input type="text" class="form-control" id="daodien" name="daodien" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1">Đang chiếu</option>
                    <option value="2">Ngừng chiếu</option>
                </select>
            </div>
            <div class="form-group">
                <label for="theloai">Chọn Thể Loại</label><br>
                <select class="form-control" id="theloai" name="theloai[]" multiple size="10" required>
                    <?php foreach ($theloaiList as $theloai): ?>
                        <option value="<?= $theloai['id_theloai'] ?>"><?= htmlspecialchars($theloai['ten']) ?></option>
                    <?php endforeach; ?>
                </select>
                <small class="form-text text-muted">Giữ Ctrl (hoặc Command trên Mac) để chọn nhiều thể loại.</small>
            </div>
            <button type="submit" class="btn btn-primary">Thêm Phim</button>
        </form>
    </div>

    <!-- Thêm thư viện Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</body>
</html>
