<?php
include 'db.php';

// Truy vấn lấy danh sách thể loại
$sql = "SELECT * FROM rap";  // Câu lệnh SQL để lấy dữ liệu
$stmt = $conn->prepare($sql);    // Chuẩn bị câu lệnh SQL

try {
    // Thực thi câu lệnh
    $stmt->execute(); 

    // Lấy dữ liệu từ cơ sở dữ liệu
    $rap = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($rap)) {
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
    <title>Quản lý rap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        h1 {
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>
    <h1>Danh sách rap</h1>
    <a href="?view=quanlirap&action=create" class="btn btn-primary">Thêm rap</a>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>địa chỉ</th>
            <th>số lượng</th>
            <th>Sửa và Xóa</th>
        </tr>
        <?php if (!empty($rap) && is_array($rap)): ?>
            <?php foreach ($rap as $raps): ?>
            <tr>
                <td><?= htmlspecialchars($raps['id']) ?></td>
                <td><?= htmlspecialchars($raps['ten']) ?></td>
                <td><?= htmlspecialchars($raps['diachi']) ?></td>
                <td><?= htmlspecialchars($raps['soluong']) ?></td>

                <td>
                    <a href="edit.php?id=<?= htmlspecialchars($raps['id']) ?>">Chỉnh sửa</a>
                    <a href="delete.php?id=<?= htmlspecialchars($raps['id']) ?>" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
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
