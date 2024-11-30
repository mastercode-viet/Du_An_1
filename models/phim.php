<?php 
require_once 'models/connectdb.php';
function getall_phim(){
    $conn=pdo_get_connection();
    $sql="SELECT * FROM phim order by id DESC ";
    $stmt =$conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq=$stmt->fetchAll();
    return $kq;

}
?>