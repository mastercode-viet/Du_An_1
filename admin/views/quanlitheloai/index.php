<!-- views/theloai/index.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách thể loại</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center text-danger">Danh sách thể loại phim</h1>

        <!-- Thông báo thành công hoặc lỗi -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <a href="?view=TheLoai&action=create" class="btn btn-primary mb-3">Thêm thể loại</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên thể loại</th>
                    <th>Status</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($theloai as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['id_theloai']) ?></td>
                        <td><?= htmlspecialchars($item['ten']) ?></td>
                        <td>
                            <?= $item['status'] == 1 ? 'Hoạt động' : 'Dừng hoạt động' ?>
                        </td>
                        <td>
                            <a href="?view=TheLoai&action=edit&id=<?= urlencode($item['id_theloai']) ?>" class="btn btn-warning btn-sm">Chỉnh sửa</a>
                            <a href="?view=TheLoai&action=delete&id=<?= urlencode($item['id_theloai']) ?>" onclick="return confirm('Bạn có chắc muốn xóa?');" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Phân trang -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?view=TheLoai&page=<?= $page - 1 ?>" tabindex="-1" aria-disabled="true">Prev</a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?view=TheLoai&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link" href="?view=TheLoai&page=<?= $page + 1 ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</body>
</html>
