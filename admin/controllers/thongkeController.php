<?php
class thongkeController
{
    public $thongkeModel;
    function __construct()
    {
        $this->thongkeModel = new thongkeModel();
    }
    function thongke()
    {
        // $idbill = $this->statusModel->updateIdBillInTrangthai();
        $thongke = $this->thongkeModel->getAllStk();

        require_once 'views/thongke.php';
    }

    function deletebill()
    {
        $idbill = isset($_GET['tk_idbill']) ? $_GET['tk_idbill'] : null;

        if ($idbill) {
            try {
                // Gọi model để xóa đơn hàng
                $this->thongkeModel->deleteBill($idbill);

                // Thông báo thành công
                $_SESSION['message'] = "Đơn hàng đã được xóa thành công!";
            } catch (Exception $e) {
                // Thông báo lỗi
                $_SESSION['error'] = "Xóa đơn hàng thất bại: " . $e->getMessage();
            }

            // Chuyển hướng về trang danh sách đơn hàng
            header("Location: index.php?act=thongke");
            exit();
        } else {
            echo "ID Bill không hợp lệ!";
        }
    }
}
