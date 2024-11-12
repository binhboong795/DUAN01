<?php
    session_start();

    if(isset($_SESSION["user"])) {
        unset($_SESSION["user"]);
        // echo "Đăng xuất thành công!";
        // session_destroy();
    }
    header("location: dangnhap.php");
?>