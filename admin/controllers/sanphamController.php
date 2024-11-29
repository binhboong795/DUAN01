<?php
class sanphamController
{
    public $sanphamModel;
    function __construct()
    {
        $this->sanphamModel = new sanphamModel();
    }

    function sanpham()
    {
        $product = $this->sanphamModel->allProduct();
        require_once 'views/sanpham/listsp.php';
    }


    function add()
    {
        require_once 'views/sanpham/addsp.php';
        if (isset($_POST['btn_add'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $img = $_FILES['img']['name'];
            $tmp = $_FILES['img']['tmp_name'];
            move_uploaded_file($tmp, '../assets/img/' . $img);
            $mota = $_POST['mota'];
            $luotxem = $_POST['luotxem'];
            $iddm = $_POST['iddm'];
            $motachitiet = $_POST['motachitiet'];
            $soluong = $_POST['soluong'];

            if ($this->sanphamModel->add($name, $price, $img, $mota, $luotxem, $iddm, $motachitiet, $soluong)) {
                header("Location: ?act=sanpham");
            } else {
                echo "Lỗi khi thêm sản phẩm.";
            }
        }
    }
    function editsp()
    {
        $id = $_GET['id'] ?? null; // Lấy ID từ URL

        if (!$id) {
            echo "ID không hợp lệ!";
            return;
        }

        // Lấy thông tin sản phẩm từ model
        $sanpham = $this->sanphamModel->getProductById($id);

        if (!$sanpham) {
            echo "Không tìm thấy sản phẩm!";
            return;
        }

        // Nếu form được submit
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_update'])) {
            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? 0;
            $mota = $_POST['mota'] ?? '';
            $luotxem = $_POST['luotxem'] ?? 0;
            $iddm = $_POST['iddm'] ?? 0;
            $motachitiet = $_POST['motachitiet'] ?? '';
            $soluong = $_POST['soluong'] ?? 0;

            // Xử lý ảnh
            $img = $sanpham['img']; // Mặc định là ảnh cũ
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $img = $_FILES['img']['name'];
                $tmp = $_FILES['img']['tmp_name'];
                $uploadDir = '../assets/img/';

                // Kiểm tra thư mục tồn tại, nếu không thì tạo mới
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Di chuyển file tải lên
                move_uploaded_file($tmp, $uploadDir . $img);
            }

            // Gọi model để cập nhật sản phẩm
            $updated = $this->sanphamModel->editsp($id, $name, $price, $img, $mota, $luotxem, $iddm, $motachitiet, $soluong);

            if ($updated) {
                header("Location: ?act=sanpham");
                exit;
            } else {
                echo "Lỗi cập nhật sản phẩm!";
            }
        }

        // Gửi dữ liệu sản phẩm tới view
        require_once 'views/sanpham/editsp.php';
    }


    function deleteProduct()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if (!$id) {
            echo "<script>alert('Không tìm thấy sản phẩm để xóa!'); window.location.href='index.php?act=sanpham';</script>";
            return;
        }

        // Gọi model để xóa sản phẩm
        $success = $this->sanphamModel->delete($id);

        if ($success) {
            echo "<script>
                alert('Xóa sản phẩm thành công!');
                window.location.href='index.php?act=sanpham';
              </script>";
        } else {
            echo "<script>
                alert('Đã xảy ra lỗi khi xóa sản phẩm!');
                window.location.href='index.php?act=sanpham';
              </script>";
        }
    }
}
