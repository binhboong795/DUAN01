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
<a href="index.php?act=addUser"><button class="mb-5 text-white btn btn-danger">Thêm tài khoản</button></a>
    <table border="1">
        <thead>
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
            <?php foreach ($listUser as $value) { ?>
                <tr>
                    <td><?php echo $value['id']; ?></td>
                    <td><?php echo $value['user']; ?></td>
                    <td><?php echo $value['pass']; ?></td>
                    <td><?php echo $value['email']; ?></td>
                    <td><?php echo $value['address']; ?></td>
                    <td><?php echo $value['tell']; ?></td>
                    <td><?php echo $value['role']?></td>
                    <td><?php echo $value['role'] == 1 ? "Admin" : "User" ?></td>
                    <td>
                        <a href="index.php?act=editUser&id=<?php echo $value['id']; ?>"><button class="btn btn-info text-white">Sửa</button></a>
                        <button class="btn btn-danger text-white" onclick="deleteUser('index.php?act=deleteUser&id=<?php echo $value['id']; ?>')">Xóa</button>
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
    function deleteUser(Url) {
        if(confirm("Bạn có muốn xóa không")) {
            document.location = Url;
        }
    }
</script>
