<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Banner</title>
</head>

<body>
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-primary">CẬP NHẬT BANNER</h1>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <form action="" method="post" enctype="multipart/form-data">
                            <!-- Hiển thị tên -->
                            <input class="w-100 form-control border-0 py-3 mb-4" type="text" name="name"
                                placeholder="Tên Banner" value="<?= $idBanner['name'] ?>" required>

                            <!-- Hiển thị ảnh hiện tại -->
                            <div class="mb-4">
                                <label for="img">Ảnh hiện tại:</label>
                                <img src="../assets/img/<?= $idBanner['img'] ?>" alt="Banner Image" class="d-block mt-2"
                                    style="max-width: 200px; border: 1px solid #ccc; padding: 5px;">
                            </div>

                            <!-- Tải ảnh mới -->
                            <input class="w-100 form-control border-0 py-3 mb-4" type="file" name="img">

                            <!-- Nút cập nhật -->
                            <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary"
                                type="submit" name="btn_update">Cập Nhật</button>

                            <!-- Hiển thị lỗi nếu có -->
                            <?php if (!empty($error)): ?>
                                <p style="color: red;"><?= $error ?></p>
                            <?php endif; ?>
                        </form>
                    </div>
                    <div class="col-lg-5">
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Address</h4>
                                <p class="mb-2">Trường Cao Đẳng FPT Polytechnic</p>
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