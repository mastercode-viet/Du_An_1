<!-- views/film_list.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phim và thể loại</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<body>
    <h1 class="text-center text-danger">Danh sách phim</h1>

    <!-- Thông báo thành công hoặc lỗi -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php elseif (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <a href="?view=Phim&action=create" class="btn btn-primary mb-3">Thêm phim</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Ảnh</th>
                <th>Ngày ra mắt</th>
                <th>Ngày chiếu</th>
                <th>Thời lượng</th>
                <th>Đạo diễn</th>
                <th>Thể loại</th>
                <th>Status</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($films as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['id']) ?></td>
                    <td><?= htmlspecialchars($p['ten']) ?></td>
                    <td>
                        <?php if (!empty($p['image'])): ?>
                            <img src="<?= htmlspecialchars($p['image']) ?>" width="100px" height="180px">
                        <?php else: ?>
                            <span>Không có ảnh</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($p['ngayramat']) ?></td>
                    <td><?= htmlspecialchars($p['ngaychieu']) ?></td>
                    <td><?= htmlspecialchars($p['thoiluong']) ?></td>
                    <td><?= htmlspecialchars($p['daodien']) ?></td>
                    <td><?= htmlspecialchars($p['theloai']) ?></td>
                    <td><?= htmlspecialchars($p['status']) ?></td>
                    <td>
                        <a href="?view=Phim&action=edit&id=<?= urlencode($p['id']) ?>" class="btn btn-warning btn-sm">Chỉnh sửa</a>
                        <a href="?view=Phim&action=delete&id=<?= urlencode($p['id']) ?>" onclick="return confirm('Bạn có chắc muốn xóa?');" class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Phân trang với nút Next và Prev -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <!-- Nút Prev -->
            <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?view=Phim&page=<?= $page - 1 ?>" tabindex="-1" aria-disabled="true">Prev</a>
            </li>

            <!-- Các trang số -->
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?view=Phim&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <!-- Nút Next -->
            <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                <a class="page-link" href="?view=Phim&page=<?= $page + 1 ?>">Next</a>
            </li>
        </ul>
    </nav>
</body>
</html>
