<?php
class detailModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connectDB();
    }
    function findProductById($id)
    {
        $sql = "select * from sanpham where id=$id";
        return $this->conn->query($sql)->fetch();
    }
    function getTotalQuantity($iduser)
    {
        $sql = "SELECT SUM(soluong) as total_quantity FROM giohang WHERE iduser = :iduser";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['iduser' => $iduser]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_quantity'] ?? 0; // Trả về 0 nếu không có sản phẩm trong giỏ
    }
    function getCommentById($id)
    {

        $sql = "select taikhoan.user, binhluan.rating,binhluan.noidung ,binhluan.ngaybinhluan from `binhluan`
                     join taikhoan on binhluan.iduser=taikhoan.id
                     where binhluan.idpro= '$id'
                     order by binhluan.ngaybinhluan desc";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function increaseViews($id)
    {
        // Câu lệnh SQL cập nhật lượt xem
        $sql = "UPDATE sanpham SET luotxem = luotxem + 1 WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
}
