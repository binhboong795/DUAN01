<h1>Thêm sản phẩm mới</h1>
<form method="POST" enctype="multipart/form-data" action="">
    <label for="name">Tên sản phẩm:</label>
    <input type="text" name="name" id="name" required>
    <br>

    <label for="price">Giá:</label>
    <input type="number" name="price" id="price" required>
    <br>

    <label for="img">Hình ảnh:</label>
    <input type="file" name="img" id="img" required>
    <br>

    <label for="mota">Mô tả ngắn:</label>
    <textarea name="mota" id="mota" required></textarea>
    <br>

    <label for="luotxem">Lượt xem:</label>
    <input type="number" name="luotxem" id="luotxem" value="0" required>
    <br>

    <label for="iddm">Danh mục :</label>
    <input type="number" name="iddm" id="iddm" required>
    <br>

    <label for="motachitiet">Mô tả chi tiết:</label>
    <textarea name="motachitiet" id="motachitiet" required></textarea>
    <br>
    <label for="soluong">Số Lượng:</label>
    <textarea name="soluong" id="soluong" required></textarea>
    <br>
    <input type="submit" value="add" name="btn_add">
</form>