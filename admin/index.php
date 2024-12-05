<?php

session_start();
require_once '../commons/function.php';
require_once 'controllers/accController.php';
require_once 'models/accModel.php';
require_once 'controllers/bannerController.php';
require_once 'models/bannerModel.php';
require_once 'controllers/sanphamController.php';
require_once 'models/sanphamModel.php';
require_once 'controllers/cmtController.php';
require_once 'models/cmtModel.php';
require_once 'controllers/danhmucController.php';
require_once 'models/danhmucModel.php';
require_once 'controllers/statusController.php';
require_once 'models/statusModel.php';
require_once 'controllers/huydonController.php';
require_once 'models/huydonModel.php';
require_once 'controllers/contactController.php';
require_once 'models/contactModel.php';
require_once 'controllers/thongkeController.php';
require_once 'models/thongkeModel.php';



$act = $_GET['act'] ?? '/';
match ($act) {
    '/' => (new accController())->home(),
    'dangky' => (new accController())->registerUser(), // Đăng ký
    'dangnhap' => (new accController())->login(), // Đăng nhập
    'dangxuat' => (new accController())->logout(), // Đăng xuất
    'sanpham' => (new sanphamController())->sanpham(),
    'taikhoan' => (new accController())->taikhoan(),
    'addUser' => (new accController())->addUser(),
    'editUser' => (new accController())->editUser(),
    'deleteUser' => (new accController())->deleteUser(),
    'danhmuc' => (new danhmucController())->danhmuc(),
    'deleteDanhmuc' => (new danhmucController())->deleteDanhmuc($_GET['id']),
    'addDanhmuc' => (new danhmucController())->addDanhmuc(),
    'editDanhmuc' => (new danhmucController())->editDanhmuc($_GET['id']),
    'binhluan' => (new cmtController())->binhluan(),
    'deleteBl' => (new cmtController())->deleteBl(),
    'banner' => (new bannerController())->banner(),
    'editBanner' => (new bannerController())->editBanner($_GET['id']),
    'deletebanner' => (new bannerController())->deleteBanner($_GET['id']),
    'insertbanner' => (new bannerController())->addBanner(),
    'status' => (new statusController())->status(),
    // 'addstatus'=> (new statusController())->addStatus(),
    'updatestatus' => (new statusController())->updateStatus($_GET['id_bill']),
    'deletestatus' => (new statusController())->deletebill(),
    'add' => (new sanphamController())->add(),
    'editsp' => (new sanphamController())->editsp(),
    'deleteproduct' => (new sanphamController())->deleteProduct($_GET['id']),
    // 'listsp' => (new sanphamController())->sanpham(), // Thêm case 'danhsach'
    'huydon' => (new huydonController())->huydon(),
    'deletehuy' => (new huydonController())->deletehuy(),
    'lienhe' => (new contactController())->lienhe(),
    'deletecontact' => (new contactController())->deleteContact(),
    'editcontact' => (new contactController())->editContact($_GET['id']),
    'thongke' => (new thongkeController())->thongke(),
    'deletethongke' => (new thongkeController())->deletebill(),
};