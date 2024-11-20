<?php
// Kiểm tra nếu chưa đăng nhập thì chuyển đến trang login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: /admin/loginadmin.php");  // Điều hướng tới trang đăng nhập nếu chưa đăng nhập
    exit; // Dừng thực thi phần còn lại của mã
}

include 'db.php';

// Kiểm tra xem có yêu cầu thêm phim không
if (isset($_GET['action']) && $_GET['action'] == 'create') {
    // Chèn form thêm phim vào trang quản trị
    include 'create.php';  // Đây sẽ là trang tạo phim mới
    exit;  // Dừng thực thi phần còn lại của mã để tránh hiển thị danh sách phim
} 
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    // Chèn form thêm phim vào trang quản trị
    include 'edit.php';  // Đây sẽ là trang chỉnh sửa phim
    exit;  // Dừng thực thi phần còn lại của mã để tránh hiển thị danh sách phim
} else {
    // Truy vấn lấy danh sách phim và thể loại liên kết
    $sql = "SELECT phim.*, GROUP_CONCAT(the_loai.ten SEPARATOR ', ') AS theloai
            FROM phim
            LEFT JOIN the_loai_phim ON phim.id = the_loai_phim.id_phim
            LEFT JOIN the_loai ON the_loai_phim.id_theloai = the_loai.id_theloai
            GROUP BY phim.id";
    $stmt = $conn->prepare($sql);

    try {
        // Thực thi câu lệnh
        $stmt->execute();
        // Lấy dữ liệu từ cơ sở dữ liệu
        $phim = $stmt->fetchAll(PDO::FETCH_ASSOC);    
    } catch (PDOException $e) {
        // Xử lý lỗi nếu có
    }

    // Kiểm tra thông báo từ URL
    if (isset($_GET['status']) && $_GET['status'] == 'success') {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Thêm phim thành công!',
                    showConfirmButton: false,
                    timer: 1500
                });
              </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phim và thể loại</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Thêm SweetAlert2 -->
    <style>
        h1 {
            text-align: center;
            color: red;
        }
    </style>
</head>

<body>
    <h1>Danh sách phim</h1>
    <a href="?view=quanlyphim&action=create" class="btn btn-primary">Thêm phim</a>
    <table class="table table-bordered">
    <tr>
    <th>ID</th>
    <th>Tên</th>
    <th>Ảnh</th>
    <th>Ngày ra mắt</th>
    <th>Ngày chiếu</th>
    <th>Thời lượng</th>
    <th>Nội dung</th>
    <th>Giới thiệu</th>
    <th>Đạo diễn</th>
    <th>Thể loại</th>
    <th>Status</th>
    <th>Hành động</th>
</tr>
<?php if (!empty($phim)): ?>
    <?php foreach ($phim as $p): ?>
    <tr>
        <td><?= htmlspecialchars($p['id'] ?? '') ?></td>
        <td><?= htmlspecialchars($p['ten'] ?? '') ?></td>
        <td>
            <?php if (!empty($p['image'])): ?>
                <img src="<?= htmlspecialchars($p['image']) ?>" width="100px" height="100px">
            <?php else: ?>
                <span>Không có ảnh</span>
            <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($p['ngayramat'] ?? '') ?></td>
        <td><?= htmlspecialchars($p['ngaychieu'] ?? '') ?></td>
        <td><?= htmlspecialchars($p['thoiluong'] ?? '') ?></td>
        <td><?= htmlspecialchars($p['noidung'] ?? '') ?></td>
        <td><?= htmlspecialchars($p['gioithieu'] ?? '') ?></td>
        <td><?= htmlspecialchars($p['daodien'] ?? '') ?></td>
        <td><?= htmlspecialchars($p['theloai'] ?? '') ?></td>
        <td><?= htmlspecialchars($p['status'] ?? '') ?></td>
        <td>
            <a href="?view=quanlyphim&action=edit&id=<?= urlencode($p['id']) ?>" 
            class="btn btn-warning btn-sm">Chỉnh sửa</a>
            <a href="?view=quanlyphim&action=delete&id=<?= htmlspecialchars($p['id']) ?>" 
               onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="11">Không có dữ liệu phim nào để hiển thị.</td>
    </tr>
<?php endif; ?>

    </table>

    <!-- Thêm thư viện SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
