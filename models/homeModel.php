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
    function getCartItems($iduser, $idpro = null)
    {
        $result = [];
        $sql = "SELECT g.*, s.img, s.name, s.price 
            FROM giohang g 
            INNER JOIN sanpham s ON g.idpro = s.id 
            WHERE g.iduser = :iduser";

        if ($idpro !== null) {
            $sql .= " AND g.idpro = :idpro";
        }

        $stmt = $this->conn->prepare($sql);

        $params = ['iduser' => $iduser];
        if ($idpro !== null) {
            $params['idpro'] = $idpro;
        }

        $stmt->execute($params);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($items as $item) {
            $item['total_price'] = $item['price'] * $item['soluong'];
            $result[] = $item;
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


    // Lấy sản phẩm trong giỏ hàng của user theo id sản phẩm
    // function getCartItemByUserAndProduct($iduser, $idpro)
    // {
    //     $sql = "SELECT * FROM giohang WHERE iduser = :iduser AND idpro = :idpro";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute(['iduser' => $iduser, 'idpro' => $idpro]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    // Thêm sản phẩm mới vào giỏ hàng
    function insertCartItem($iduser, $idpro, $img, $name, $price, $soluong, $thanhtien, $idbill)
    {
        $sql = "INSERT INTO giohang (iduser, idpro, img, name, price, soluong, thanhtien, idbill) 
            VALUES (:iduser, :idpro, :img, :name, :price, :soluong, :thanhtien, :idbill)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'iduser' => $iduser,
            'idpro' => $idpro,
            'img' => $img,
            'name' => $name,
            'price' => $price,
            'soluong' => $soluong,
            'thanhtien' => $thanhtien,
            'idbill' => $idbill,
        ]);
    }

    // Cập nhật số lượng và tổng tiền sản phẩm trong giỏ hàng
    function updateCartItem($id, $soluong, $thanhtien)
    {
        $sql = "UPDATE giohang SET soluong = :soluong, thanhtien = :thanhtien WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'soluong' => $soluong,
            'thanhtien' => $thanhtien,
            'id' => $id,
        ]);
    }
    function deleteCartItem($iduser, $idpro)
    {
        $sql = "DELETE FROM giohang WHERE iduser = :iduser AND idpro = :idpro";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'iduser' => $iduser,
            'idpro' => $idpro,
        ]);
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
