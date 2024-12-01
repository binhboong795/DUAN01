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
        $sql = "SELECT * FROM sanpham ORDER BY id DESC";
        $stmt = $this->conn->query($sql); // Thực hiện truy vấn
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về kết quả dưới dạng mảng
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

    function findCate($id)
    {
        $sql = "SELECT soluong FROM sanpham where id= :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // function findProductByIddm($iddm)
    // {
    //     // Câu truy vấn SQL với tham số động
    //     $sql = "SELECT * FROM sanpham WHERE iddm = :iddm";

    //     // Chuẩn bị truy vấn
    //     $stmt = $this->conn->prepare($sql);

    //     // Thực thi truy vấn với tham số
    //     $stmt->execute([':iddm' => $iddm]);

    //     // Lấy kết quả
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
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
    function getProductbyDanhmuc($categoryId, $minPrice, $maxPrice = null)
    {
        if ($maxPrice === null) {
            $sql = "SELECT * FROM sanpham WHERE iddm = ? AND price >= ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$categoryId, $minPrice]);
        } else {
            $sql = "SELECT * FROM sanpham WHERE iddm = ? AND price >= ? AND price <= ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$categoryId, $minPrice, $maxPrice]);
        }
        return $stmt->fetchAll();
    }
}
