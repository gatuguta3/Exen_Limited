<?php
include 'php_files\connect.php';
$id=$_POST('Cust_Id');
$sql2="SELECT * FROM customer_details WHERE Cust_id='$id'";
$query = mysqli_query($conn,$sql2);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);