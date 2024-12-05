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
    // function updateStatus()
    // {
    //     if (isset($_GET['id']) && isset($_POST['bill_status'])) {
    //         $id = (int)$_GET['id']; // Chuyển đổi thành số nguyên để đảm bảo an toàn
    //         $newStatus = $_POST['bill_status']; // Lấy giá trị trạng thái mới từ form

    //         // Lấy trạng thái hiện tại từ database
    //         $currentStatus = $this->statusModel->getCurrentStatusById($id);

    //         // Kiểm tra logic: Không cho phép hủy nếu trạng thái hiện tại không hợp lệ
    //         if (in_array($currentStatus, ['Đang giao hàng', 'Giao hàng thành công']) && $newStatus == 'Hủy') {
    //             $_SESSION['error'] = 'Không thể hủy đơn hàng khi đang giao hàng hoặc đã giao hàng thành công.';
    //             header("Location: ?act=status");
    //             exit;
    //         }

    //         // Cập nhật trạng thái nếu hợp lệ
    //         $this->statusModel->updatePaymentMethod($id, $newStatus);

    //         // Lưu thông báo thành công
    //         $_SESSION['success'] = 'Cập nhật trạng thái thành công.';
    //     } else {
    //         $_SESSION['error'] = 'Dữ liệu không hợp lệ.';
    //     }

    //     header("Location: ?act=status");
    //     exit;
    // }
    function updateStatus()
    {
        if (isset($_GET['id_bill']) && isset($_POST['bill_status'])) {
            $idbill = (int)$_GET['id_bill']; // Lấy idbill từ GET
            $bill_status = $_POST['bill_status']; // Lấy trạng thái từ POST
            // echo "<pre>"; // Kiểm tra dữ liệu từ URL
            // print_r($bill_status);   // Kiểm tra giá trị ID
            // echo "</pre>";
            // exit();
            try {
                // Cập nhật trạng thái hóa đơn trong bảng trangthai
                $this->statusModel->updatePaymentMethod($idbill, $bill_status);

                // Nếu trạng thái là "Giao hàng thành công"
                if ($bill_status == 'Giao hàng thành công') {
                    // // Lấy idbill từ id
                    // $idbill = $this->statusModel->getIdBillById($idbill); // Lấy idbill từ id

                    // Lấy dữ liệu từ orders và trangthai
                    $data = $this->statusModel->getDataForThongKe($idbill);
                    // echo "<pre>"; // Kiểm tra dữ liệu từ URL
                    // print_r($data);   // Kiểm tra giá trị ID
                    // echo "</pre>";
                    // exit();
                    // Chuyển dữ liệu sang bảng thongke
                    if (!empty($data)) {
                        $this->statusModel->moveToThongKe($data);

                        // // (Tùy chọn) Xóa dữ liệu sau khi chuyển
                        // $this->statusModel->deleteBillFromTrangThai($idbill);
                        // $this->statusModel->deleteBillFromOrders($idbill);

                        // Thông báo thành công
                        echo "<script>
                        alert('Bạn đã cập nhật thành công!');
                      
                    </script>";
                    } else {
                        $_SESSION['error'] = "Không có dữ liệu để chuyển!";
                    }
                } else {
                    // Nếu trạng thái không phải "Giao hàng thành công"
                    $_SESSION['message'] = "Cập nhật trạng thái thành công!";
                }
            } catch (Exception $e) {
                // Thông báo lỗi
                $_SESSION['error'] = "Cập nhật trạng thái thất bại: " . $e->getMessage();
            }

            // Chuyển hướng về trang danh sách trạng thái
            header("Location: index.php?act=status");
            exit();
        }
    }




    // function deleteStatus()
    // {
    //     if ($_GET['id']) {
    //         $id = $_GET['id'];
    //         $status = $this->statusModel->deleteBill($id);
    //     }
    //     header("location:?act=status");
    // }
    // function deletebill()
    // {
    //     $idbill = isset($_GET['id_bill']) ? $_GET['id_bill'] : null;

    //     if ($idbill) {
    //         try {
    //             // Gọi model để xóa đơn hàng
    //             $this->statusModel->deleteBill($idbill);

    //             // Thông báo thành công
    //             $_SESSION['message'] = "Đơn hàng đã được xóa thành công!";
    //         } catch (Exception $e) {
    //             // Thông báo lỗi
    //             $_SESSION['error'] = "Xóa đơn hàng thất bại: " . $e->getMessage();
    //         }

    //         // Chuyển hướng về trang danh sách đơn hàng
    //         header("Location: index.php?act=status");
    //         exit();
    //     } else {
    //         echo "ID Bill không hợp lệ!";
    //     }
    // }
    function deletebill()
    {
        $idbill = isset($_GET['id_bill']) ? $_GET['id_bill'] : null;

        if ($idbill) {
            try {
                // Lấy danh sách sản phẩm trong đơn hàng
                $orderItems = $this->statusModel->getOrderItemsByIdBill($idbill);

                // Phục hồi số lượng sản phẩm trong kho
                foreach ($orderItems as $item) {
                    // Gọi hàm restoreProductQuantity để phục hồi số lượng sản phẩm
                    $this->statusModel->restoreProductQuantity($item['id_pro'], $item['soluong']);
                }

                // Gọi model để xóa đơn hàng
                $this->statusModel->deleteBill($idbill);

                // Thông báo thành công
                $_SESSION['message'] = "Đơn hàng đã được xóa và số lượng sản phẩm đã được phục hồi!";
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
