<?php
class danhmucModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connectDB();
    }
}
