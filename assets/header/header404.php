<!-- Navbar start -->
<!-- Navbar start -->
<?php
// session_start();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user']['username'];  // Lấy thông tin người dùng từ session
}
?>
<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                        class="text-white">Trường Cao Đẳng FPT Polytechnic</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                        class="text-white">caodangfpt@fpt.edu.vn</a></small>
            </div>
            <div class="top-link pe-2">
                <?php
                if (isset($_SESSION['user'])) {
                ?>
                    <!-- Hiển thị khi đã đăng nhập -->
                    <a class="text-white mx-2">
                        Xin chào, <?php echo $user ?>
                    </a>
                    <a class="text-white mx-2">|</a>
                    <a href="index.php?act=dangxuat" class="text-white"><small class="text-white mx-2">Đăng Xuất</small></a>
                <?php
                } else {
                ?>
                    <a href="index.php?act=dangky" class="text-white"><small class="text-white mx-2">Đăng Ký</small></a> /
                    <a href="index.php?act=dangnhap" class="text-white"><small class="text-white mx-2">Đăng Nhập</small></a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="?act=/" class="navbar-brand">
                <h1 class="text-primary display-6">Fruitables</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="?act=/" class="nav-item nav-link ">Home</a>
                    <a href="?act=shop" class="nav-item nav-link">Shop</a>
                    <a href="" class="nav-item nav-link">Shop Detail</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="?act=cart" class="dropdown-item">Cart</a>
                            <a href="?act=chackout" class="dropdown-item">Chackout</a>
                            <a href="?act=testimonial" class="dropdown-item">Testimonial</a>
                            <a href="?act=404" class="dropdown-item">404 Page</a>
                        </div>
                    </div>
                    <a href="?act=contact" class="nav-item nav-link">Contact</a>
                </div>
                <div class="d-flex m-3 me-0">
                    <a href="?act=cart" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                        <span
                            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top: -5px; left: 15px; height: 20px; min-width: 20px;" name="cart-count">
                            <? echo $totalQuantity; ?>
                        </span>
                    </a>
                    <a href="#" class="my-auto">
                        <i class="fas fa-user fa-2x"></i>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->