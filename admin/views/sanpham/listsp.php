<!-- header -->
<?php require_once 'asset/headerA/header.php'; ?>
<!-- /#header -->

<!-- Content -->
<!-- Breadcrumbs -->
<div class="breadcrumbs bg-light py-3">
    <div class="breadcrumbs-inner container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="text-primary">Danh sách sản phẩm</h1>
            </div>
            <div class="col-md-6 text-md-end text-center">
                <a href="?act=add" class="btn btn-success">Thêm sản phẩm mới</a>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="container my-5">
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-primary text-center">
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
                        <td><?= number_format($row['price']) ?> ₫</td>
                        <td class="text-center">
                            <img class="img-thumbnail" style="width: 150px;" src="../assets/img/<?= $row['img'] ?>"
                                alt="Ảnh sản phẩm">
                        </td>
                        <td><?= $row['mota'] ?></td>
                        <td><?= $row['luotxem'] ?></td>
                        <td><?= $row['iddm'] ?></td>
                        <td><?= $row['motachitiet'] ?></td>
                        <td><?= $row['soluong'] ?></td>
                        <td class="text-center">
                            <a href="index.php?act=editsp&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm mb-2">Sửa</a>
                            <a href="index.php?act=deleteproduct&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Footer -->
<?php require_once 'asset/footerA/footer.php'; ?>
<!-- /#footer -->

<script>
    function deleteBanner(Url) {
        if (confirm("Bạn có muốn xóa không")) {
            document.location = Url;
        }
    }