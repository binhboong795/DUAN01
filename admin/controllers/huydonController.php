<?php
class huydonController
{
    public $huydonModel;
    function __construct()
    {
        $this->huydonModel = new huydonModel();
    }
    function home()
    {

        require_once 'views/home.php';
    }

    function huydon()
    {
        $listhuy = $this->huydonModel->getAlldonhang();
        require_once 'views/huydon/list.php';
    }

    function deletehuy()
    {
        if ($_GET['id']) {
            $id = $_GET['id'];
            $iddon = $this->huydonModel->deletedonhang($id);
        }
        header('location:index.php?act=huydon');
    }
}
