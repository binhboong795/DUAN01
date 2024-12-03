<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Sản Phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Chỉnh Sửa Sản Phẩm</h1>
        <form method="POST" enctype="multipart/form-data">
            <!-- Tên sản phẩm -->
            <div class="form-group">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" class="form-control" name="name" id="name"
                    value="<?= htmlspecialchars($sanpham['name']) ?>">
            </div>

            <!-- Giá -->
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" class="form-control" name="price" id="price"
                    value="<?= htmlspecialchars($sanpham['price']) ?>" min="0">
            </div>

            <!-- Hiển thị ảnh hiện tại -->
            <div class="form-group">
                <label>Ảnh hiện tại:</label>
                <div>
                    <img src="../assets/img/<?= htmlspecialchars($sanpham['img']) ?>" alt="Ảnh hiện tại"
                        class="img-thumbnail mt-2" style="max-width: 200px;">
                </div>
            </div>

            <!-- Tải ảnh mới -->
            <div class="form-group">
                <label for="img">Tải ảnh mới:</label>
                <input class="form-control-file" type="file" name="img" id="img">
            </div>

            <!-- Mô tả ngắn -->
            <div class="form-group">
                <label for="mota">Mô tả:</label>
                <textarea class="form-control" name="mota" id="mota" rows="3"
                    required><?= htmlspecialchars($sanpham['mota']) ?></textarea>
            </div>



            <!-- Danh mục -->
            <div class="form-group">
                <label for="iddm">Danh mục:</label>
                <input type="number" class="form-control" name="iddm" id="iddm"
                    value="<?= htmlspecialchars($sanpham['iddm']) ?>" min="0">
            </div>

            <!-- Mô tả chi tiết -->
            <div class="form-group">
                <label for="motachitiet">Mô tả chi tiết:</label>
                <input class="form-control" name="motachitiet" id="motachitiet" rows="5"
                    <?= htmlspecialchars($sanpham['motachitiet']) ?>>
            </div>

            <!-- Số lượng -->
            <div class="form-group">
                <label for="soluong">Số lượng:</label>
                <input type="number" class="form-control" name="soluong" id="soluong"
                    value="<?= htmlspecialchars($sanpham['soluong']) ?>" min="0">
            </div>

            <!-- Nút submit -->
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary" name="btn_update">Cập nhật</button>
                <a href="?act=sanpham" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>