<form action="" method="post">
    <input type="text" name="user" placeholder="Tên tài khoản">
    <input type="password" name="pass" placeholder="Mật khẩu">
    <button type="submit" name="dangnhap">Đăng nhập</button>

</form>

<?php

if (isset($_POST["dangnhap"])) {
    $user = $_POST["user"];
    $pass = $_POST["pass"];

    foreach ($login as $value) {

        if ($user == $value->user && $pass == $value->pass) {
            $_SESSION["user"] = $user;
            echo "Đăng nhập thành công!";
            include_once "views/da.php";
            break;
        } else {
            echo "Tài khoản hoặc mật khẩu của bạn sai!";
            break;
        }
    }
    session_start();
    if (isset($_SESSION["user"])) {
        unset($_SESSION["user"]);
    }
    // header("location:dangky.php");
}
   
?>