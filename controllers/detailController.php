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

        require_once 'views/shopDetail.php';
    }
}
