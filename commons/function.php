<?php

function connectDB()
{

    $host = "mysql:host=localhost; dbname=duan_01; charset=utf8";

    $user = "root";
    $pass = "";
    try {
        $conn = new PDO($host, $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
