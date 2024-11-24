<!-- View: edit_film.php -->
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
        <form action="/admin/index.php?view=Phim&action=update&id=<?= htmlspecialchars($phim['id']) ?>" method="POST">
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
