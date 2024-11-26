<?php
class statusController
{
    public $statusModel;
    function __construct()
    {
        $this->statusModel = new statusModel();
    }
    function status()
    {
        $status = $this->statusModel->getAllStatus();
        require_once 'views/status/status.php';
    }
    function updateStatus()
    {
        if (isset($_GET['id']) && isset($_POST['bill_status'])) {
            $id = (int)$_GET['id']; // Chuyển đổi thành số nguyên
            $bill_status = $_POST['bill_status']; // Lấy giá trị phương thức thanh toán
            $this->statusModel->updatePaymentMethod($id, $bill_status);
        }
        header("Location: ?act=status");
        exit;
    }


    function deleteStatus()
    {
        if ($_GET['id']) {
            $id = $_GET['id'];
            $status = $this->statusModel->deleteStatus($id);
        }
        header("location:?act=status");
    }
}
