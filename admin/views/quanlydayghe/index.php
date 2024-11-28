<div class="container">
    <h1>Danh sách dãy ghế</h1>
    
    <!-- Hiển thị thông báo nếu có -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php elseif (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    
    <a href="?view=dayghe&action=create" class="btn btn-primary">Thêm dãy ghế mới</a>
    <table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên dãy ghế</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($result) && is_array($result)): // Kiểm tra xem $result có phải là mảng không ?>
            <?php foreach ($result as $row): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['ten']; ?></td>
                    <td>
                        <a href="index.php?view=dayghe&action=edit&id=<?php echo $row['id']; ?>" class="btn btn-warning">Sửa</a>
                        <a href="index.php?view=dayghe&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Không có dữ liệu dãy ghế</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>
