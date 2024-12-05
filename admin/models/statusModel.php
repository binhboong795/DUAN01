<?php
class statusModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connectDB();
    }
    function getAllStatus()
    {
        $sql = "SELECT * FROM trangthai ORDER BY id desc";
        return $this->conn->query($sql);
    }
    function deleteStatus($id)
    {
        $sql = "DELETE FROM trangthai WHERE id = $id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    function updatePaymentMethod($idbill, $bill_status)
    {
        $sql = "UPDATE trangthai SET bill_status = :bill_status WHERE id_bill = :idbill";  // Đảm bảo tên cột là id_bill
        $stmt = $this->conn->prepare($sql);

        // Gắn tham số vào câu lệnh
        $stmt->bindValue(':bill_status', $bill_status, PDO::PARAM_STR);
        $stmt->bindValue(':idbill', $idbill, PDO::PARAM_INT);  // Sử dụng idbill thay vì id

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        } else {
            die("Lỗi thực thi câu lệnh: " . implode(", ", $stmt->errorInfo()));
        }
    }

    // function updateIdBillInTrangthai()
    // {
    //     $sql = "UPDATE trangthai AS t
    //         JOIN orders AS o ON t.id_user = o.iduser
    //         SET t.idbill = o.idbill
    //         WHERE t.idbill IS NULL";

    //     $stmt = $this->conn->prepare($sql);
    //     return $stmt->execute();
    // }
    function getCurrentStatusById($id)
    {
        $sql = "SELECT bill_status FROM trangthai WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchColumn(); // Lấy giá trị của `bill_status`
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
    function getDataForThongKe($idbill)
    {
        // Lấy dữ liệu từ bảng orders và kết hợp với bảng trangthai để lấy bill_name
        $sql = "SELECT o.idbill, o.iduser, t.bill_name AS tk_nameuser, o.name AS tk_namepro, o.soluong AS tk_soluong, o.thanhtien AS tk_thanhtien, t.bill_status
            FROM orders o
            JOIN trangthai t ON o.idbill = t.id_bill
            WHERE o.idbill = :idbill";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idbill' => $idbill]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về dữ liệu dưới dạng mảng
    }


    function getIdBillById($id)
    {
        $sql = "SELECT id_bill FROM trangthai WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchColumn(); // Lấy giá trị cột `id_bill`
    }

    function getOrderByIdBill($idbill)
    {
        $sql = "SELECT * FROM orders WHERE idbill = :idbill";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idbill' => $idbill]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách dữ liệu
    }
    function getStatusByIdBill($idbill)
    {
        $sql = "SELECT * FROM trangthai WHERE id_bill = :idbill";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idbill' => $idbill]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về một bản ghi
    }

    // function moveToThongKe($data)
    // {
    //     // echo "<pre>";
    //     // print_r($data);
    //     // echo "</pre>";
    //     // exit();

    //     $sql = "INSERT INTO thongke (tk_idbill, tk_iduser, tk_nameuser, tk_namepro, tk_soluong, tk_thanhtien, tk_status)
    //             VALUES (:tk_idbill, :tk_iduser, :tk_nameuser, :tk_namepro, :tk_soluong, :tk_thanhtien, :tk_status)";
    //     $stmt = $this->conn->prepare($sql);

    //     foreach ($data as $row) {
    //         try {
    //             $stmt->execute([
    //                 'tk_idbill' => $row['tk_idbill'],
    //                 'tk_iduser' => $row['tk_iduser'],
    //                 'tk_nameuser' => $row['tk_nameuser'],
    //                 'tk_namepro' => $row['tk_namepro'],
    //                 'tk_soluong' => $row['tk_soluong'],
    //                 'tk_thanhtien' => $row['tk_thanhtien'],
    //                 'tk_status' => $row['tk_status'],
    //             ]);
    //         } catch (PDOException $e) {
    //             error_log("Lỗi khi thêm vào bảng thongke: " . $e->getMessage());
    //             throw $e;
    //         }
    //     }
    // }
    function moveToThongKe($data)
    {
        // Câu lệnh SQL để thêm dữ liệu vào bảng thongke
        $sql = "INSERT INTO thongke (tk_idbill, tk_iduser, tk_nameuser, tk_namepro, tk_soluong, tk_thanhtien, tk_status)
            VALUES (:tk_idbill, :tk_iduser, :tk_nameuser, :tk_namepro, :tk_soluong, :tk_thanhtien, :tk_status)";

        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($sql);

        // Lặp qua mỗi dòng dữ liệu trong $data và chèn vào bảng thongke
        foreach ($data as $row) {
            // Gắn giá trị vào câu lệnh SQL
            $stmt->execute([
                'tk_idbill' => $row['idbill'],              // ID hóa đơn
                'tk_iduser' => $row['iduser'],              // ID người dùng
                'tk_nameuser' => $row['tk_nameuser'],       // Tên người dùng lấy từ bảng trangthai (bill_name)
                'tk_namepro' => $row['tk_namepro'],         // Tên sản phẩm
                'tk_soluong' => $row['tk_soluong'],         // Số lượng sản phẩm
                'tk_thanhtien' => $row['tk_thanhtien'],     // Thành tiền
                'tk_status' => $row['bill_status']          // Trạng thái đơn hàng
            ]);
        }
    }


    function deleteBillFromTrangThai($idbill)
    {
        $sql = "DELETE FROM trangthai WHERE id_bill = :idbill";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idbill' => $idbill]);
    }

    function deleteBillFromOrders($idbill)
    {
        $sql = "DELETE FROM orders WHERE idbill = :idbill";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idbill' => $idbill]);
    }
}
