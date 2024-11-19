<?php 
class DanhMucController{
    // hiển thị danh sách
    // kết nối đến model
    public $modelDanhMuc;
    public function __construct()
    {
        $this -> $modelDanhMuc = new DanhMuc();
    }
    public function index(){
         $danhmucs = $this->$modelDanhMuc->getAll();
         var_dump($danhmucs);
         require_once './admin/views/danhmuc/listtheloai.php';
    }
    // thêm
    public function create(){

    }
    // thêm cơ sở dữ liệu
    public function store(){

    }
    // hàm hiển thị form sửa
    public function edit(){

    }
    // hàm xử lý cập nhật dữ liệu vào csdl
    public function update(){

    }
    // xóa trong cơ sở dữ liệu
    public function destroy(){

    }
}
?>