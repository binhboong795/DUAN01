<?php
class contactModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connectDB();
    }
    function getAll()
    {
        $sql = "SELECT * FROM lienhe ORDER BY id desc";
        return $this->conn->query($sql);
    }
    function getId($id)
    {
        $sql = "SELECT * FROM lienhe WHERE id =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    function delete($id)
    {
        $sql = "DELETE FROM lienhe WHERE id =?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
    function update($name, $sdt, $mail, $noidung, $id)
    {
        $sql = "UPDATE lienhe SET name =?, sdt =?, mail =?, noidung =? WHERE id =?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name, $sdt, $mail, $noidung, $id]);
    }
}
