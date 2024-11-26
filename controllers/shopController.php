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
        $cam = $this->shopModel->findCate('1');
        $nho = $this->shopModel->findCate('2');
        $chuoi = $this->shopModel->findCate('3');
        $man = $this->shopModel->findCate('4');
        $nhoxanh = $this->shopModel->findCate('5');
        $taomeo = $this->shopModel->findCate('6');
        $products = [];
        $products = [];
        $categoryId = isset($_GET['category']) ? $_GET['category'] : null; // Lấy ID danh mục từ URL
        $priceRange = isset($_GET['priceRange']) ? $_GET['priceRange'] : null; // Lấy khoảng giá từ URL

        // Xử lý lọc sản phẩm
        if ($categoryId && $priceRange) {
            switch ($priceRange) {
                case '<3':
                    $products = $this->shopModel->getProductbyDanhmuc($categoryId, 0, 3);
                    break;
                case '3-6':
                    $products = $this->shopModel->getProductbyDanhmuc($categoryId, 3, 6);
                    break;
                case '>6':
                    $products = $this->shopModel->getProductbyDanhmuc($categoryId, 6);
                    break;
                default:
                    $products = $this->shopModel->allProductShop();
                    break;
            }
        } elseif ($categoryId) {
            $products = $this->shopModel->getProductbyDanhmuc($categoryId, 0); // Lấy tất cả sản phẩm theo danh mục
        } elseif ($priceRange) {
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
            $products = $this->shopModel->allProductShop(); // Lấy tất cả sản phẩm nếu không có bộ lọc
        }
       


        $danhmuc = $this->shopModel->allDanhmuc();

        if (isset($_SESSION['user'])) {
            $iduser = $_SESSION['user']['id'];
            // Lấy tổng số lượng sản phẩm trong giỏ hàng
            $totalQuantity = $this->shopModel->getTotalQuantity($iduser);
        }

        require_once 'views/shop.php';
    }
    function categories($id)
    {
        // Gọi model để cập nhật số lượt xem



        require_once 'views/shop.php';
    }
}
