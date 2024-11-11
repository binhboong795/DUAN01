<?php
    // require_once 'models/ConnectDatabase.php';
    // $conn = new ConnectDatabase();
    require_once 'models/User.php';
    require_once 'controllers/UserController.php';
    $user = new UserController();

    $luachon = isset($_GET['act']) ? $_GET['act'] : '/';
    switch($luachon) {
        case 'registerUser':
            $user->registerUser();
            break;        
        case 'login':
            $user->login();
            break;        
        case 'dangxuat':
            $user->dangxuat();
            break;        
    }
?>