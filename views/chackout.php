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
            <h1 class="mb-4">Billing details</h1>
            <form action="index.php?act=chackthongtin" method="post">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="row">

                            <div class="form-item w-100">
                                <label class="form-label my-3">Name<sup>*</sup></label>
                                <input type="text" name="bill_name" class="form-control">
                            </div>


                        </div>

                        <div class="form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" class="form-control" name="bill_address" placeholder="House Number Street Name">
                        </div>



                        <div class="form-item">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <input type="tel" name="bill_tell" class="form-control">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email<sup>*</sup></label>
                            <input type="email" name="bill_email" class="form-control">
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
                               <tbody>
                            <?php if (!empty($cartItems)):
                                    var_dump($cartItems)
                                ?>
                                <?php foreach ($cartItems as $item): ?>
                                    <tr>
                                        <td><img src="<?= $item['img'] ?>" alt="<?= $item['name'] ?>" style="width: 50px;"></td>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= number_format($item['price'], 0, ',', '.') ?> VND</td>
                                        <td><?= $item['soluong'] ?></td>
                                        <td><?= number_format($item['thanhtien'], 0, ',', '.') ?> VND</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">Giỏ hàng trống</td>
                                </tr>
                            <?php endif; ?>
                               </tbody>
                            </table>

                        


                            
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="Transfer-1"
                                        name="Transfer" value="Transfer">
                                    <label class="form-check-label" for="Transfer-1">Direct Bank Transfer</label>
                                </div>
                                <p class="text-start text-dark">Make your payment directly into our bank account. Please
                                    use your Order ID as the payment reference. Your order will not be shipped until the
                                    funds have cleared in our account.</p>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="Payments-1"
                                        name="Transfer" value="Payments">
                                    <label class="form-check-label" for="Payments-1">Check Payments</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="Delivery-1"
                                        name="Transfer" value="Delivery">
                                    <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="Paypal-1"
                                        name="Transfer" value="Paypal">
                                    <label class="form-check-label" for="Paypal-1">Paypal</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">


                            <button class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary" type="submit" name="order">Place Order</button>

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