<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa phòng chiếu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Sửa phòng chiếu</h1>

        <!-- Thông báo thành công hoặc lỗi -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <form action="?view=Phongchieu&action=update&id=<?= $phongchieu['id_phongchieu'] ?>" method="POST">
            <div class="form-group">
                <label for="id_rap">Chọn Rạp:</label>
                <select name="id_rap" id="id_rap" class="form-control">
                    <?php foreach ($raps as $rap): ?>
                        <option value="<?= $rap['id'] ?>" <?= $rap['id'] == $phongchieu['id_rap'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($rap['ten']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="danhgia">Đánh giá:</label>
                <input type="text" name="danhgia" id="danhgia" class="form-control" value="<?= htmlspecialchars($phongchieu['danhgia']) ?>" required>
            </div>

            <div class="form-group">
                <label for="status">Trạng thái:</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" <?= $phongchieu['status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                    <option value="0" <?= $phongchieu['status'] == 0 ? 'selected' : '' ?>>Dừng hoạt động</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</body>
</html>
