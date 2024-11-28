<?php
class danhmucModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connectDB();
    }
    function getAllDanhmuc(){
        $sql = "SELECT * FROM danhmuc"; // Đảm bảo đúng tên bảng
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function deleteDanhmuc($id){
        $sql = "DELETE FROM `danhmuc` where id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
    function addDanhmuc($name){
        $sql = "INSERT INTO danhmuc VALUES (null, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name]);
    }
    function getIdDanhmuc($id)
    {
        $sql = "SELECT * FROM danhmuc WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();  // return the row that matches the given id
    }
    function updateDanhmuc($id,$name){
        $sql = "UPDATE danhmuc SET name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name,$id]);
    }
}
