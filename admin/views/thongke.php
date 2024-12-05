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
                        <h1>Trang thống kế </h1>
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
            <!-- <?php echo "<pre>";
                    print_r($thongke);
                    echo "</pre>";

                    ?> -->
            <table class="table table-bordered  text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>STT</th>
                        <th>Mã Bill</th>
                        <th>Tên & ID KH</th>
                        <th>Địa Chỉ</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>

                        <!-- <th>Phương thức thanh toán</th> -->
                        <!-- <th>Ngày đặt hàng</th> -->
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($thongke as $key => $value) { ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $value['tk_idbill']; ?></td>
                        <td><?= $value['tk_nameuser']; ?>
                            (<?= $value['tk_iduser']; ?>)</td>

                        <td><?= $value['tk_namepro']; ?></td>
                        <td><?= number_format($value['tk_thanhtien']) ?></td>
                        <td><?= $value['tk_status']; ?></td>




                        <td>
                            <!-- Checkbox ẩn, chỉ dùng để thay đổi trạng thái -->
                            <input type="checkbox" id="delete-toggle-<?= $value['tk_idbill']; ?>"
                                class="delete-toggle" />
                            <label for="delete-toggle-<?= $value['tk_idbill']; ?>"
                                class="fa-regular fa-circle-xmark delete-label"></label>

                            <!-- Nút xóa sẽ chỉ hiển thị khi checkbox được check -->
                            <button class="btn btn-danger btn-sm delete-btn"
                                onclick="deletebill('index.php?act=deletethongke&tk_idbill=<?= $value['tk_idbill']; ?>')">
                                Xóa
                            </button>
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
<style>
.delete-toggle {
    display: none;
    /* Ẩn checkbox */
}

.delete-btn {
    display: none;
    /* Ẩn nút xóa mặc định */
}

.delete-label {
    cursor: pointer;
    /* Thêm con trỏ khi di chuột vào */
}

/* Khi checkbox được check, hiển thị nút xóa và ẩn label */
.delete-toggle:checked+.delete-label {
    display: none;
    /* Ẩn label khi checkbox được check */
}

.delete-toggle:checked+.delete-label+.delete-btn {
    display: inline-block;
    /* Hiển thị nút xóa */
}
</style>


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
function deletebill(Url) {
    if (confirm("Bạn có muốn xóa không?")) {
        document.location = Url;
    }
}
</script>