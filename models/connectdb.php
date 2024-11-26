<?php
$servername = "localhost"; // Tên server (thường là localhost)
$username = "root";        // Tên đăng nhập MySQL
$password = "";            // Mật khẩu MySQL (để trống nếu dùng Laragon mặc định)
$dbname = "da1";         // Tên database của bạn

// Tạo hàm kết nối PDO
function pdo_get_connection() {
    global $servername, $username, $password, $dbname; // Sử dụng thông tin kết nối đã khai báo
    $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";
    try {
        $conn = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Kích hoạt chế độ báo lỗi
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Kết quả trả về dạng mảng liên kết
        ]);
        return $conn;
    } catch (PDOException $e) {
        die("Kết nối thất bại: " . $e->getMessage());
    }
}

// Hàm thực thi SQL (INSERT, UPDATE, DELETE)
function pdo_execute($sql) {
    $sql_args = array_slice(func_get_args(), 1); // Lấy các tham số sau câu SQL
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql); // Chuẩn bị câu lệnh
        $stmt->execute($sql_args);   // Thực thi với tham số
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn); // Đóng kết nối
    }
}

// Hàm truy vấn trả về nhiều dòng (SELECT)
function pdo_query($sql) {
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $rows = $stmt->fetchAll(); // Lấy tất cả kết quả
        return $rows;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}

// Hàm truy vấn trả về một dòng (SELECT)
function pdo_query_one($sql) {
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $row = $stmt->fetch(); // Lấy một dòng kết quả
        return $row;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}

// Hàm truy vấn trả về một giá trị (SELECT)
function pdo_query_value($sql) {
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $row = $stmt->fetch(); // Lấy một dòng kết quả
        return $row ? array_values($row)[0] : null; // Trả về giá trị đầu tiên
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}
?>
