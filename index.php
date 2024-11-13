<?php

require_once 'commons/function.php';
require_once 'controllers/homeController.php';
require_once 'models/homeModel.php';


$act=$_GET['act']??'/';
match ($act) {
    '/' => (new homeController())->home(),
    'shop' => (new homeController())->shop(),
    'shopdetail' => (new homeController())->shopDetail($_GET['id']),
    'contact' => (new homeController())->contact(),
    'cart' => (new homeController())->cart(),
    'testimonial' => (new homeController())->testimonial(),
    '404' => (new homeController())->error(),
    'chackout' => (new homeController())->chackout(),
    'dangky' => (new homeController())->registerUser(),
    'dangnhap' => (new homeController())->login(),
    'dangxuat' => (new homeController())->logout(),
    'test' => (new homeController())->test(),
};

 
?>