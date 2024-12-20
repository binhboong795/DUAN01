<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="icon" href="./assets/img/logo.jpg" type="image/x-icon">
    <?php require_once 'views/components/style.php' ?>

</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <?php require_once 'assets/header/headerContact.php' ?>


    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <!-- Single Page Header start -->
    <div class="" style="height: 55px"></div>
    <!-- Single Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-primary">Get in touch</h1>
                            <p class="mb-4">The contact form is currently inactive. Get a functional and working contact
                                form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code
                                and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="h-100 rounded">
                            <iframe class="rounded w-100" style="height: 400px;"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.634114336443!2d105.84117081539908!3d21.028511593594302!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab98a74d6dd7%3A0x32db9d7bfb382c39!2zSGFub2kgQ2l0eSwgVmnhu4d0IE5hbQ!5e0!3m2!1sen!2sbd!4v1694259649153!5m2!1sen!2sbd"
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                        </div>
                    </div>
                    <div class="col-lg-7">
                        <!-- <form action="" method="post">
                            <input name="name" type="text" class="w-100 form-control border-0 py-3 mb-4"
                                placeholder="Your Name">
                            <input name="email" type="email" class="w-100 form-control border-0 py-3 mb-4"
                                placeholder="Enter Your Email">
                            <input name="content" type="text" class="w-100 form-control border-0 mb-4" rows="5"
                                cols="10" placeholder="Your Message"></input>
                            <button type="submit" name="addlienhe">thêm</button>
                            <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary "
                                type="submit" name="addlienhe">thêm</button>
                        </form> -->
                        <form action="?act=addlienhe" method="post">
                            <input class="w-100 form-control border-0 py-3 mb-4" type="text" name="name"
                                placeholder="Tên">
                            <input class="w-100 form-control border-0 py-3 mb-4" type="number" name="sdt"
                                placeholder="Số điện thoại">
                            <input class="w-100 form-control border-0 py-3 mb-4" type="text" name="mail"
                                placeholder="email">
                            <input class="w-100 form-control border-0 py-3 mb-4" type="text" name="noidung"
                                placeholder="Content">
                            <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary "
                                type="submit" name="addlienhe">them</button>

                            <!-- <a href="?act=dangnhap">Đăng nhập</a> -->
                        </form>
                    </div>
                    <div class="col-lg-5">
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Address</h4>
                                <p class="mb-2"> Trường Cao Đẳng FPT Polytechnic</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Mail Us</h4>
                                <p class="mb-2">caodangfpt@fpt.edu.vn</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded bg-white">
                            <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Telephone</h4>
                                <p class="mb-2">(+84) 0954835784</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->



    <?php require_once 'assets/footer/footer.php' ?>



</body>

</html>