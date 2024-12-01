<!-- Kiểm tra và hiển thị thông báo -->
<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['success']; ?>
    </div>
    <?php unset($_SESSION['success']); // Xóa thông báo sau khi đã hiển thị ?>
<?php elseif (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error']; ?>
    </div>
    <?php unset($_SESSION['error']); // Xóa thông báo sau khi đã hiển thị ?>
<?php endif; ?>

<!-- Nút Thêm Lịch Chiếu -->
<a href="?view=LichChieuPhim&action=create" class="btn btn-primary mb-3">Thêm Lịch Chiếu</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Phim</th>
            <th>Phòng Chiếu</th>
            <th>Thời Gian Bắt Đầu</th>
            <th>Thời Gian Kết Thúc</th>
            <th>Trạng Thái</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lichChieuPhimList as $lichChieu): ?>
            <tr>
                <td><?php echo $lichChieu['id']; ?></td>
                <td><?php echo $lichChieu['ten_phim']; ?></td>  <!-- Hiển thị tên phim -->
                <td><?php echo $lichChieu['ten_phongchieu']; ?></td>  <!-- Hiển thị tên phòng chiếu -->
                <td><?php echo $lichChieu['thoigianbatdau']; ?></td>
                <td><?php echo $lichChieu['thoigianketthuc']; ?></td>
                <td>
                    <?php 
                    // Kiểm tra giá trị của status và hiển thị trạng thái tương ứng
                    switch ($lichChieu['status']) {
                        case 0:
                            echo 'Chưa chiếu';
                            break;
                        case 1:
                            echo 'Đang chiếu';
                            break;
                        case 2:
                            echo 'Đã chiếu';
                            break;
                        default:
                            echo 'Không xác định';
                            break;
                    }
                    ?>
                </td>
                <td>
                    <a href="?view=LichChieuPhim&action=edit&id=<?php echo $lichChieu['id']; ?>" class="btn btn-warning">Sửa</a>
                    <a href="?view=LichChieuPhim&action=delete&id=<?php echo $lichChieu['id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa lịch chiếu này?');">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
