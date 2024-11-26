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
                        <h1>Bình Luận</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="breadcrumbs mb-5">
    <?php if (!empty($commentsByProduct)) { ?>
        <?php foreach ($commentsByProduct as $idpro => $product) { ?>
            <h4>Bình luận của sản phẩm <?php echo $product['tensp'] ?></h4>
            <table border="1">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Nội Dung</th>
                        <th>Ten Người Bình Luận</th>
                        <th>Ngay Bình Luận</th>
                        <th>Rating</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $stt = 1;
                    foreach ($product['binh_luan'] as $comment) { ?>
                        <tr>
                            <td><?php echo $stt++; ?></td>
                            <td><?php echo $comment['noidung']; ?></td>
                            <td><?php echo $comment['user']; ?></td>
                            <td><?php echo $comment['ngaybinhluan']  ?></td>
                            <td><?php echo $comment['rating']; ?></td>
                            <td> <button class="btn btn-warning"
                                    onclick="deleteBl('index.php?act=deleteBl&id=<?php echo $comment['idbl']; ?>')">Xóa</button>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    <?php } else { ?>
        <p>Khong co binh luan nao</p>
    <?php } ?>
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
    function deleteBl(Url) {
        if (confirm("Bạn có muốn xóa không")) {
            document.location = Url;
        }
    }
</script>