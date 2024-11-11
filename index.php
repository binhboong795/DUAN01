<?php
         if(isset($_GET['pg'])) {
            switch ($_GET['pg']) {
                case 'product':
                include_once "controllers/product.php";
                break;
                default:
                        # code...
                        break;
            }
         }else {
                include_once "views/header.php";
                include_once "views/home.php";
                include_once "views/footer.php";
         }            
 
?>