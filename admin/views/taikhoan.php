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
                        <h1>Tài Khoản</h1>
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
                <th>Mã Tài Khoản</th>
                <th>Tên Tài Khoản</th>
                <th>Mật khẩu</th>
                <th>Email</th>
                <th>Vai Trò</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listUser as $value) { ?>
                <tr>
                    <td><?php echo $value['id']; ?></td>
                    <td><?php echo $value['user']; ?></td>
                    <td><?php echo $value['pass']; ?></td>
                    <td><?php echo $value['email']; ?></td>
                    <td><?php echo $value['role'] == 1 ? "Admin" : "User" ?></td>
                    <td>

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