<!-- header -->
<?php require_once 'asset/headerA/header.php'; ?>
<!-- /#header -->

<!-- Breadcrumbs -->
<div class="breadcrumbs bg-light py-3 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="text-primary">Quản lý danh mục</h1>
            </div>

        </div>
    </div>
</div>

<!-- Main Content -->
<div class="breadcrumbs mb-5">
    <div class="card shadow">
        <div class="col-md-6 text-md-end">
            <a href="index.php?act=addDanhmuc" class="btn btn-success">
                <i class="fa fa-plus"></i> Thêm danh mục mới
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>STT</th>
                            <th>Tên danh mục</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt = 1; ?>
                        <?php foreach ($listDanhmuc as $value): ?>
                        <tr>
                            <td><?= $stt++; ?></td>
                            <td><?= $value['name']; ?></td>
                            <td>
                                <a href="index.php?act=editDanhmuc&id=<?= $value['id']; ?>"
                                    class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Sửa
                                </a>
                                <button class="btn btn-danger btn-sm"
                                    onclick="deleteDanhmuc('index.php?act=deleteDanhmuc&id=<?= $value['id']; ?>')">
                                    <i class="fa fa-trash"></i> Xóa
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
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
function deleteDanhmuc(Url) {
    if (confirm("Bạn có muốn xóa không?")) {
        document.location = Url;
    }
}
</script>