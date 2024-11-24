<!-- create.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Phim Mới</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.5.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Thêm Phim Mới</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="ten">Tên Phim</label>
                <input type="text" name="ten" id="ten" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="ngayramat">Ngày Ra Mắt</label>
                <input type="date" name="ngayramat" id="ngayramat" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="ngaychieu">Ngày Chiếu</label>
                <input type="date" name="ngaychieu" id="ngaychieu" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="thoiluong">Thời Lượng</label>
                <input type="text" name="thoiluong" id="thoiluong" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="noidung">Nội Dung</label>
                <textarea name="noidung" id="noidung" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="gioithieu">Giới Thiệu</label>
                <textarea name="gioithieu" id="gioithieu" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="daodien">Đạo Diễn</label>
                <input type="text" name="daodien" id="daodien" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="status">Trạng Thái</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="0">Hoạt động</option>
                    <option value="1">Không hoạt động</option>
                </select>
            </div>

            <div class="form-group">
                <label for="theloai">Thể Loại</label>
                <select name="theloai[]" id="theloai" class="form-control" multiple required>
                    <?php foreach ($theloaiList as $theloai): ?>
                        <option value="<?= $theloai['id_theloai'] ?>"><?= $theloai['ten'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Ảnh</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Thêm Phim</button>
        </form>
    </div>
</body>
</html>
