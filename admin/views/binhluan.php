<!-- header -->
<?php require_once 'asset/headerA/header.php'; ?>
<!-- /#header -->

<!-- Content -->
<!-- Breadcrumbs -->
<div class="breadcrumbs bg-light py-3 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="text-primary">Quản lý Bình Luận</h1>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="breadcrumbs mb-5">

    <?php if (!empty($commentsByProduct)): ?>
        <?php foreach ($commentsByProduct as $idpro => $product): ?>
            <h4 class="mb-4">Bình luận của sản phẩm: <?= $product['tensp']; ?></h4>
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>STT</th>
                                    <th>Nội Dung</th>
                                    <th>Tên Người Bình Luận</th>
                                    <th>Ngày Bình Luận</th>
                                    <th>Rating</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stt = 1;
                                foreach ($product['binh_luan'] as $comment): ?>
                                    <tr>
                                        <td><?= $stt++; ?></td>
                                        <td><?= $comment['noidung']; ?></td>
                                        <td><?= $comment['user']; ?></td>
                                        <td><?php
                                            echo date('d/m/Y', strtotime($comment['ngaybinhluan']));
                                            ?></td>
                                        <td><?= $comment['rating']; ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm text-white"
                                                onclick="deleteBl('index.php?act=deleteBl&id=<?= $comment['idbl']; ?>')">
                                                <i class="fa fa-trash"></i> Xóa
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">Không có bình luận nào.</p>
    <?php endif; ?>
</div>

<!-- Footer -->
<?php require_once 'asset/footerA/footer.php'; ?>
<!-- /#footer -->

<script>
    function deleteBl(Url) {
        if (confirm("Bạn có muốn xóa không?")) {
            document.location = Url;
        }
    }
</script>
</body>

</html>