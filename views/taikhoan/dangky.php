<?php require_once 'views/components/style.php' ?>

<div class="container-fluid contact py-5">
            <div class="container py-5">
                <div class="p-5 bg-light rounded">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="text-center mx-auto" style="max-width: 700px;">
                                <h1 class="text-primary">Đăng Ký</h1>
                            </div>
                        </div>
                        <!-- <div class="col-lg-12">
                            <div class="h-100 rounded">
                                <iframe class="rounded w-100" 
                               
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div> -->
                        <div class="col-lg-7">
                            <form action="" method="post">
                                <input class="w-100 form-control border-0 py-3 mb-4" type="text" name="user" placeholder="Tên tài khoản">
                                <input class="w-100 form-control border-0 py-3 mb-4" type="password" name="pass" placeholder="Mật khẩu">
                                <input class="w-100 form-control border-0 py-3 mb-4" type="email" name="email" placeholder="Email">
                                <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary " type="submit" name="dangky">Đăng ký</button>
                                <!-- <a href="?act=dangnhap">Đăng nhập</a> -->
                            </form>
                        </div>
                        <div class="col-lg-5">
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Address</h4>
                                    <p class="mb-2">123 Street New York.USA</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Mail Us</h4>
                                    <p class="mb-2">info@example.com</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded bg-white">
                                <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Telephone</h4>
                                    <p class="mb-2">(+012) 3456 7890</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
