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
    function editUser($id, $user, $pass, $email, $address, $tell)
    {
        $sql = "UPDATE taikhoan SET user = ?, pass = ?, email = ?, address = ?, tell = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$user, $pass, $email, $address, $tell, $id]);  
    }
    function deleteUser($id)
    {
        $sql = "DELETE FROM `taikhoan` where id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
