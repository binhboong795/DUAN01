<?php
session_start();
require_once 'models/homeModel.php';
class homeController
{
    public $homeModel;
    function __construct()
    {
        $this->homeModel = new homeModel();
    }
    function home()
    {
        $product = $this->homeModel->allProduct();
        require_once 'views/home.php';
    }
    // function detailPro($id) {
    // $productOne=$this->homeModel->findProductById($id);
    // require_once 'views/detailProduct.php';
    // }
    function shop()
    {
        $product = $this->homeModel->allProductShop();
        require_once 'views/shop.php';
    }
    function shopDetail($id)
    {
        $productOne = $this->homeModel->findProductById($id);
        $comments=$this->homeModel->getCommentById($id);
        require_once 'views/shopDetail.php';
    }

    function contact()
    {
        require_once 'views/contact.php';

    }
    function cart()
    {
        require_once 'views/cart.php';
    }
    function testimonial()
    {
        require_once 'views/testimonial.php';
    }
    function error()
    {
        require_once 'views/404.php';
    }
    function chackout()
    {
        require_once 'views/chackout.php';
    }
    function registerUser()
    {
        $error = "";

        if (isset($_POST["dangky"])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $email = $_POST['email'];

            if ($user == "" || $pass == "" || $email == "") {
                $error = "Vui lòng nhập đầy đủ thông tin đăng ký!";
            } else {
                $mUser = new homeModel();
                $registerUser = $mUser->insertUser(null, $user, $pass, $email);
                echo "<script>
                        alert('Bạn đã đăng ký thành công!');
                        window.location.href='?act=dangnhap';
                    </script>";
            }
        }
        require_once 'views/taikhoan/dangky.php';
    }
    function login() {
        // Include view
    
        if (isset($_POST['dangnhap'])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $userInfo = $this->homeModel->checkAcc($user, $pass);

            if ($userInfo) {  // Nếu thông tin người dùng tồn tại
                // Lưu thông tin vào session
                $_SESSION['user'] = [
                    'username' => $userInfo['user'], // Giả sử cột tên là `user`
                    'email' => $userInfo['email'],  // Giả sử cột tên là `email`
                    'id' => $userInfo['id']
                ]; // Lưu tên tài khoản vào session
                header('Location:index.php'); // Chuyển hướng về trang chủ
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

    function quenmk()
{
    $error = "";

    if (isset($_POST["doimatkhau"])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        // Kiểm tra xem email có tồn tại trong cơ sở dữ liệu không
        $mUser = new homeModel();
        $userExists = $mUser->checkEmailExists($email); // Kiểm tra email

        if ($email == "" || $pass == "") {
            $error = "Vui lòng nhập đầy đủ thông tin!";
        } elseif (!$userExists) {
            $error = "Email không tồn tại!";
        } else {
            // Cập nhật mật khẩu mới
            $updatePassword = $mUser->updatePassword($email, $pass);
            if ($updatePassword) {
                echo "<script>
                        alert('Bạn đã thay đổi mật khẩu thành công!');
                        window.location.href='?act=dangnhap';
                    </script>";
            } else {
                $error = "Lỗi khi cập nhật mật khẩu!";
            }
        }
    }

    require_once 'views/taikhoan/quenmk.php'; // Giao diện để người dùng nhập thông tin
}

    function addComment()
    {
        if (isset($_POST['comment']) && isset($_SESSION['user']) && isset($_GET['id'])) {
            $noidung = $_POST['comment'];
            $iduser = $_SESSION['user']['id']; // Lấy ID người dùng từ session
            $idpro = $_GET['id']; // ID sản phẩm
            $ngaybinhluan = date('Y:m:d');
            $rating=isset($_POST['rating'])? (int)$_POST['rating']:5;
            if ($noidung !== "") {
                // Gọi phương thức saveComment để lưu vào cơ sở dữ liệu
                $this->homeModel->insertComment(null, $noidung, $iduser, $idpro, $ngaybinhluan,$rating);
                // echo "<script>alert('Bình luận của bạn đã được lưu!');</script>";
                header("Location: index.php?act=shopdetail&id={$idpro}"); // Chuyển hướng về chi tiết sản phẩm
                exit;
            } else {
                echo "<script>
                        alert('Vui lòng nhập bình luận!');
                        window.location.href='?act=shopdetail&id={$idpro}';
                    </script>";
                
            }
        } else {
            echo "<script>alert('Vui lòng đăng nhập để bình luận.');</script>";
        }
    }
    
   
}