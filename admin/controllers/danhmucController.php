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

        require_once 'views/danhmuc.php';
    }
}
