<?php
// session_start();
if (isset($_SESSION['bill_name'])) {
    $bill_name = $_SESSION['bill_name'];
    $bill_address = $_SESSION['bill_address'];
    $bill_tell = $_SESSION['bill_tell'];
    $bill_email = $_SESSION['bill_email'];
    $bill_pttt = $_SESSION['bill_pttt'];
    $ngaydathang = $_SESSION['ngaydathang'];
}

// ngày giao hàng
$chuanbi = 1;
$vanchuyen = (stripos($bill_address, 'hà nội') !== false) ? 2 : 4;
$ngaygiaohang = date('Y-m-d', strtotime("$ngaydathang +$chuanbi day +$vanchuyen day"));

// tổng tiền
$totalPriceAll = 0; // Biến lưu tổng tiền
foreach ($getOrder as $value) {
    $totalPriceAll += $value['thanhtien']; // Cộng tổng tiền của từng sản phẩm vào tổng tiền
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

table {
    width: 100%;
    table-layout: fixed;
    /* Makes columns have equal width */
    border-collapse: collapse;
}

th,
td {
    border: 1px solid #ccc;
    padding: 10px;
    width: 14%;
    /* Set an approximate equal width for all columns */
    text-align: center;
}

/* Specific styling for the total row */
.total-row th,
.total-row td {
    font-weight: bold;
}
</style>


<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <?php require_once 'assets/header/headerOrder.php' ?>


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
                <h1 class="display-5 mb-5 text-dark">Chi Tiết Order</h1>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Họ tên người nhận</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Phương thức thanh toán</th>
                        <th>Ngày đặt hàng</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $bill_name ?></td>
                        <td><?= $bill_address ?></td>
                        <td><?= $bill_tell ?></td>
                        <td><?= $bill_email ?></td>
                        <td><?= $bill_pttt ?></td>
                        <td><?= $ngaydathang ?></td>
                        <td>

                            <?php foreach ($getOrder as $index => $item): ?>
                            <p style="color: <?= $item['bill_status'] === 'Đã thanh toán' ? 'green' : 'red'; ?>;">
                                <?= htmlspecialchars($item['bill_status']); ?>
                            </p>
                            <?php endforeach; ?>
                        </td>
                    </tr>
            </table>
            <table>
                <thead>
                    <tr>
                        <th>Mã Bill</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getOrder as $value) { ?>
                    <tr>
                        <td><?= $value['idbill'] ?></td>
                        <td><img src="assets/img/<?= $value['img'] ?>" alt="" width="50"></td>
                        <td><?= $value['name'] ?></td>
                        <td><?= $value['price'] ?> $</td>
                        <td><?= $value['soluong'] ?></td>
                        <td><?= $value['thanhtien'] ?> $</td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
    <!-- Checkout Page End -->





    <?php require_once 'assets/footer/footer.php' ?>

</body>

</html>