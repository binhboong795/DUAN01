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
        $listsp = $this->sanphamModel->getAllSP();
        require_once 'views/sanpham.php';
    }  
    
    function addProduct(){
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
            
            if ($this->sanphamModel->insertProduct(null, $name, $price, $img, $mota, $luotxem, $iddm, $motachitiet, $soluong)) {
                header("Location: ?act=add");
            } else {
                echo "Lỗi khi thêm sản phẩm.";
            }
        }
        require_once 'views/sanpham/addsp.php';      
    }
//     function editsp()
// {
//     $id = isset($_GET['id']) ? $_GET['id'] : null;
//     if (!$id) {
//         echo "<script>alert('Không tìm thấy sản phẩm!'); window.location.href='index.php?act=danhsach';</script>";
//         return;
//     }

//     // Lấy thông tin sản phẩm
//     $product = $this->sanphamModel->allProduct($id); 
//     if (!$product) {
//         echo "<script>alert('Sản phẩm không tồn tại!'); window.location.href='index.php?act=danhsach';</script>";
//         return;
//     }

//     $error = "";

//     if (isset($_POST["capnhat"])) {
//         $name = $_POST['name'];
//         $price = $_POST['price'];
//         $mota = $_POST['mota'];
//         $luotxem = $_POST['luotxem'];
//         $motachitiet = $_POST['motachitiet'];
//         $soluong = $_POST['soluong'];

//         // Xử lý ảnh
//         if (!empty($_FILES['img']['name'])) {
//             $img = $_FILES['img']['name'];
//             $tmp = $_FILES['img']['tmp_name'];
//             move_uploaded_file($tmp, '../assets/img/' . $img);
//         } else {
//             $img = $product['img']; // Nếu không upload ảnh mới, giữ ảnh cũ
//         }

//         // Kiểm tra nhập liệu
//         if (empty($name) || empty($price) || empty($mota) || empty($luotxem) || empty($motachitiet) || empty($soluong)) {
//             $error = "Vui lòng nhập đầy đủ thông tin!";
//         } else {
//             // Cập nhật sản phẩm
//             $success = $this->sanphamModel->editsp($id, $name, $price, $img, $mota, $luotxem, $motachitiet, $soluong);
//             if ($success) {
//                 echo "<script>
//                         alert('Bạn đã cập nhật thành công!');
//                         window.location.href='index.php?act=danhsachsp';
//                       </script>";
//             } else {
//                 $error = "Đã xảy ra lỗi trong quá trình cập nhật!";
//             }
//         }
//     }

//     // Gửi dữ liệu tới view
//     require_once 'views/sanpham/editsp.php';
// }
// function deleteProduct()
// {
//     $id = isset($_GET['id']) ? $_GET['id'] : null;
//     if (!$id) {
//         echo "<script>alert('Không tìm thấy sản phẩm để xóa!'); window.location.href='index.php?act=danhsach';</script>";
//         return;
//     }

//     // Gọi model để xóa sản phẩm
//     $success = $this->sanphamModel->delete($id);

//     if ($success) {
//         echo "<script>
//                 alert('Xóa sản phẩm thành công!');
//                 window.location.href='index.php?act=danhsach';
//               </script>";
//     } else {
//         echo "<script>
//                 alert('Đã xảy ra lỗi khi xóa sản phẩm!');
//                 window.location.href='index.php?act=danhsach';
//               </script>";
//     }
// }


    }

