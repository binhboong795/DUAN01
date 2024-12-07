<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm mới</title>
    <!-- Thêm liên kết đến Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center">Thêm sản phẩm mới</h1>
        <form method="POST" enctype="multipart/form-data" action="">
            <div class="form-group">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" class="form-control" name="price" id="price" required>
            </div>

            <div class="form-group">
                <label for="img">Hình ảnh:</label>
                <input type="file" class="form-control-file" name="img" id="img" required>
            </div>

            <div class="form-group">
                <label for="mota">Mô tả ngắn:</label>
                <textarea class="form-control" name="mota" id="mota"></textarea>
            </div>



            <div class="form-group">
                <label for="iddm">Danh mục:</label>
                <select name="category" id="category">
                    <option value="">
                        value
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="motachitiet">Mô tả chi tiết:</label>
                <textarea class="form-control" name="motachitiet" id="motachitiet"></textarea>
            </div>

            <div class="form-group">
                <label for="soluong">Số lượng:</label>
                <textarea class="form-control" name="soluong" id="soluong" required></textarea>
            </div>

            <div class="form-group text-center">
                <input type="submit" class="btn btn-primary" value="Thêm sản phẩm" name="btn_add">
            </div>
        </form>
    </div>

    <!-- Thêm liên kết đến Bootstrap JS và jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>