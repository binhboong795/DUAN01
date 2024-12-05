<!-- header -->
<?php require_once 'asset/headerA/header.php'; ?>
<!-- /#header -->

<!-- Content -->
<!-- Breadcrumbs -->
<div class="breadcrumbs bg-light py-3 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="text-primary">Danh Sách Liên Hệ</h1>
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
                            <th>STT</th>
                            <th>Tên & ID KH</th>
                            <th>SĐT</th>
                            <th>Email</th>
                            <th>Nội Dung</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contact as $index => $value): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $value['name']; ?> (<?= $value['iduser']; ?>)</td>
                                <td><?= $value['sdt']; ?></td>
                                <td><?= $value['mail']; ?></td>
                                <td><?= $value['noidung']; ?></td>

                                <td>
                                    <a href="index.php?act=editcontact&id=<?= $value['id']; ?>"
                                        class="btn btn-info btn-sm text-white">
                                        <i class="fa fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm text-white"
                                        onclick="deleteContact('index.php?act=deletecontact&id=<?= $value['id']; ?>')">
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
    function deleteContact(Url) {
        if (confirm("Bạn có muốn xóa không?")) {
            document.location = Url;
        }
    }
</script>

</body>

</html>