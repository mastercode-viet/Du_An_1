<?php
// Bắt đầu output buffering để ngăn chặn việc gửi output trước khi thay đổi header
ob_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);


// Kết nối cơ sở dữ liệu
include 'db.php'; // Đảm bảo đường dẫn đúng đến file db.php

// Kiểm tra nếu có id phim cần xóa và id đó là số
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Bắt đầu giao dịch (transaction) để đảm bảo cả hai câu lệnh xóa đều thành công
        $conn->beginTransaction();

        // Xóa các thể loại liên kết với phim trong bảng trung gian
        $delete_the_loai_sql = "DELETE FROM the_loai_phim WHERE id_phim = :id";
        $delete_stmt = $conn->prepare($delete_the_loai_sql);
        $delete_stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $delete_stmt->execute();

        // Xóa phim khỏi bảng phim
        $delete_phim_sql = "DELETE FROM phim WHERE id = :id";
        $delete_phim_stmt = $conn->prepare($delete_phim_sql);
        $delete_phim_stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $delete_phim_stmt->execute();

        // Cam kết (commit) giao dịch
        $conn->commit();

        // Thiết lập thông báo thành công vào session
        $_SESSION['success'] = 'Phim đã được xóa thành công!';

        ob_clean(); 
        // Chuyển hướng về trang quản lý phim
        // header("Location: /admin/index.php?view=quanlyphim"); 
        echo "<script>window.location.href='".SITE_URL."/admin/index.php?view=quanlyphim'</script>";
        exit();  // Dừng thực thi sau khi chuyển hướng

    } catch (PDOException $e) {
        // Nếu có lỗi xảy ra, thực hiện rollback (hủy bỏ) giao dịch
        $conn->rollBack();

        // Lưu thông báo lỗi vào session
        $_SESSION['error'] = 'Lỗi khi xóa phim: ' . $e->getMessage();

        // Chuyển hướng về trang quản lý phim
        // header("Location: /admin/index.php?view=quanlyphim"); // Điều hướng về trang quản lý phim
         echo "<script>window.location.href='".SITE_URL."/admin/index.php?view=quanlyphim'</script>";
        // echo 'Xóa thành công. bấm vào <a href="">đây để tiếp tục</a>'
        exit();  // Dừng thực thi sau khi chuyển hướng
    }
} else {
    // Nếu không có ID hoặc ID không hợp lệ, thông báo lỗi
    $_SESSION['error'] = 'ID phim không hợp lệ.';

    // Chuyển hướng về trang quản lý phim
    // header("Location: /admin/index.php?view=quanlyphim"); // Điều hướng về trang quản lý phim
    echo "<script>window.location.href='".SITE_URL."/admin/index.php?view=quanlyphim'</script>";

    exit();  // Dừng thực thi sau khi chuyển hướng
}

// Kết thúc output buffering
ob_end_flush(); // Gửi tất cả output đã được buffer cho trình duyệt
?>
