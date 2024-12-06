<?php
class danhmucController
{
    public $danhmucModel;
    function __construct()
    {
        $this->danhmucModel = new danhmucModel();
    }
    function danhmuc()
    {
        $listDanhmuc = $this->danhmucModel->getAllDanhmuc();
       
        require_once 'views/danhmuc/danhmuc.php';
    }
    function deleteDanhmuc()
    {
        if ($_GET['id']) {
            $id = $_GET['id'];
            if ($this->danhmucModel->checkDanhmucHasProducts($id)) {
                // Nếu có sản phẩm, hiển thị thông báo lỗi
                $errorMessage = "Không thể xóa danh mục vì danh mục này đang chứa sản phẩm!";
                $listDanhmuc = $this->danhmucModel->getAllDanhmuc();
                require_once 'views/danhmuc/danhmuc.php';
                return;
            }
            $id = $this->danhmucModel->deleteDanhmuc($id);
        }
        header('location:index.php?act=danhmuc');
    }
    function addDanhmuc()
    {
        $error="";
        if(isset($_POST['themmoi'])){
            $name = trim($_POST['name']);
            if($name==""){
                $error="Vui long nhap ten danh muc";
            }else{
                $this->danhmucModel->addDanhmuc($name);
                // Chuyển hướng sau khi thêm thành công
                header('location:index.php?act=danhmuc');
                exit;
            }
        }
        require_once 'views/danhmuc/addDanhmuc.php';
    }
    function editDanhmuc()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $iddm = $this->danhmucModel->getIdDanhmuc($id);
            if (isset($_POST['update_danhmuc'])) {
                $name = $_POST['name'];
                $this->danhmucModel->updateDanhmuc($id, $name);
                header('location:index.php?act=danhmuc');
                exit;
            }
        }
        require_once 'views/danhmuc/editDanhmuc.php';
    }
}
