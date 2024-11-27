<?php
class sanphamModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connectDB();
    }
    function getAllSP()
    {
        $sql = "SELECT * FROM sanpham"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    function insertProduct($id, $name, $price, $img, $mota, $luotxem, $iddm, $motachitiet, $soluong)
    {
        $sql = "INSERT INTO taikhoan (id, name, price, img, mota, luotxem, iddm, motachitiet, soluong) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql); // Chuẩn bị truy vấn với PDO
        return $stmt->execute([$id, $name, $price, $img, $mota, $luotxem, $iddm, $motachitiet, $soluong]);
    }
    // function getIdUser($id)
    // {
    //     $sql = "SELECT * FROM taikhoan where id = ?"; 
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute([$id]);
    //     return $stmt->fetch(); 
    // }
    // function editUser($id, $user, $pass, $email, $address, $tell, $role)
    // {
    //     $sql = "UPDATE taikhoan SET user = ?, pass = ?, email = ?, address = ?, tell = ?, $role = ? WHERE id = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     return $stmt->execute([$user, $pass, $email, $address, $tell, $role, $id]);  
    // }
    function deleteUser($id)
    {
        $sql = "DELETE FROM `taikhoan` where id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
