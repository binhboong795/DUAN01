<?php
    class UserController {
        public function registerUser() {
            if (isset($_POST["dangky"])) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $email = $_POST['email'];

                if ($user == "" || $pass == "" || $email == "") {
                    echo "Vui lòng nhập đầy đủ thông tin đăng ký!";
                    // header('Location: index.php');
                } else {
                    $mUser = new User();
                    $registerUser = $mUser->insertUser(null, $user, $pass, $email);
                    echo "Bạn đã đăng ký thành công!";
                }
            }
            include_once 'views/dangky.php';
        }
        
        public function login() {
            $mUser = new User();
            $login = $mUser->login();
            include_once 'views/dangnhap.php';
        }
        public function dangxuat() {
            header('location: views/dangnhap.php');
        }
        
    }
?>