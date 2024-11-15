<?php
class homeModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connectDB();
    }
    function allProduct()
    {
        $sql = "select * from sanpham order by id desc";
        return $this->conn->query($sql);
    }
    // function top3Product() {
    // $sql="select * from product order by pro_id desc limit 3";
    // return $this->conn->query($sql);
    // }
    // function findProductById($id) {
    // $sql="select * from sanpham where id=$id";
    // return $this->conn->query($sql)->fetch();
    // }
    function allProductShop()
    {
        $sql = "select * from sanpham order by id desc";
        return $this->conn->query($sql);
    }
    function findProductById($id)
    {
        $sql = "select * from sanpham where id=$id";
        return $this->conn->query($sql)->fetch();
    }
    function insertUser($id, $user, $pass, $email)
    {
        $sql = "INSERT INTO taikhoan (id, user, pass, email) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql); // Chuẩn bị truy vấn với PDO
        return $stmt->execute([$id, $user, $pass, $email]);
    }

    function checkAcc($user, $pass)
    {
        $pass = $pass;
        $sql = "select * from taikhoan where user='$user' and pass='$pass'";
        return $this->conn->query($sql)->rowCount();
    }

    function checkEmail($email)
    {
        $sql = "SELECT * FROM taikhoan WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();
        return $count > 0; // Trả về true nếu tồn tại, false nếu không
    }


    function newpass($email, $pass)
    {
        $sql = "UPDATE taikhoan SET pass = ? WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$email, $pass]);
    }
}
