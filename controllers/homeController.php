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
    $product=$this->homeModel->allProductShop($id);
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
}
?>