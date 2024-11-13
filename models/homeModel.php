<?php
    class homeModel{
        public $conn;
        function __construct() {
        $this->conn=connectDB();
        }
        function allProduct() {
        $sql="select * from sanpham order by id desc";
        return $this->conn->query($sql);
        }
        // function top3Product() {
        // $sql="select * from product order by pro_id desc limit 3";
        // return $this->conn->query($sql);
        // }
        // function findProductById($id) {
        // $sql="select * from sanpham where id=$id";
        // return $this->conn->query($sql)->fetch();
        // }
        function allProductShop() {
        $sql="select * from sanpham order by id desc";
        return $this->conn->query($sql);
        }
        function findProductById($id) {
        $sql="select * from sanpham where id=$id";
        return $this->conn->query($sql)->fetch();
        }
    }
?>