<?php

require_once 'commons/function.php';
require_once 'controllers/homeController.php';
require_once 'models/homeModel.php';
require_once 'controllers/shopController.php';
require_once 'models/shopModel.php';
require_once 'controllers/detailController.php';
require_once 'models/detailModel.php';

// Lấy giá trị hành động từ URL, mặc định là '/'
$act = $_GET['act'] ?? '/';
// Lấy ID sản phẩm (nếu có) từ URL
$id = $_GET['id'] ?? null;
$action = $_GET['action'] ?? null; // Thêm action để xử lý tăng/giảm số lượng

// Sử dụng match để xử lý các hành động
match ($act) {
    '/' => (new homeController())->home(), // Trang chủ
    'shop' => (new shopController())->shop(), // Trang shop với ID danh mục
    'shopdetail' => (new detailController())->shopDetail($id), // Chi tiết sản phẩm
    'contact' => (new homeController())->contact(), // Trang liên hệ
    'cart' => (new homeController())->cart(), // Hiển thị giỏ hàng
    'testimonial' => (new homeController())->testimonial(), // Trang đánh giá
    'dathang' => (new homeController())->dathang(), // Trang đặt hàng
    '404' => (new homeController())->error(), // Trang lỗi
    'chackout' => (new homeController())->chackout(), // Trang thanh toán
    'dangky' => (new homeController())->registerUser(), // Đăng ký
    'dangnhap' => (new homeController())->login(), // Đăng nhập
    'dangxuat' => (new homeController())->logout(), // Đăng xuất
    'quenmk' => (new homeController())->quenmk(), // Quên mật khẩu
    'addComment' => (new homeController())->addComment(), // Thêm bình luận
    'addToCart' => (new homeController())->addToCartDb($id), // Thêm vào giỏ hàng
    'removeFromCart' => (new homeController())->removeFromCart($id), // Xóa khỏi giỏ hàng
    'updateQuantity' => (new homeController())->updateQuantity($id, $action), // Cập nhật số lượng sản phẩm
    'chackthongtin' => (new homeController())->chackthongtin(), // Cập nhật số lượng sản phẩm

    // 'deletecart' => (new homeController())->deleteCart($iduser),

    'chuyenkhoan' => (new homeController())->chuyenkhoan(),

    'chitietdonhang' => (new homeController())->chitietdonhang(),
    default => (new homeController())->error(), // Hành động không xác định
};
