<div class="container">
    <h1 class="text-center">Danh sách rạp</h1>
    <a href="?view=Rap&action=create" class="btn btn-primary mb-3">Thêm rạp mới</a>

    <!-- Hiển thị thông báo -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Địa chỉ</th>
                <th>Thời gian mở</th>
                <th>Thời gian đóng</th>
                <th>Status</th>
                <th>Số điện thoại</th> <!-- Cột mới -->
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($raps as $rap): ?>
                <tr>
                    <td><?= $rap['id']; ?></td>
                    <td><?= $rap['ten']; ?></td>
                    <td><?= $rap['diachi']; ?></td>
                    <td><?= $rap['thoi_gian_mo']; ?></td>
                    <td><?= $rap['thoi_gian_dong']; ?></td>
                    <td><?= $rap['status'] == 1 ? 'Hoạt động' : 'Dừng hoạt động'; ?></td>
                    <td><?= $rap['dienthoai']; ?></td> <!-- Hiển thị số điện thoại -->
                    <td>
                        <a href="?view=Rap&action=edit&id=<?= urlencode($rap['id']) ?>" class="btn btn-warning">Sửa</a>
                        <a href="?view=Rap&action=delete&id=<?= urlencode($rap['id']) ?>" 
                           onclick="return confirm('Bạn có chắc muốn xóa?');" 
                           class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?view=Rap&page=<?= $page - 1 ?>">Previous</a>
            </li>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="?view=Rap&page=<?= $i ?>"><?= $i ?></a></li>
            <?php endfor; ?>
            <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                <a class="page-link" href="?view=Rap&page=<?= $page + 1 ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>
