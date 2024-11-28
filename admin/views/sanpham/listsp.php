<!-- header -->
<?php require_once 'asset/headerA/header.php'; ?>
<!-- /#header -->

<!-- Content -->
<!-- Breadcrumbs-->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Danh sách sản phẩm</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- content -->
<div class="breadcrumbs mb-5">
    <a href="?act=add">Thêm sản phẩm mới</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Hình ảnh</th>
                <th>Mô tả ngắn</th>
                <th>Lượt xem</th>
                <th>Danh mục</th>
                <th>Mô tả chi tiết</th>
                <th>Số Lượng</th>
                <th>Hành động</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($product as $key => $row) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['price'] ?></td>
                    <td><img style="width: 150px;" src="../assets/img/<?= $row['img'] ?>"></td>
                    <td><?= $row['mota'] ?></td>
                    <td><?= $row['luotxem'] ?></td>
                    <td><?= $row['iddm'] ?></td>
                    <td><?= $row['motachitiet'] ?></td>
                    <td><?= $row['soluong'] ?></td>
                    <td>
                        <a href="index.php?act=editsp&id=<?= $row['id'] ?>">Sửa</a>
                        <a href="index.php?act=deleteProduct&id=<?= $row['id'] ?>"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</a>
                    </td>
                </tr>
            <?php  } ?>
        </tbody>
    </table>

</div>
<!-- content -->


<!-- .animated -->

<!-- /.content -->
<div class="clearfix"></div>
<!-- Footer -->
<?php require_once 'asset/footerA/footer.php'; ?>
<!-- /.site-footer -->
</div>
<!-- /#right-panel -->


</body>

</html>
<script>
    function deleteBanner(Url) {
        if (confirm("Bạn có muốn xóa không")) {
            document.location = Url;
        }
    }
</script>