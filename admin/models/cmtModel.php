<?php
class cmtModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connectDB();
    }
    function getComment()
    {

        $sql = "select taikhoan.user ,
        binhluan.id as idbl, 
        binhluan.rating,
        binhluan.noidung ,
        binhluan.ngaybinhluan,
        sanpham.name as tensp,
        sanpham.id as idpro
         from `binhluan`
             join taikhoan on binhluan.iduser=taikhoan.id
             join sanpham on binhluan.idpro= sanpham.id
             order by sanpham.id, binhluan.ngaybinhluan desc";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }
    function deleteBl($id)
    {
        $sql = "DELETE FROM `binhluan` where id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
