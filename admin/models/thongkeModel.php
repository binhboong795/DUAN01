<?php
class thongkeModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connectDB();
    }
    function getAllStk()
    {
        $sql = "SELECT * FROM thongke ORDER BY id desc";
        return $this->conn->query($sql);
    }
    function deleteStatus($id)
    {
        $sql = "DELETE FROM trangthai WHERE id = $id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    function updatePaymentMethod($id, $bill_status)
    {
        $sql = "UPDATE trangthai SET bill_status = :bill_status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        // Gắn tham số vào câu lệnh
        $stmt->bindValue(':bill_status', $bill_status, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        } else {
            die("Lỗi thực thi câu lệnh: " . implode(", ", $stmt->errorInfo()));
        }
    }
    // function updateIdBillInTrangthai()
    // {
    //     $sql = "UPDATE trangthai AS t
    //         JOIN orders AS o ON t.id_user = o.iduser
    //         SET t.idbill = o.idbill
    //         WHERE t.idbill IS NULL";

    //     $stmt = $this->conn->prepare($sql);
    //     return $stmt->execute();
    // }
    function getCurrentStatusById($id)
    {
        $sql = "SELECT bill_status FROM trangthai WHERE bill_status = 'Giao hàng thành công";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn(); // Lấy giá trị của `bill_status`
    }
    function deleteBill($idbill)
    {
        try {
            // Xóa dữ liệu trong bảng chi tiết đơn hàng trước
            $sqlDetails = "DELETE FROM orders WHERE idbill = :idbill";
            $stmtDetails = $this->conn->prepare($sqlDetails);
            $stmtDetails->execute(['idbill' => $idbill]);

            // Xóa dữ liệu trong bảng trạng thái (nếu có)
            $sqlStatus = "DELETE FROM trangthai WHERE id_bill = :idbill";
            $stmtStatus = $this->conn->prepare($sqlStatus);
            $stmtStatus->execute(['idbill' => $idbill]);

            // Xóa dữ liệu trong bảng đơn hàng
            $sqlBill = "DELETE FROM thongke WHERE tk_idbill = :idbill";
            $stmtBill = $this->conn->prepare($sqlBill);
            $stmtBill->execute(['idbill' => $idbill]);
        } catch (PDOException $e) {
            error_log("Error deleting bill: " . $e->getMessage());
            throw $e; // Ném lỗi để xử lý thêm nếu cần
        }
    }
}
