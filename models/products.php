<?php
// Hiển thị sản phẩm mới
function get_productNew($limit){
    global $conn;
    $sql = "SELECT * FROM phim ORDER BY id DESC LIMIT :limit";
    $conn = pdo_get_connection();
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Hàm kết nối PDO
function pdo_get_connection(){
    try {
        $conn = new PDO('mysql:host=localhost;dbname=ten_database', 'username', 'password');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit();
    }
}
?>
