<?php
class bannerController
{
    public $bannerModel;
    function __construct()
    {
        $this->bannerModel = new bannerModel();
    }
    function banner()
    {
        $listBanner = $this->bannerModel->getAllBanner();
        require_once 'views/banner/banner.php';
    }
    function addBanner()
    {


        if (isset($_POST['btn_add'])) {
            $name = $_POST['name'];
            // Kiểm tra file tải lên
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $img = $_FILES['img']['name'];
                $tmp = $_FILES['img']['tmp_name'];
                move_uploaded_file($tmp, '../assets/img/' . $img);
            } else {
                $img = null;
                echo "không được để trống";
            }

            if ($this->bannerModel->insertBanner($name, $img)) {
                header("Location:?act=banner");
                exit;
            } else {
                echo "Lỗi";
            }
        }
        require_once 'views/banner/insertBanner.php';
    }
    function editBanner()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            // Lấy chi tiết banner từ model
            $idBanner = $this->bannerModel->getIdBanner($id);

            if (!$idBanner) {
                echo "Không tìm thấy banner!";
                return;
            }

            require_once 'views/banner/editBanner.php';

            if (isset($_POST['btn_update'])) {
                $name = $_POST['name'];

                // Kiểm tra nếu có tải file mới
                if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                    $img = $_FILES['img']['name'];
                    $tmp = $_FILES['img']['tmp_name'];
                    move_uploaded_file($tmp, '../assets/img/' . $img);
                } else {
                    $img = $idBanner['img']; // Giữ nguyên ảnh cũ
                }

                if ($this->bannerModel->updateBanner($id, $name, $img)) {
                    header("Location:?act=banner");
                    exit;
                } else {
                    echo "Lỗi cập nhật banner!";
                }
            }
        } else {
            echo "ID không hợp lệ!";
        }
    }

    // function deleteBanner()
    // {
    //     $id = $_GET['id'] ?? null;

    //     if ($id && $this->bannerModel->deleteBanner($id)) {
    //         header("Location:?act=banner");
    //         exit;
    //     } else {
    //         echo "Lỗi xóa banner";
    //     }
    // }
    function deleteBanner()
    {
        if ($_GET['id']) {
            $id = $_GET['id'];
            $idBanner = $this->bannerModel->delete($id);
        }
        header('location:index.php?act=banner');
    }
}
