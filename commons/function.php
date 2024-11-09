<?php
function connectDB(){
$host="mysql:host=localhost; dbname=web2014su24; charset=utf8";
$user="root";
$pass="abinhx00z";
try {
$conn = new PDO ($host, $user, $pass);
$conn->setAttribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
return $conn;
}catch (PDOException $e) {
echo $e->getMessage();
}
 }
?>