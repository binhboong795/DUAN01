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



$act = $_GET['act'] ?? '/';
match ($act) {
    '/' => (new accController())->home(),
    'sanpham' => (new sanphamController())->sanpham(),
    'taikhoan' => (new accController())->taikhoan(),
    'danhmuc' => (new danhmucController())->danhmuc(),
    'binhluan' => (new cmtController())->binhluan(),
    'editUser' => (new accController())->editUser(),
    'deleteUser' => (new accController())->deleteUser(),
    'banner' => (new bannerController())->banner(),
    'editBanner' => (new bannerController())->editBanner($_GET['id']),
    'deletebanner' => (new bannerController())->deleteBanner($_GET['id']),
    'insertbanner' => (new bannerController())->addBanner(),
};
