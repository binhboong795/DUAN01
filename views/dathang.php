<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="icon" href="./assets/img/logo.jpg" type="image/x-icon">
    <?php include 'views/components/style.php' ?>
</head>
<style>
    .text-right {
        text-align: right;
    }
</style>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <?php require_once 'assets/header/headerChackout.php' ?>


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


    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="testimonial-header text-center">
                <h1 class="display-5 mb-5 text-dark">Order</h1>
            </div>
            <!-- Notification -->
            <div class="alert alert-success text-center" role="alert" style="margin-top: 50px;">
                <h4 class="alert-heading">Đặt Hàng Thành Công!</h4>
                <p>Chúng tôi đã nhận được đơn hàng của bạn. Cảm ơn bạn đã mua hàng tại cửa hàng của chúng tôi!</p>
                <hr>
                <p class="mb-0">Thông tin đơn hàng sẽ được gửi đến email của bạn. Vui lòng kiểm tra hộp thư của bạn.</p>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-center mt-4">
                <a href="index.php" class="btn btn-primary py-3 px-4 text-uppercase mx-3">Quay lại trang chủ</a>
                <a href="index.php?act=chitietdonhang" class="btn btn-secondary py-3 px-4 text-uppercase mx-3">Xem chi
                    tiết đơn hàng</a>
            </div>
        </div>
    </div>
    <!-- Checkout Page End -->


    <?php require_once 'assets/footer/footer.php' ?>



</body>

</html>