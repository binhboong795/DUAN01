<?php
class statusModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connectDB();
    }
    function getAllStatus()
    {
        $sql = "SELECT * FROM trangthai ORDER BY id desc";
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
}
