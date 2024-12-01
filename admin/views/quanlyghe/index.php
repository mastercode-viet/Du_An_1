<?php
// Kiểm tra nếu có thông báo lỗi từ session
if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']); // Sau khi hiển thị thì xóa thông báo lỗi
}

if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
    unset($_SESSION['success']); // Sau khi hiển thị thì xóa thông báo thành công
}
?>
<div class="container">
    <h1>Danh sách ghế</h1>
    <a href="?view=Ghe&action=create" class="btn btn-primary">Thêm ghế mới</a>
    <table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>ID Ghế</th>
            <th>Tên Phòng Chiếu</th>
            <th>Tên Dãy Ghế</th>
            <th>Tên Ghế</th>
            <th>Trạng Thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo $row['id_ghe']; ?></td>
                <td><?php echo $row['ten_phongchieu']; ?></td> <!-- Hiển thị tên phòng chiếu -->
                <td><?php echo $row['ten_dayghe']; ?></td> <!-- Hiển thị tên dãy ghế -->
                <td><?php echo $row['ten']; ?></td>
                <td><?php echo $row['status'] == 1 ? 'Hoạt động' : 'Không hoạt động'; ?></td>
                <td>
                    <a href="?view=Ghe&action=edit&id_ghe=<?php echo $row['id_ghe']; ?>" class="btn btn-warning">Sửa</a>
                    <a href="?view=Ghe&action=delete&id_ghe=<?php echo $row['id_ghe']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
    </table>
</div>
