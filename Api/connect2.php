<?php
$host="Localhost";
$pass="";
$user="root";
$db="exen-limited";

try{
    $conn = new PDO("mysql :host =$host;db=$db",$user ,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "connection failed:" . $e->getMessage();
}