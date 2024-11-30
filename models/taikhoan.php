<?php
// function insert_taikhoan($gmail,$user,$pass)
// {
//     $sql = "insert into khach_hang(gmail,user,pass) values('$gmail','$user','$pass')";
//     pdo_execute($sql);
// }
// function checkuser($user,$pass){

//     $sql = "select *from taikhoan where user='" . $user."' and  pass='" . $pass."'";
//     $sp= pdo_query_one($sql); 
//     return $sp;

// }
function insert_taikhoan($gmail, $user, $pass, $ho, $ten) {
    $conn = pdo_get_connection();
    $stmt = $conn->prepare("INSERT INTO khach_hang (gmail, username, password, ho, ten) VALUES (:gmail, :username, :password, :ho, :ten)");

    // Gán giá trị các tham số
    $stmt->bindParam(':gmail', $gmail);
    $stmt->bindParam(':username', $user);
    $stmt->bindParam(':password', $pass);
    $stmt->bindParam(':ho', $ho);
    $stmt->bindParam(':ten', $ten);

    // Thực thi câu lệnh
    return $stmt->execute();
}

?>