<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <?php include 'views/components/style.php' ?>
</head>
<style>
    .text-right {
        text-align: right;
    }

    table {
        width: 100%;
        table-layout: fixed;
        /* Makes columns have equal width */
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 10px;
        width: 14%;
        /* Set an approximate equal width for all columns */
        text-align: center;
    }

    /* Specific styling for the total row */
    .total-row th,
    .total-row td {
        font-weight: bold;
    }
</style>


<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <?php require_once 'assets/header/headerOrder.php' ?>


    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       
    </div>
    <!-- Modal Search End -->


    <!-- Single Page Header start -->
    <div class="" style="height: 55px"></div>
    <!-- Single Page Header End -->


    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="testimonial-header text-center">
                <h1 class="display-5 mb-5 text-dark">Hủy đơn hàng</h1>
            </div>

        </div>
        <!-- Nút Hủy Đơn Hàng -->
        <form id="cancelOrderForm" method="post">
           

            <!-- Modal Hủy Đơn Hàng -->

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cancelOrderLabel">Lý do hủy đơn hàng</h5>
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="cancelReason" class="form-label">Chọn lý do hủy:</label>
                                <select id="cancelReason" class="form-select" name="lido" required>
                                    <option value="" disabled selected>Chọn lý do</option>
                                    <option value="Tôi không muốn mua nữa">Tôi không muốn mua nữa</option>
                                    <option value="Giá sản phẩm quá cao">Giá sản phẩm quá cao</option>
                                    <option value="Đơn hàng được tạo do có sự nhầm lẫn">Đơn hàng được tạo do có sự nhầm lẫn</option>
                                    <option value="Đã tìm được nơi mua khác">Đã tìm được nơi mua khác</option>
                                    <option value="Lý do khác">Lý do khác</option>
                                </select>
                            </div>
                            <div class="mb-3" id="otherReasonInput" style="display: none;">
                                <label for="otherReason" class="form-label">Nhập lý do khác:</label>
                                <textarea id="otherReason" class="form-control" name="other_lido" rows="3"></textarea>
                            </div>  
                        </div>
                        <div class="modal-footer">
                            <a href="index.php?act=chitietdonhang"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button></a>
                            <button type="submit" class="btn btn-primary" id="confirmCancel" name="huydonhang">Xác nhận hủy</button>
                        </div>
        </form>
    </div>
    </div>
    </div>


    </div>

    <!-- Checkout Page End -->

    <?php require_once 'assets/footer/footer.php' ?>

</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cancelReasonSelect = document.getElementById('cancelReason');
        const otherReasonInput = document.getElementById('otherReasonInput');
        const confirmCancelButton = document.getElementById('confirmCancel');

        // Hiển thị ô nhập nếu chọn "Lý do khác"
        cancelReasonSelect.addEventListener('change', function() {
            if (this.value === 'Lý do khác') {
                otherReasonInput.style.display = 'block';
            } else {
                otherReasonInput.style.display = 'none';
            }
        });

        // Xử lý khi nhấn nút "Xác nhận hủy"
        confirmCancelButton.addEventListener('click', function() {
            const selectedReason = cancelReasonSelect.value;
            const otherReason = document.getElementById('otherReason').value;

            if (!selectedReason) {
                alert('Vui lòng chọn lý do hủy đơn hàng.');
                return;
            }

            let reason = selectedReason;
            if (selectedReason === 'Lý do khác') {
                reason = otherReason;
            }

            if (!reason) {
                alert('Vui lòng nhập lý do hủy đơn hàng.');
                return;
            }

            // Thực hiện gửi lý do hủy qua AJAX hoặc chuyển hướng tới server xử lý
            console.log('Lý do hủy đơn hàng:', reason);

            // Ví dụ: Đóng modal sau khi xử lý
            const cancelOrderModal = bootstrap.Modal.getInstance(document.getElementById('cancelOrderModal'));
            cancelOrderModal.hide();

            alert('Đơn hàng của bạn đã bị hủy với lý do: ' + reason);
        });
    });
</script>