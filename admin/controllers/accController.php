<?php
class accController
{
    public $accModel;
    function __construct()
    {
        $this->accModel = new accModel();
    }
    function home()
    {

        require_once 'views/home.php';
    }
    function sanpham()
    {

        require_once 'views/sanpham.php';
    }
    function danhmuc()
    {

        require_once 'views/danhmuc.php';
    }
    function binhluan()
    {

        require_once 'views/binhluan.php';
    }
    function banner()
    {

        require_once 'views/banner.php';
    }
    function taikhoan()
    {
        $listUser = $this->accModel->getAllUser();
        require_once 'views/account/taikhoan.php';
    }
    function editUser()
    {
        $edituser = $this->accModel->updateUser();
        require_once 'views/edit.php';
    }
}
