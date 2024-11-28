<h1>Chỉnh Sửa Sản Phẩm</h1>
<form method="POST" enctype="multipart/form-data" action="index.php?act=sanpham">
    <label for="name">Tên sản phẩm:</label>
    <input type="text" name="name" id="name" value="<?= $product['name'] ?>" required>
    <br>

    <label for="price">Giá:</label>
    <input type="number" name="price" id="price" value="<?= $product['price'] ?>" required>
    <br>


    <br>
    <!-- Hiển thị ảnh hiện tại -->
    <div class="mb-4">
        <label for="img">Ảnh hiện tại:</label>
        <img src="../assets/img/<?= $product['img'] ?>" alt="img" class="d-block mt-2"
            style="max-width: 200px; border: 1px solid #ccc; padding: 5px;">
    </div>

    <!-- Tải ảnh mới -->
    <input class="w-100 form-control border-0 py-3 mb-4" type="file" name="img">
    <label for="mota">Mô tả:</label>
    <textarea name="mota" id="mota" required> <?= $product['mota'] ?></textarea>
    <input type="text" name="mota" id="mota" value="<?= $product['mota'] ?>" required>
    <br>

    <label for="luotxem">Lượt xem:</label>
    <input type="number" name="luotxem" id="luotxem" value="<?= $product['luotxem'] ?>" required>
    <br>

    <label for="iddm">Danh mục :</label>
    <input type="number" name="iddm" id="iddm" value="<?= $product['iddm'] ?>" required>
    <br>

    <label for="motachitiet">Mô tả chi tiết:</label>
    <textarea name="motachitiet" id="motachitiet" value="<?= $product['motachitiet'] ?>" required></textarea>
    <br>
    <label for="soluong">Số Lượng:</label>
    <input type="number" name="soluong" id="soluong" value="<?= $product['soluong'] ?>" required>

    <br>
    <input type="submit" value="add" name="btn_add">
</form>