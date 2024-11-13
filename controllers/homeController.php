<?php
    require_once 'models/homeModel.php';
    class homeController{
    public $homeModel;
    function __construct() {
    $this->homeModel=new homeModel();
    }
    function home() {
    $product=$this->homeModel->allProduct();
    require_once 'views/home.php';
    }
    // function detailPro($id) {
    // $productOne=$this->homeModel->findProductById($id);
    // require_once 'views/detailProduct.php';
    // }
    function shop() {
    $product=$this->homeModel->allProductShop();
    require_once 'views/shop.php';
    }
    function shopDetail($id) {
    $productOne=$this->homeModel->findProductById($id);
    require_once 'views/shopDetail.php';
    }
    function contact(){
    require_once 'views/contact.php';
    }
    function cart(){
    require_once 'views/cart.php';
    }
    function testimonial(){
    require_once 'views/testimonial.php';
    }
    function error(){
    require_once 'views/404.php';
    }
    function chackout(){
    require_once 'views/chackout.php';
    }
    function registerUser() {
        if (isset($_POST["dangky"])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $email = $_POST['email'];

            if ($user == "" || $pass == "" || $email == "") {
                echo "Vui lòng nhập đầy đủ thông tin đăng ký!";
                // header('Location: index.php');
            } else {
                $mUser = new homeModel();
                $registerUser = $mUser->insertUser(null, $user, $pass, $email);
                echo "<script>
                alert('Đăng ký thành công!!!');
                window.location.href='?act=dangnhap';
                </script>";
            }
        }
        require_once 'views/dangky.php';
    }
    
    function login() {
        // Include view
        require_once 'views/dangnhap.php';
    
        if (isset($_POST['dangnhap'])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
    
            // Kiểm tra tài khoản
            if ($this->homeModel->checkAcc($user, $pass) > 0) {
                $_SESSION['user'] = $user; // Lưu tên tài khoản vào session
                header('Location:index.php'); // Chuyển hướng về trang chủ
                exit;
            } else {
                echo "<p style='color: red;'>Đăng nhập thất bại! Tài khoản hoặc mật khẩu không đúng.</p>";
            }
        }
    }
    
    function logout(){
        unset($_SESSION['user']);
        header('Location:index.php');
    }
}
?>