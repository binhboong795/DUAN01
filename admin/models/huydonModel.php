<?php
class huydonModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connectDB();
    }

    function getAlldonhang()
    {
        $sql = "SELECT * FROM huydonhang";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function deletedonhang($id)
    {
        $sql = "DELETE FROM `huydonhang` where id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
