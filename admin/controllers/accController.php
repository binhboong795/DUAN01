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
    function addUser()
    {
        $error = "";

        if (isset($_POST["themmoi"])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $tell = $_POST['tell'];

            if ($user == "" || $pass == "" || $email == "" || $address == "" || $tell == "") {
                $error = "Vui lòng nhập đầy đủ thông tin đăng ký!";
            }elseif(strlen($pass) < 8) {
                $error = "Mật khẩu phải có ít nhất 8 kí tự!";
            }elseif(strlen($email) < 14 || strpos($email, '@gmail.com') === false) {
                $error = "Email quá ngắn và ký tự và phải đúng định dạng!";
            }elseif(!preg_match('/^[0-9]{10}$/', $tell)) {
                $error = "Số điện thoại không hợp lệ!";
            }
            else {
                $mUser = new accModel();
                $addUser = $mUser->insertUser(null, $user, $pass, $email, $address, $tell);
                echo "<script>
                        alert('Bạn đã thêm thành công!');
                        window.location.href='?act=taikhoan';
                    </script>";
            }
        }
        require_once 'views/account/add.php';
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
                $error = "Vui lòng nhập đầy đủ thông tin đăng ký!";
            }elseif(strlen($pass) < 8) {
                $error = "Mật khẩu phải có ít nhất 8 kí tự!";
            }elseif(strlen($email) < 14 || strpos($email, '@gmail.com') === false) {
                $error = "Email quá ngắn và ký tự và phải đúng định dạng!";
            }elseif(!preg_match('/^[0-9]{10}$/', $tell)) {
                $error = "Số điện thoại không hợp lệ!";
            }
            else {
                $mUser = new accModel();
                $registerUser = $mUser->editUser($id, $user, $pass, $email, $address, $tell);
                echo "<script>
                        alert('Bạn đã cập nhật thành công!');
                        window.location.href='?act=taikhoan';
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
