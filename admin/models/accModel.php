<?php
class accModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connectDB();
    }

    function getAllUser()
    {
        $sql = "SELECT * FROM taikhoan"; // Đảm bảo đúng tên bảng
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng kết quả
    }
    function updateUser()
    {
        $sql = "SELECT * FROM taikhoan"; // Đảm bảo đúng tên bảng
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng kết quả
    }
}
