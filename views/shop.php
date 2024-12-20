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
    .fruite-item img {
        max-height: 200px;
        height: 200px;
        /* Cố định chiều cao */


    }
</style>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <?php require_once 'assets/header/headerShop.php' ?>

    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="input-group w-75 mx-auto d-flex">
            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
        </div>
        <form action="" method="GET" class="">
            <input name="name" class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="text"
                placeholder="Search">
            <button type="submit"
                class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100"
                style="top: 0; right: 25%;">Tìm kiếm
            </button>
            <form\>
    </div>
    <!-- Modal Search End -->


    <!-- Single Page Header start -->
    <div class="" style="height: 55px"></div>
    <!-- Single Page Header End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fresh fruits shop</h1>
            <div class="row g-4">
                <form method="get" action="">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            <div class="col-xl-3">
                                <div class="input-group w-100 mx-auto d-flex">
                                    <form action="" method="GET" class="">
                                        <input name="name" type="text" class="form-control p-3" placeholder="Search"
                                            aria-describedby="search-icon-1">
                                        <button type="submit"
                                            class="btn btn-primary  border-secondary   text-white h-200">Tìm kiếm
                                        </button>
                                        <form\>
                                </div>
                                <!-- <form action="" method="GET" class="">
                                <input name="name"
                                    class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill"
                                    type="text" placeholder="">
                                <button type="submit"
                                    class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100"
                                    style="top: 0; right: 25%;">Tìm kiếm
                                </button>
                                <form\> -->
                            </div>
                            <div class="col-6"></div>
                            <div class="col-xl-3">
                                <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                    <input type="hidden" name="act" value="shop">
                                    <label for="fruits">Danh mục:</label>

                                    <select id="category" name="category" class="border-0 form-select-sm bg-light me-3"
                                        onchange="this.form.submit()">

                                        <option value="">All</option>
                                        <?php foreach ($danhmuc as $dm) { ?>
                                            <option value="<?= $dm['id'] ?>"
                                                <?= (isset($_GET['category']) && $_GET['category'] == $dm['id']) ? 'selected' : '' ?>>
                                                <?= $dm['name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <!-- <div class="mb-3">
                                            <h4>Categories</h4>
                                            <ul class="list-unstyled fruite-categorie">
                                                <?php foreach ($cam as $cate) { ?>
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Cam</a>
                                                            <span>(<?= $cate['soluong'] ?>)</span>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                                <?php foreach ($nho as $cate) { ?>
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Nho mỹ</a>
                                                            <span>(<?= $cate['soluong'] ?>)</span>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                                <?php foreach ($chuoi as $cate) { ?>
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Chuối </a>
                                                            <span>(<?= $cate['soluong'] ?>)</span>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                                <?php foreach ($man as $cate) { ?>
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Mận cam</a>
                                                            <span>(<?= $cate['soluong'] ?>)</span>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                                <?php foreach ($nhoxanh as $cate) { ?>
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Nho xanh</a>
                                                            <span>(<?= $cate['soluong'] ?>)</span>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                                <?php foreach ($taomeo as $cate) { ?>
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>
                                                                Táo mèo</a>
                                                            <span>(<?= $cate['soluong'] ?>)</span>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div> -->
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">

                                            <h4 class="mb-2">Price</h4>
                                            <div class="col-lg-3">

                                                <input type="hidden" name="act" value="shop">
                                                <select style="width: auto;" name="priceRange" class="form-select"
                                                    onchange="this.form.submit()">
                                                    <option value="">All</option>
                                                    <option value="<100000"
                                                        <?= (isset($_GET['priceRange']) && $_GET['priceRange'] == '<100000') ? 'selected' : '' ?>>
                                                        < 100.000đ</option>
                                                    <option value="100000-300000"
                                                        <?= (isset($_GET['priceRange']) && $_GET['priceRange'] == '100000-300000') ? 'selected' : '' ?>>
                                                        100.000đ-300.000đ</option>
                                                    <option value=">300000"
                                                        <?= (isset($_GET['priceRange']) && $_GET['priceRange'] == '>300000') ? 'selected' : '' ?>>
                                                        >
                                                        300.000đ</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>




                                </div>
                            </div>
                            <div class="col-lg-9">

                                <div class="row g-4 justify-content-center">
                                    <?php
                                    if (isset($_GET["name"])) {
                                        $search = $_GET["name"];
                                    } else {
                                        $search = "";
                                    };
                                    ?>
                                    <?php
                                    // Số sản phẩm mỗi trang
                                    $itemsPerPage = 6;

                                    // Xác định trang hiện tại
                                    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

                                    // Tính tổng số trang
                                    $totalItems = count($products);
                                    $totalPages = ceil($totalItems / $itemsPerPage);

                                    // Xác định chỉ số bắt đầu và kết thúc cho mảng sản phẩm
                                    $startIndex = ($currentPage - 1) * $itemsPerPage;
                                    $productsToShow = array_slice($products, $startIndex, $itemsPerPage);
                                    ?>

                                    <?php if (empty($productsToShow)) : ?>
                                        <p class="text-center">Không có sản phẩm phù hợp.</p>
                                    <?php else : ?>
                                        <?php
                                        foreach ($productsToShow as $list_products) :
                                        ?>
                                            <?php if (
                                                (empty($search)) || (is_string($list_products['name']) && strpos(strtolower($list_products["name"]), strtolower($search)) !== false)
                                            ) : ?>
                                                <div class="col-md-6 col-lg-6 col-xl-4">
                                                    <div class="rounded position-relative fruite-item">
                                                        <!-- ảnh -->
                                                        <div class="fruite-img">
                                                            <img style="height: 200px;"
                                                                src="assets/img/<?= $list_products['img'] ?>"
                                                                class="img-fluid w-100 rounded-top" alt="">

                                                        </div>
                                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                            style="top: 10px; left: 10px;">Fruits</div>
                                                        <div style="height:270px;"
                                                            class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                            <!-- Tên -->
                                                            <h4>
                                                                <a class="linkpro"
                                                                    href="?act=shopdetail&id=<?= $list_products['id'] ?>">
                                                                    <?= $list_products['name'] ?></a>
                                                            </h4>
                                                            <!-- Mô tả -->

                                                            <p style="height:90px;">
                                                                <?= mb_strimwidth($list_products['mota'], 0, 90, "..."); ?>
                                                            </p>
                                                            <p>Lượt xem: <?= $list_products['luotxem'] ?></p>
                                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                                <p class="text-dark fs-5 fw-bold mb-0">
                                                                    <!-- Giá -->
                                                                    <?= number_format($list_products['price']) ?><span> đ /
                                                                        kg</span>
                                                                </p>
                                                                <a href="index.php?act=addToCart&id=<?= $list_products['id'] ?>"
                                                                    class="btn border border-secondary rounded-pill px-3 text-primary">
                                                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm
                                                                </a>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            <?php endif ?>
                                        <?php endforeach ?>

                                    <?php endif ?>

                                    <div class="col-12">
                                        <div class="pagination d-flex justify-content-center mt-5">
                                            <?php if ($currentPage > 1) : ?>
                                                <a href="?act=shop&page=<?= $currentPage - 1 ?>" class="rounded">&laquo;</a>
                                            <?php endif; ?>

                                            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                                <a href="?act=shop&page=<?= $i ?>"
                                                    class="rounded <?= $i === $currentPage ? 'active' : '' ?>"><?= $i ?></a>
                                            <?php endfor; ?>

                                            <?php if ($currentPage < $totalPages) : ?>
                                                <a href="?act=shop&page=<?= $currentPage + 1 ?>" class="rounded">&raquo;</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <!-- Fruits Shop End-->


        </div>
    </div>
    <?php require_once 'assets/footer/footer.php' ?>

</body>

</html>