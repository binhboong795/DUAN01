<!-- header -->
<?php require_once 'asset/headerA/header.php'; ?>
<!-- /#header -->

<!-- Content -->
<!-- Breadcrumbs-->
<div class="breadcrumbs mb-5">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Quản Lý Tài Khoản</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="container">
    <div class="card">
        <div class="card-header">
            <strong>Danh sách hóa đơn</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>ID Khách</th>
                        <th>Mã Bill</th>
                        <th>Tên Tài Khoản</th>
                        <th>Địa Chỉ</th>
                        <th>Số Điện Thoại</th>
                        <th>Email</th>
                        <th>Phương thức thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt hàng</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($status as $value) { ?>
                        <tr>
                            <td><?= $value['id_user']; ?></td>
                            <td><?= $value['id']; ?></td>
                            <td><?= $value['bill_name']; ?></td>
                            <td><?= $value['bill_address']; ?></td>
                            <td><?= $value['bill_tell']; ?></td>
                            <td><?= $value['bill_email']; ?></td>
                            <td><?= $value['bill_pttt']; ?></td>
                            <td>
                                <!-- Form cập nhật phương thức thanh toán -->
                                <form method="POST" action="index.php?act=updatestatus&id=<?= $value['id']; ?>">
                                    <select class="form-control" name="bill_status" onchange="this.form.submit()">
                                        <option value="Đợi thanh toán"
                                            <?= $value['bill_status'] == 'Đợi thanh toán' ? 'selected' : ''; ?>>
                                            Đợi thanh toán
                                        </option>
                                        <option value="Đã thanh toán"
                                            <?= $value['bill_status'] == 'Đã thanh toán' ? 'selected' : ''; ?>>
                                            Đã thanh toán
                                        </option>
                                        <option value="Đang giao hàng"
                                            <?= $value['bill_status'] == 'Đang giao hàng' ? 'selected' : ''; ?>>
                                            Đang giao hàng
                                        </option>
                                        <option value="Đã giao hàng"
                                            <?= $value['bill_status'] == 'Đã giao hàng' ? 'selected' : ''; ?>>
                                            Đã giao hàng
                                        </option>
                                    </select>
                                </form>
                            </td>
                            <td><?= $value['ngaydathang']; ?></td>
                            <td>
                                <!-- Nút sửa -->
                                <a href="index.php?act=updatestatus&id=<?= $value['id']; ?>">
                                    <button class="btn btn-primary btn-sm">Sửa</button>
                                </a>
                                <!-- Nút xóa -->
                                <button class="btn btn-danger btn-sm"
                                    onclick="deleteUser('index.php?act=deletestatus&id=<?= $value['id']; ?>')">Xóa</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

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
    function deleteUser(Url) {
        if (confirm("Bạn có muốn xóa không?")) {
            document.location = Url;
        }
    }
</script>