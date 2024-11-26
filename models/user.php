<?php 
include_once 'connectdb.php';
function checkuser($username, $password) {
    // Kết nối tới cơ sở dữ liệu
    $conn = pdo_get_connection();

    // Chuẩn bị câu truy vấn
    $stmt = $conn->prepare("SELECT * FROM khach_hang WHERE username = :username AND password = :password");

    // Gán giá trị cho các tham số trong truy vấn
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    // Thực thi truy vấn
    $stmt->execute();

    // Lấy kết quả
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Trả về kết quả (nếu không tìm thấy sẽ trả về null)
    $kq =$stmt->fetchAll();
    if(count($kq)>0) return $kq[0]['role'];
    else return 0;
}   
function getuserinfor($username, $password) {
    // Kết nối tới cơ sở dữ liệu
    $conn = pdo_get_connection(); // Đổi thành pdo_get_connection()

    // Chuẩn bị câu truy vấn
    $stmt = $conn->prepare("SELECT * FROM khach_hang WHERE username = :username AND password = :password");

    // Gán giá trị cho các tham số trong truy vấn
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    // Thực thi truy vấn
    $stmt->execute();

    // Lấy một dòng kết quả (dùng fetch nếu chỉ cần dòng đầu tiên)
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Trả về kết quả (nếu không tìm thấy trả về null)
    return $result;
}

       

  
?>