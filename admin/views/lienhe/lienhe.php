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
                <th>STT</th>
                <th>Tên & ID KH </th>
                <th>SĐT</th>
                <th>Email</th>
                <th>Nội dung</th>
                <th>Địa Chỉ</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($contact as $index => $value) { ?>
                <tr>
                    <td><?php echo $index + 1 ?></td>
                    <td><?= $value['name']; ?>
                        (<?= $value['iduser']; ?>)</td>
                    <td><?php echo $value['sdt']; ?></td>
                    <td><?php echo $value['mail']; ?></td>
                    <td><?php echo $value['noidung']; ?></td>
                    <td>
                        <a href="index.php?act=editcontact&id=<?php echo $value['id']; ?>"><button
                                class="btn btn-info text-white">Sửa</button></a>
                        <button class="btn btn-danger text-white"
                            onclick="deleteContact('index.php?act=deletecontact&id=<?= $value['id']; ?>')">Xóa</button>
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
    function deleteContact(Url) {
        if (confirm("Bạn có muốn xóa không")) {
            document.location = Url;
        }
    }
</script>