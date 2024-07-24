<?php
include 'Connect.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json; charset=utf-8');


 $query = "SELECT * FROM products";
 $result = mysqli_query($conn, $query);
 
 $products = [];
 while ($row = mysqli_fetch_array($result)) {
     $products[] = $row;
 }
 
 echo json_encode($products);