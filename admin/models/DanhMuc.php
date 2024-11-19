<?php
    class DanhMuc{
        public $conn;
//kết nối csdl
        public function __construct()
        {
            $this->conn = connectDB();
        }
        // danh sách danh mục
        public function getAll(){
            try{
                $sql = 'SELECT * from the_loai';

                $stmt = $this ->conn->prepare($sql);

                $stmt->execute();
                return $stmt->fetchAll();
            }catch (PDOException $e){
                echo 'lỗi:' .$e->getMessage();
            }
        }
        // HỦY KẾT NỐI CSDL
        public function __destruct()
        {
            $this ->conn = null;
        }
    }
    ?>