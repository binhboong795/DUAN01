<?php
class cmtController
{
    public $cmtModel;
    function __construct()
    {
        $this->cmtModel = new cmtModel();
    }
    function binhluan()
    {

        require_once 'views/binhluan.php';
    }
}
