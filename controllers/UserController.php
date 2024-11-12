<?php
class userController {
    public $userodel;
    function __construct() {
        $this->userModel = new userModel();
    }
    function dangky() {
        if (isset($_POST["dangky"])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $email = $_POST['email'];

            if ($user == "" || $pass == "" || $email == "") {
                echo "Vui lòng nhập đầy đủ thông tin đăng ký!";
                header('Location: index.php');
            } else {
                $mUser = new userModel();
                $registerUser = $mUser->insertUser(null, $user, $pass, $email);
                echo "Bạn đã đăng ký thành công!";
            }
        }
        include_once 'views/dangky.php';
    }
    function login() {
        $mUser = new userModel();
        $login = $mUser->login();
        include_once 'views/dangnhap.php';
    }
    function dangxuat() {
            header('location: views/dangnhap.php');
        }
}
?>