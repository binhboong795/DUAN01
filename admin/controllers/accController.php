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
            $role = $_POST['role'];

            if ($user == "" || $pass == "" || $email == "" || $address == "" || $tell == "") {
                $error = "Vui lòng nhập đầy đủ thông tin đăng ký!";
            } elseif (strlen($pass) < 8) {
                $error = "Mật khẩu phải có ít nhất 8 kí tự!";
            } elseif (strlen($email) < 14 || strpos($email, '@gmail.com') === false) {
                $error = "Email quá ngắn và ký tự và phải đúng định dạng!";
            } elseif (!preg_match('/^[0-9]{10}$/', $tell)) {
                $error = "Số điện thoại không hợp lệ!";
            } else {
                $mUser = new accModel();
                $addUser = $mUser->insertUser(null, $user, $pass, $email, $address, $tell, $role);
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
            $role = $_POST['role'];

            if ($user == "" || $pass == "" || $email == "" || $address == "" || $tell == "") {
                $error = "Vui lòng nhập đầy đủ thông tin đăng ký!";
            } elseif (strlen($pass) < 8) {
                $error = "Mật khẩu phải có ít nhất 8 kí tự!";
            } elseif (strlen($email) < 14 || strpos($email, '@gmail.com') === false) {
                $error = "Email quá ngắn và ký tự và phải đúng định dạng!";
            } elseif (!preg_match('/^[0-9]{10}$/', $tell)) {
                $error = "Số điện thoại không hợp lệ!";
            } else {
                $mUser = new accModel();
                $registerUser = $mUser->editUser($id, $user, $pass, $email, $address, $tell, $role);
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
    function registerUser()
    {
        $error = "";

        if (isset($_POST["dangky"])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $tell = $_POST['tell'];

            if ($user == "" || $pass == "" || $email == "" || $address == "" || $tell == "") {
                $error = "Vui lòng nhập đầy đủ thông tin đăng ký!";
            } elseif (strlen($pass) < 8) {
                $error = "Mật khẩu phải có ít nhất 8 kí tự!";
            } elseif (strlen($email) < 14 || strpos($email, '@gmail.com') === false) {
                $error = "Email quá ngắn và ký tự và phải đúng định dạng!";
            } elseif (!preg_match('/^[0-9]{10}$/', $tell)) {
                $error = "Số điện thoại không hợp lệ!";
            } else {
                $mUser = new homeModel();
                $registerUser = $mUser->insertUser(null, $user, $pass, $email, $address, $tell);
                echo "<script>
                        alert('Bạn đã đăng ký thành công!');
                        window.location.href='?act=dangnhap';
                    </script>";
            }
        }
        require_once 'views/taikhoan/dangky.php';
    }
    function login()
    {
        if (isset($_POST['dangnhap'])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];

            // Lấy thông tin người dùng từ cơ sở dữ liệu
            $userInfo = $this->accModel->checkAcc($user, $pass);

            if ($userInfo) { // Nếu thông tin người dùng tồn tại
                // Kiểm tra role từ cơ sở dữ liệu và chuyển hướng phù hợp
                if ($userInfo['role'] == 1) {
                    header('Location: ?act=/'); // Chuyển hướng về admin nếu là admin
                    exit;
                }

                // Lưu thông tin vào session
                $_SESSION['user'] = [
                    'username' => $userInfo['user'],
                    'email' => $userInfo['email'],
                    'role' => $userInfo['role'],
                    'id' => $userInfo['id']
                ];
                header('Location:http://localhost/Duan1/'); // Chuyển hướng về trang chủ
                exit;
            } else {
                $error = "Đăng nhập thất bại! Tài khoản hoặc mật khẩu không đúng";
            }
        }
        require_once 'views/taikhoan/dangnhap.php';
    }


    function logout()
    {
        unset($_SESSION['user']);
        header('Location:index.php');
    }
}
