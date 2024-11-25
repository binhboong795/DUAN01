<?php

class shopController
{
    public $shopModel;
    function __construct()
    {
        $this->shopModel = new shopModel();
    }
    function shop()
    {

        $products = [];
        if (isset($_GET['priceRange'])) {
            $priceRange = $_GET['priceRange'];
            switch ($priceRange) {
                case '<3':
                    $products = $this->shopModel->getPrice(0, 3);
                    break;
                case '3-6':
                    $products = $this->shopModel->getPrice(3, 6);
                    break;
                case '>6':
                    $products = $this->shopModel->getPrice(6);
                    break;
                default:
                    $products = $this->shopModel->allProductShop();
                    break;
            }
        } else {
            $products = $this->shopModel->allProductShop();
        }
        $danhmuc = $this->shopModel->allDanhmuc();

        if (isset($_SESSION['user'])) {
            $iduser = $_SESSION['user']['id'];
            // Lấy tổng số lượng sản phẩm trong giỏ hàng
            $totalQuantity = $this->shopModel->getTotalQuantity($iduser);
        }

        require_once 'views/shop.php';
    }
}
