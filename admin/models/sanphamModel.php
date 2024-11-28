<?php
class sanphamModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connectDB();
    }
    function allProduct()
    {
        $sql = "SELECT * from sanpham";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function getProductById($id)
    {
        $sql = "SELECT * FROM sanpham WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về thông tin sản phẩm
    }

    // Thêm sản phẩm
    function add($name, $price, $img, $mota, $luotxem, $iddm, $motachitiet, $soluong)
    {
        // Kiểm tra iddm có tồn tại trong bảng danhmuc
        $checkStmt = $this->conn->prepare("SELECT COUNT(*) FROM danhmuc WHERE id = ?");
        $checkStmt->execute([$iddm]);
        $exists = $checkStmt->fetchColumn();

        if ($exists == 0) {
            die("Lỗi: Danh mục không tồn tại.");
        }

        // Nếu iddm hợp lệ, thực hiện thêm dữ liệu vào bảng sanpham
        $sql = "INSERT INTO `sanpham` (name, price, img, mota, luotxem, iddm, motachitiet, soluong) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name, $price, $img, $mota, $luotxem, $iddm, $motachitiet, $soluong]);
    }
    function editsp($id, $name, $price, $img, $mota, $luotxem, $iddm, $motachitiet, $soluong)
    {
        $sql = "UPDATE sanpham 
            SET name = ?, 
                price = ?, 
                img = ?, 
                mota = ?, 
                luotxem = ?, 
                iddm = ?, 
                motachitiet = ?, 
                soluong = ? 
            WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        try {
            return $stmt->execute([$name, $price, $img, $mota, $luotxem, $iddm, $motachitiet, $soluong, $id]);
        } catch (PDOException $e) {
            // Log lỗi hoặc thông báo ra màn hình
            echo "Lỗi SQL: " . $e->getMessage();
            return false;
        }
    }



    function delete($id)
    {
        $sql = "DELETE FROM sanpham WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
