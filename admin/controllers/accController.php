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
function taikhoan()
{
    $listUser = $this->accModel->getAllUser();
    require_once 'views/taikhoan.php';
}

}
