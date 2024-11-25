<?php
class bannerModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connectDB();
    }
    function getAllBanner()
    {
        $sql = "SELECT * FROM banner";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function getIdBanner($id)
    {
        $sql = "SELECT * FROM banner WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();  // return the row that matches the given id
    }
    function insertBanner($name, $img)
    {
        $sql = "INSERT INTO banner VALUES (null, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name, $img]);
    }
    function updateBanner($id, $name, $img)
    {
        $sql = "UPDATE banner SET name = ?, img = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name, $img, $id]);
    }

    function delete($id)
    {
        $sql = "DELETE FROM banner WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
