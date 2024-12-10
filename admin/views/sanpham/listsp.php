<!-- header -->
<?php require_once 'asset/headerA/header.php'; ?>
<!-- /#header -->

<!-- Breadcrumbs -->
<div class="breadcrumbs bg-light py-3 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="text-primary">Danh sách sản phẩm</h1>
            </div>

        </div>
    </div>
</div>

<!-- Main Content -->
<div class="breadcrumbs mb-5">
    <div class="card shadow">
        <div class="col-md-6 text-md-end">
            <a href="?act=add" class="btn btn-success">
                <i class="fa fa-plus"></i> Thêm sản phẩm mới
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Giá</th>
                            <th>Hình ảnh</th>
                            <th>Mô tả ngắn</th>
                            <th>Lượt xem</th>
                            <th>Danh mục</th>
                            <th>Mô tả chi tiết</th>
                            <th>Số lượng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($product as $key => $row) { ?>
                            <tr>
                                <td><?= $row['pr_id'] ?></td>
                                <td><?= $row['pr_name'] ?></td>
                                <td><?= number_format($row['price']) ?> ₫</td>
                                <td>
                                    <img src="../assets/img/<?= $row['img'] ?>" alt="Ảnh sản phẩm" class="img-thumbnail"
                                        style="width: 100px;">
                                </td>
                                <td><?= $row['mota'] ?></td>
                                <td><?= $row['luotxem'] ?></td>
                                <td><?= $row['category_name'] ?></td>
                                <td><?= $row['motachitiet'] ?></td>
                                <td><?= $row['soluong'] ?></td>
                                <td>
                                    <div class="d-grid gap-2 d-md-block">
                                        <a href="?act=editsp&id=<?= $row['pr_id'] ?>" class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i> Sửa
                                        </a>
                                        <a href="index.php?act=deleteproduct&id=<?= $row['pr_id'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                            <i class="fa fa-trash"></i> Xóa
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
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
</script>