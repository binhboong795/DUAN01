<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <?php require_once 'views/components/style.php' ?>

</head>
<style>
    .stars {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center;

    }

    .stars input {
        display: none;
    }

    .stars label {
        font-size: 40px;
        color: grey;
        cursor: pointer;
    }

    .stars input:checked~label,
    .stars label:hover,
    .stars label:hover~label {
        color: gold;
    }

    .bold {
        font-size: 24px;
        color: gold;
    }

    .grey {
        color: grey;
    }

    .full {
        font-size: 24px;
        color: gold;
    }

    .half {
        font-size: 24px;
        color: grey;
    }

    .stars input[checked="checked"]:nth-of-type(5)~label {
        color: gold;
    }
</style>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <?php require_once 'assets/header/headerDetail.php' ?>


    <!-- Modal Search Start -->
    <!-- <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div> -->
    <!-- Modal Search End -->


    <!-- Single Page Header start -->
    <div class="" style="height: 55px"></div>
    <!-- Single Page Header End -->


    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">

                <div class="col-lg-8 col-xl-9">

                    <div class="row g-4">

                        <div class="col-lg-6">

                            <div class="border rounded">

                                <a href="#">
                                    <img src="assets/img/<?= $productOne['img'] ?>" class="img-fluid w-100 rounded-top"
                                        alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">

                            <h4>
                                <?= $productOne['name'] ?></h4>
                            <p class="mb-3">Category: Vegetables</p>
                            <p class="fw-bold mb-3"><?= number_format($productOne['price']) ?> đ</p>
                            <div class="d-flex mb-3">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $fullStart) {
                                        // Sao vàng đầy
                                        echo "<span class='star full'>★</span>";
                                    } else {
                                        // Sao xám
                                        echo "<span class='star half'>☆</span>";
                                    }
                                }
                                ?>
                                <span class="ms-2 mt-2">(<?= $tbStart ?> / 5 sao)</span>
                            </div>

                            <p><strong><?= $sumStart ?> đánh giá</strong></p>

                            <p><?= $productOne['mota'] ?></p>
                            <p>Lượt xem: <?= $productOne['luotxem'] ?></p>
                            <!-- <div class="input-group quantity mb-5" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div> -->
                            <br>
                            <br>
                            <br>


                            <a href="index.php?act=addToCart&id=<?= $productOne['id'] ?>"
                                class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                    class="fa fa-shopping-bag me-2 text-primary"></i> Thêm </a>
                            <!-- php-->



                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Description</button>
                                    <button class="nav-link  border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Reviews</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel"
                                    aria-labelledby="nav-about-tab">
                                    <p><?= $productOne['motachitiet'] ?></p>


                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel"
                                    aria-labelledby="nav-mission-tab">
                                    <div id="commentList">
                                        <?php
                                        $count = 0;
                                        if (!empty($comments)) {
                                            foreach ($comments as $comment) {
                                                $count++;
                                                // Thêm class "hidden-comment" nếu bình luận vượt quá 3.
                                                $hiddenClass = ($count > 3) ? 'hidden-comment d-none' : '';
                                        ?>
                                                <div class="d-flex comment-item <?php echo $hiddenClass; ?>">
                                                    <img src="assets/img/avatar.jpg" class="img-fluid rounded-circle p-3"
                                                        style="width: 100px; height: 100px;" alt="">
                                                    <div>
                                                        <p class="mb-2" style="font-size: 14px;">
                                                            <?php echo $comment['ngaybinhluan']; ?>
                                                        </p>
                                                        <div class="d-flex justify-content-between">
                                                            <h5><?php echo $comment['user']; ?></h5>
                                                            <div class="d-flex mb-3">
                                                                <?php
                                                                for ($i = 1; $i <= 5; $i++) {
                                                                    if ($i <= $comment['rating']) {
                                                                        echo "<span class='star bold'>★</span>";
                                                                    } else {
                                                                        echo "<span class='star bold grey'>★</span>";
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <p><?php echo $comment['noidung']; ?></p>
                                                    </div>
                                                </div>
                                            <?php }
                                        } else { ?>
                                            <p>Chưa có bình luận</p>
                                        <?php  }
                                        ?>
                                    </div>
                                    <!-- Nút "See more" và "Thu gọn" -->
                                    <?php if (count($comments) > 3) { ?>
                                        <div class="mt-3">
                                            <button id="seeMoreBtn"
                                                class="btn btn-link text-decoration-underline text-primary">See
                                                more</button>
                                            <button id="collapseBtn"
                                                class="btn btn-link text-decoration-underline text-secondary d-none">Thu
                                                gọn</button>
                                        </div>
                                    <?php } ?>
                                </div>




                                <div class="tab-pane" id="nav-vision" role="tabpanel">
                                    <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et
                                        tempor sit. Aliqu diam
                                        amet diam et eos labore. 3</p>
                                    <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos
                                        labore.
                                        Clita erat ipsum et lorem et sit</p>
                                </div>
                            </div>
                        </div>
                        <!-- php-->
                        <?php
                        $id = $_GET['id'];

                        ?>

                        <form action="?act=addComment&id=<?php echo $id ?>" method="post">
                            <h4 class="mb-5 fw-bold">Leave a Reply</h4>

                            <div class="row g-4">
                                <?php if (isset($_SESSION['user'])) {   ?>
                                    <div class="col-lg-6">
                                        <div class="border-bottom rounded">
                                            <span type="text" class="form-control border-0 me-4"
                                                placeholder="Yur Name *"><?php echo $_SESSION['user']['username'] ?></span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="idpro" value="<?php $_GET['id'] ?>">
                                    <div class="col-lg-6">
                                        <div class="border-bottom rounded">
                                            <span type="email" class="form-control border-0"
                                                placeholder="Your Email *"><?php echo $_SESSION['user']['email'] ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="border-bottom rounded my-4">
                                            <textarea name="comment" id="" class="form-control border-0" cols="30" rows="8"
                                                placeholder="Your Review *" spellcheck="false"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between py-3 mb-5">
                                            <div class="d-flex align-items-center">
                                                <p class="mb-0 me-3">Please rate:</p>
                                                <div class="stars">
                                                    <input type="radio" id="star5" name="rating" value="5" checked><label
                                                        for="star5">★</label>
                                                    <input type="radio" id="star4" name="rating" value="4"><label
                                                        for="star4">★</label>
                                                    <input type="radio" id="star3" name="rating" value="3"><label
                                                        for="star3">★</label>
                                                    <input type="radio" id="star2" name="rating" value="2"><label
                                                        for="star2">★</label>
                                                    <input type="radio" id="star1" name="rating" value="1"><label
                                                        for="star1">★</label>
                                                </div><br>
                                            </div>
                                            <button type="submit"
                                                class="btn border border-secondary text-primary rounded-pill px-4 py-3">
                                                Post Comment</button>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">

                    <div class="row g-4 fruite">
                        <div class="col-lg-12">
                            <!-- <div class="input-group w-100 mx-auto d-flex mb-4">
                                <input type="search" class="form-control p-3" placeholder="keywords"
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i
                                        class="fa fa-search"></i></span>
                            </div> -->
                            <div class="mb-4">
                                <h4>Categories</h4>
                                <ul class="list-unstyled fruite-categorie">
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Apples</a>
                                            <span>(3)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Oranges</a>
                                            <span>(5)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Strawbery</a>
                                            <span>(2)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Banana</a>
                                            <span>(8)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Pumpkin</a>
                                            <span>(5)</span>
                                        </div>
                                    </li>
                                </ul>
                                <a href="index.php?act=/"
                                    class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i>VỀ TRANG CHỦ</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h4 class="mb-4">Featured products</h4>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded" style="width: 100px; height: 100px;">
                                    <img src="assets/img/featur-1.jpg" class="img-fluid rounded" alt="Image">
                                </div>
                                <div>
                                    <h6 class="mb-2">Big Banana</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">2.99 $</h5>
                                        <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded" style="width: 100px; height: 100px;">
                                    <img src="assets/img/featur-2.jpg" class="img-fluid rounded" alt="">
                                </div>
                                <div>
                                    <h6 class="mb-2">Big Banana</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">2.99 $</h5>
                                        <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded" style="width: 100px; height: 100px;">
                                    <img src="assets/img/featur-3.jpg" class="img-fluid rounded" alt="">
                                </div>
                                <div>
                                    <h6 class="mb-2">Big Banana</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">2.99 $</h5>
                                        <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded me-4" style="width: 100px; height: 100px;">
                                    <img src="assets/img/vegetable-item-4.jpg" class="img-fluid rounded" alt="">
                                </div>
                                <div>
                                    <h6 class="mb-2">Big Banana</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">2.99 $</h5>
                                        <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded me-4" style="width: 100px; height: 100px;">
                                    <img src="assets/img/vegetable-item-5.jpg" class="img-fluid rounded" alt="">
                                </div>
                                <div>
                                    <h6 class="mb-2">Big Banana</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">2.99 $</h5>
                                        <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded me-4" style="width: 100px; height: 100px;">
                                    <img src="img/vegetable-item-6.jpg" class="img-fluid rounded" alt="">
                                </div>
                                <div>
                                    <h6 class="mb-2">Big Banana</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">2.99 $</h5>
                                        <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center my-4">
                                <a href="#"
                                    class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew
                                    More</a>
                            </div> -->
                        </div>
                        <!-- <div class="col-lg-12">
                            <div class="position-relative">
                                <img src="img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                <div class="position-absolute"
                                    style="top: 50%; right: 10px; transform: translateY(-50%);">
                                    <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- <h1 class="fw-bold mb-0">Related products</h1>
            <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="img/vegetable-item-6.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                            style="top: 10px; right: 10px;">Vegetable</div>
                        <div class="p-4 pb-0 rounded-bottom">
                            <h4>Parsely</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold">$4.99 / kg</p>
                                <a href="#"
                                    class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="img/vegetable-item-1.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                            style="top: 10px; right: 10px;">Vegetable</div>
                        <div class="p-4 pb-0 rounded-bottom">
                            <h4>Parsely</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold">$4.99 / kg</p>
                                <a href="#"
                                    class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="img/vegetable-item-3.png" class="img-fluid w-100 rounded-top bg-light" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                            style="top: 10px; right: 10px;">Vegetable</div>
                        <div class="p-4 pb-0 rounded-bottom">
                            <h4>Banana</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold">$7.99 / kg</p>
                                <a href="#"
                                    class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="img/vegetable-item-4.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                            style="top: 10px; right: 10px;">Vegetable</div>
                        <div class="p-4 pb-0 rounded-bottom">
                            <h4>Bell Papper</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold">$7.99 / kg</p>
                                <a href="#"
                                    class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="img/vegetable-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                            style="top: 10px; right: 10px;">Vegetable</div>
                        <div class="p-4 pb-0 rounded-bottom">
                            <h4>Potatoes</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold">$7.99 / kg</p>
                                <a href="#"
                                    class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="img/vegetable-item-6.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                            style="top: 10px; right: 10px;">Vegetable</div>
                        <div class="p-4 pb-0 rounded-bottom">
                            <h4>Parsely</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold">$7.99 / kg</p>
                                <a href="#"
                                    class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="img/vegetable-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                            style="top: 10px; right: 10px;">Vegetable</div>
                        <div class="p-4 pb-0 rounded-bottom">
                            <h4>Potatoes</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold">$7.99 / kg</p>
                                <a href="#"
                                    class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="img/vegetable-item-6.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                            style="top: 10px; right: 10px;">Vegetable</div>
                        <div class="p-4 pb-0 rounded-bottom">
                            <h4>Parsely</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold">$7.99 / kg</p>
                                <a href="#"
                                    class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <!-- Single Product End -->


    <?php require_once 'assets/footer/footer.php' ?>





</body>

</html>
<script>
    const seeMoreBtn = document.getElementById('seeMoreBtn');
    const collapseBtn = document.getElementById('collapseBtn');
    const hiddenComments = document.querySelectorAll('.hidden-comment');

    // Khi nhấn "See more"
    seeMoreBtn.addEventListener('click', function() {
        hiddenComments.forEach(comment => {
            comment.classList.remove('d-none');
        });
        seeMoreBtn.classList.add('d-none'); // Ẩn nút "See more"
        collapseBtn.classList.remove('d-none'); // Hiển thị nút "Thu gọn"
    });

    // Khi nhấn "Thu gọn"
    collapseBtn.addEventListener('click', function() {
        hiddenComments.forEach(comment => {
            comment.classList.add('d-none');
        });
        collapseBtn.classList.add('d-none'); // Ẩn nút "Thu gọn"
        seeMoreBtn.classList.remove('d-none'); // Hiển thị lại nút "See more"
    });
</script>

</script>