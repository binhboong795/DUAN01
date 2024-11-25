<?php
class sanphamModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connectDB();
    }
}
