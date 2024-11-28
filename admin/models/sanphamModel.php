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
    function getIdProduct($id)
    {
        $sql = "SELECT * FROM sanpham WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();  // return the row that matches the given id
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
    // Cập nhât
    function editsp($id, $name, $price, $img, $mota, $luotxem, $motachitiet, $soluong)
    {


        // Câu lệnh SQL
        $sql = "UPDATE sanpham 
                SET name = ?, price = ?, img = ?, mota = ?, luotxem = ?, motachitiet = ?, soluong = ? 
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        // Thực thi và kiểm tra lỗi
        if (!$stmt->execute([$name, $price, $img, $mota, $luotxem, $motachitiet, $soluong, $id])) {
            // In lỗi ra màn hình nếu có
            error_log(print_r($stmt->errorInfo(), true)); // Ghi log lỗi
            return false;
        }
        return true;
    }
    function delete($id)
    {
        $sql = "DELETE FROM sanpham WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
