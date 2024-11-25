<?php
class sanphamController
{
    public $sanphamModel;
    function __construct()
    {
        $this->sanphamModel = new sanphamModel();
    }
    function sanpham()
    {

        require_once 'views/sanpham.php';
    }
}
