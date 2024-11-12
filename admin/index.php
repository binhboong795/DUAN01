<?php
    session_start();
    require_once '../commons/function.php';
    

    $act = $_GET['act'] ?? '/';
    match ($act) {
        '/'    => (new accController())-> login(),
        
         
    };
?>
