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




    function taikhoan()
    {
        $listUser = $this->accModel->getAllUser();
        require_once 'views/account/taikhoan.php';
    }
    function editUser()
    {
        if ($_GET['id']) {
            $id = $_GET['id'];
            $idUser = $this->accModel->getIdUser($id);
        }

        $error = "";

        if (isset($_POST["capnhat"])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $tell = $_POST['tell'];

            if ($user == "" || $pass == "" || $email == "" || $address == "" || $tell == "") {
                $error = "Vui lòng nhập đầy đủ thông tin!";
            } else {
                $mUser = new accModel();
                $editUser = $mUser->editUser(null, $user, $pass, $email, $address, $tell);
                echo "<script>
                        alert('Bạn đã cập nhật thành công!');
                        window.location.href='index.php?act=taikhoan';
                    </script>";
            }
        }
        require_once 'views/account/edit.php';
    }

    function deleteUser()
    {
        if ($_GET['id']) {
            $id = $_GET['id'];
            $idUser = $this->accModel->deleteUser($id);
        }
        header('location:index.php?act=taikhoan');
    }
}
