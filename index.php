<?php
<<<<<<< HEAD
require_once 'commons/function.php';
require_once 'controllers/homeController.php';
require_once 'models/homeModel.php';


$act=$_GET['act']??'/';
match ($act) {
    '/' => (new homeController())->home(),
    'shop' => (new homeController())->shop($_GET['id']),
    'shopdetail' => (new homeController())->shopDetail($_GET['id']),
    'contact' => (new homeController())->contact(),
    'cart' => (new homeController())->cart(),
    'testimonial' => (new homeController())->testimonial(),
    '404' => (new homeController())->error(),
    'chackout' => (new homeController())->chackout(),
};
=======
    
    // include_once "views/header.php";
    require_once 'models/User.php';
    require_once 'controllers/UserController.php';
    $user = new UserController();
  
    $luachon = isset($_GET['act']) ? $_GET['act'] : '/';
 
    switch($luachon) {
        // case 'product':
        //     include_once "controllers/product.php";
        //     break;      
        
        case 'registerUser':
            $user->registerUser();
            break;
        
        case 'login':
            $user->login();
            break;
        
        case 'dangxuat':
            $user->dangxuat();
            break;

        

        // default:
          
        //     include_once "views/home.php";
        //     break;
    }

  
    // include_once "views/footer.php";
>>>>>>> 0b96c49fe8f16f6f6b8012c23f6f0dd035a1f97c
?>