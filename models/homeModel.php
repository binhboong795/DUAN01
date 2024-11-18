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

        $sql = "select * from taikhoan where user='$user' and pass='$pass'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    function insertComment($id, $noidung, $iduser, $idpro, $ngaybinhluan, $rating)
    {
        $sql = "INSERT INTO `binhluan`(id, noidung, iduser, idpro, ngaybinhluan,rating) VALUES (?, ?, ?, ?,?,?)";
        $stmt = $this->conn->prepare($sql); // Chuẩn bị truy vấn với PDO
        return $stmt->execute([$id, $noidung, $iduser, $idpro, $ngaybinhluan, $rating]);
    }

    function checkEmailExists($email)
    {
        $sql = "SELECT COUNT(*) FROM taikhoan WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();
        return $count > 0; // Trả về true nếu tồn tại, false nếu không
    }

    function updatePassword($email, $pass)
    {
        $sql = "UPDATE taikhoan SET pass = ? WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$pass, $email]);
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

    // Lấy danh sách sản phẩm trong giỏ hàng từ session
    function getCartItems($cart)
    {
        $result = [];
        foreach ($cart as $id => $quantity) {
            $sql = "SELECT * FROM sanpham WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($product) {
                $product['quantity'] = $quantity;
                $product['total_price'] = $product['price'] * $quantity;
                $result[] = $product;
            }
        }
        return $result;
    }

    // Tính tổng giá trị giỏ hàng
    function calculateCartTotal($cart)
    {
        $total = 0;
        foreach ($cart as $id => $quantity) {
            $sql = "SELECT price FROM sanpham WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($product) {
                $total += $product['price'] * $quantity;
            }
        }
        return $total;
    }
}
