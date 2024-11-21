<?php
// Kết nối cơ sở dữ liệu
include 'db.php';

// Kiểm tra xem ID phim có hợp lệ không
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin phim từ cơ sở dữ liệu
    $sqlPhim = "SELECT * FROM phim WHERE id = :id";
    $stmtPhim = $conn->prepare($sqlPhim);
    $stmtPhim->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtPhim->execute();
    $phim = $stmtPhim->fetch(PDO::FETCH_ASSOC);

    if (!$phim) {
        $_SESSION['error'] = "Phim không tồn tại!";
        header("Location: index.php?view=quanlyphim");
        exit();
    }

    // Lấy tất cả thể loại từ cơ sở dữ liệu để người dùng có thể chọn
    $sqlTheLoai = "SELECT * FROM the_loai";
    $stmtTheLoai = $conn->prepare($sqlTheLoai);
    $stmtTheLoai->execute();
    $theloaiList = $stmtTheLoai->fetchAll(PDO::FETCH_ASSOC);

    // Lấy các thể loại hiện tại của phim này
    $sqlPhimTheLoai = "SELECT id_theloai FROM the_loai_phim WHERE id_phim = :id";
    $stmtPhimTheLoai = $conn->prepare($sqlPhimTheLoai);
    $stmtPhimTheLoai->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtPhimTheLoai->execute();
    $currentTheLoaiIds = $stmtPhimTheLoai->fetchAll(PDO::FETCH_COLUMN);

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
            // Cập nhật thông tin phim trong bảng 'phim'
            $sqlUpdatePhim = "UPDATE phim SET ten = :ten, ngayramat = :ngayramat, ngaychieu = :ngaychieu, 
                             thoiluong = :thoiluong, noidung = :noidung, gioithieu = :gioithieu, 
                             daodien = :daodien, status = :status WHERE id = :id";
            $stmtUpdatePhim = $conn->prepare($sqlUpdatePhim);
            $stmtUpdatePhim->execute([
                ':ten' => $tenPhim,
                ':ngayramat' => $ngayRaMat,
                ':ngaychieu' => $ngayChieu,
                ':thoiluong' => $thoiLuong,
                ':noidung' => $noiDung,
                ':gioithieu' => $gioiThieu,
                ':daodien' => $daoDien,
                ':status' => $status,
                ':id' => $id
            ]);

            // Xóa các thể loại cũ của phim này trong bảng 'the_loai_phim'
            $sqlDeleteOldTheLoai = "DELETE FROM the_loai_phim WHERE id_phim = :id_phim";
            $stmtDeleteOldTheLoai = $conn->prepare($sqlDeleteOldTheLoai);
            $stmtDeleteOldTheLoai->bindParam(':id_phim', $id, PDO::PARAM_INT);
            $stmtDeleteOldTheLoai->execute();

            // Chèn các thể loại mới vào bảng 'the_loai_phim'
            $sqlInsertNewTheLoai = "INSERT INTO the_loai_phim (id_phim, id_theloai, status) 
                                    VALUES (:id_phim, :id_theloai, :status)";
            $stmtInsertNewTheLoai = $conn->prepare($sqlInsertNewTheLoai);
            foreach ($theLoaiIds as $theLoaiId) {
                $stmtInsertNewTheLoai->execute([
                    ':id_phim' => $id,
                    ':id_theloai' => $theLoaiId,
                    ':status' => 1  // Cung cấp giá trị cho status (ví dụ là 1 cho 'đang chiếu')
                ]);
            }

            // Chuyển hướng về trang danh sách phim sau khi cập nhật thành công
            $_SESSION['success'] = 'Phim đã được cập nhật thành công!';
            header("Location: /admin/index.php?view=quanlyphim");
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Lỗi: ' . $e->getMessage();
        }
    }
} else {
    $_SESSION['error'] = "ID phim không hợp lệ.";
    header("Location: /admin/index.php?view=quanlyphim");
    exit();
}
?>

<!-- HTML form cho phép chỉnh sửa phim -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Phim</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Chỉnh Sửa Phim</h1>

        <!-- Hiển thị thông báo lỗi hoặc thành công -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success']; ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error']; ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Form chỉnh sửa thông tin phim -->
        <form action="/admin/views/quanlyphim/edit.php?id=<?= htmlspecialchars($id) ?>" method="POST">
            <div class="form-group">
                <label for="ten">Tên Phim</label>
                <input type="text" class="form-control" id="ten" name="ten" value="<?= htmlspecialchars($phim['ten']) ?>" required>
            </div>
            <div class="form-group">
                <label for="ngayramat">Ngày Ra Mắt</label>
                <input type="date" class="form-control" id="ngayramat" name="ngayramat" value="<?= htmlspecialchars($phim['ngayramat']) ?>" required>
            </div>
            <div class="form-group">
                <label for="ngaychieu">Ngày Chiếu</label>
                <input type="date" class="form-control" id="ngaychieu" name="ngaychieu" value="<?= htmlspecialchars($phim['ngaychieu']) ?>" required>
            </div>
            <div class="form-group">
                <label for="thoiluong">Thời Lượng (phút)</label>
                <input type="number" class="form-control" id="thoiluong" name="thoiluong" value="<?= htmlspecialchars($phim['thoiluong']) ?>" required>
            </div>
            <div class="form-group">
                <label for="noidung">Nội Dung</label>
                <textarea class="form-control" id="noidung" name="noidung" rows="4" required><?= htmlspecialchars($phim['noidung']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="gioithieu">Giới Thiệu</label>
                <textarea class="form-control" id="gioithieu" name="gioithieu" rows="4" required><?= htmlspecialchars($phim['gioithieu']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="daodien">Đạo Diễn</label>
                <input type="text" class="form-control" id="daodien" name="daodien" value="<?= htmlspecialchars($phim['daodien']) ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1" <?= $phim['status'] == 1 ? 'selected' : '' ?>>Đang chiếu</option>
                    <option value="2" <?= $phim['status'] == 2 ? 'selected' : '' ?>>Ngừng chiếu</option>
                </select>
            </div>
            <!--  -->
            <div class="form-group">
                <label for="image">Chọn ảnh mới</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/">
            </div>
            <!--  -->
            <div class="form-group">
                <label for="theloai">Chọn Thể Loại</label><br>
                <select class="form-control" id="theloai" name="theloai[]" multiple size="10" required>
                    <?php foreach ($theloaiList as $theloai): ?>
                        <option value="<?= $theloai['id_theloai'] ?>" 
                            <?= in_array($theloai['id_theloai'], $currentTheLoaiIds) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($theloai['ten']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <small class="form-text text-muted">Giữ Ctrl (hoặc Command trên Mac) để chọn nhiều thể loại.</small>
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật Phim</button>
        </form>
    </div>
</body>
</html>
