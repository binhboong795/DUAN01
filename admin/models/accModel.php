<?php
class accModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connectDB();
    }

    function getAllUser()
    {
        $sql = "SELECT * FROM taikhoan"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    function getIdUser($id)
    {
        $sql = "SELECT * FROM taikhoan where id = ?"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(); 
    }
    function insertUser($id, $user, $pass, $email, $address, $tell, $role)
    {
        $sql = "INSERT INTO taikhoan (id, user, pass, email, address, tell, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql); // Chuẩn bị truy vấn với PDO
        return $stmt->execute([$id, $user, $pass, $email, $address, $tell, $role]);
    }
    function editUser($id, $user, $pass, $email, $address, $tell, $role)
    {
        $sql = "UPDATE taikhoan SET user = ?, pass = ?, email = ?, address = ?, tell = ?, $role = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$user, $pass, $email, $address, $tell, $role, $id]);  
    }
    function deleteUser($id)
    {
        $sql = "DELETE FROM `taikhoan` where id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
