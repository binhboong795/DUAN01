<?php
require_once 'asset/headerA/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <style>
        @keyframes bounceSlow {
        0% {
            transform: translateY(0) rotate(0deg);
            /* Vị trí ban đầu và không xoay */
            filter: drop-shadow(1px 1px 10px #00FF00);
            /* Bóng đổ lúc đầu */
        }     

        30% {
            transform: translateY(-100px);
            /* Xoay thêm khi quả táo rơi xuống */
            filter: drop-shadow(1px 1px 10px #00FF66);
        }
        

        100% {
            transform: translateY(0) rotate(360deg);
            /* Trở về vị trí ban đầu và xoay một vòng hoàn chỉnh */
            filter: drop-shadow(1px 1px 10px #66FF99);
            /* Bóng đổ lúc kết thúc */
        }
    }

    .bouncing-slow-apple {
        animation: bounceSlow 3s ease-in-out infinite;
        /* Thời gian và hiệu ứng */
        transition: box-shadow 0.3s ease;
        /* Chuyển đổi mượt mà cho bóng đổ */
    }
    </style> -->
</head>

<body>
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                            <h1 class="text-primary">Cập Nhật Tài Khoản</h1>
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

                            <input class="w-100 form-control border-0 py-3 mb-4" type="text" name="name"
                                placeholder="Tên tài khoản" value="<?php echo $idContact['name'] ?>">


                            <input class="w-100 form-control border-0 py-3 mb-4" type="number" name="sdt"
                                placeholder="sdt" value="<?php echo $idContact['sdt'] ?>">

                            <input class="w-100 form-control border-0 py-3 mb-4" type="email" name="mail"
                                placeholder="Email" value="<?php echo $idContact['mail'] ?>">


                            <input class="w-100 form-control border-0 py-3 mb-4" type="text" name="noidung"
                                placeholder="Tell" value="<?php echo $idContact['noidung'] ?>">





                            <button class="w-100 btn form-control border-secondary bg-white text-primary " type="submit"
                                name="capnhat">Cập Nhật</button>

                            <!-- <a href="?act=dangnhap">Đăng nhập</a> -->
                        </form>
                    </div>
                    <div class="col-lg-5">
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-map-marker-alt fa-2x fs-7 text-primary me-4 mr-2"
                                style="font-size: 30px; padding-top:5px;"></i>
                            <div>
                                <h4>Address</h4>
                                <p class="mb-2">Trường Cao Đẳng FPT Polytechnic</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-envelope fa-2x text-primary me-4 mr-2"
                                style="font-size: 30px; padding-top:5px;"></i>
                            <div>
                                <h4>Mail Us</h4>
                                <p class="mb-2">caodangfpt@fpt.edu.vn</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded bg-white">
                            <i class="fa fa-phone-alt fa-2x text-primary me-4 mr-2"
                                style="font-size: 30px; padding-top:5px;"></i>
                            <div>
                                <h4>Telephone</h4>
                                <p class="mb-2">0954835784</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
// require_once 'assets/footer/footer.php';
?>