<!-- header -->
<?php require_once 'asset/headerA/header.php'; ?>
<!-- /#header -->

<!-- Content -->
<!-- Breadcrumbs -->
<div class="breadcrumbs bg-light py-3 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="text-primary">Quản lý tài khoản</h1>
            </div>

        </div>
    </div>
</div>

<!-- Main Content -->
<div class="breadcrumbs mb-5">
    <div class="card shadow">
        <div class="col-md-6 text-md-end">
            <a href="index.php?act=addUser" class="btn btn-danger">
                <i class="fa fa-plus"></i> Thêm tài khoản
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Mã Tài Khoản</th>
                            <th>Tên Tài Khoản</th>
                            <th>Mật khẩu</th>
                            <th>Email</th>
                            <th>Địa Chỉ</th>
                            <th>Số Điện Thoại</th>
                            <th>Vai Trò (Số)</th>
                            <th>Tên Vai Trò</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listUser as $value): ?>
                            <tr>
                                <td><?= $value['id']; ?></td>
                                <td><?= $value['user']; ?></td>
                                <td><?= $value['pass']; ?></td>
                                <td><?= $value['email']; ?></td>
                                <td><?= $value['address']; ?></td>
                                <td><?= $value['tell']; ?></td>
                                <td><?= $value['role']; ?></td>
                                <td><?= $value['role'] == 1 ? 'Admin' : 'User'; ?></td>
                                <td>
                                    <a href="index.php?act=editUser&id=<?= $value['id']; ?>"
                                        class="btn btn-info btn-sm text-white">
                                        <i class="fa fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm text-white"
                                        onclick="deleteUser('index.php?act=deleteUser&id=<?= $value['id']; ?>')">
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
    function deleteUser(Url) {
        if (confirm("Bạn có muốn xóa không?")) {
            document.location = Url;
        }
    }
</script>
</body>

</html>