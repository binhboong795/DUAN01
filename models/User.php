<?php
    require_once 'ConnectDatabase.php';
    class User {
        public $connect;
        public function __construct()
        {
            $this->connect = new ConnectDatabase();
        }

        public function insertUser($id, $user, $pass, $email) {
            $sql = "INSERT INTO `taikhoan` (id, user, pass, email) VALUES (?, ?, ?, ?)";
            $this->connect->setQuery($sql);
            return $this->connect->loadData([$id, $user, $pass, $email]);
        }
        
        public function login() {
            $sql = "SELECT * FROM `taikhoan`";
            $this->connect->setQuery($sql);
            return $this->connect->loadData();
        }
    }
?>