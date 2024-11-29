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
        // Kiểm tra nếu sản phẩm có trong cơ sở dữ liệu hay không
        $sqlCheck = "SELECT luotxem FROM sanpham WHERE id = :id";
        $stmtCheck = $this->conn->prepare($sqlCheck);
        $stmtCheck->execute(['id' => $id]);
        $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($result === false || $result['luotxem'] === null) {
            // Nếu sản phẩm chưa có giá trị luotxem, khởi tạo bằng 1
            $sqlInit = "UPDATE sanpham SET luotxem = 1 WHERE id = :id";
            $stmtInit = $this->conn->prepare($sqlInit);
            $stmtInit->execute(['id' => $id]);
        } else {
            // Nếu đã có, tăng thêm 1
            $sqlUpdate = "UPDATE sanpham SET luotxem = luotxem + 1 WHERE id = :id";
            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            $stmtUpdate->execute(['id' => $id]);
        }
    }
}
