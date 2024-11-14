<!-- Navbar start -->
<?php

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];  // Lấy thông tin người dùng từ session
}
?>
<link rel="stylesheet" href="">
<style>
/* Định dạng cho nút tìm kiếm */
.btn-search {
    background-color: #ffffff;
    /* Màu nền trắng */
    border: 1px solid #6c757d;
    /* Màu viền xám nhạt */
    color: #0d6efd;
    /* Màu của biểu tượng tìm kiếm (text-primary) */
    width: 40px;
    /* Kích thước nút */
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    /* Tạo hình tròn */
    transition: all 0.3s ease;
    /* Tạo hiệu ứng chuyển mượt */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    /* Đổ bóng nhẹ */
}

/* Hiệu ứng khi di chuột vào nút */
.btn-search:hover {
    background-color: #0d6efd;
    /* Thay đổi màu nền khi hover */
    color: #ffffff;
    /* Màu biểu tượng chuyển thành trắng */
    border-color: #0d6efd;
    /* Thay đổi màu viền */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    /* Tăng đổ bóng khi hover */
    transform: scale(1.1);
    /* Tăng kích thước nhẹ */
}

/* Định dạng cho biểu tượng tìm kiếm bên trong nút */
.btn-search i {
    font-size: 16px;
    /* Kích thước biểu tượng */
}

/* Định dạng chung cho container tìm kiếm */
/* Định dạng chung cho container tìm kiếm */
/* Định dạng chung cho container tìm kiếm */
.search-container {
    position: relative;
    display: inline-flex;
    align-items: center;
    overflow: hidden;
}

.search-container {
    height: 50px;
}

/* Định dạng cho nút tìm kiếm */
.btn-search {
    background-color: #ffffff;
    border: 1px solid #6c757d;
    color: #0d6efd;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    cursor: pointer;
}

/* Định dạng cho input tìm kiếm - ẩn ban đầu */
.search-input {
    margin-right: 5px;
    width: 0;
    padding: 0;
    border: 1px solid #6c757d;
    border-radius: 20px;
    transition: width 0.4s ease, padding 0.4s ease, transform 0.4s ease;
    opacity: 0;
    margin-left: 10px;
    font-size: 14px;
    color: #495057;
    transform-origin: right;
    transform: scaleX(0);
    /* Bắt đầu từ kích thước 0 */
}

/* Khi container có focus */
.search-container:focus-within .search-input {
    width: 170px;
    height: 40px;
    /* Chiều rộng khi mở rộng */
    padding: 10px 20px;
    opacity: 1;
    transform: scaleX(1);
    /* Mở rộng từ phải sang trái */
}
</style>
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
            <a href="index.html" class="navbar-brand">
                <h1 class="text-primary display-6">Fruitables</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="?act=/" class="nav-item nav-link active">Home</a>
                    <a href="?act=shop" class="nav-item nav-link ">Shop</a>
                    <a href="" class="nav-item nav-link">Shop Detail</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
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
                    <div class="search-container">
                        <input type="text" class="search-input" placeholder="Tìm kiếm...">
                        <button
                            class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4">
                            <i class="fas fa-search text-primary"></i>
                        </button>

                    </div>
                    <a href="#" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                        <span
                            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
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