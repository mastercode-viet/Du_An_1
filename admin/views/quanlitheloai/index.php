<?php
include 'db.php';

// Truy vấn lấy danh sách thể loại
$sql = "SELECT * FROM the_loai";  // Câu lệnh SQL để lấy dữ liệu
$stmt = $conn->prepare($sql);    // Chuẩn bị câu lệnh SQL

try {
    // Thực thi câu lệnh
    $stmt->execute();

    // Lấy dữ liệu từ cơ sở dữ liệu
    $theloai = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($theloai)) {
        echo "Không có dữ liệu thể loại nào.";
    }
} catch (PDOException $e) {
    // Xử lý lỗi nếu có
    echo "Lỗi truy vấn: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý thể loại phim</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        h1 {
            text-align: center;
            color: red;
        }
    </style>
</head>

<body>
    <h1>Danh sách thể loại phim</h1>
    <a href="?view=quanlitheloai&action=create" class="btn btn-primary">Thêm thể loại</a>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Status</th>
            <!-- <th>ảnh</th> -->
            <th>Sửa và Xóa</th>
        </tr>
        <?php if (!empty($theloai) && is_array($theloai)): ?>
            <?php foreach ($theloai as $theloais): ?>
                <tr>
                    <td><?= htmlspecialchars($theloais['id_theloai']) ?></td>
                    <td><?= htmlspecialchars($theloais['ten']) ?></td>
                    <td><?= htmlspecialchars($theloais['status']) ?></td>

                    <td>
                        <a href="edit.php?id=<?= htmlspecialchars($theloais['id_theloai']) ?>">Chỉnh sửa</a>
                        <a href="delete.php?id=<?= htmlspecialchars($theloais['id_theloai']) ?>" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Không có dữ liệu thể loại nào để hiển thị.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>

</html>