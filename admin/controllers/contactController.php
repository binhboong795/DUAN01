<?php
class contactController
{
    public $contactModel;
    function __construct()
    {
        $this->contactModel = new contactModel();
    }
    function lienhe()
    {
        $contact = $this->contactModel->getAll();
        require_once 'views/lienhe/lienhe.php';
    }
    function deleteContact()
    {
        if ($_GET['id']) {
            $id = $_GET['id'];
            $id = $this->contactModel->delete($id);
        }
        header('location:index.php?act=lienhe');
    }
    function editContact()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $idContact = $this->contactModel->getId($id);
            if (isset($_POST['capnhat'])) {
                $name = $_POST['name'];
                $sdt = $_POST['sdt'];
                $mail = $_POST['mail'];
                $noidung = $_POST['noidung'];
                $this->contactModel->update($name, $sdt, $mail, $noidung, $id);
                header('location:index.php?act=lienhe');
                exit;
            }
        }
        require_once 'views/lienhe/edit.php';
    }
}
