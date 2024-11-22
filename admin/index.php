<?php

session_start();
require_once '../commons/function.php';
require_once 'controllers/accController.php';
require_once 'models/accModel.php';


$act = $_GET['act'] ?? '/';
match ($act) {
    '/'=> (new accController())->home(),
    'sanpham'=> (new accController())->sanpham(),
    'taikhoan'=> (new accController())->taikhoan(),
    'danhmuc'=> (new accController())->danhmuc(),
    'binhluan'=> (new accController())->binhluan(),
    'banner'=> (new accController())->banner(),
    'editUser'=> (new accController())->editUser(),
    'deleteUser'=> (new accController())->deleteUser(),
};
