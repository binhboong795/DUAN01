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
            $id = $this->danhmucModel->deleteDanhmuc($id);
        }
        header('location:index.php?act=danhmuc');
    }
    function addDanhmuc()
    {
        if (isset($_POST['themmoi'])) {
            $name = $_POST['name'];
            $this->danhmucModel->addDanhmuc($name);
            // Chuyển hướng sau khi thêm thành công
            header('location:index.php?act=danhmuc');
            exit; // Dừng script ngay sau khi chuyển hướng
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
