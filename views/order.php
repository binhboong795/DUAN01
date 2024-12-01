<?php

if (isset($_SESSION['bill_name'])) {
    $bill_name = $_SESSION['bill_name'];
    $bill_address = $_SESSION['bill_address'];
    $bill_tell = $_SESSION['bill_tell'];
    $bill_email = $_SESSION['bill_email'];
    $bill_pttt = $_SESSION['bill_pttt'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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
                <h1 class="display-5 mb-5 text-dark">Order Confirmation</h1>
            </div>
            <form action="index.php?act=chackthongtin" method="post">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="row">

                            <div class="form-item w-100">
                                <label class="form-label my-3">Name<sup>*</sup></label>
                                <input type="text" name="bill_name" class="form-control" value=" <?php if (isset($_SESSION['bill_name'])) {
                                                                                                        echo $bill_name;
                                                                                                    } else {
                                                                                                        echo "Chưa nhập tên";
                                                                                                    } ?>">
                            </div>


                        </div>

                        <div class="form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" class="form-control" name="bill_address" value=" <?php if (isset($_SESSION['bill_address'])) {
                                                                                                    echo $bill_address;
                                                                                                } else {
                                                                                                    echo "Chưa nhập địa chỉ";
                                                                                                } ?>">
                        </div>



                        <div class="form-item">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <input type="tel" name="bill_tell" class="form-control" value=" <?php if (isset($_SESSION['bill_tell'])) {
                                                                                                echo $bill_tell;
                                                                                            } else {
                                                                                                echo "Chưa nhập số điện thoại";
                                                                                            } ?>">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email<sup>*</sup></label>
                            <input type="email" name="bill_email" class="form-control" value=" <?php if (isset($_SESSION['bill_email'])) {
                                                                                                    echo $bill_email;
                                                                                                } else {
                                                                                                    echo "Chưa nhập email";
                                                                                                } ?>">
                        </div>
                        <?php if (!empty($error)) : ?>
                            <p style="color: red;"><?= $error ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if (!empty($getOrder)): ?>
                                        <?php foreach ($getOrder as $item): ?>
                                            <tr>
                                                <td><img src="assets/img/<?= $item['img'] ?>" alt="<?= $item['name'] ?>"
                                                        width="50"></td>
                                                <td><?= $item['name'] ?></td>
                                                <td><?= number_format($item['price']) ?> đ</td>
                                                <td><?= $item['soluong'] ?></td>
                                                <td><?= number_format($item['total_price']) ?> đ</td>
                                            </tr>

                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="5" class="text-right"><?= number_format($totalPrice) ?> đ</td>
                                        </tr>

                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Giỏ hàng trống</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <h4>Phương Thức Thanh Toán</h4>
                            <p>
                                <?php if (isset($_SESSION['bill_pttt'])) {
                                    echo $bill_pttt;
                                } else {
                                    echo "Chưa chọn phương thức thanh toán";
                                } ?>
                            </p>
                        </div>

                    </div>

                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">

                        <form action="" method="post">
                            <button class="btn border-secondary py-3 px-4 text-uppercase w-25 text-primary ms-auto"
                                type="submit" name="dathang">Order</button>
                        </form>

                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
    <!-- Checkout Page End -->


    <?php require_once 'assets/footer/footer.php' ?>



</body>

</html>