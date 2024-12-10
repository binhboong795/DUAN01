<?php

class detailController
{
    public $detailModel;
    function __construct()
    {
        $this->detailModel = new detailModel();
    }
    function shopDetail($id)
    {
        // Gọi model để cập nhật số lượt xem
        $this->detailModel->increaseViews($id);
        $productOne = $this->detailModel->findProductById($id);
        $comments = $this->detailModel->getCommentById($id);

        if (isset($_SESSION['user'])) {
            $iduser = $_SESSION['user']['id'];
            // Lấy tổng số lượng sản phẩm trong giỏ hàng
            $totalQuantity = $this->detailModel->getTotalQuantity($iduser);
            // Lấy thông tin chi tiết sản phẩm
            $product = $this->detailModel->findProductById($id);
        }
        $ratingData = $this->detailModel->getTbStart($id);

        // Tính các giá trị để hiển thị số sao
        $tbStart = round($ratingData['tbStart'], 1); // Làm tròn sao trung bình đến 1 chữ số thập phân
        $sumStart = $ratingData['sumStart'];

        $fullStart = floor($tbStart); // Phần nguyên là số sao đầy
      
        require_once 'views/shopDetail.php';
    }
}
