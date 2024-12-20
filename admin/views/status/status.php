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
<style>
.limited-width {
    max-width: 330px;
    /* Giới hạn chiều rộng */
    word-wrap: break-word;
    /* Tự động xuống dòng */
    white-space: normal;
    /* Bật xuống dòng */
}

/* Thay đổi màu nền, viền và bo tròn */
/* Cải thiện giao diện select box */
.form-select {
    border-radius: 8px;
    /* Bo tròn các góc */
    background-color: #f8f9fa;
    /* Màu nền sáng */
    border: 1px solid #ced4da;
    /* Đường viền nhạt */
    padding: 0.375rem 0.75rem;
    /* Điều chỉnh padding */
}

/* Khi thẻ select được focus */
.form-select:focus {
    border-color: #007bff;
    /* Màu viền khi focus */
    box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
    /* Hiệu ứng bóng mờ */
}

/* Cải thiện size của select box khi nhỏ */
.form-select-sm {
    height: 35px;
    font-size: 14px;
}

/* Hiệu ứng khi hover vào select */
.form-select:hover {
    border-color: #0056b3;
    /* Màu viền khi hover */
}

/* Chỉ áp dụng hiệu ứng hover cho các thẻ td */
table tbody tr td:hover {
    background-color: #f1f1f1;
    /* Màu nền khi hover */
    cursor: pointer;
    /* Thêm con trỏ tay khi hover */
}
</style>


<!-- Content -->
<div class="breadcrumbs mb-5">
    <div class="card shadow">

        <div class="card-body">
            <table class="table table-bordered  text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>STT</th>
                        <th>Mã Bill</th>
                        <th>Tên & ID KH</th>
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
                    <?php foreach ($status as $key => $value) { ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $value['id_bill']; ?></td>
                        <td><?= $value['bill_name']; ?>
                            (<?= $value['id_user']; ?>)</td>
                        <td style="max-width: 200px;"><?= $value['bill_address']; ?></td>
                        <td><?= $value['bill_tell']; ?></td>
                        <td><?= $value['bill_email']; ?></td>
                        <td><?= $value['bill_pttt']; ?></td>
                        <td>
                            <form method="POST" action="index.php?act=updatestatus&id_bill=<?= $value['id_bill']; ?>">
                                <select class="form-select form-select-sm" name="bill_status"
                                    onchange="this.form.submit()"
                                    <?= $value['bill_status'] == 'Giao hàng thành công' ? 'disabled' : ''; ?>>
                                    <option value="Chờ xác nhận"
                                        <?= $value['bill_status'] == 'Chờ xác nhận' ? 'selected' : ''; ?>
                                        <?= in_array($value['bill_status'], ['Đã xác nhận', 'Đang giao hàng', 'Giao hàng thành công']) ? 'disabled' : ''; ?>>
                                        Chờ xác nhận
                                    </option>
                                    <option value="Đã xác nhận"
                                        <?= $value['bill_status'] == 'Đã xác nhận' ? 'selected' : ''; ?>
                                        <?= in_array($value['bill_status'], ['Đang giao hàng', 'Giao hàng thành công']) ? 'disabled' : ''; ?>>
                                        Đã xác nhận
                                    </option>
                                    <option value="Đang giao hàng"
                                        <?= $value['bill_status'] == 'Đang giao hàng' ? 'selected' : ''; ?>
                                        <?= $value['bill_status'] == 'Giao hàng thành công' ? 'disabled' : ''; ?>>
                                        Đang giao hàng
                                    </option>
                                    <option value="Giao hàng thành công"
                                        <?= $value['bill_status'] == 'Giao hàng thành công' ? 'selected' : ''; ?>>
                                        Giao hàng thành công
                                    </option>
                                </select>
                            </form>



                        </td>

                        <td><?= $value['ngaydathang']; ?></td>

                        <td>
                            <?php if (is_null($value['bill_status']) || $value['bill_status'] == 'Đã xác nhận'): ?>
                            <button class="btn btn-danger btn-sm"
                                onclick="deleteUser('index.php?act=deletestatus&id_bill=<?= $value['id_bill']; ?>')">
                                <i class="fa fa-trash"></i> Hủy
                            </button>
                            <?php endif; ?>
                        </td>
                        <!-- <td>
                            <a href="index.php?act=updatestatus&id=<?= $value['id']; ?>"
                                class="btn btn-primary btn-sm me-2">
                                <i class="fa fa-edit"></i> Sửa
                            </a>
                            <button class="btn btn-danger btn-sm"
                                onclick="deleteUser('index.php?act=deletestatus&id=<?= $value['id']; ?>')">
                                <i class="fa fa-trash"></i> Xóa
                            </button>
                        </td> -->
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