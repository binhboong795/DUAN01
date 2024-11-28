<?php require_once 'asset/headerA/header.php'; ?>
<!-- /#header -->

<!-- Content -->
<!-- Breadcrumbs-->
<div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-primary">Thêm danh mục mới</h1>
                        </div>
                    </div>
                    <!-- <div class="col-lg-12">
                            <div class="h-100 rounded">
                                <iframe class="rounded w-100" 
                               
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div> -->
                    <div class="col-lg-12">
                        <form action="" method="post">

                            <input class="w-100 form-control border-0 py-3 mb-4" type="text" name="name"
                                placeholder="Tên danh mục">
                           
                            <!-- <p style="color: red;"><?=$error?></p> -->
                            <button class="btn form-control btn-primary text-light "
                                type="submit" name="themmoi">Thêm mới</button>

                            <!-- <a href="?act=dangnhap">Đăng nhập</a> -->
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
<div class="clearfix"></div>
<!-- Footer -->
<?php require_once 'asset/footerA/footer.php'; ?>
<!-- /.site-footer -->
</div>
<!-- /#right-panel -->


</body>

</html>