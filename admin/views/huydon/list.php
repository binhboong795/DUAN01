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
                        <h1>Danh sách hủy đơn hàng</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- content -->
<div class="breadcrumbs mb-5">
    <table border="1">
        <thead>
            <tr>
                <th>Mã tài khoản</th>
                <th>Ngày hủy</th>
                <th>Lí do</th>
                <th>Lí do khác</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listhuy as $value) { ?>
                <tr>
                    <td><?php echo $value['id']; ?></td>
                    <td><?php echo $value['ngayhuy']; ?></td>
                    <td><?php echo $value['lido']; ?></td>
                    <td><?php echo $value['other_lido']; ?></td>
                    <td>
                        <button class="btn btn-danger text-white" onclick="deletehuy('index.php?act=deletehuy&id=<?php echo $value['id']; ?>')">Xóa</button>
                    </td>
                </tr>
            <?php } ?>
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
    function deletehuy(Url) {
        if(confirm("Bạn có muốn xóa không")) {
            document.location = Url;
        }
    }
</script>
