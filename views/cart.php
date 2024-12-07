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


    <?php require_once 'assets/header/headerCart.php' ?>


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


    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($cartItems)): ?>
                            <?php foreach ($cartItems as $item): ?>
                                <tr>
                                    <!-- Hình ảnh sản phẩm -->
                                    <td>
                                        <img src="assets/img/<?= htmlspecialchars($item['img']) ?>"
                                            alt="<?= htmlspecialchars($item['name']) ?>" width="50">
                                    </td>
                                    <!-- Tên sản phẩm -->
                                    <td><?= htmlspecialchars($item['name']) ?></td>
                                    <!-- Giá sản phẩm -->
                                    <td><?= number_format($item['price']) ?> đ</td>
                                    <!-- Số lượng và nút tăng/giảm -->
                                    <td>
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <!-- Nút giảm số lượng -->
                                            <div class="input-group-btn">
                                                <a href="index.php?act=updateQuantity&id=<?= $item['idpro'] ?>&action=decrease"
                                                    class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                    <i class="fa fa-minus"></i>
                                                </a>
                                            </div>
                                            <!-- Hiển thị số lượng -->
                                            <input type="text" class="form-control form-control-sm text-center border-0"
                                                value="<?= $item['soluong'] ?>" disabled>
                                            <!-- Nút tăng số lượng -->
                                            <div class="input-group-btn">
                                                <a href="index.php?act=updateQuantity&id=<?= $item['idpro'] ?>&action=increase"
                                                    class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- Tổng giá sản phẩm -->
                                    <td><?= number_format($item['total_price']) ?> đ</td>
                                    <!-- Nút xóa sản phẩm -->
                                    <td>
                                        <a href="index.php?act=removeFromCart&id=<?= $item['idpro'] ?>">Xóa</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Giỏ hàng trống</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>



                </table>
            </div>
            <!-- <div class="mt-5">
                <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply
                    Coupon</button>
            </div> -->
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <?php if (!empty($cartItems)): ?>
                                    <!-- Hiển thị tổng giá trị nếu có sản phẩm trong giỏ hàng -->
                                    <div>
                                        <span><?= number_format($totalPrice) ?> đ</span>
                                    </div>
                                <?php else: ?>
                                    <!-- Nếu giỏ hàng trống -->
                                    <div>
                                        <span>Giỏ hàng trống</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Shipping</h5>
                                <div class="">
                                    <p class="mb-0">Flat rate: 30,000 đ</p>
                                </div>
                            </div>
                            <p class="mb-0 text-end">Ha noi</p>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <div style="margin-right: 27px;">
                                <?php if (!empty($cartItems)): ?>
                                    <!-- Hiển thị tổng giá trị nếu có sản phẩm trong giỏ hàng -->
                                    <div>
                                        <span><?= number_format($totalPriceAll) ?> đ</span>
                                    </div>
                                <?php else: ?>
                                    <!-- Nếu giỏ hàng trống -->
                                    <div>
                                        <span>...</span>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>

                        <a href="?act=chackout">
                            <button
                                class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                                type="button">
                                Proceed Checkout
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->


    <?php require_once 'assets/footer/footer.php' ?>



</body>

</html>