<?php
    
    include_once "views/header.php";
    require_once 'models/User.php';
    require_once 'controllers/UserController.php';
    
  
    $user = new UserController();

   
    $luachon = isset($_GET['act']) ? $_GET['act'] : '/';

    
    switch($luachon) {
        case 'product':
            include_once "controllers/product.php";
            break;      
        
        case 'registerUser':
            $user->registerUser();
            break;
        
        case 'login':
            $user->login();
            break;
        
        case 'dangxuat':
            $user->dangxuat();
            break;

        default:
          
            include_once "views/home.php";
            break;
    }

  
    include_once "views/footer.php";
?>