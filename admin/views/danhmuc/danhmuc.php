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
                        <h1>Danh Mục</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-success "><a href="index.php?act=addDanhmuc" class="text-light">Thêm mới</a></button>
    <table border="1">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên danh mục</th>  
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stt=1;
             foreach ($listDanhmuc as $value) { ?>
                <tr>
                    <td><?php echo $stt++; ?></td>
                    <td><?php echo $value['name']; ?></td>          
                    <td>
                        <a href="index.php?act=editDanhmuc&id=<?= $value['id']; ?>"><button class="btn btn-warning">Sửa</button></a>
                        <button class="btn btn-danger" onclick="deleteDanhmuc('index.php?act=deleteDanhmuc&id=<?php echo $value['id']; ?>')">Xóa</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>
    <!-- content -->
        
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
    function deleteDanhmuc(Url) {
        if(confirm("Bạn có muốn xóa không")) {
            document.location = Url;
        }
    }
</script>
