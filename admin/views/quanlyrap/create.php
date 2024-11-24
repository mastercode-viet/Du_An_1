<!-- views/rap/create.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Rạp</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center text-danger">Thêm Rạp</h1>

        <!-- Thông báo thành công hoặc lỗi -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="?view=Rap&action=create" method="POST">
            <div class="form-group">
                <label for="ten">Tên Rạp</label>
                <input type="text" name="ten" id="ten" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="dia_chi">Địa chỉ</label>
                <input type="text" name="dia_chi" id="dia_chi" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="thoi_gian_mo">Thời gian mở</label>
                <input type="time" name="thoi_gian_mo" id="thoi_gian_mo" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="thoi_gian_dong">Thời gian đóng</label>
                <input type="time" name="thoi_gian_dong" id="thoi_gian_dong" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="1">Hoạt động</option>
                    <option value="0">Dừng hoạt động</option>
                </select>
            </div>

        

            <div class="form-group">
                <label for="dienthoai">Điện thoại</label>
                <input type="text" name="dienthoai" id="dienthoai" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Thêm Rạp</button>
        </form>

        <a href="?view=Rap" class="btn btn-secondary mt-3">Quay lại</a>
    </div>
</body>
</html>
