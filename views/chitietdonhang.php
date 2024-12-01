<?php
// session_start();
$bill_pttt = $_SESSION['bill_pttt'];
// $ngaydathang = $_SESSION['ngaydathang'];


// tổng tiền
$totalPriceAll = 0; // Biến lưu tổng tiền
foreach ($getOrder as $item) {
    $totalPriceAll += $item['thanhtien']; // Cộng tổng tiền của từng sản phẩm vào tổng tiền
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

    <?php if (isset($_SESSION['user'])) { ?>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="testimonial-header text-center">
                <h1 class="display-5 mb-5 text-dark">Chi Tiết Đơn Hàng</h1>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Thông tin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getOrder as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><img src="assets/img/<?= htmlspecialchars($item['img']) ?>" alt="" width="50"></td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= htmlspecialchars($item['price']) ?> đ</td>
                        <td><?= htmlspecialchars($item['soluong']) ?></td>
                        <td><?= htmlspecialchars($item['thanhtien']) ?> đ</td>
                        <td>
                            <a href="index.php?act=chitietorder&idbill=<?= $item['idbill'] ?>">Xem chi tiết</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
    <?php  } else {
    ?>
    <?php } ?>

    <!-- Checkout Page End -->





    <?php require_once 'assets/footer/footer.php' ?>

</body>

</html>