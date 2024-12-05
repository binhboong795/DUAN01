<!-- header -->
<?php require_once 'asset/headerA/header.php'; ?>
<!-- /#header -->

<!-- Content -->
<!-- Breadcrumbs -->
<div class="breadcrumbs bg-light py-3 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="text-primary">Danh sách hủy đơn hàng</h1>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->

<div class="breadcrumbs mb-5">
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Tên khách hàng</th>
                            <th>Mã tài khoản</th>
                            <th>Mã bill</th>
                            <th>Ngày hủy</th>
                            <th>Lí do</th>
                            <th>Lí do khác</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listhuy as $value): ?>
                            <tr>
                                <td><?= $value['name']; ?></td>
                                <td><?= $value['id']; ?></td>
                                <td><?= $value['idbill']; ?></td>
                                <td><?= $value['ngayhuy']; ?></td>
                                <td><?= $value['lido']; ?></td>
                                <td><?= $value['other_lido']; ?></td>
                                <td>
                                    <button class="btn btn-danger btn-sm text-white"
                                        onclick="deletehuy('index.php?act=deletehuy&id=<?= $value['id']; ?>')">
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
    function deletehuy(Url) {
        if (confirm("Bạn có muốn xóa không?")) {
            document.location = Url;
        }
    }
</script>

</body>

</html>