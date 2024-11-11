<?php
  if(isset($_GET['action'])) {
    include_once "views/header.php";
    switch ($_GET['action']) {
        case 'shop': 
            include_once "views/shop.php";          
            break;
        case 'detail':
            include_once "views/detail.php";                
            break;
        default:
            # code...
            break;
    }
    include_once "views/footer.php";
  }else {
    header('location: index.php');
  }
?>
