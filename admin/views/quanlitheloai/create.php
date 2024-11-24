<!-- views/theloai/create.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm thể loại phim</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center text-danger">Thêm thể loại phim</h1>

        <!-- Thông báo thành công hoặc lỗi -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <form action="?view=TheLoai&action=create" method="POST">
            <div class="form-group">
                <label for="ten">Tên thể loại</label>
                <input type="text" class="form-control" id="ten" name="ten" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1">Hoạt động</option>
                    <option value="0">Dừng hoạt động</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Thêm thể loại</button>
        </form>
    </div>
</body>
</html>
