<?php
include 'db.php'; // Kết nối tới cơ sở dữ liệu

// Kiểm tra nếu tham số 'id' được truyền qua URL và không rỗng
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    $id = trim($_GET['id']); // Lấy giá trị của tham số 'id'

    // Chuẩn bị câu lệnh DELETE
    $sql = "DELETE FROM the_loai WHERE id_theloai = :id";
    if ($stmt = $conn->prepare($sql)) {
        // Gán giá trị tham số
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            // Hiển thị thông báo xóa thành công và chuyển hướng về trang chính
            echo "<script>window.location.href='".SITE_URL."/admin/index.php?view=quanlitheloai'</script>";

        } else {
            // Hiển thị lỗi nếu không xóa được
            echo "Có lỗi xảy ra. Vui lòng thử lại.";
        }

        // Đóng câu lệnh
        unset($stmt);
    }
}

// Đóng kết nối cơ sở dữ liệu
unset($conn);
?>
