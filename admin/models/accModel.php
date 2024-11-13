<?php
class accModel{
    public $conn;
    function __construct(){
        $this->conn=connectDB();
    }
    function checkAcc($user, $pass){
        $pass=sha1($pass);
        $sql="select * from acc where user='$user' and pass='$pass'";
        return $this->conn->query($sql)->rowCount();
    }
}
?>