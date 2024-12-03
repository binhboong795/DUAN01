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
        // $idbill = $this->statusModel->updateIdBillInTrangthai();
        $status = $this->statusModel->getAllStatus();

        require_once 'views/status/status.php';
    }
    function updateStatus()
    {
        if (isset($_GET['id']) && isset($_POST['bill_status'])) {
            $id = (int)$_GET['id']; // Chuyển đổi thành số nguyên để đảm bảo an toàn
            $newStatus = $_POST['bill_status']; // Lấy giá trị trạng thái mới từ form

            // Lấy trạng thái hiện tại từ database
            $currentStatus = $this->statusModel->getCurrentStatusById($id);

            // Kiểm tra logic: Không cho phép hủy nếu trạng thái hiện tại không hợp lệ
            if (in_array($currentStatus, ['Đang giao hàng', 'Giao hàng thành công']) && $newStatus == 'Hủy') {
                $_SESSION['error'] = 'Không thể hủy đơn hàng khi đang giao hàng hoặc đã giao hàng thành công.';
                header("Location: ?act=status");
                exit;
            }

            // Cập nhật trạng thái nếu hợp lệ
            $this->statusModel->updatePaymentMethod($id, $newStatus);

            // Lưu thông báo thành công
            $_SESSION['success'] = 'Cập nhật trạng thái thành công.';
        } else {
            $_SESSION['error'] = 'Dữ liệu không hợp lệ.';
        }

        header("Location: ?act=status");
        exit;
    }



    // function deleteStatus()
    // {
    //     if ($_GET['id']) {
    //         $id = $_GET['id'];
    //         $status = $this->statusModel->deleteBill($id);
    //     }
    //     header("location:?act=status");
    // }
    function deletebill()
    {
        $idbill = isset($_GET['id_bill']) ? $_GET['id_bill'] : null;

        if ($idbill) {
            try {
                // Gọi model để xóa đơn hàng
                $this->statusModel->deleteBill($idbill);

                // Thông báo thành công
                $_SESSION['message'] = "Đơn hàng đã được xóa thành công!";
            } catch (Exception $e) {
                // Thông báo lỗi
                $_SESSION['error'] = "Xóa đơn hàng thất bại: " . $e->getMessage();
            }

            // Chuyển hướng về trang danh sách đơn hàng
            header("Location: index.php?act=status");
            exit();
        } else {
            echo "ID Bill không hợp lệ!";
        }
    }
}
