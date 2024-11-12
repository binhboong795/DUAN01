<?php
class userModel{
    public $conn;
    function __construct(){
        $this->conn=connectDB();
    }
    function insertUser($id, $user, $pass, $email) {
        $sql = "INSERT INTO `taikhoan` (id, user, pass, email) VALUES (?, ?, ?, ?)";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id, $user, $pass, $email]);
    }
    function login() {
        $sql = "SELECT * FROM `taikhoan`";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
}
?>