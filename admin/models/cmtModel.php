<?php
class cmtModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connectDB();
    }
}
