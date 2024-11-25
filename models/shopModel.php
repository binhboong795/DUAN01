<?php
class shopModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    function allProductShop()
    {
        $sql = "select * from sanpham order by id desc";
        return $this->conn->query($sql);
    }
    function allDanhmuc()
    {
        $sql = "select * from danhmuc order by id desc";
        return $this->conn->query($sql);
    }
    function getTotalQuantity($iduser)
    {
        $sql = "SELECT SUM(soluong) as total_quantity FROM giohang WHERE iduser = :iduser";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['iduser' => $iduser]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_quantity'] ?? 0; // Trả về 0 nếu không có sản phẩm trong giỏ
    }
    function getPrice($minPrice, $maxPrice = null)
    {
        if ($maxPrice === null) {
            $sql = "SELECT * FROM sanpham WHERE price >= ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$minPrice]);
        } else {
            $sql = "SELECT * FROM sanpham WHERE price >= ? AND price <= ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$minPrice, $maxPrice]);
        }
        return $stmt->fetchAll();
    }
}
