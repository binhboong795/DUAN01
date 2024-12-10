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
    function insertCartItem($iduser, $idpro, $img, $name, $price, $soluong, $thanhtien)
    {
        $sql = "INSERT INTO giohang (iduser, idpro, img, name, price, soluong, thanhtien) 
            VALUES (:iduser, :idpro, :img, :name, :price, :soluong, :thanhtien)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'iduser' => $iduser,
            'idpro' => $idpro,
            'img' => $img,
            'name' => $name,
            'price' => $price,
            'soluong' => $soluong,
            'thanhtien' => $thanhtien,

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
    function updateProductQuantity($idpro, $quantity)
    {
        // echo "<pre>";
        // print_r($idpro);
        // echo "</pre>";
        // exit;


        // Giảm số lượng sản phẩm trong bảng sanpham
        $sql = "UPDATE sanpham SET soluong = soluong - :quantity WHERE id = :idpro";
        $stmt = $this->conn->prepare($sql);

        // Gắn giá trị vào câu lệnh
        $stmt->bindValue(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindValue(':idpro', $idpro, PDO::PARAM_INT);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        } else {
            die("Lỗi thực thi câu lệnh: " . implode(", ", $stmt->errorInfo()));
        }
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

    function insertdonhang($id, $iduser, $id_pro, $img, $name, $price, $soluong, $thanhtien, $idbill)
    {
        $sql = "INSERT INTO orders (id, iduser, id_pro, img, name, price, soluong, thanhtien, idbill) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql); // Chuẩn bị truy vấn với PDO
        return $stmt->execute([$id, $iduser, $id_pro, $img, $name, $price, $soluong, $thanhtien, $idbill]);
    }

    function getOrder($iduser)
    {
        $sql = "SELECT * FROM `orders` where iduser = ? ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$iduser]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getOrderByBill($idbill)
    {
        $sql = "SELECT * FROM `orders` WHERE idbill = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idbill]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // function getOrderByBills($id)
    // {
    //     $sql = "SELECT * FROM `orders` WHERE idbill = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute([$idbill]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }


    function getAllBanner()
    {
        $sql = "SELECT * FROM banner";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function getPopularProducts($luotxem = 200)
    {
        $sql = "SELECT * FROM sanpham WHERE luotxem > :luotxem ORDER BY luotxem DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['luotxem' => $luotxem]);
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
    function getBillStatusById($id_bill)
    {
        $sql = "SELECT bill_status FROM trangthai WHERE id_bill = :id_bill";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id_bill' => $id_bill]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Lấy một hàng duy nhất
    }


    function getOrderStatusesById($iduser)
    {
        $sql = "SELECT o.idbill, t.bill_status
                FROM `orders` AS o
                LEFT JOIN trangthai AS t ON o.idbill = t.id
                WHERE o.iduser = :iduser";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['iduser' => $iduser]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function updateBillStatus($idbill, $status)
    {
        $sql = "UPDATE trangthai SET bill_status = :status WHERE id_bill = :idbill";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt->execute([
            'status' => $status,
            'idbill' => $idbill
        ])) {
            // Nếu có lỗi, in ra thông tin
            error_log("SQL Error: " . json_encode($stmt->errorInfo()));
        } else {
            error_log("Bill status updated for ID Bill: $idbill");
        }
    }



    function getInfoStatus($idbill)
    {
        $sql = "SELECT bill_name,bill_address,bill_tell,bill_email,bill_pttt,ngaydathang,id_bill FROM trangthai WHERE id_bill = :idbill";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':idbill' => $idbill]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Lấy một hàng duy nhất
    }


    function insertHuydon($id, $name, $id_user, $idbill, $ngayhuy, $lido, $other_lido)
    {
        $sql = "INSERT INTO huydonhang (id, name, id_user, idbill, ngayhuy, lido, other_lido) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id, $name, $id_user, $idbill, $ngayhuy, $lido, $other_lido]);
    }
    // Lấy thông tin các sản phẩm trong đơn hàng
    function getOrderItemsByIdBill($idbill)
    {
        $sql = "SELECT id_pro, soluong FROM orders WHERE idbill = :idbill";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idbill' => $idbill]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cập nhật lại số lượng sản phẩm trong bảng sanpham khi hủy đơn hàng
    function restoreProductQuantity($id_pro, $quantity)
    {
        try {
            // Kiểm tra số lượng sản phẩm cần phục hồi có hợp lệ không
            if ($quantity <= 0) {
                throw new Exception("Số lượng phục hồi phải lớn hơn 0.");
            }

            // Câu lệnh SQL để cập nhật lại số lượng sản phẩm trong bảng sanpham
            $sql = "UPDATE sanpham SET soluong = soluong + :quantity WHERE id = :id_pro";
            $stmt = $this->conn->prepare($sql);

            // Gắn giá trị vào câu lệnh SQL
            $stmt->bindValue(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindValue(':id_pro', $id_pro, PDO::PARAM_INT);

            // Thực thi câu lệnh SQL
            $stmt->execute();

            // Kiểm tra nếu không có dòng nào bị ảnh hưởng, có thể là id sản phẩm không tồn tại
            if ($stmt->rowCount() === 0) {
                throw new Exception("Không tìm thấy sản phẩm với ID $id_pro.");
            }

            // Trả về true nếu thành công
            return true;
        } catch (Exception $e) {
            // Xử lý lỗi và trả về thông báo lỗi
            error_log("Lỗi khi phục hồi số lượng sản phẩm: " . $e->getMessage()); // Ghi log lỗi
            return false; // Trả về false nếu có lỗi
        }
    }


    public function checkIdBillExists($idbill)
    {
        $sql = "SELECT COUNT(*) as count FROM orders WHERE idbill = :idbill";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idbill' => $idbill]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
    function deleteOrder($idbill)
    {
        $sql = "DELETE FROM orders WHERE idbill = :idbill";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['idbill' => $idbill]);
    }

    // Xóa trạng thái khỏi bảng trangthai
    function deleteStatus($id_bill)
    {
        $sql = "DELETE FROM trangthai WHERE id_bill = :id_bill";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id_bill' => $id_bill]);
    }
    function getIdBillByUser($iduser)
    {
        $sql = "SELECT idbill FROM orders WHERE iduser = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$iduser]);
        return $stmt->fetchColumn();
    }
    function getIdNameStatus($id_user)
    {
        $sql = "SELECT bill_name FROM trangthai WHERE id_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_user]);
        return $stmt->fetchColumn();
    }

    function insertLienhe($iduser, $name, $sdt, $mail, $noidung)
    {
        $sql = "INSERT INTO lienhe VALUES (null, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql); // Chuẩn bị truy vấn với PDO
        return $stmt->execute([$iduser, $name, $sdt, $mail, $noidung]);
    }
    function updateIdBillInTrangthai($id_bill)
    {
        $sql = "UPDATE trangthai 
            SET id_bill = :id_bill 
            ";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([

            'id_bill' => $id_bill
        ]);
    }
    function deleteBill($idbill)
    {
        try {
            // Xóa dữ liệu trong bảng chi tiết đơn hàng trước
            $sqlDetails = "DELETE FROM orders WHERE idbill = :idbill";
            $stmtDetails = $this->conn->prepare($sqlDetails);
            $stmtDetails->execute(['idbill' => $idbill]);

            // Xóa dữ liệu trong bảng trạng thái (nếu có)
            $sqlStatus = "DELETE FROM trangthai WHERE id_bill = :idbill";
            $stmtStatus = $this->conn->prepare($sqlStatus);
            $stmtStatus->execute(['idbill' => $idbill]);

            // Xóa dữ liệu trong bảng đơn hàng
            // $sqlBill = "DELETE FROM donhang WHERE idbill = :idbill";
            // $stmtBill = $this->conn->prepare($sqlBill);
            // $stmtBill->execute(['idbill' => $idbill]);
        } catch (PDOException $e) {
            error_log("Error deleting bill: " . $e->getMessage());
            throw $e; // Ném lỗi để xử lý thêm nếu cần
        }
    }
}
