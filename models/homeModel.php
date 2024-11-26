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
        $sql = "SELECT * FROM sanpham order by id desc";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Đảm bảo dữ liệu là mảng
    }
    function allDanhmuc()
    {
        $sql = "select * from danhmuc order by id desc";
        return $this->conn->query($sql);
    }

    function findProductById($id)
    {
        $sql = "select * from sanpham where id=$id";
        return $this->conn->query($sql)->fetch();
    }

    function findProductByIddm($iddm)
    {
        // Câu truy vấn SQL với tham số động
        $sql = "SELECT * FROM sanpham WHERE iddm = :iddm";

        // Chuẩn bị truy vấn
        $stmt = $this->conn->prepare($sql);

        // Thực thi truy vấn với tham số
        $stmt->execute([':iddm' => $iddm]);

        // Lấy kết quả
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function insertUser($id, $user, $pass, $email, $address, $tell)
    {
        $sql = "INSERT INTO taikhoan (id, user, pass, email, address, tell) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql); // Chuẩn bị truy vấn với PDO
        return $stmt->execute([$id, $user, $pass, $email, $address, $tell]);
    }

    function checkAcc($user, $pass)
    {
        $sql = "SELECT * FROM taikhoan WHERE user = :user AND pass = :pass";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        return $stmt->fetch();  // Trả về dữ liệu người dùng nếu có
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
    // function deleteCartUser($iduser)
    // {
    //     $sql = "DELETE * FROM giohang WHERE iduser = :iduser";
    //     $stmt = $this->conn->prepare($sql);
    //     return $stmt->execute([
    //         'iduser' => $iduser,
    //     ]);
    // }
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
    function calculateTotalPrice($iduser)
    {
        $sql = "SELECT SUM(thanhtien) as total_price_all FROM giohang WHERE iduser = :iduser";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['iduser' => $iduser]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_price_all'] ?? 0; // Nếu không có sản phẩm thì trả về 0
    }

    function insertOrder($id, $id_user, $bill_name, $bill_address, $bill_tell, $bill_email, $bill_pttt, $ngaydathang, $idbill)
    {
        $sql = "INSERT INTO trangthai (id,id_user, bill_name, bill_address, bill_tell, bill_email, bill_pttt, ngaydathang,id_bill) VALUES (?,?, ?, ?, ?, ?, ?, ?,?)";
        $stmt = $this->conn->prepare($sql); // Chuẩn bị truy vấn với PDO
        return $stmt->execute([$id, $id_user, $bill_name, $bill_address, $bill_tell, $bill_email, $bill_pttt, $ngaydathang, $idbill]);
    }


    function chackcart($iduser)
    {
        // Kiểm tra $iduser có giá trị hợp lệ
        if (!$iduser) {
            return []; // Nếu không có iduser, trả về mảng rỗng
        }

        $sql = "SELECT id, idpro, img, name, price, soluong, thanhtien, idbill 
                FROM giohang
                WHERE iduser = :iduser";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['iduser' => $iduser]);

        // Kiểm tra xem có kết quả không
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($cartItems)) {
            return []; // Nếu không có sản phẩm trong giỏ, trả về mảng rỗng
        }

        return $cartItems;
    }

    function deleteAllCart($iduser)
    {
        $sql = "DELETE FROM giohang WHERE iduser = :iduser";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['iduser' => $iduser]);
    }



    function insertdonhang($idorder, $iduser, $id_pro, $img, $name, $price, $soluong, $thanhtien, $idbill)
    {
        $sql = "INSERT INTO orders (idorder, iduser, id_pro, img, name, price, soluong, thanhtien, idbill) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql); // Chuẩn bị truy vấn với PDO
        return $stmt->execute([$idorder, $iduser, $id_pro, $img, $name, $price, $soluong, $thanhtien, $idbill]);
    }

    function getOrder($iduser)
    {
        $sql = "SELECT * FROM `orders` where iduser = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$iduser]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getAllBanner()
    {
        $sql = "SELECT * FROM banner";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function getPopularProducts($threshold = 100)
    {
        $sql = "SELECT * FROM sanpham WHERE luotxem > :threshold ORDER BY luotxem DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['threshold' => $threshold]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // function getTotalQuantityOrder($iduser)
    // {
    //     $sql = "SELECT SUM(soluong) as total_quantity FROM chitietdonhang WHERE iduser = :iduser";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute(['iduser' => $iduser]);
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return $result['total_quantity'] ?? 0; // Trả về 0 nếu không có sản phẩm trong giỏ
    // }
    // function calculateTotalPriceOrder($iduser)
    // {
    //     $sql = "SELECT SUM(thanhtien) as total_price_all FROM chitietdonhang WHERE iduser = :iduser";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute(['iduser' => $iduser]);
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return $result['total_price_all'] ?? 0; // Nếu không có sản phẩm thì trả về 0
    // }
    function getBillStatus($iduser)
    {
        $sql = "SELECT bill_status FROM trangthai WHERE id_user = :iduser";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['iduser' => $iduser]);

        // Kiểm tra nếu có kết quả, trả về mảng với các trạng thái
        return $stmt->fetchAll(PDO::FETCH_COLUMN) ?: [];
    }
}
