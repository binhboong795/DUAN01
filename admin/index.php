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



$act = $_GET['act'] ?? '/';
match ($act) {
    '/' => (new accController())->home(),
    'sanpham' => (new sanphamController())->sanpham(),
    'taikhoan' => (new accController())->taikhoan(),
    'danhmuc' => (new danhmucController())->danhmuc(),
    'deleteDanhmuc' => (new danhmucController())->deleteDanhmuc($_GET['id']),
    'addDanhmuc' => (new danhmucController())->addDanhmuc(),
    'editDanhmuc' => (new danhmucController())->editDanhmuc($_GET['id']),
    'binhluan' => (new cmtController())->binhluan(),
    'deleteBl' => (new cmtController())->deleteBl(),
    'addUser' => (new accController())->addUser(),
    'editUser' => (new accController())->editUser(),
    'deleteUser' => (new accController())->deleteUser(),
    'banner' => (new bannerController())->banner(),
    'editBanner' => (new bannerController())->editBanner($_GET['id']),
    'deletebanner' => (new bannerController())->deleteBanner($_GET['id']),
    'insertbanner' => (new bannerController())->addBanner(),
    'status' => (new statusController())->status(),
    // 'addstatus'=> (new statusController())->addStatus(),
    'updatestatus' => (new statusController())->updateStatus($_GET['id']),
    'deletestatus' => (new statusController())->deleteStatus($_GET['id']),
    'add' => (new sanphamController())->add(),
    'editsp' => (new sanphamController())->editsp(),
    'deleteproduct' => (new sanphamController())->deleteProduct($_GET['id']),
};
