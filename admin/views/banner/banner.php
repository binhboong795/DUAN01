<!-- header -->
<?php require_once 'asset/headerA/header.php'; ?>
<!-- /#header -->

<!-- Content -->
<!-- Breadcrumbs-->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Banner</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- content -->
<div class="breadcrumbs mb-5">
    <a href="?act=insertbanner">Thêm banner mới</a>
    <table border="1">
        <thead>
            <tr>
                <th>Mã Banner</th>
                <th>Tên Ảnh</th>
                <th>Ảnh</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listBanner as $value) { ?>
                <tr>
                    <td><?= $value['id']; ?></td>
                    <td><?= $value['name']; ?></td>
                    <td> <img src="../assets/img/<?= $value['img'] ?>" style="width: 150px;"></td>
                    <td>
                        <a href="index.php?act=editBanner&id=<?= $value['id']; ?>"><button>Sửa</button></a>
                        <button onclick="deleteBanner('index.php?act=deletebanner&id=<?= $value['id']; ?>')">Xóa</button>
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
    function deleteBanner(Url) {
        if (confirm("Bạn có muốn xóa không")) {
            document.location = Url;
        }
    }
</script>